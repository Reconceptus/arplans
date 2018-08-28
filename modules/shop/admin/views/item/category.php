<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 12:44
 */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Товары';

$columns = [
    [
        'class'   => 'yii\grid\SerialColumn',
        'options' => ['style' => 'width:40px'],
    ],
    [
        'attribute' => 'image_id',
        'format'    => 'html',
        'options'   => ['style' => 'width:100px'],
        'value'     => function ($model) {
            return $model->image_id ? Html::img($model->image->image, ['class' => 'post-list-image-preview']) : '';
        }
    ],
    [
        'attribute' => 'name',
    ],
    [
        'attribute' => 'price',
    ],
    [
        'attribute' => 'discount',
    ],
    [
        'class'    => 'yii\grid\ActionColumn',
        'template' => '{update} {delete}',
        'options'  => ['style' => 'width:100px']
    ]
];
?>
    <h1><?= $this->title ?></h1>
<?= Html::a('Добавить товар', Url::to(['/admin/modules/shop/item/create', 'category_id' => Yii::$app->request->get('category_id')]), ['class' => 'btn btn-admin add-big-button']) ?>
<?= \yii\grid\GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['onclick' => 'window.location = "' . Url::to(['/admin/modules/shop/item/update', 'id' => $model->id]) . '"'];
        },
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
);
