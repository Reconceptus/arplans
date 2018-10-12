<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 17:33
 */

namespace modules\partner\widgets\map;


use yii\base\Widget;
use yii\data\ActiveDataProvider;

class Map extends Widget
{
    public $viewName = 'index';
    public $query = null;

    public function run()
    {
        $models = [];
        if ($this->viewName !== 'index') {
            $models = $this->query->all();
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $this->query
        ]);
        $content = $this->render($this->viewName, ['dataProvider' => $dataProvider, 'models' => $models]);
        return $content;
    }
}