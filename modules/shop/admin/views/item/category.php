<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 12:44
 */

use modules\shop\models\Item;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;


/* @var $dataProvider ActiveDataProvider */
/* @var $filterModel Item */

$this->title = 'Товары';

$columns = [
    'id',
    [
        'attribute' => 'image_id',
        'format'    => 'html',
        'options'   => ['style' => 'width:100px'],
        'value'     => function ($model) {
            return $model->image ? Html::img($model->image->image, ['class' => 'post-list-image-preview']) : '';
        },
        'filter'    => false
    ],
    [
        'attribute' => 'name',
    ],
    [
        'attribute' => 'price',
        'filter'    => false
    ],
    [
        'attribute' => 'discount',
        'filter'    => false
    ],
    'created_at',
    [
        'class'    => 'yii\grid\ActionColumn',
        'template' => '{delete}',
        'options'  => ['style' => 'width:100px'],
        'buttons'  => [
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to([
                    '/shop/item/delete',
                    'id'   => $model->id,
                    'back' => Yii::$app->request->absoluteUrl
                ]), [
                    'data-method'  => 'post',
                    'data-confirm' => 'Вы действительно хотите удалить этот товар?'
                ]);
            }
        ]
    ]
];
?>
<h1><?= $this->title ?></h1>
<?= Html::a('Добавить товар', Url::to(['/shop/item/create', 'category_id' => Yii::$app->request->get('category_id')]), ['class' => 'btn btn-admin add-big-button']) ?>
<?= GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'filterModel'  => $filterModel,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['onclick' => 'window.location = "' . Url::to(['/shop/item/update', 'id' => $model->id]) . '"'];
        },
        'layout'=>"{summary}\n{items}",
        'columns'      => $columns
    ]
);
?>

<?= LinkPager::widget([
    'pagination'         => $dataProvider->getPagination(),
    'linkOptions'        => ['class' => 'page'],
    'activePageCssClass' => 'current',
    'nextPageLabel'      => '>',
    'prevPageLabel'      => '<',
    'prevPageCssClass'   => 'prev',
    'nextPageCssClass'   => 'next',
]) ?>
