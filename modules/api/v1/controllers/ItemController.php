<?php

namespace modules\api\v1\controllers;

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
        $categories = \Yii::$app->user->identity->partner->categories;
        if (isset($get['category'])) {
            $category = Category::findOne(['id' => intval($get['category'])]);
        } else {
            $category = $categories[0];
        }
        $partnerCategories = [];
        foreach ($categories as $cat) {
            $partnerCategories[] = ['id' => $cat->id, 'name' => $cat->name];
        }
        $query = Item::getFilteredQuery($category, $get);
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'defaultPageSize' => 6,
            ],
        ]);
        return ['status' => 'success', 'html' => $this->renderPartial('index', ['dataProvider' => $dataProvider, 'category' => $category]), 'categories' => $partnerCategories];
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

}
