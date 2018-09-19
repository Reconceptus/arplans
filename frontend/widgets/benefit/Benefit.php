<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:35
 */

namespace frontend\widgets\benefit;

use yii\base\Widget;


class Benefit extends Widget
{
    public $viewName = 'benefits';
    public $model;

    public function run()
    {
        $content = $this->render('benefits', ['model' => $this->model]);
        return $content;
    }
}