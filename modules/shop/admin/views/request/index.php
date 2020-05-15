<?php

use common\models\Request;
use common\models\RequestSearch;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\ArrayHelper;

/* @var $dataProvider ActiveDataProvider */
/* @var $searchModel RequestSearch */

$this->title = 'Заявки';

$columns = [
    [
        'class'   => SerialColumn::class,
        'options' => ['style' => 'width:40px'],
    ],
    [
        'attribute' => 'created_at',
        'value'     => static function ($model) {
            return date('Y-m-d', strtotime($model->created_at));
        }
    ],
    [
        'attribute' => 'type',
        'value'     => static function ($model) {
            return ArrayHelper::getValue(Request::TYPES, $model->type);
        },
        'filter'=>Request::TYPES
    ],
    'name',
    'email',
    'phone',
    'region',
    [
        'attribute'     => 'text',
        'headerOptions' => ['style' => 'min-width:400px']
    ],
    'url',
    [
        'attribute' => 'partner_id',
        'value'     => static function ($model) {
            /* @var $model Request */
            return $model->partner ? $model->partner->name : '';
        }
    ],
    [
        'class'    => ActionColumn::class,
        'template' => '{delete}',
        'options'  => ['style' => 'width:100px']
    ]
];
?>
    <h1><?= $this->title ?></h1>
<?= GridView::widget(
    [
        'filterModel'  => $searchModel,
        'dataProvider' => $dataProvider,
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
);
