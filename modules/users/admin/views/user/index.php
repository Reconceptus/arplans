<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 08.08.2018
 * Time: 17:50
 */

/* @var $dataProvider \yii\data\ActiveDataProvider */

/* @var $filterModel User */

use common\models\User;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Users';
$auth = Yii::$app->authManager;

$columns = [
    [
        'header'    => 'Логин',
        'attribute' => 'username',
        'filter'    => Html::textInput('User[username]', Yii::$app->request->get('User')['username'], ['class' => 'form-control'])
    ],
    [
        'header' => 'ФИО',
        'filter' => Html::textInput('User[fio]', Yii::$app->request->get('User')['fio'], ['class' => 'form-control']),
        'value'  => function ($model) {
            return $model->profile->fio;
        },
    ],
    [
        'header'    => 'Роль',
        'attribute' => 'role',
        'filter'    => Html::dropDownList('User[role]', Yii::$app->request->get('User')['role'], \yii\helpers\ArrayHelper::merge(['' => 'Все'], User::getAccessTypes()), ['class' => 'form-control']),
    ],
    [
        'header'    => 'Статус',
        'attribute' => 'status',
        'format'    => 'html',
        'value'     => function ($model) {
            return $model->status === User::STATUS_ACTIVE ? '<span class="green">Активен</span>' : '<span class="red">Отключен</span>';
        },
        'filter'    => Html::dropDownList('User[status]', Yii::$app->request->get('User')['status'], ['' => 'Все', 10 => 'Активен', 0 => 'Не активен'], ['class' => 'form-control']),
    ],
    [
        'class'    => 'yii\grid\ActionColumn',
        'template' => '{delete}',
        'buttons'  => [
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-remove"></span>', Url::to([
                    '/users/user/delete',
                    'id'   => $model->id,
                    'back' => Yii::$app->request->absoluteUrl
                ]), [
                    'data-method'  => 'post',
                    'data-confirm' => 'Are you sure you want to delete this user?'
                ]);
            }
        ]
    ]
];
?>
    <h1><?= $this->title ?></h1>
<?= Html::a('Add user', Url::to(['/users/user/create', 'back' => Yii::$app->request->absoluteUrl]), ['class' => 'btn btn-admin add-big-button']) ?>
<?= GridView::widget([
    'id'           => 'user-list',
    'filterModel'  => $filterModel,
    'dataProvider' => $dataProvider,
    'rowOptions'   => function ($model, $key, $index, $grid) {
        return ['onclick' => 'window.location = "' . Url::to(['/users/user/update', 'id' => $model->id, 'back' => Yii::$app->request->absoluteUrl]) . '"'];
    },
    'layout'       => '{items}{pager}',
    'columns'      => $columns,
    'pager'        => [
        'firstPageLabel' => 'First',
        'lastPageLabel'  => 'Last',
    ]
]); ?>