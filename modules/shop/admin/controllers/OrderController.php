<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 16:02
 */

namespace modules\shop\admin\controllers;


use modules\admin\controllers\AdminController;
use yii\filters\AccessControl;

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

    public function actionIndex()
    {
        return $this->render('index');
    }
}