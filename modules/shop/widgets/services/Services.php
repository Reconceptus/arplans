<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 29.08.2018
 * Time: 16:24
 */

namespace modules\shop\widgets\services;


use modules\shop\models\Service;
use yii\base\Widget;

class Services extends Widget
{
    public $viewName = 'index';
    public $id = 0;

    public function run()
    {
        $cache = \Yii::$app->cache;

        $content = $cache->getOrSet('services_'.$this->viewName.'_'.$this->id, function ($cache) {
            $services = Service::find()->where(['!=', 'id', $this->id])->all();
            return $this->render($this->viewName, ['models' => $services]);
        }, 1000);
        return $content;
    }
}