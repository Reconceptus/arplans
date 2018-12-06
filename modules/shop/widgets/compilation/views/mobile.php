<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 30.08.2018
 * Time: 12:52
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $models array */
/* @var $favorites array */
/* @var $inCart array */
?>

<div class="section projects mobile-show">
    <div class="content content--lg">
        <div class="projects-filters">
            <div class="projects-filters--item current">новые проекты</div>
        </div>
        <div class="projects-list col-4">
            <? if (array_key_exists('new', $models)): ?>
                <? foreach ($models['new'] as $model): ?>
                    <div class="projects-item">
                        <?= \modules\shop\widgets\item\Item::widget(['model' => $model, 'favorites' => $favorites]) ?>
                    </div>
                <? endforeach; ?>
            <? endif; ?>
        </div>

        <div class="btn-box">
            <?= Html::a('все новые проекты', Url::to('/shop/compilation/new'), ['class' => 'btn btn--lt']) ?>
        </div>

    </div>

    <div class="content content--lg">
        <div class="projects-filters">
            <div class="projects-filters--item current">Скидки</div>
        </div>
        <div class="projects-list col-4">
            <? if (array_key_exists('discount', $models)): ?>
                <? foreach ($models['discount'] as $model): ?>
                    <div class="projects-item">
                        <?= \modules\shop\widgets\item\Item::widget(['model' => $model, 'favorites' => $favorites, 'inCart'=>$inCart]) ?>
                    </div>
                <? endforeach; ?>
            <? endif ?>
        </div>

        <div class="btn-box">
            <?= Html::a('все проекты со скидкой', Url::to('/shop/compilation/discount'), ['class' => 'btn btn--lt']) ?>
        </div>

    </div>

    <div class="content content--lg">
        <div class="projects-filters">
            <div class="projects-filters--item current">Бесплатно</div>
        </div>
        <div class="projects-list col-4">
            <? if (array_key_exists('free', $models)): ?>
                <? foreach ($models['free'] as $model): ?>
                    <div class="projects-item">
                        <?= \modules\shop\widgets\item\Item::widget(['model' => $model, 'favorites' => $favorites]) ?>
                    </div>
                <? endforeach; ?>
            <? endif; ?>
        </div>

        <div class="btn-box">
            <?= Html::a('все бесплатные проекты', Url::to('/shop/compilation/free'), ['class' => 'btn btn--lt']) ?>
        </div>

    </div>

</div>
