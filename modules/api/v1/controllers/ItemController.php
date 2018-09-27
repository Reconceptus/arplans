<?php

namespace modules\api\v1\controllers;


use modules\shop\models\Category;
use modules\shop\models\Item;
use yii\data\ActiveDataProvider;

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
        return $this->renderPartial('index', ['dataProvider' => $dataProvider, 'category' => $category]);
    }

    public function actionView($id)
    {
        $query = Item::find()->where(['id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }
}
