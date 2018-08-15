<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 14.08.2018
 * Time: 13:12
 */

namespace frontend\modules;


class Module extends \yii\base\Module
{
    public function init()
    {
//        $name = explode('/', $_SERVER['REQUEST_URI'])[1];
//        $path = str_replace('Module', '', $this->className()) . "{$name}\\";
//        $this->controllerNamespace = "{$path}controllers";
        parent::init();
    }
}