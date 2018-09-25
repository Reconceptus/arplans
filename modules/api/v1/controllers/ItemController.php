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

    public function actionIndex($category)
    {
        $category = Category::findOne(['id' => $category]);
        $query = Item::getFilteredQuery($category, \Yii::$app->request->get());
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'defaultPageSize' => 2,
            ],
        ]);
        return $this->renderPartial('index', ['dataProvider' => $dataProvider, 'category' => $category]);
    }

    public function actionView($id)
    {
        $query = Item::find()->where(['id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'defaultPageSize' => 2,
            ],
        ]);
        return $dataProvider;
    }
}
