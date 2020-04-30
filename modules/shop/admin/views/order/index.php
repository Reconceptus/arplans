<?php

use modules\shop\models\Order;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;

/* @var $dataProvider ActiveDataProvider */
/* @var $partners array */
/* @var $filterModel Order */

$this->title = 'Заказы';

$order = Yii::$app->request->get('Order');

$columns = [
    [
        'attribute' => 'id',
        'header'    => 'Номер заказа',
        'filter'    => Html::textInput('Order[id]', $order['id'], ['style' => 'width:80px;display: inline-block;font-size:13px'])
    ],
    [
        'attribute' => 'fio',
        'format'    => 'raw',
        'header'    => 'ФИО',
        'filter'    => Html::textInput('Order[fio]', $order['fio'], ['style' => 'display: inline-block;font-size:13px']),
        'value'     => function ($model) {
            return $model->user->profile->fio;
        }
    ],
    [
        'attribute' => 'email',
        'format'    => 'raw',
        'header'    => 'Email',
        'filter'    => Html::textInput('Order[email]', $order['email'], ['style' => 'display: inline-block;font-size:13px']),
        'value'     => function ($model) {
            return $model->user->email;
        }
    ],
    [
        'header'    => 'Дата оформления заказа',
        'attribute' => 'created_at',
        'options'   => ['style' => 'width:190px;'],
        'filter'    =>
            '<div style="min-width: 165px">'.
            DatePicker::widget([
                'dateFormat' => 'dd.MM.yyyy',
                'name'       => 'Order[from]',
                'value'      => $order['from'] ? (new DateTime(Yii::$app->request->get('Order')['from']))->format('d.m.Y') : '',
                'options'    => ['style' => 'width:80px; display: inline-block;font-size:13px', 'placeholder' => 'От']
            ]).

            DatePicker::widget([
                'dateFormat' => 'dd.MM.yyyy',
                'name'       => 'Order[to]',
                'value'      => $order['to'] ? (new DateTime(Yii::$app->request->get('Order')['to']))->format('d.m.Y') : '',
                'options'    => ['style' => 'width:80px; display: inline-block;font-size:13px', 'placeholder' => 'До']
            ]).
            '</div>',
        'value'     => function ($model) {
            return date('d m Y', strtotime($model->created_at));
        }
    ],
    [
        'header' => 'Промокод',
        'value'  => function ($model) {
            /* @var $model Order */
            $promocode = $model->promocode;
            return $promocode ? $promocode->code.' на '.($promocode->fixed_discount ? $promocode->fixed_discount.'руб.' : $promocode->percent_discount.'%') : '';
        }
    ],
    [
        'header' => 'Цена с промокодом',
        'value'  => function ($model) {
            return $model->price_after_promocode ?? $model->price;
        }
    ],
    [
        'header'    => 'Сумма заказа',
        'attribute' => 'price',
        'filter'    =>
            '<div style="min-width: 170px">'.
            Html::textInput('Order[price_from]', $order['price_from'], ['style' => 'width:80px;display: inline-block;font-size:13px']).' '.
            Html::textInput('Order[price_to]', $order['price_to'], ['style' => 'width:80px;display: inline-block;font-size:13px']).
            '</div>',
    ],
    [
        'header' => 'Сайт-партнер',
        'filter' => Html::dropDownList('Order[partner]', $order['partner'], $partners),
        'value'  => function ($model) {
            return $model->type === 1 && $model->user->partner ? $model->user->partner->name : '';
        }
    ],
    [
        'attribute' => 'referrer_id',
        'header'    => 'Реферер',
        'filter'    => Html::textInput('Order[referrer_id]', $order['referrer_id'], ['style' => 'display: inline-block;font-size:13px']),
        'value'     => function ($model) {
            return $model->referrer_id ? $model->referrer->username : '';
        }
    ],
    [
        'attribute' => 'status',
        'header'    => 'Статус',
        'filter'    => Html::dropDownList('Order[status]', $order['status'], array_merge([0 => ''], Order::getStatusList())),
        'value'     => function ($model) {
            return Order::getStatusName($model->status);
        }
    ]
];
?>
    <h1><?= $this->title ?></h1>
<?= Html::a('Сбросить фильтры', Url::to('/admin/modules/shop/order'), ['class' => 'btn btn-admin', 'style' => 'margin-bottom:20px']) ?>

<?= GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'filterModel'  => $filterModel,
        'rowOptions'   => function ($model) {
            return [
                'onclick' => 'window.location = "'.Url::to(['/shop/order/update', 'id' => $model->id]).'"',
                'style'   => $model->type === 1 && $model->user->partner ? 'color:blue' : ''
            ];
        },
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
);