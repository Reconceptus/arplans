<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:35
 */

namespace frontend\widgets\finished;

use yii\base\Widget;

class Finished extends Widget
{
    public $viewName = 'sidebar';

    public function run()
    {
        $content = $this->render($this->viewName);

        return $content;
    }
}