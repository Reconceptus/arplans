<?php

use modules\shop\models\Promocode;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modules\shop\models\PromocodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Промокоды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocode-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <p>
        <?= Html::a('Добавить промокод', ['/shop/promocode/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'rowOptions'   => static function ($model, $key, $index, $grid) {
            return ['onclick' => 'window.location = "'.Url::to(['/shop/promocode/update', 'id' => $model->id]).'"'];
        },
        'columns'      => [
            ['class' => SerialColumn::class],

            'id',
            'code',
            'fixed_discount',
            'percent_discount',
            'min_amount',
            'number_of_uses',
            'used',
            'start_date',
            'end_date',
            [
                'attribute' => 'status',
                'value'     => static function ($model) {
                    return $model->status === Promocode::STATUS_ACTIVE ? '<span class="green">Активен</span>' : '<span class="red">Отключен</span>';
                },
                'filter'    => Promocode::STATUS_LIST
            ],

            [
                'class'    => ActionColumn::class,
                'template' => '{delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
