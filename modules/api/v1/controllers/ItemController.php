<?php

namespace modules\api\v1\controllers;

use modules\shop\models\Cart;
use modules\shop\models\Category;
use modules\shop\models\Item;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
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
        if (isset($get['cart'])) {
            $cart = Html::encode($get['cart']);
            $inCart = Cart::find()->select(['item_id', 'count'])->where(['guid' => $cart])->indexBy('item_id')->column();
        } else {
            $inCart = [];
        }
        $partner = \Yii::$app->user->identity->partner;
        if ($partner) {
            $categories = $partner->categories;
            $categoriesArray = ArrayHelper::map($categories, 'id', 'name');
            if (isset($get['category'])) {
                if (isset($categoriesArray) && array_key_exists($get['category'], $categoriesArray)) {
                    $category = Category::findOne(['id' => intval($get['category'])]);
                } else {
                    return ['status' => 'fail', 'message' => 'Категория не существует'];
                }
            } elseif ($categories) {
                $category = $categories[0];
            } else {
                return ['status' => 'fail', 'message' => 'Не указаны категории'];
            }
            unset($get['askCat']);
            $query = Item::getFilteredQuery($category, $get);
            $dataProvider = new ActiveDataProvider([
                'query'      => $query,
                'pagination' => [
                    'defaultPageSize' => 24,
                ],
            ]);
            return ['status' => 'success', 'html' => $this->renderPartial('index', ['dataProvider' => $dataProvider, 'category' => $category, 'inCart' => $inCart]), 'categories' => !empty(\Yii::$app->request->get('askCat')) ? $categoriesArray : [], 'category_id' => $category->id];
        } else {
            return ['status' => 'fail', 'message' => 'Ошибка получения данных'];
        }
    }

    public function actionView($id)
    {
        $model = Item::findOne(['id' => $id]);
        $get = \Yii::$app->request->get();
        if (isset($get['cart'])) {
            $cart = Html::encode($get['cart']);
            $inCart = Cart::find()->select(['item_id', 'count'])->where(['guid' => $cart])->indexBy('item_id')->column();
        } else {
            $inCart = [];
        }
        if ($model) {
            $isInCart = array_key_exists($model->id, $inCart);
            return ['status' => 'success', 'html' => $this->renderPartial('view', ['model' => $model, 'isInCart' => $isInCart])];
        } else {
            return ['status' => 'fail'];
        }
    }

}
