<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 11.01.2019
 * Time: 12:13
 */

namespace frontend\controllers;


use Yii;
use yii\web\Controller;

class SitemapController extends Controller
{
    public function actionIndex()
    {
        $items = [];
        $models = ['common\models\Post', 'common\models\Page', 'modules\shop\models\Item'];
        foreach ($models as $class)
            $items = array_merge($items, $class::findActive()->active()->all());

        $this->renderPartial('index', array(
            'host'  => Yii::$app->request->hostInfo,
            'items' => $items,
        ));
    }
}