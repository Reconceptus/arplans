<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modules\shop\models\SelectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Подборки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="selection-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Добавить подборку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['onclick' => 'window.location = "'.Url::to(['/shop/selection/items', 'id' => $model->id]).'"'];
        },
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'slug',
            'description',
            'status',
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons'  => [
                    'view' => static function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $model->url,['data-pjax'=>0]);
                    },
                ]
            ],
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]) ?>
    <?php Pjax::end(); ?>
</div>