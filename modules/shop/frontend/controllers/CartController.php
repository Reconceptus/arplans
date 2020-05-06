<?php

namespace modules\shop\frontend\controllers;


use common\models\Config;
use common\models\User;
use modules\shop\models\Cart;
use modules\shop\models\Order;
use modules\shop\models\Promocode;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;

class CartController extends Controller
{
    /**
     * Вывод корзины
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionIndex()
    {
        $guid = Cart::setGuid();
        $models = Cart::find()->where(['guid' => $guid])->all();
        $user = null;
        if (!Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity;
        }

        return $this->render('index', [
            'models' => $models,
            'user'   => $user
        ]);
    }

    /**
     * Добавляем товар в корзину
     * @return array
     * @throws \yii\base\Exception
     */
    public function actionAdd()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $get = \Yii::$app->request->get();
        $message = 'Ошибка добавления товара';
        $status = 'success';
        if (isset($get['id'])) {
            $cookies = Yii::$app->request->cookies;
            $guid = $cookies->getValue('cart', null);
            if (!$guid) {
                $guid = Yii::$app->security->generateRandomString();
                Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name'  => 'cart',
                    'value' => $guid
                ]));
            }
            if (Yii::$app->user->isGuest) {
                $guid = Cart::setGuid(false);
                $cart = Cart::find()->where(['guid' => $guid, 'item_id' => $get['id']])->one();
            } else {
                $cart = Cart::find()->where(['user_id' => \Yii::$app->user->id, 'item_id' => $get['id']])->one();
            }
            if ($cart) {
                $status = 'fail';
                $message = 'Этот товар уже у вас в корзине';
            } else {
                $cart = new Cart();
                $cart->user_id = \Yii::$app->user->id;
                $cart->item_id = $get['id'];
                $cart->guid = $guid;
                $cart->count = 1;
                if ($cart->save()) {
                    $status = 'success';
                    $message = 'Товар добавлен в корзину';
                } else {
                    $d = $cart->errors;
                    echo $d;
                }
            }
        } else {
            $status = 'fail';
        }
        return ['status' => $status, 'message' => $message];
    }

    /**
     * Удаляем товар из корзины
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $get = \Yii::$app->request->get();
        if (isset($get['id'])) {
            $model = Cart::findOne(['id' => intval($get['id'])]);
            if ($model) {
                $model->delete();
                return ['status' => 'success'];
            }
        }
        return ['status' => 'fail'];
    }

    /**
     * @return array
     * @throws \yii\base\Exception
     */
    public function actionOrder()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        $info = ArrayHelper::getValue($get, 'info');
        $email = ArrayHelper::getValue($info, 'email');
        if (Yii::$app->user->isGuest && User::findOne(['email' => $email])) {
            return [
                'status'  => 'fail',
                'message' => 'Пользователь с таким email уже зарегистрирован, войдите и повторите заказ. Все товары останутся в вашей корзине<br/> <a href="/site/login" style="color:blue">Войти</a>'
            ];
        }
        $amount = 0;
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            if (Yii::$app->user->isGuest) {
                $password = Yii::$app->security->generateRandomString(8);
                $user = User::createUser($info['email'], $password, $info['fio'], $info['phone'], $info['country'], $info['city'], $info['address']);
                User::sendRegLetter($user, $password);
            } else {
                $user = Yii::$app->user->identity;
            }
            if ($user) {
                $order = Order::createOrder($info['fio'], $user, $info['email'], $info['phone'], $info['country'], $info['city'], $info['address'],
                    $info['village']);
                if ($order) {
                    $amount += $order->addItems($get['items']);
                }
                $order->price = $amount;
                $code = ArrayHelper::getValue($info, 'promocode');
                if ($code) {
                    $date = date('Y-m-d');
                    $promocode = Promocode::find()->where(['code' => $code, 'status' => Promocode::STATUS_ACTIVE])
                        ->andWhere(['<=', 'start_date', $date])->andWhere(['>=', 'end_date', $date])
                        ->andWhere('`number_of_uses`>`used`')->one();
                    /* @var $promocode Promocode */
                    if ($promocode) {
                        if ($order->price > $promocode->min_amount) {
                            if ($promocode->fixed_discount) {
                                $order->price_after_promocode = $order->price - $promocode->fixed_discount;
                            } else {
                                $order->price_after_promocode = $order->price - ($order->price / 100 * $promocode->percent_discount);
                            }
                            $order->promocode_id = $promocode->id;
                            $promocode->used = ++$promocode->used;
                            if ($promocode->used >= $promocode->number_of_uses) {
                                $promocode->status = Promocode::STATUS_DISABLED;
                            }
                            $promocode->save();
                            $order->updateItemsWithPromocode($promocode);
                        }
                    } else {
                        $order->price_after_promocode = $amount;
                    }
                }
                if ($order->save()) {
                    Cart::clearUserCart($user->id);
                    $transaction->commit();
                    $mail = Yii::$app->mailer->compose('new-order', ['model' => $order]);
                    $mail->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name]);
                    $mail->setTo($order->email);
                    $mail->setBcc(Config::getValue('requestEmail'));
                    $mail->setSubject('Новый заказ на сайте '.Yii::$app->request->getHostInfo());
                    $mail->send();
                    return ['status' => 'success', 'orderId' => $order->id];
                }
                Yii::info(Json::encode($order->getErrorSummary(true)));
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            return ['status' => 'fail'];
        }
    }

    /**
     * Меняет количество альбомов у товара в заказе
     * @return array
     */
    public function actionChange()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        $albumPrice = Config::getValue('albumPrice');
        $id = (int) ArrayHelper::getValue($get, 'id');
        $count = (int) ArrayHelper::getValue($get, 'count');
        if ($id && $count) {
            $model = Cart::findOne(['id' => $id]);
            if ($model) {
                if ($count >= 1) {
                    $model->count = $count;
                } else {
                    $model->count = 1;
                }
                if ($model->save()) {
                    return ['status' => 'success', 'count' => $model->count, 'price' => $model->getLotPrice($albumPrice)];
                }
            }
        }
        return ['status' => 'fail', 'message' => 'Ошибка при попытке изменить количество'];
    }

    /**
     * @return array|string[]
     */
    public function actionPromocode()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $code = Yii::$app->request->get('code');
        $date = date('Y-m-d');
        $code = Promocode::find()->where(['code' => $code, 'status' => Promocode::STATUS_ACTIVE])
            ->andWhere(['<=', 'start_date', $date])->andWhere(['>=', 'end_date', $date])
            ->andWhere('`number_of_uses`>`used`')->one();
        /* @var $code Promocode */
        if ($code) {
            $type = $code->fixed_discount > 0 ? 1 : 2;
            $discount = (int) $code->fixed_discount > 0 ? $code->fixed_discount : $code->percent_discount;
            return [
                'status'   => 'success', 'discount' => $discount, 'type' => $type, 'minimal' => $code->min_amount,
                'remnants' => $code->number_of_uses - $code->used
            ];
        }
        return ['status' => 'fail'];
    }
}