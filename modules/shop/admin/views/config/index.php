<?php

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Url;

$this->title = 'Параметры';

$columns = [
    [
        'class'   => 'yii\grid\SerialColumn',
        'options' => ['style' => 'width:40px'],
    ],
    [
        'attribute' => 'name',
        'value'     => function ($model) {
            return $model->name ?? $model->slug;
        }
    ],
    'value'
];
?>
    <h1><?= $this->title ?></h1>
<?= \yii\grid\GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['onclick' => 'window.location = "' . Url::to(['/shop/config/update', 'id' => $model->id]) . '"'];
        },
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
);
