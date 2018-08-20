<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.08.2018
 * Time: 16:59
 */

/* @var  $model \modules\shop\models\Item */
?>
<div class="projects-item--wrap">
    <a href="#" class="projects-item--preview">
        <div class="bg"
             style="background-image: url(<?= $model->getMainImage() ?>)"></div>
        <? if ($model->is_new): ?>
            <div class="hash">
                <span class="new">новинка</span>
            </div>
        <? endif; ?>
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
            <? if ($model->discount): ?>
                <div class="price old"><?= $model->price ?> &#8381;</div>
            <? endif; ?>
            <div class="price"><?= $model->discount ? $model->price - $model->discount : $model->price ?>&#8381;
            </div>
        </div>
        <a href="#" class="icon-like liked">
            <svg xmlns="http://www.w3.org/2000/svg">
                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                     xlink:href="#icon-heart-like"/>
            </svg>
        </a>
        <a href="#" class="basket btn-small">в корзину</a>
    </div>
</div>
