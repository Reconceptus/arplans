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
<div class="search">
    <form action="/search">
        <div class="fieldset">
            <input class="input" type="text" name="q">
            <button class="submit" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-search"></use>
                </svg>
            </button>
        </div>
    </form>
</div>
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
    <li>
        <span>
            <?= Html::a('Блог', Url::to('/blog')) ?>
        </span>
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
                <? if (Yii::$app->user->isGuest): ?>
                    <li><?= \yii\helpers\Html::a('Войти', \yii\helpers\Url::to('/site/login')) ?></li>
                    <li><?= \yii\helpers\Html::a('Регистрация', \yii\helpers\Url::to('/site/signup')) ?></li>
                <? else: ?>
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
                <? endif; ?>
            </ul>
        </li>
    </ul>
</div>