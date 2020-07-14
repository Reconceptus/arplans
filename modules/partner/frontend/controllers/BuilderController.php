<?php
namespace modules\partner\frontend\controllers;

use modules\partner\models\Builder;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class BuilderController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $get = Yii::$app->request->get();
        $query = Builder::getFilteredQuery($get)->orderBy(['sort' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionView()
    {
        $slug = Yii::$app->request->get('slug');
        $model = Builder::findOne(['slug' => $slug, 'is_active' => Builder::IS_ACTIVE, 'is_deleted' => Builder::IS_NOT_DELETED, 'no_page' => Builder::IS_NOT_ACTIVE]);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $this->render('view', ['model' => $model]);
    }

    public function actionDownloadPrice()
    {
        $id = Yii::$app->request->get('id');
        $model = Builder::findOne(['id' => $id]);
        if ($model && $model->price_list) {
            $fileName = Yii::getAlias('@webroot') . $model->price_list;
            $extArr = explode('.', $model->price_list);
            $ext = end($extArr);
            if ($model->price_list && file_exists($fileName)) {
                header("Content-Disposition: attachment; filename=pricelist_" . $model->slug . "." . $ext . ";");
                echo file_get_contents($fileName);
            }
        }
    }
}