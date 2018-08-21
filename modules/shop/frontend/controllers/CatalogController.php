<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace modules\shop\frontend\controllers;

use modules\shop\models\Category;
use modules\shop\models\Item;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{

    public function actionIndex()
    {
        $category = \Yii::$app->request->get('category');
        if (!$category) {
            $category = Category::find()->where(['is_active' => Category::IS_ACTIVE])->one();
        } else {
            $category = Category::find()->where(['slug' => $category])->andWhere(['is_active' => Category::IS_ACTIVE])->one();
        }
        if (!$category) {
            throw new NotFoundHttpException();
        }
        $query = Item::find()->where(['category_id' => $category->id])
            ->andWhere(['is_active' => Item::IS_ACTIVE])
            ->andWhere(['is_deleted' => Item::IS_NOT_DELETED]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'category'     => $category
        ]);
    }

}