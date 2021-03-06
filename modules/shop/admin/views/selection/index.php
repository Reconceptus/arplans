<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
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
        'rowOptions'   => static function ($model, $key, $index, $grid) {
            return ['onclick' => 'window.location = "'.Url::to(['/shop/selection/items', 'id' => $model->id]).'"'];
        },
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => SerialColumn::class],
            'name',
            'slug',
            [
                'attribute' => 'description',
                'value'     => static function ($model) {
                    return mb_substr($model->description, 0, 150);
                }
            ],
            [
                'attribute' => 'status',
                'value'     => static function ($model) {
                    return $model->status === 1 ? 'активна' : 'отключена';
                }
            ],
            [
                'attribute' => 'block.name',
                'label'     => 'Группа'
            ],
            [
                'class'    => ActionColumn::class,
                'template' => '{view}',
                'buttons'  => [
                    'view' => static function ($url, $model) {
                        return Html::a(count($model->selectionItems), $model->url, ['data-pjax' => 0]);
                    },
                ]
            ],
            [
                'class'    => ActionColumn::class,
                'template' => '{update}',
            ],
            [
                'class'    => ActionColumn::class,
                'template' => '{delete}',
            ],
        ],
    ]) ?>
    <?php Pjax::end(); ?>
</div>
