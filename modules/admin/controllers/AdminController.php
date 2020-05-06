<?php

namespace modules\admin\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class AdminController extends Controller
{
    public $layout = 'admin';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect('/');
                },
                'rules' => [
                    [
                        'actions' => [],
                        'allow'   => true,
                        'roles'   => [
                            'adminPanel',
                        ],
                    ],
                ],
            ],
        ];
    }
}