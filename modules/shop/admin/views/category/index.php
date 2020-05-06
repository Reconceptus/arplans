<?php

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Категории товаров';

$columns = [
    [
        'class' => 'yii\grid\SerialColumn',
        'options'   => ['style' => 'width:40px'],
    ],
    [
        'attribute' => 'name',
    ],
];
?>
    <h1><?= $this->title ?></h1>
<?= Html::a('Добавить категорию', Url::to('/admin/modules/shop/category/create'), ['class' => 'btn btn-admin add-big-button']) ?>
<?= \yii\grid\GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['onclick' => 'window.location = "' . Url::to(['/shop/category/update', 'id' => $model->id]) . '"'];
        },
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
);
