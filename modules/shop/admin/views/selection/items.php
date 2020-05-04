<?php

use modules\shop\models\Selection;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $selection Selection */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Подборка '.$selection->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="selection-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'price',
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{update} {view}',
                'buttons'  => [
                    'update' => static function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/shop/item/update', 'id' => $model->id]);
                    },
                    'view' => static function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $model->url);
                    },
                ]
            ],
        ],
    ]) ?>
    <?php Pjax::end(); ?>
</div>
