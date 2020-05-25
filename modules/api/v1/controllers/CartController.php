<?php

namespace modules\api\v1\controllers;


use common\models\Config;
use common\models\Request;
use common\models\User;
use modules\shop\models\Cart;
use modules\shop\models\Order;
use modules\shop\models\Service;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;

class CartController extends ActiveController
{
    public $modelClass = 'modules\shop\models\Cart';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index'], $actions['view'], $actions['delete']);
        return $actions;
    }

    public function actionIndex()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $get = \Yii::$app->request->get();
        $services = Service::find()->all();
        if (isset($get['guid'])) {
            $models = Cart::find()->where(['guid' => $get['guid']])->all();
        } else {
            return ['status' => 'success', 'html' => '<p>Корзина пуста</p>'];
        }
        return ['status' => 'success', 'html' => $this->renderPartial('index', ['models' => $models, 'services' => $services])];
    }

    /**
     * @return array
     */
    public function actionToCart()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $get = \Yii::$app->request->get();
        $itemId = intval($get['id']);
        $cartId = $get['cart'];
        if ($cartId && $itemId) {
            $cart = Cart::find()->where(['guid' => $cartId, 'item_id' => $itemId])->one();
            if ($cart) {
                return ['status' => 'fail', 'message' => 'Этот товар уже в корзине'];
            } else {
                $cart = new Cart();
                $cart->item_id = $get['id'];
                $cart->guid = $cartId;
                $cart->count = 1;
                if ($cart->save()) {
                    return ['status' => 'success', 'message' => 'Товар добавлен в корзину', 'count' => $cart->count, 'name' => $cart->item->name];
                }
            }
        }
        return ['status' => 'fail', 'message' => 'Ошибка при добавлении товара'];
    }

    public function actionGetCart()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $guid = \Yii::$app->request->get('guid');
        $models = Cart::find()->where(['guid' => $guid])->all();
        $result = [];
        foreach ($models as $model) {
            $result[] = ['item_id' => $model->item_id, 'count' => $model->count, 'name' => $model->item->name];
        }
        return $result;
    }

    public function actionMinus()
    {
        $get = \Yii::$app->request->get();
        $id = $get['id'];
        $guid = $get['guid'];
        /* @var $model Cart */
        $model = Cart::find()->where(['guid' => $guid, 'item_id' => $id])->one();
        if ($model->count > 1) {
            $model->count = $model->count - 1;
            $model->save();
            return ['status' => 'success', 'count' => $model->count, 'price' => $model->getLotPrice(Config::getValue('albumPrice'))];
        }
        return ['status' => 'fail', 'count' => $model->count];
    }

    public function actionPlus()
    {
        $get = \Yii::$app->request->get();
        $id = $get['id'];
        $guid = $get['guid'];
        /* @var $model Cart */
        if ($model = Cart::find()->where(['guid' => $guid, 'item_id' => $id])->one()) {
            $model->count = $model->count + 1;
            if ($model->save()) {
                return ['status' => 'success', 'count' => $model->count, 'price' => $model->getLotPrice(Config::getValue('albumPrice'))];
            }
        }
        return ['status' => 'fail', 'count' => $model->count];
    }

    public function actionDeleteItem()
    {
        $get = \Yii::$app->request->get();
        $id = $get['id'];
        $guid = $get['guid'];
        $model = Cart::find()->where(['guid' => $guid, 'item_id' => $id])->one();
        if ($model) {
            /* @var $model Cart */
            $price = $model->getLotPrice(Config::getValue('albumPrice'));
            $model->delete();
            return ['status' => 'success', 'price' => $price];
        }
        return ['status' => 'fail'];
    }

    /**
     * @return array
     * @throws \yii\base\Exception
     */
    public function actionOrder()
    {
        $get = Yii::$app->request->get();
        $info = $get['info'];
        $amount = 0;
        $connection = Yii::$app->db;
        $user = Yii::$app->user->identity;
        /* @var $user User */
        if ($user->partner->is_active === 1 && $user->partner->is_deleted == 0) {
            $transaction = $connection->beginTransaction();
            try {
                $order = Order::createOrder($info['fio'], $user, $info['email'], $info['phone'], $info['country'], $info['city'], $info['address'], $info['village'], true);
                if ($order) {
                    $amount += $order->addItems($get['items']);
                    if (isset($get['services'])) {
//                        $amount +=
                        $order->addServices($get['services']);
                    }
                }
                $order->price = $amount;
                $order->partner_percent = $amount / 100 * floatval(Config::getValue('partner_percent'));
                $order->type = Order::TYPE_API;
                if ($order->save()) {
                    Cart::clearUserCartByGuid($get['guid']);
                    $transaction->commit();
                    $mail = Yii::$app->mailer->compose('new-order', ['model' => $order]);
                    $mail->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name]);
                    $mail->setTo($order->email);
                    $mail->setCc(Config::getValue('requestEmail'));
                    $mail->setSubject('Новый заказ');
                    $mail->send();
                    return ['status' => 'success', 'orderId' => $order->id];
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
            }
        } else {
            return ['status' => 'fail'];
        }
    }

    public function actionHelp()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Request();
        $get = Yii::$app->request->get();
        if (!$get) {
            return ['status' => 'fail', 'message' => 'Ошибка при отправке данных'];
        }
        if (isset($get['Request']['accept'])) {
            $get['Request']['accept'] = 1;
        };
        $user = Yii::$app->user->identity;
        /* @var $user User */
        $partner = $user->partner;
        if ($partner) {
            $model->partner_id = $partner->id;
        }
        if ($model->load($get)) {
            $file = UploadedFile::getInstance($model, 'file');
            if ($model->save()) {
                $mail = Yii::$app->mailer->compose('request', ['model' => $model])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo(Config::getValue('requestEmail'))
                    ->setSubject(Request::TYPES[intval($model->type)]);
                if ($partner->send_notify) {
                    $mail->setCc([$user->email]);
                }
                if ($file) {
                    $mail->attachContent(file_get_contents($file->tempName), ['fileName' => $file->baseName . '.' . $file->extension]);
                }
                $mail->send();
                return ['status' => 'success', 'message' => 'Ваш  запрос успешно отправлен. В ближайшее время мы с вами свяжемся'];
            } else {
                return ['status' => 'fail', 'message' => $model->getFirstErrors()];
            }
        }
    }
}
