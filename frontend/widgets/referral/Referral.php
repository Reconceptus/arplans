<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:35
 */

namespace frontend\widgets\referral;

use common\models\User;
use Yii;
use yii\base\Widget;
use yii\web\Cookie;


class Referral extends Widget
{
    public $viewName = 'index';

    public function run()
    {
        /* @var $user User */
        $user = Yii::$app->user->identity;
        if (!$user) {
            $ref = intval(Yii::$app->request->get('inv'));
            if ($ref) {
                $referrer = User::findOne(['id' => $ref, 'status' => User::STATUS_ACTIVE, 'is_referrer' => 1]);
                if ($referrer) {
                    $cookies = Yii::$app->response->cookies;
                    if (!$cookies->has('inv')) {
                        $cookies->add(new Cookie([
                            'name'   => 'inv',
                            'value'  => $ref,
                            'expire' => time() + 60 * 60 * 24 * 365
                        ]));
                    }
                }
                $this->view->context->redirect(Yii::$app->request->hostInfo . '/' . Yii::$app->request->pathInfo);
            }
        } elseif ($user->is_referrer) {
            if(strpos(Yii::$app->request->pathInfo,'profile')===0){
                $link = Yii::$app->request->hostInfo.'?inv='.$user->id;
            }else{
                $link = Yii::$app->request->hostInfo.'/'.Yii::$app->request->pathInfo.'?inv='.$user->id;
            }
            return $this->render('_link', ['link' => $link]);
        }
        return '';
    }
}
