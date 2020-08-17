<?php
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

        $content = $cache->getOrSet(
            'services_' . $this->viewName . '_' . $this->id,
            function ($cache) {
                $services = Service::find()->where(['!=', 'id', $this->id])->andWhere(['is_active' => 1])->all();
                if (!$services) {
                    return '';
                }
                return $this->render($this->viewName, ['models' => $services]);
            }, 1000);
        return $content;
    }
}