<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 29.08.2018
 * Time: 16:22
 */

/* @var $models \modules\shop\models\Item[] */
/* @var $inCart array */
?>
<? if ($models): ?>
    <div class="section like-slider">
        <div class="content content--lg">
            <div class="like-slider--wrap">
                <h3 class="title">Вам могут понравиться</h3>
                <div class="like-slider--carousel" data-owl="likes">
                    <ul class="owl-carousel">
                        <? foreach ($models as $model): ?>
                            <? $image = $model->getMainImage(true); ?>
                            <? $isInCart = array_key_exists($model->id, $inCart); ?>
                            <li class="projects-item">
                                <div class="projects-item--wrap">
                                    <a href="<?= \yii\helpers\Url::to(['/shop/' . $model->category->slug . '/' . $model->slug, $get ?? []]) ?>"
                                       class="projects-item--preview">
                                        <div class="bg" <?= $image ? 'style="background-image: url(' . $image->getThumb() . ')"' : '' ?>></div>
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
                                        <button type="button" class="icon-like js-favor <?= array_key_exists($model->id, $favorites) ? 'liked' : '' ?>"
                                           data-id="<?= $model->id ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     xlink:href="#icon-heart-like"/>
                                            </svg>
                                        </button>
                                        <a class="basket btn-small <?= $isInCart ? 'incart' : '' ?> js-to-cart"
                                           data-id="<?= $model->id ?>"><?= $isInCart ? 'в корзине' : 'в корзину' ?></a>
                                    </div>
                                </div>
                            </li>
                        <? endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<? endif; ?>