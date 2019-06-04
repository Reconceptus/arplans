<?php

use modules\shop\models\RefRequest;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modules\shop\models\RefRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запросы рефереров';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'layout'       => "{summary}\n{items}",
    'rowOptions'   => function ($model) {
        return [
            'onclick' => 'window.location = "' . Url::to(['/shop/referrer/update', 'id' => $model->id]) . '"',
        ];
    },
    'columns'      => [
        [
            'attribute' => 'id',
            'filter'    => false,
            'options'   => ['style' => 'width:40px'],
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
<?= LinkPager::widget([
    'pagination'         => $dataProvider->getPagination(),
    'linkOptions'        => ['class' => 'page'],
    'activePageCssClass' => 'current',
    'nextPageLabel'      => '>',
    'prevPageLabel'      => '<',
    'prevPageCssClass'   => 'prev',
    'nextPageCssClass'   => 'next',
]) ?>
