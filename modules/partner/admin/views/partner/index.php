<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 23.10.2018
 * Time: 16:53
 */

/* @var $dataProvider \yii\data\ActiveDataProvider */

/* @var $filterModel \modules\partner\models\Partner */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Партнеры';

$columns = [
    [
        'class'   => 'yii\grid\SerialColumn',
        'options' => ['style' => 'width:40px'],
    ],
    [
        'attribute' => 'name',
    ],
    [
        'attribute' => 'url',
    ],
    [
        'attribute' => 'api_url',
    ],
    [
        'header' => 'Представитель',
        'format' => 'html',
        'value'  => function ($model) {
            if ($model->agent) {
                return $model->agent->profile->fio ?? $model->agent->username;
            } else {
                return '';
            }
        },
        'filter' => false
    ],
    [
        'class'    => 'yii\grid\ActionColumn',
        'template' => '{config} {categories} {delete}',
        'options'  => ['style' => 'width:100px'],
        'buttons'  => [
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to([
                    '/partner/partner/delete',
                    'id'   => $model->id,
                    'back' => Yii::$app->request->absoluteUrl
                ]), [
                    'data-method'  => 'post',
                    'data-confirm' => 'Вы действительно хотите удалить этого партнера?'
                ]);
            },
            'categories' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-list"></span>', Url::to([
                    '/partner/partner/categories',
                    'id'   => $model->id,
                    'back' => Yii::$app->request->absoluteUrl
                ]));
            },
            'config' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to([
                    '/partner/partner/config',
                    'id'   => $model->id
                ]));
            }
        ]
    ]
];
?>
<h1><?= $this->title ?></h1>
<?= Html::a('Добавить партнера (быстро)', Url::to(['/partner/partner/add']), ['class' => 'btn btn-admin add-big-button']) ?>
<?= Html::a('Добавить партнера', Url::to(['/partner/partner/create']), ['class' => 'btn btn-admin add-big-button']) ?>
<?= \yii\grid\GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'filterModel'  => $filterModel,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['onclick' => 'window.location = "' . Url::to(['/partner/partner/update', 'id' => $model->id]) . '"'];
        },
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
); ?>
