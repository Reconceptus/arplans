<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:35
 */

namespace frontend\widgets\categories;

use modules\shop\models\Category;
use yii\base\Widget;


class Categories extends Widget
{
    public $viewName = 'top';

    public function run()
    {
        $cache = \Yii::$app->cache;

        $content = $cache->getOrSet('categories_' . $this->viewName, function ($cache) {
            $models = Category::find()->where(['is_active' => Category::IS_ACTIVE])->all();
            return $this->render($this->viewName, ['models' => $models]);
        }, 1000);

        return $content;
    }
}