<?php

namespace modules\shop\admin\controllers;

use modules\admin\controllers\AdminController;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AdminController
{

	/**
	 * Renders the index view for the module
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->redirect('/admin/posts');
	}
}
