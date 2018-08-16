<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace modules\shop\frontend\controllers;

use yii\web\Controller;

class CatalogController extends Controller
{

    public function actionIndex()
    {
        return $this->redirect('/');
    }

}