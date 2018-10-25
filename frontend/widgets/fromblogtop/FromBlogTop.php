<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 30.08.2018
 * Time: 15:15
 */

namespace frontend\widgets\fromblogtop;


use common\models\Post;
use yii\base\Widget;

class FromBlogTop extends Widget
{
    public $viewName = 'index';
    public $limit = 3;

    public function run()
    {
        $models = Post::find()->where(['status' => Post::STATUS_PUBLISHED, 'on_main_top' => 1])->all();
        $content = $this->render($this->viewName, ['models' => $models]);
        return $content;
    }
}