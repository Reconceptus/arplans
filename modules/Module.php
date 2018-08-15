<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 14.08.2018
 * Time: 13:12
 */

namespace modules;


class Module extends \yii\base\Module
{
    public function init()
    {
        $name = explode('/', $_SERVER['REQUEST_URI'])[1];
        if ($name !== 'admin') {
            $name = 'frontend';
        }
        $path = str_replace('Module', '', $this->className()) . "{$name}";
        $this->controllerNamespace = "{$path}\\controllers";
        $this->viewPath = $this->basePath.DIRECTORY_SEPARATOR.$name.DIRECTORY_SEPARATOR.'views';
        $this->layoutPath = '@modules/admin/views/layouts';
        parent::init();
    }
}