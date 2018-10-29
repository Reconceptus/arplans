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
<nav>
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
                <a href="/builder">Строители и магазины</a>
            </span>
        </li>
    </ul>
</nav>