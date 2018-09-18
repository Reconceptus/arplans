<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace modules\partner\frontend\controllers;

use modules\partner\models\Partner;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class PartnerController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $get = Yii::$app->request->get();
        $query = Partner::getFilteredQuery($get);
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
        $model = Partner::findOne(['slug' => $slug, 'is_active' => Partner::IS_ACTIVE, 'is_deleted' => Partner::IS_NOT_DELETED]);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        $this->render('view', ['model' => $model]);
    }
}