<?php

namespace frontend\modules\admin;

use frontend\modules\Module;

/**
 * admin module definition class
 */
class Admin extends Module
{
	/**
	 * @var string
	 */
    public $controllerNamespace = 'frontend\modules\admin\controllers';

	/**
	 *
	 */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
