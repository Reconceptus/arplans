<?php

namespace console\controllers;

use modules\shop\models\Promocode;
use modules\shop\models\Selection;
use yii\console\Controller;

class SiteController extends Controller
{
    public function actionPromocode()
    {
        $models = Promocode::find()->where(['status' => Promocode::STATUS_ACTIVE])->all();
        foreach ($models as $model) {
            /* @var $model Promocode */
            $date = time();
            if ($date > strtotime($model->end_date.' 23:59:59')) {
                $model->status = Promocode::STATUS_DISABLED;
                $model->save();
            }
        }
    }

    public function actionSelection()
    {
        Selection::collectAll();
    }
}