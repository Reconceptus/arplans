<?php
/* @var $dataProvider ArrayDataProvider */

/* @var $searchModel array */

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Рефереры';

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
        'attribute' => 'referrals',
        'label'     => 'Количество рефералов',
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
<?php Pjax::begin() ?>
    <div class="posts-table">
        <?= GridView::widget(
            [
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'layout'       => '{items}{pager}',
                'rowOptions'   => function ($model) {
                    return ['onclick' => 'window.location = "' . Url::to(['/shop/referral/list', 'id' => $model['id']]) . '"'];
                },
                'columns'      => $columns
            ]
        );
        ?>
    </div>
<?php Pjax::end() ?>