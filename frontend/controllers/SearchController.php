<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace frontend\controllers;

use modules\shop\models\Item;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\Controller;


class SearchController extends Controller
{

    public function actionIndex(string $q)
    {
        $q = Html::encode($q);
        $query = Item::find()->alias('i')
            ->where(['i.is_active' => Item::IS_ACTIVE, 'i.is_deleted' => Item::IS_NOT_DELETED])
            ->andWhere(['like', 'i.name', $q])
            ->orWhere(['like', 'i.description', $q])
            ->orWhere(['like', 'i.slug', $q]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}