<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 17:35
 */

use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $dataProvider \yii\data\ActiveDataProvider*/
?>
<div class="view-list partners-list">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options'      => [
            'tag' => 'ul'
        ],
        'pager'        => [
            'nextPageLabel'      => '',
            'prevPageLabel'      => '',
            'maxButtonCount'     => '10',
            'activePageCssClass' => 'current',
            'linkOptions'        => [
                'class' => 'pager-el',
            ],
            'options'            => [
                'class' => 'pager'
            ],
        ],
        'itemOptions'  => [
            'tag' => 'li',
        ],
        'layout'       => "{items}",
        'itemView'     => function ($model, $key, $index, $widget) {
            return $this->render('_item', ['model' => $model]);
        },
    ]); ?>

    <div class="catalog-actions">
        <?= LinkPager::widget([
            'pagination'         => $dataProvider->getPagination(),
            'linkOptions'        => ['class' => 'page'],
            'activePageCssClass' => 'current',
            'nextPageLabel'      => '>',
            'prevPageLabel'      => '<',
            'prevPageCssClass'   => 'prev',
            'nextPageCssClass'   => 'next',
        ]) ?>
    </div>
</div>
