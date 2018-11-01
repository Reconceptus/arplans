<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 29.08.2018
 * Time: 16:24
 */

namespace modules\shop\widgets\related;


use modules\shop\models\Item;
use yii\base\Widget;

class Related extends Widget
{
    public $viewName = 'index';
    public $model;
    public $favorites = [];
    public $inCart = [];

    public function run()
    {
        $models = Item::getFilteredQuery($this->model->category, \Yii::$app->request->get())->andWhere(['!=', 'i.id', $this->model->id])->limit(4)->all();
        if (!$models) {
            $models = Item::find()->where(['category_id' => $this->model->category_id])->andWhere(['is_active' => Item::IS_ACTIVE])->andWhere(['is_deleted' => Item::IS_NOT_DELETED])->limit(4)->all();
        }
        $content = $this->render($this->viewName, ['models' => $models, 'favorites' => $this->favorites, 'inCart' => $this->inCart]);
        return $content;
    }
}