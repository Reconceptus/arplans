<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 29.08.2018
 * Time: 16:22
 */

use modules\shop\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $models Item[] */
/* @var $favorites array */
/* @var $inCart array */
$get = Yii::$app->request->get();
if (isset($get['category'])) {
    unset($get['category']);
}
?>
<div class="section projects">
    <div class="content content--lg mobile-hidden">
        <div class="projects-filters">
            <?= Html::a('скидки', 'javascript:void(0);', ['class' => 'projects-filters--item', 'data-filter' => "1"]) ?>
            <?= Html::a('новые проекты', 'javascript:void(0);', ['class' => 'projects-filters--item current', 'data-filter' => "2"]) ?>
            <?= Html::a('бесплатно', 'javascript:void(0);', ['class' => 'projects-filters--item', 'data-filter' => "3"]) ?>
        </div>
    </div>
    <div class="content content--lg active" data-filter-box="2">
        <div class="projects-filters mobile-show">
            <div class="projects-filters--item current">новые проекты</div>
        </div>
        <div class="projects-list col-4">
            <?php foreach ($models['new'] as $model): ?>
                <div class="projects-item">
                    <?= \modules\shop\widgets\item\Item::widget([
                        'model'     => $model,
                        'get'       => $get,
                        'favorites' => $favorites,
                        'inCart'    => $inCart
                    ]) ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="btn-box">
            <?= Html::a('все новые проекты', Url::to('/shop/compilation/new'), ['class' => 'btn btn--lt']) ?>
        </div>
    </div>
    <div class="content content--lg" data-filter-box="1">
        <div class="projects-filters mobile-show">
            <div class="projects-filters--item current">Скидки</div>
        </div>
        <div class="projects-list col-4">
            <?php foreach ($models['discount'] as $model): ?>
                <div class="projects-item">
                    <?= \modules\shop\widgets\item\Item::widget([
                        'model'     => $model,
                        'get'       => $get,
                        'favorites' => $favorites,
                        'inCart'    => $inCart
                    ]) ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="btn-box">
            <?= Html::a('все проекты со скидкой', Url::to('/shop/compilation/discount'), ['class' => 'btn btn--lt']) ?>
        </div>
    </div>
    <div class="content content--lg" data-filter-box="3">
        <div class="projects-filters mobile-show">
            <div class="projects-filters--item current">Бесплатно</div>
        </div>
        <div class="projects-list col-4">
            <?php foreach ($models['free'] as $model): ?>
                <div class="projects-item">
                    <?= \modules\shop\widgets\item\Item::widget([
                        'model'     => $model,
                        'get'       => $get,
                        'favorites' => $favorites,
                        'inCart'    => $inCart
                    ]) ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="btn-box">
            <?= Html::a('все бесплатные проекты', Url::to('/shop/compilation/free'), ['class' => 'btn btn--lt']) ?>
        </div>
    </div>
</div>