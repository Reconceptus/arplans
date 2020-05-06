<?php

namespace modules\partner\widgets\slider;


use yii\base\Widget;

class Slider extends Widget
{
    public $viewName = 'builder';
    public $model;

    public function run()
    {
        return $this->render($this->viewName, ['model' => $this->model]);
    }
}