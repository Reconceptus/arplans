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
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{

    public function actionIndex()
    {
        $get = \Yii::$app->request->get();

        // Определяем категорию
        $category = isset($get['category']) ? $get['category'] : '';
        if (!$category) {
            $category = Category::find()->where(['is_active' => Category::IS_ACTIVE])->one();
        } else {
            $category = Category::find()->where(['slug' => $category])->andWhere(['is_active' => Category::IS_ACTIVE])->one();
        }
        if (!$category) {
            throw new NotFoundHttpException();
        }

        $query = Item::getFilteredQuery($category, $get)->orderBy(['sort' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        // получаем данные для фильтров-слайдеров
        $commonArea = [
            'min' => \Yii::$app->db->createCommand("SELECT MIN(common_area) FROM shop_item WHERE category_id=" . $category->id)->queryScalar(),
            'max' => \Yii::$app->db->createCommand("SELECT MAX(common_area) FROM shop_item WHERE category_id=" . $category->id)->queryScalar()
        ];

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'category'     => $category,
            'commonArea'   => $commonArea
        ]);
    }

    public function actionView()
    {
        $model = Item::find()->where(['slug' => Yii::$app->request->get('slug'), 'is_active' => Item::IS_ACTIVE, 'is_deleted' => Item::IS_NOT_DELETED])->one();
        if (!$model) {
            throw new NotFoundHttpException('Товар не найден');
        }
        return $this->render('view', ['model' => $model]);
    }
}