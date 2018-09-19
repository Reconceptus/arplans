<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 19.09.2018
 * Time: 9:59
 */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Партнеры';

$columns = [
    [
        'class'   => 'yii\grid\SerialColumn',
        'options' => ['style' => 'width:40px'],
    ],
    [
        'attribute' => 'logo',
        'format'    => 'html',
        'options'   => ['style' => 'width:100px'],
        'value'     => function ($model) {
            return $model->logo ? Html::img($model->logo, ['class' => 'post-list-image-preview']) : '';
        }
    ],
    [
        'attribute' => 'name',
    ],
    [
        'attribute' => 'url',
    ],
    [
        'attribute' => 'region',
    ],
    [
        'class'    => 'yii\grid\ActionColumn',
        'template' => '{delete}',
        'options'  => ['style' => 'width:100px'],
        'buttons'  => [
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to([
                    '/admin/modules/partner/partner/delete',
                    'id'   => $model->id,
                    'back' => Yii::$app->request->absoluteUrl
                ]), [
                    'data-method'  => 'post',
                    'data-confirm' => 'Вы действительно хотите удалить этого партнера?'
                ]);
            }
        ]
    ]
];
?>
    <h1><?= $this->title ?></h1>
<?= Html::a('Добавить партнера', Url::to(['/admin/modules/partner/partner/create']), ['class' => 'btn btn-admin add-big-button']) ?>
<?= \yii\grid\GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['onclick' => 'window.location = "' . Url::to(['/admin/modules/partner/partner/update', 'id' => $model->id]) . '"'];
        },
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
);
