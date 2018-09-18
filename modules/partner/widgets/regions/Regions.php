<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 10:52
 */

namespace modules\partner\widgets\regions;


use common\models\Region;
use yii\base\Widget;

class Regions extends Widget
{
    public $viewName = 'drop';

    public function run()
    {
        $regions = Region::find()->all();
        return $this->render($this->viewName, ['models' => $regions]);
    }
}