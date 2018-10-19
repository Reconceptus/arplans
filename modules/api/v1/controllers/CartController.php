<?php

namespace modules\api\v1\controllers;


use modules\shop\models\Cart;
use modules\shop\models\Service;
use yii\web\Response;

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
            return ['status' => 'success', 'count' => $model->count];
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
                return ['status' => 'success', 'count' => $model->count];
            }
        }
        return ['status' => 'fail', 'count' => $model->count];
    }

    public function actionDeleteItem()
    {
        $get = \Yii::$app->request->get();
        $id = $get['id'];
        $guid = $get['guid'];
        if ($model = Cart::find()->where(['guid' => $guid, 'item_id' => $id])->one()) {
            $model->delete();
            return ['status' => 'success'];
        }
        return ['status' => 'fail', 'count' => $model->count];
    }
}
