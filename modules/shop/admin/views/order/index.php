<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 16:03
 */

/* @var $dataProvider \yii\data\ActiveDataProvider */

/* @var $filterModel \modules\shop\models\Order */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;

$this->title = 'Заказы';

$order = Yii::$app->request->get('Order');

$columns = [
    [
        'class'   => 'yii\grid\SerialColumn',
        'options' => ['style' => 'width:40px'],
    ],
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
            '<div style="min-width: 165px">' .
            DatePicker::widget([
                'dateFormat' => 'dd.MM.yyyy',
                'name'       => 'Order[from]',
                'value'      => $order['from'] ? (new \DateTime(Yii::$app->request->get('Order')['from']))->format('d.m.Y') : '',
                'options'    => ['style' => 'width:80px; display: inline-block;font-size:13px', 'placeholder' => 'От']
            ]) .

            DatePicker::widget([
                'dateFormat' => 'dd.MM.yyyy',
                'name'       => 'Order[to]',
                'value'      => $order['to'] ? (new \DateTime(Yii::$app->request->get('Order')['to']))->format('d.m.Y') : '',
                'options'    => ['style' => 'width:80px; display: inline-block;font-size:13px', 'placeholder' => 'До']
            ]) .
            '</div>',
        'value'     => function ($model) {
            return date('d m Y', strtotime($model->created_at));
        }
    ],
    [
        'header'    => 'Сумма заказа',
        'attribute' => 'price',
        'filter'    =>
            '<div style="min-width: 170px">' .
            Html::textInput('Order[price_from]', $order['price_from'], ['style' => 'width:80px;display: inline-block;font-size:13px']) . ' ' .
            Html::textInput('Order[price_to]', $order['price_to'], ['style' => 'width:80px;display: inline-block;font-size:13px']) .
            '</div>',
    ],
    [
        'header' => 'Сайт-партнер',
        'value'  => function ($model) {
            return $model->type === 1 && $model->user->partner ? $model->user->partner->name : '';
        }
    ],
    [
        'attribute' => 'status',
        'header'    => 'Статус',
        'filter'    => Html::dropDownList('Order[status]', $order['status'], \modules\shop\models\Order::getStatusList()),
        'value'     => function ($model) {
            return \modules\shop\models\Order::getStatusName($model->status);
        }
    ]
];
?>
    <h1><?= $this->title ?></h1>
<?= Html::a('Сбросить фильтры', Url::to('/admin/modules/shop/order'), ['class' => 'btn btn-admin','style'=>'margin-bottom:20px']) ?>

<?= \yii\grid\GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'filterModel'  => $filterModel,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return [
                'onclick' => 'window.location = "' . Url::to(['/admin/modules/shop/order/update', 'id' => $model->id]) . '"',
                'style'   => $model->type === 1 && $model->user->partner ? 'color:blue' : ''
            ];
        },
        'layout'       => '{items}{pager}',
        'columns'      => $columns
    ]
);