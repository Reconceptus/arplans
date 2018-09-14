<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 30.08.2018
 * Time: 15:15
 */

namespace frontend\widgets\posts;


use common\models\Post;
use yii\base\Widget;

class Posts extends Widget
{
    public $viewName = 'index';

    public function run()
    {
        $models = Post::find()->where(['status' => Post::STATUS_PUBLISHED, 'to_menu' => 1])->all();
        $content = $this->render($this->viewName, ['models' => $models]);
        return $content;
    }
}