<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace modules\shop\frontend\controllers;

use modules\shop\models\Item;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class CatalogController extends Controller
{

    public function actionIndex($category_id)
    {
        $query = Item::find()->where(['category_id' => $category_id])
            ->andWhere(['is_active' => Item::IS_ACTIVE])
            ->andWhere(['is_deleted' => Item::IS_NOT_DELETED]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'category_id'  => (int)$category_id
        ]);
    }

}