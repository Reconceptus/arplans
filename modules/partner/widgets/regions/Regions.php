<?php

namespace modules\partner\widgets\regions;


use common\models\Region;
use modules\partner\models\Builder;
use modules\partner\models\Village;
use yii\base\Widget;

class Regions extends Widget
{
    public $viewName = 'drop';
    public $type = 'about';

    public function run()
    {
        if ($this->type === 'builder') {
            $query = Region::find()->distinct()->alias('r')
                ->innerJoin(['b' => Builder::tableName()], 'r.id=b.region_id')
                ->where(['b.no_page' => Builder::PAGE_NEED, 'b.is_active' => Builder::IS_ACTIVE, 'b.is_deleted' => Builder::IS_NOT_DELETED]);
        } else if ($this->type === 'village') {
            $query = Region::find()->distinct()->alias('r')
                ->innerJoin(['v' => Village::tableName()], 'r.id=v.region_id')
                ->where(['v.no_page' => Village::PAGE_NEED, 'v.is_active' => Village::IS_ACTIVE, 'v.is_deleted' => Village::IS_NOT_DELETED]);
        } else {
            $query1 = Region::find()->distinct()->alias('r')
                ->innerJoin(['b' => Builder::tableName()], 'r.id=b.region_id')
                ->where(['b.is_office' => Builder::IS_OFFICE, 'b.is_active' => Builder::IS_ACTIVE, 'b.is_deleted' => Builder::IS_NOT_DELETED]);
            $query2 = Region::find()->distinct()->alias('r')
                ->innerJoin(['v' => Village::tableName()], 'r.id=v.region_id')
                ->where(['v.is_office' => Village::IS_OFFICE, 'v.is_active' => Village::IS_ACTIVE, 'v.is_deleted' => Village::IS_NOT_DELETED]);
            $query = $query1->union($query2);
        }
        return $this->render($this->viewName, ['models' => $query->all()]);
    }
}