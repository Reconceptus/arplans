<?php

namespace modules;


class Module extends \yii\base\Module
{
    public function init()
    {
        $name = explode('/', $_SERVER['REQUEST_URI'])[1];
        if ($name !== 'admin') {
            $name = 'frontend';
        }
        $path = str_replace('Module', '', self::className()) . "{$name}";
        $this->controllerNamespace = "{$path}\\controllers";
        $this->viewPath = $this->basePath . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . 'views';
        if ($name === 'admin') {
            $this->layoutPath = '@modules/admin/views/layouts';
        }
        parent::init();
    }
}