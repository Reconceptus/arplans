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
    public $inCart = [];
    public $api = false;

    public function run()
    {
        $isInCart = array_key_exists($this->model->id, $this->inCart);
        $content = $this->render(($this->api ? 'api'.DIRECTORY_SEPARATOR : '') . $this->viewName, [
            'model'       => $this->model,
            'get'         => [],
            'favorites'   => $this->favorites,
            'sizeCatalog' => $this->sizeCatalog,
            'isInCart'    => $isInCart
        ]);
        return $content;
    }
}