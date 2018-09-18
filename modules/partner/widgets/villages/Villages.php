<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 17:33
 */

namespace modules\partner\widgets\villages;


use yii\base\Widget;

class Villages extends Widget
{
    public $viewName = 'index';
    public $dataProvider;

    public function run()
    {
        $content = $this->render($this->viewName, ['dataProvider' => $this->dataProvider]);
        return $content;
    }
}