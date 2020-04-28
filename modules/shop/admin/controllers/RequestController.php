<?php

namespace modules\shop\admin\controllers;


use common\models\Request;
use common\models\RequestSearch;
use modules\admin\controllers\AdminController;
use Yii;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class RequestController extends AdminController
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class'        => AccessControl::className(),
            'denyCallback' => function ($rule, $action) {
                return $this->redirect('/');
            },
            'rules'        => [
                [
                    'actions' => [],
                    'allow'   => true,
                    'roles'   => [
                        'shop_request',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->request->baseUrl = '/admin/modules';
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];
        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @return ActiveRecord|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Request::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}