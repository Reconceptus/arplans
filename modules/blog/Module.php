<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 14.08.2018
 * Time: 13:11
 */

namespace modules\blog;


class Module extends \modules\Module
{
    public $controllerNamespace = 'modules\blog\admin\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}