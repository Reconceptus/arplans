<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 29.08.2018
 * Time: 16:24
 */

namespace modules\shop\widgets\about;


use yii\base\Widget;

class About extends Widget
{
    public $viewName = 'index';

    public function run()
    {
        $content = $this->render($this->viewName);
        return $content;
    }
}