<?php

namespace modules\api\v1\controllers;


use modules\shop\models\Cart;
use modules\shop\models\Category;
use modules\shop\models\Item;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class ItemController extends ActiveController
{
    public $modelClass = 'modules\shop\models\Item';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index'], $actions['view']);
        return $actions;
    }

    public function actionIndex()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $get = \Yii::$app->request->get();
        if (isset($get['category'])) {
            $category = Category::findOne(['id' => intval($get['category'])]);
        } else {
            $categories = \Yii::$app->user->identity->partner->categories;
            $category = $categories[0];
        }
        $query = Item::getFilteredQuery($category, $get);
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'defaultPageSize' => 6,
            ],
        ]);
        return ['status' => 'success', 'html' => $this->renderPartial('index', ['dataProvider' => $dataProvider, 'category' => $category])];
    }

    public function actionView($id)
    {
        $model = Item::findOne(['id' => $id]);
        if ($model) {
            return ['status' => 'success', 'html' => $this->renderPartial('view', ['model' => $model])];
        } else {
            return ['status' => 'fail'];
        }
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
                    return ['status' => 'success', 'message' => 'Товар добавлен в корзину', 'count' => $cart->count, 'name'=>$cart->item->name];
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
}
