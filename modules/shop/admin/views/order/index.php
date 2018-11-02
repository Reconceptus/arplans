<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 16:03
 */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Url;

$this->title = 'Заказы';

$columns = [
    [
        'class'   => 'yii\grid\SerialColumn',
        'options' => ['style' => 'width:40px'],
    ],
    [
        'attribute' => 'id',
        'header'    => 'Номер заказа',
    ],
    [
        'attribute' => 'user_id',
        'format'    => 'raw',
        'header'    => 'ФИО',
        'value'     => function ($model) {
            return $model->user->profile->fio;
        }
    ],
    [
        'attribute' => 'user_id',
        'format'    => 'raw',
        'header'    => 'Email',
        'value'     => function ($model) {
            return $model->user->email;
        }
    ],
    [
        'header'    => 'Дата оформления заказа',
        'attribute' => 'created_at',
        'value'     => function ($model) {
            return date('d m Y', strtotime($model->created_at));
        }
    ],
    [
        'header'    => 'Сумма заказа',
        'attribute' => 'price'
    ],
    [
        'header' => 'Сайт-партнер',
        'value'  => function ($model) {
            return $model->type === 1 && $model->user->partner ? $model->user->partner->name : '';
        }
    ],
    [
        'attribute' => 'status',
        'header'    => 'Статус'
    ]
];
?>
    <h1><?= $this->title ?></h1>
<?= \yii\grid\GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return [
                'onclick' => 'window.location = "' . Url::to(['/admin/modules/shop/order/update', 'id' => $model->id]) . '"',
                'style'   => $model->type === 1 && $model->user->partner ? 'color:blue' : ''
            ];
        },
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
);