<?php

namespace modules\shop\frontend\controllers;

use modules\shop\models\Cart;
use modules\shop\models\Category;
use modules\shop\models\Item;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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
        $category = ArrayHelper::getValue($get, 'category');
        if (!$category) {
            $category = Category::find()->where(['is_active' => Category::IS_ACTIVE])->one();
        } else {
            $category = Category::find()->where(['slug' => $category])->andWhere(['is_active' => Category::IS_ACTIVE])->one();
        }
        if (!$category) {
            throw new NotFoundHttpException();
        }

        $query = Item::getFilteredQuery($category, $get);

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize'        => 24,
                'defaultPageSize' => 24,
            ],
            'sort'       => [
                'defaultOrder' => ['sort' => SORT_DESC, 'id' => SORT_DESC]
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'category'     => $category,
            'favorites'    => Yii::$app->user->isGuest ? [] : Yii::$app->user->identity->getFavoriteIds(),
            'inCart'       => Cart::getInCart(),
            'sort'         => ArrayHelper::getValue($get, 'sort'),
        ]);
    }

    public function actionView()
    {
        $model = Item::find()->where(['slug' => Yii::$app->request->get('slug'), 'is_active' => Item::IS_ACTIVE, 'is_deleted' => Item::IS_NOT_DELETED])->one();
        if (!$model) {
            throw new NotFoundHttpException('Товар не найден');
        }
        /* @var $model Item */
        $stat = $model->stat;
        ++$stat->views;
        $stat->save();
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
        if ($model->getPrice() == 0) {
            $fileName = Yii::getAlias('@webroot').$model->project;
            $extArr = explode('.', $model->project);
            $ext = end($extArr);
            if ($model->project && file_exists($fileName)) {
                header("Content-Disposition: attachment; filename=project_".$model->slug.".".$ext.";");
                echo file_get_contents($fileName);
            }
        }
    }

    public function actionHistory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $arr = Yii::$app->request->get('arr');
        if ($arr) {
            $models = Item::find()->where(['in', 'id', $arr])->andWhere(['is_active' => Item::IS_ACTIVE, 'is_deleted' => Item::IS_NOT_DELETED])->all();
        } else {
            $models = [];
        }
        $html = $this->renderPartial('_history', ['models' => array_reverse($models)]);
        return ['status' => 'success', 'html' => $html];
    }
}