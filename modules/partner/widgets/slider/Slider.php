<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 10:52
 */

namespace modules\partner\widgets\slider;


use yii\base\Widget;

class Slider extends Widget
{
    public $viewName = 'builder';
    public $model;

    public function run()
    {
        $models = $this->model->images;
        return $this->render($this->viewName, ['models' => $models]);
    }
}