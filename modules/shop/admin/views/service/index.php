<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 05.09.2018
 * Time: 14:59
 */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Услуги';

$columns = [
    [
        'class'   => 'yii\grid\SerialColumn',
        'options' => ['style' => 'width:40px'],
    ],
    'name',
    'slug',
    'price',
    [
        'class'    => 'yii\grid\ActionColumn',
        'template' => '{delete}',
        'buttons'  => [
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/admin/modules/shop/category/delete', 'id' => $model->id]);
            }
        ],
        'options'  => ['style' => 'width:100px']
    ]
];
?>
    <h1><?= $this->title ?></h1>
<?= Html::a('Добавить услугу', Url::to('/admin/modules/shop/service/create'), ['class' => 'btn btn-admin add-big-button']) ?>
<?= \yii\grid\GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['onclick' => 'window.location = "' . Url::to(['/admin/modules/shop/service/update', 'id' => $model->id]) . '"'];
        },
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
);
