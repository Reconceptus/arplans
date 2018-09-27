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
                'class' => \yii\filters\Cors::className(),
                'actions' => [
                    'incoming' => [
                        'Origin' => ['*'],
                        'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                        'Access-Control-Request-Headers' => ['*'],
                        'Access-Control-Allow-Credentials' => null,
                        'Access-Control-Max-Age' => 86400,
                        'Access-Control-Expose-Headers' => [],
                    ],
                ],
            ],
            ], parent::behaviors());

        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        return $behaviors;
    }
}
