<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:35
 */

namespace frontend\widgets\referral;

use Yii;
use yii\base\Widget;
use yii\web\Cookie;


class Referral extends Widget
{
    public $viewName = 'index';

    public function run()
    {
        if (Yii::$app->user->isGuest) {
            $ref = Yii::$app->request->get('inv');
            if ($ref) {
                $cookies = Yii::$app->response->cookies;
                if (!$cookies->has('inv')) {
                    $cookies->add(new Cookie([
                        'name'   => 'inv',
                        'value'  => $ref,
                        'expire' => time() + 60 * 60 * 24 * 365
                    ]));
                    $this->view->context->redirect(Yii::$app->request->hostInfo . '/' . Yii::$app->request->pathInfo);
                }
            }
        }
        return '';
    }
}