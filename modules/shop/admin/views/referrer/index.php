<?php

use modules\shop\models\RefRequest;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modules\shop\models\RefRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запросы реферреров';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>
<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'rowOptions'   => function ($model) {
        return [
            'onclick' => 'window.location = "' . Url::to(['/shop/referrer/update', 'id' => $model->id]) . '"',
        ];
    },
    'columns'      => [
        [
            'class'   => 'yii\grid\SerialColumn',
            'options' => ['style' => 'width:40px'],
        ],
        [
            'attribute' => 'id',
            'filter'    => false,
            'options' => ['style' => 'width:40px'],
        ],
        [
            'attribute' => 'referrer_id',
            'filter'    => false,
            'value'     => function ($model) {
                /* @var $model RefRequest */
                return $model->referrer->username;
            }
        ],
        'amount',
        [
            'attribute' => 'status',
            'filter'    => RefRequest::STATUS_LIST,
            'value'     => function ($model) {
                /* @var $model RefRequest */
                return RefRequest::STATUS_LIST[$model->status];
            }
        ],
    ],
]); ?>
<?php Pjax::end(); ?>