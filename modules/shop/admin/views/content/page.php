<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 05.09.2018
 * Time: 14:59
 */


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
    ],
    [
        'attribute' => 'text',
        'value'     => function ($model) {
            return mb_substr($model->text, 0, 150);
        }
    ],
];
?>
    <h1><?= $this->title ?></h1>
<?= \yii\grid\GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['onclick' => 'window.location = "' . Url::to(['/admin/modules/shop/content/update', 'id' => $model->id]) . '"'];
        },
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
);
