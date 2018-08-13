<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:35
 */

namespace frontend\widgets\share;

use common\models\Post;
use yii\base\Widget;


class Share extends Widget
{
    public $viewName = 'index';
    public $model;

    public function run()
    {
        $neighbors = Post::getNeighbors($this->model->id);
        $content = $this->render($this->viewName, ['prev' => $neighbors['prev'], 'next' => $neighbors['next'], 'model' => $this->model]);

        return $content;
    }
}