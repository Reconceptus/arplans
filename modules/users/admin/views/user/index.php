<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 08.08.2018
 * Time: 17:50
 */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use common\models\User;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Users';
$auth = Yii::$app->authManager;

$columns = [
    [
        'attribute' => 'username',
    ],
    [
        'attribute' => 'email',
    ],
    [
        'attribute' => 'status',
        'value'     => function ($model) {
            return $model->status === User::STATUS_ACTIVE ? 'Active' : 'Disabled';
        }
    ],
    [
        'label' => 'Roles',
        'value' => function ($model) use ($auth) {
            $roles = $auth->getRolesByUser($model->id);
            $result = [];
            foreach ($roles as $role) {
                $result[] = mb_strtolower($role->description);
            }
            return implode(',', $result);
        }
    ],
    [
        'class'    => 'yii\grid\ActionColumn',
        'template' => '{delete}',
        'buttons'  => [
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to([
                    '/admin/modules/users/user/delete',
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
<?= Html::a('Add user', Url::to(['/admin/modules/users/user/create', 'back' => Yii::$app->request->absoluteUrl]), ['class' => 'btn btn-admin add-big-button']) ?>
<?= GridView::widget([
    'id'           => 'user-list',
    'dataProvider' => $dataProvider,
    'rowOptions'   => function ($model, $key, $index, $grid) {
        return ['onclick' => 'window.location = "' . Url::to(['/admin/modules/users/user/update', 'id' => $model->id, 'back' => Yii::$app->request->absoluteUrl]) . '"'];
    },
    'layout'       => '{items}{pager}',
    'columns'      => $columns,
    'pager'        => [
        'firstPageLabel' => 'First',
        'lastPageLabel'  => 'Last',
    ]
]); ?>