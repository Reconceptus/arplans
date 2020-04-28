<?php

namespace modules\shop\admin\controllers;

use modules\admin\controllers\AdminController;
use modules\shop\models\Promocode;
use modules\shop\models\PromocodeSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * PromocodeController implements the CRUD actions for Promocode model.
 */
class PromocodeController extends AdminController
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
                        'shop_promocode',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Lists all Promocode models.
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->request->baseUrl = '/admin/modules';
        $searchModel = new PromocodeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Promocode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->request->baseUrl = '/admin/modules';
        $model = new Promocode();
        return $this->modify($model);
    }

    /**
     * Updates an existing Promocode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        Yii::$app->request->baseUrl = '/admin/modules';
        $model = $this->findModel($id);
        return $this->modify($model);
    }


    public function modify($model)
    {
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('form', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Promocode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->request->baseUrl = '/admin/modules';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Promocode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  integer  $id
     * @return Promocode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Promocode::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
