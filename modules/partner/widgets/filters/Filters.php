<?php

namespace modules\partner\widgets\filters;


use yii\base\Widget;

class Filters extends Widget
{
    public $viewName = 'builders';
    public function run()
    {
        $content = $this->render($this->viewName);
        return $content;
    }
}