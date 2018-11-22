<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 10:52
 */

namespace modules\partner\widgets\regions;


use common\models\Region;
use modules\partner\models\Builder;
use modules\partner\models\Village;
use yii\base\Widget;

class Regions extends Widget
{
    public $viewName = 'drop';

    public function run()
    {
        $query1 = Region::find()->distinct()->alias('r');
        $query1 = $query1->innerJoin(['b' => Builder::tableName()], 'r.id=b.region_id')->where(['b.no_page'=>Builder::PAGE_NEED]);
        $query2 = Region::find()->distinct()->alias('r');
        $query2 = $query2->innerJoin(['v' => Village::tableName()], 'r.id=v.region_id')->where(['v.no_page'=>Village::PAGE_NEED]);
        $query = $query1->union($query2);
        return $this->render($this->viewName, ['models' => $query->all()]);
    }
}