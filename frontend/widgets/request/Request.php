<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:35
 */

namespace frontend\widgets\request;

use yii\base\Widget;


class Request extends Widget
{
    public $viewName = 'index';
    public $model;

    public function run()
    {
        $model = new \common\models\Request();
        $content = $this->render($this->viewName, ['model' => $model]);

        return $content;
    }
}