<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $dataProvider ActiveDataProvider */

$this->title = 'Выберите категорию товара';

$columns = [
    [
        'class'   => SerialColumn::class,
        'options' => ['style' => 'width:40px'],
    ],
    [
        'attribute' => 'image',
        'format'    => 'html',
        'options'   => ['style' => 'width:100px'],
        'value'     => static function ($model) {
            return $model->image ? Html::img($model->image, ['class' => 'post-list-image-preview']) : '';
        }
    ],
    'name',
];
?>
    <h1><?= $this->title ?></h1>

<?= GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'rowOptions'   => static function ($model) {
            return ['onclick' => 'window.location = "' . Url::to(['/admin/modules/shop/item/category', 'category_id' => $model->id]) . '"'];
        },
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
);