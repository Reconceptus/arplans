<?php

namespace modules\api\v1\controllers;

use modules\shop\models\Category;
use modules\shop\models\Item;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
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
            } elseif (isset($categories)) {
                $category = $categories[0];
            } else {
                return ['status' => 'fail', 'message' => 'Не указаны категории'];
            }
            unset($get['askCat']);
            $query = Item::getFilteredQuery($category, $get);
            $dataProvider = new ActiveDataProvider([
                'query'      => $query,
                'pagination' => [
                    'defaultPageSize' => 6,
                ],
            ]);
            return ['status' => 'success', 'html' => $this->renderPartial('index', ['dataProvider' => $dataProvider, 'category' => $category]), 'categories' => !empty(\Yii::$app->request->get('askCat')) ? $categoriesArray : []];
        } else {
            return ['status' => 'fail', 'message' => 'Ошибка получения данных'];
        }
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
