<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 24.08.2018
 * Time: 12:07
 */

use yii\helpers\Html;

/* @var $model \modules\shop\models\Item */
/* @var $favorites array */
/* @var $isInPrice bool */

$price = $model->getPrice();
?>

<div class="custom-row-col col-33">
    <div class="project-page--info static">
        <div class="main-data">
            <div class="index"><?= $model->name ?></div>
            <div class="price">
                <div class="current-price"><?= $price ?>
                    &#8381;
                </div>
                <? if ($model->discount > 0): ?>
                    <div class="old-price"><?= $model->price ?> руб</div>
                <? endif; ?>
            </div>
        </div>
        <div class="data">
            <div class="data-col">
                <div class="actions">
                    <? if ($isInCart): ?>
                        <?= Html::a('Добавлен в корзину', '', ['class' => 'btn-square-min incart js-to-cart', 'data-id' => $model->id]) ?>
                    <? else: ?>
                        <? if ($price || !$model->project): ?>
                            <?= Html::a('Купить проект', '', ['class' => 'btn-square-min js-to-cart', 'data-id' => $model->id]) ?>
                        <? else: ?>
                            <?= Html::a('Скачать проект', \yii\helpers\Url::to(['/shop/download', 'id' => $model->id]), ['class' => 'btn-square-min', 'data-id' => $model->id]) ?>
                        <? endif; ?>
                    <? endif; ?>
                    <a href="javascript:void(0);" class="icon-liked js-favor <?= array_key_exists($model->id, $favorites) ? 'liked' : '' ?>"
                       data-id="<?= $model->id ?>">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                 xlink:href="#icon-heart-project"/>
                        </svg>
                    </a>
                </div>
                <? if ($price > 0): ?>
                    <div class="feature">
                        <i class="icon-feature">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                     xlink:href="#icon-feature"/>
                            </svg>
                        </i>
                        <span>Замена материала стен и зеркальное отображение бесплатно</span>
                    </div>
                <? endif; ?>
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
                    <a href="#" class="btn-add show-modal" data-modal="calculation"><span>Получить точную смету</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
