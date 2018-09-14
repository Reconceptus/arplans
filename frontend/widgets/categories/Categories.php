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

        $content = $cache->getOrSet('categories_' . $this->viewName, function ($cache) {
            if ($this->showServices) {
                $services = Service::find()->where(['is_active' => 1, 'is_deleted' => 0, 'to_main_menu' => 1])->all();
            } else {
                $services = [];
            }
            $models = Category::find()->where(['is_active' => Category::IS_ACTIVE])->all();
            return $this->render($this->viewName, ['models' => $models, 'services' => $services]);
        }, 1000);

        return $content;
    }
}