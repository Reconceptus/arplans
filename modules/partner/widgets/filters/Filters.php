<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 10:52
 */

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