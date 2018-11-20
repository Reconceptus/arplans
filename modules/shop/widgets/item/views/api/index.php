<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 29.08.2018
 * Time: 16:22
 */

use modules\shop\models\Item;

/* @var $model Item */
/* @var $favorites array */
/* @var $get array */
/* @var $isInCart bool */
?>
<div class="projects-item--wrap">
    <a data-id="<?= $model->id ?>" onclick="openItem(<?= $model->id ?>)" class="projects-item--preview">
        <div class="bg"
             style="background-image: url(<?= Yii::$app->request->getHostInfo() . $model->getMainImage() ?>)"></div>
        <div class="hash">
            <? if ($model->is_new): ?>
                <span class="new">новинка</span>
            <? endif; ?>
            <? if ($model->discount > 0): ?>
                <span class="sale">скидка</span>
            <? endif; ?>
            <? if (!$model->price): ?>
                <span class="free">бесплатно</span>
            <? endif; ?>
        </div>
        <div class="data">
            <span class="index"><?= $model->name ?></span>
            <ul class="info">
                <li>
                    <span class="head">Жилая</span>
                    <span><?= $model->live_area ?> м<sup>2</sup></span>
                </li>
                <li>
                    <span class="head">Полезная</span>
                    <span><?= $model->useful_area ?> м<sup>2</sup></span>
                </li>
                <li>
                    <span class="head">Общая</span>
                    <span><?= $model->common_area ?> м<sup>2</sup></span>
                </li>
            </ul>
        </div>
    </a>
    <div class="projects-item--actions">
        <div class="prices">
            <? if ($model->discount > 0): ?>
                <div class="price old"><?= $model->price ?> &#8381;</div>
            <? endif; ?>
            <div class="price"><?= $model->getPrice() ?>&#8381;
            </div>
        </div>
        <a href="javascript:void(0);" class="icon-like js-favor <?= array_key_exists($model->id, $favorites) ? 'liked' : '' ?>"
           data-id="<?= $model->id ?>">
            <svg xmlns="http://www.w3.org/2000/svg">
                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                     xlink:href="#icon-heart-like"/>
            </svg>
        </a>
        <a class="basket btn-small <?= $isInCart ? 'incart' : '' ?>" onclick="toCart(<?= $model->id ?>)"
           data-id="<?= $model->id ?>"><?= $isInCart ? 'в корзине' : 'в корзину' ?></a>
    </div>
</div>