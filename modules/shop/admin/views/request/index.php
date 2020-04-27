<?php

/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Заявки';

$columns = [
    [
        'class'   => 'yii\grid\SerialColumn',
        'options' => ['style' => 'width:40px'],
    ],
    'name',
    'contact',
    'email',
    'phone',
    'url',
    'region',
    'text',
    [
        'class'    => 'yii\grid\ActionColumn',
        'template' => '{delete}',
        'options'  => ['style' => 'width:100px']
    ]
];
?>
    <h1><?= $this->title ?></h1>
<?= \yii\grid\GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
);
