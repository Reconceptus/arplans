<?php
/* @var $dataProvider ArrayDataProvider */

use yii\data\ArrayDataProvider;
use yii\grid\GridView;

$this->title = 'Рефералы';

$columns = [
    [
        'class'   => 'yii\grid\SerialColumn',
        'options' => ['style' => 'width:40px'],
    ],
    [
        'attribute' => 'id',
        'label'     => 'ID',
        'options'   => ['style' => 'width:100px'],
    ],
    [
        'attribute' => 'username',
        'label'     => 'Пользователь',
    ],
    [
        'attribute' => 'referrals',
        'label'     => 'Количество реферралов',
    ],
    [
        'attribute' => 'bonus_total',
        'label'     => 'Всего заработано',
        'value'     => function ($model) {
            return $model['bonus_total'] ?? 0;
        }
    ],
    [
        'attribute' => 'balance',
        'label'     => 'На счету',
    ],
    [
        'attribute' => 'created_at',
        'label'     => 'Зарегистрирован',
        'options'   => ['style' => 'width:100px']
    ],
];
?>
<h1><?= $this->title ?></h1>
<div class="posts-table">
    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'layout'       => '{items}{pager}',
            'columns'      => $columns
        ]
    );
    ?>
</div>