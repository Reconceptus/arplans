<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 03.09.2018
 * Time: 10:42
 */

namespace modules\shop\frontend\controllers;


use modules\shop\models\Cart;
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

        return $this->render('index', ['models' => $models]);
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
}