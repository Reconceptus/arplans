<?php
namespace console\controllers;

use modules\shop\models\Payment;
use yii\console\Controller;

class PaymentController extends Controller
{
    public function actionIndex()
    {
        $models = Payment::find()->where(['status' => Payment::STATUS_NEW])->all();
        foreach ($models as $model){
            /* @var $model Payment*/
            $model->getInfo();
        }
    }
}