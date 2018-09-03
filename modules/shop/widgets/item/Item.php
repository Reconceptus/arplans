<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 29.08.2018
 * Time: 16:24
 */

namespace modules\shop\widgets\item;


use yii\base\Widget;

class Item extends Widget
{
    public $viewName = 'index';
    public $model;
    public $get;
    public $favorites = [];
    public $sizeCatalog;

    public function run()
    {
        $content = $this->render($this->viewName, [
            'model'       => $this->model,
            'get'         => $this->get,
            'favorites'   => $this->favorites,
            'sizeCatalog' => $this->sizeCatalog
        ]);
        return $content;
    }
}