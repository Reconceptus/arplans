<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 21.08.2018
 * Time: 12:03
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $models \modules\shop\models\Category */
/* @var $services \modules\shop\models\Service */
?>
<ul>
    <li class="show-more-parent">
        <span class="show-more">Готовые проекты домов <span class="tick"></span></span>
        <ul class="show-more-hidden">
            <? foreach ($models as $model): ?>
                <li>
                    <?= Html::a($model->name, Url::to('/shop/' . $model->slug)) ?>
                </li>
            <? endforeach; ?>
        </ul>
    </li>
    <? if ($services): ?>
        <li class="show-more-parent">
            <span class="show-more">Услуги <span class="tick"></span></span>
            <ul class="show-more-hidden">
                <? foreach ($services as $service): ?>
                    <li>
                        <?= Html::a($service->name, Url::to('/shop/service/' . $service->slug)) ?>
                    </li>
                <? endforeach; ?>
            </ul>
        </li>
    <? endif; ?>
    <li>
            <span>
                <a href="/contacts">Контакты</a>
            </span>
    </li>
    <li>
            <span>
                <a href="#" class="show-modal" data-modal="consultation">Консультация</a>
            </span>
    </li>
    <li>
            <span>
                <a href="/about">О нас</a>
            </span>
    </li>
    <li>
            <span>
                <a href="/collaboration">Сотрудничество</a>
            </span>
    </li>
    <li>
            <span>
                <a href="/village">Коттеджные поселки России</a>
            </span>
    </li>
    <li>
            <span>
                <a href="/builder">Строители и материалы</a>
            </span>
    </li>
</ul>
<div class="profile-menu">
    <ul>
        <li class="show-more-parent">
            <span class="show-more">Профиль <span class="tick"></span></span>
            <ul class="show-more-hidden">
                <li><?= \yii\helpers\Html::a('Мои данные', \yii\helpers\Url::to('/profile')) ?></li>
                <li><?= \yii\helpers\Html::a('Мои заказы', \yii\helpers\Url::to('/profile/orders')) ?></li>
                <li>
                    <? if (Yii::$app->user->identity->partner): ?>
                        <?= \yii\helpers\Html::a('Мои продажи', \yii\helpers\Url::to('/profile/sales')) ?>
                    <? endif; ?>
                </li>
                <li>
                    <? if (Yii::$app->user->can('adminPanel')): ?>
                        <?= \yii\helpers\Html::a('Админка', \yii\helpers\Url::to('/admin')) ?>
                    <? endif; ?>
                </li>
                <li><?= \yii\helpers\Html::a('Выйти', \yii\helpers\Url::to('/site/logout')) ?></li>
            </ul>
        </li>
    </ul>
</div>