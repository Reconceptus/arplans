<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace modules\shop\frontend\controllers;

use modules\shop\models\Cart;
use modules\shop\models\Category;
use modules\shop\models\Item;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{
    /**
     * @return string
     * @throws NotFoundHttpException
     */
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
        if (isset($get['page'])) {
            unset($get['page']);
        }
        if (isset($get['per-page'])) {
            unset($get['per-page']);
        }
        $query = Item::getFilteredQuery($category, $get)->orderBy(['sort' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize'        => 6,
                'defaultPageSize' => 2,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'category'     => $category,
            'favorites'    => Yii::$app->user->isGuest ? [] : Yii::$app->user->identity->getFavoriteIds(),
            'inCart'    => Cart::getInCart()
        ]);
    }

    public function actionView()
    {
        $model = Item::find()->where(['slug' => Yii::$app->request->get('slug'), 'is_active' => Item::IS_ACTIVE, 'is_deleted' => Item::IS_NOT_DELETED])->one();
        if (!$model) {
            throw new NotFoundHttpException('Товар не найден');
        }
        return $this->render('view', [
            'model'     => $model,
            'favorites' => Yii::$app->user->isGuest ? [] : Yii::$app->user->identity->getFavoriteIds(),
            'inCart'    => Cart::getInCart()
        ]);
    }

    public function actionDownload()
    {
        $id = Yii::$app->request->get('id');
        $model = Item::findOne(['id' => $id]);
        if ($model->getPrice() === 0) {
            $fileName = Yii::getAlias('@webroot') . $model->project;
            $extArr = explode('.', $model->project);
            $ext = end($extArr);
            if ($model->project && file_exists($fileName)) {
                header("Content-Disposition: attachment; filename='project_" . $model->slug . "." . $ext . "';");
                echo file_get_contents($fileName);
            }
        }
    }
}