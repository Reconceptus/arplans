<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:35
 */

namespace frontend\widgets\categories;

use modules\shop\models\Category;
use modules\shop\models\Service;
use yii\base\Widget;


class Categories extends Widget
{
    public $viewName = 'top';
    public $showServices = false;

    public function run()
    {
        $cache = \Yii::$app->cache;
        $models = $cache->getOrSet('categories', function ($cache) {
            return Category::find()->where(['is_active' => Category::IS_ACTIVE])->all();
        }, 1000);
        if ($this->showServices) {
            $services = $cache->getOrSet('services', function ($cache) {
                return Service::find()->where(['is_active' => 1, 'is_deleted' => 0, 'to_main_menu' => 1])->all();
            }, 1000);
        } else {
            $services = [];
        }
        return $this->render($this->viewName, ['models' => $models, 'services' => $services]);
    }
}