<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 13.09.2018
 * Time: 17:35
 */

namespace modules\partner\admin\controllers;


use common\models\User;
use modules\admin\controllers\AdminController;
use modules\partner\models\Main;
use Yii;
use yii\filters\AccessControl;

class MainController extends AdminController
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
                        'partner_main',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * @return string
     * @throws \yii\db\Exception
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionIndex()
    {
        $model = Main::getModel();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $model->save();
        }
        $users = User::getAuthors();
        return $this->render('index', ['model' => $model, 'users'=>$users]);
    }
}