<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace frontend\controllers;

use common\models\Profile;
use Yii;
use yii\web\Controller;


class ProfileController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = Yii::$app->user->identity->profile;
        /* @var $model Profile */
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
        }
        return $this->render('index', ['profile' => $model]);
    }
    

    public function actionOrders()
    {
        $model = Yii::$app->user->identity;
    }
}