<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 19.09.2018
 * Time: 9:59
 */

/* @var $dataProvider \yii\data\ActiveDataProvider */

/* @var $filterModel \modules\partner\models\Builder */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Застройщики';

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
        },
        'filter'    => false
    ],
    [
        'attribute' => 'name',
    ],
    [
        'attribute' => 'url',
    ],
    [
        'attribute' => 'region_id',
        'format'    => 'html',
        'value'     => function ($model) {
            return $model->region_id ? $model->region->name : '';
        },
        'filter'    => false
    ],
    [
        'class'    => 'yii\grid\ActionColumn',
        'template' => '{delete}',
        'options'  => ['style' => 'width:100px'],
        'buttons'  => [
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to([
                    '/partner/builder/delete',
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
<?= Html::a('Добавить застройщика', Url::to(['/partner/builder/create']), ['class' => 'btn btn-admin add-big-button']) ?>
<?= \yii\grid\GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'filterModel'  => $filterModel,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['onclick' => 'window.location = "' . Url::to(['/partner/builder/update', 'id' => $model->id]) . '"'];
        },
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
); ?>
