<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 25.09.2018
 * Time: 9:48
 */

namespace modules\api\v1\controllers;

use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController as MainActiveController;


class ActiveController extends MainActiveController
{
    public function behaviors()
    {
        $behaviors = array_merge(
            ['corsFilter' => [
                'class' => \yii\filters\Cors::className()],
            ], parent::behaviors());

        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        $behaviors['corsFilter'] = ['class' => \yii\filters\Cors::className()];
        return $behaviors;
    }
}
