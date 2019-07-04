<?php
/* @var $dataProvider ArrayDataProvider */

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Рефералы ';

$columns = [
    [
        'attribute' => 'id',
        'label'     => 'ID',
        'options'   => ['style' => 'width:100px'],
    ],
    [
        'attribute' => 'username',
        'filter'    => Html::textInput('username', Yii::$app->request->get('username'), ['class' => 'form-control']),
        'label'     => 'Пользователь',
    ],
    [
        'attribute' => 'profile.fio',
        'label'     => 'ФИО',
    ],
];
?>
    <h1><?= $this->title ?></h1>
<?php Pjax::begin() ?>
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
<?php Pjax::end() ?>