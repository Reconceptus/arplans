<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:35
 */

namespace frontend\widgets\recently;

use yii\base\Widget;

class Recently extends Widget
{
    public $viewName = 'index';

    public function run()
    {
        $content = $this->render($this->viewName);

        return $content;
    }
}