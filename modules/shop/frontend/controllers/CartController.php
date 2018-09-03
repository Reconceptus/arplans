<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 03.09.2018
 * Time: 10:42
 */

namespace modules\shop\frontend\controllers;


use modules\shop\models\Cart;
use yii\web\Controller;

class CartController extends Controller
{
    public function actionIndex()
    {
        $guid = Cart::setGuid();
        $models = Cart::find()->where(['guid' =>$guid])->all();

        return $this->render('index', ['models' => $models]);
    }
}