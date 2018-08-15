<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:35
 */

namespace frontend\widgets\flashes;

use Yii;
use yii\base\Widget;

class Flashes extends Widget
{
    public $viewName = 'index';

    public function run()
    {
        $flashes = Yii::$app->session->getAllFlashes();

        $content = $this->render($this->viewName, ['flashes' => $flashes]);

        return $content;
    }
}