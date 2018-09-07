<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 16:02
 */

namespace modules\shop\admin\controllers;


use modules\admin\controllers\AdminController;
use modules\shop\models\Order;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class OrderController extends AdminController
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
                        'shop_order',
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
        $query = Order::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $model = Order::findOne(['id' => $id]);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $this->render('form', ['model' => $model]);
    }
}