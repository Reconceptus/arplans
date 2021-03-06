<?php

/* @var $model \modules\shop\models\Item */
/* @var $favorites array */
/* @var $isInCart bool */

$price = $model->getPrice();
?>

<div class="custom-row-col col-33">
    <div class="project-page--info static">
        <div class="main-data">
            <div class="index"><?= $model->name ?></div>
            <div class="price">
                <div class="current-price"><?= $price ?>
                    <span class="pt-sans">&#8381;</span>
                </div>
                <?php if ($model->discount > 0): ?>
                    <div class="old-price"><?= $model->price ?> руб</div>
                <?php endif; ?>
            </div>
        </div>
        <div class="data">
            <div class="data-col">
                <div class="actions">
                    <a class="btn-square-min basket <?= $isInCart ? 'incart' : '' ?>"
                       onclick="toCart(<?= $model->id ?>)" data-id="<?= $model->id ?>"><?= $isInCart ? 'Добавлен в корзину' : 'Купить проект' ?></a>
                    <button type="button" class="icon-liked js-favor <?= array_key_exists($model->id, $favorites) ? 'liked' : '' ?>"
                       data-id="<?= $model->id ?>">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                 xlink:href="#icon-heart"/>
                        </svg>
                    </button>
                </div>
                <?php if ($price > 0): ?>
                    <div class="feature">
                        <i class="icon-feature">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                     xlink:href="#icon-feature"/>
                            </svg>
                        </i>
                        <span>Архитектурно-строительный комплект чертежей</span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="data-col">
                <div class="info">
                    <i class="icon-sign">i</i>
                    <ul>
                        <li>
                            <span class="head">Жилая:</span>
                            <span class="text"><?= $model->live_area ?> м<sup>2</sup></span>
                        </li>
                        <li>
                            <span class="head">Полезная:</span>
                            <span class="text"><?= $model->useful_area ?> м<sup>2</sup></span>
                        </li>
                        <li>
                            <span class="head">Общая:</span>
                            <span class="text"><?= $model->common_area ?> м<sup>2</sup></span>
                        </li>
                    </ul>
                </div>
                <div class="estimate">
                    <a href="#" class="btn-add show-modal" data-modal="calculation"><span>Заказать расчет дома</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
