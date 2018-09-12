<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 29.08.2018
 * Time: 16:24
 */

namespace modules\shop\widgets\services;


use modules\shop\models\Service;
use yii\base\Widget;

class Services extends Widget
{
    public $viewName = 'another';
    public $model;

    public function run()
    {
        $services = Service::find()->where(['!=', 'id', $this->model->id])->all();
        $content = $this->render($this->viewName, ['models' => $services]);
        return $content;
    }
}