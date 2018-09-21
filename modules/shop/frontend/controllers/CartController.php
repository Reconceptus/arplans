<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 03.09.2018
 * Time: 10:42
 */

namespace modules\shop\frontend\controllers;


use common\models\Config;
use common\models\User;
use modules\shop\models\Cart;
use modules\shop\models\Order;
use modules\shop\models\Service;
use Yii;
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
        $services = Service::find()->all();
        $user = null;
        if (!Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity;
        }

        return $this->render('index', [
            'models'   => $models,
            'services' => $services,
            'user'     => $user
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
            $cart = Cart::find()->where(['user_id' => \Yii::$app->user->id, 'item_id' => $get['id']])->one();
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
        $info = $get['info'];
        $amount = 0;
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            if (Yii::$app->user->isGuest) {
                $password = Yii::$app->security->generateRandomString(8);
                $user = User::createUser($info['email'], $password, $info['fio'], $info['phone'], $info['country'], $info['city'], $info['address']);
                User::sendRegLetter($user);
            } else {
                $user = Yii::$app->user->identity;
            }
            $order = Order::createOrder($info['fio'], $user, $info['email'], $info['phone'], $info['country'], $info['city'], $info['address'], $info['village']);
            if ($order) {
                $amount += $order->addItems($get['items']);
                if (isset($get['services'])) {
                    $amount += $order->addServices($get['services']);
                }
            }
            $order->price = $amount;
            if ($order->save()) {
                Cart::clearUserCart($user->id);
                $transaction->commit();
                return ['status' => 'success', 'orderId' => $order->id];
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
        $albumPrice = Config::getValue('album_price');
        if (isset($get['id']) && isset($get['count'])) {
            $model = Cart::findOne(['id' => intval($get['id'])]);
            $count = intval($get['count']);
            if ($count >= 1) {
                $model->count = intval($get['count']);
            } else {
                $model->count = 1;
            }
            if ($model->save()) {
                return ['status' => 'success', 'count' => $model->count, 'price' => $model->item->getLotPrice($model->count, $albumPrice)];
            }
        }
        return ['status' => 'fail', 'message' => 'Ошибка при попытке изменить количество'];
    }
}