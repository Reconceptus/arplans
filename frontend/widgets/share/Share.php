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
        $neighbors = $this->viewName === 'blog' ? Post::getNeighbors($this->model->id) : null;
        $content = $this->render($this->viewName, [
            'prev'  => $neighbors ? $neighbors['prev'] : null,
            'next'  => $neighbors ? $neighbors['next'] : null,
            'model' => $this->model]);

        return $content;
    }
}