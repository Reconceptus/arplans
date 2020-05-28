<?php

use yii\helpers\Html;

/* @var $model \modules\shop\models\Item */
/* @var $favorites array */
/* @var $isInPrice bool */

$price = $model->getPrice();
?>

<div class="custom-row-col col-33">
    <div class="project-page--info static">
        <div class="main-data">
            <?php if (Yii::$app->user->can('adminPanel')): ?>
                <div class="index"><?= Html::a($model->name,['/admin/modules/shop/item/update','id'=>$model->id]) ?></div>
            <?php else: ?>
                <div class="index"><?= $model->name ?></div>
            <?php endif; ?>
            <div class="price">
                <div class="current-price"><?= $price ?>
                    &#8381;
                </div>
                <?php if ($model->discount > 0): ?>
                    <div class="old-price"><?= $model->price ?> руб</div>
                <?php endif; ?>
            </div>
        </div>
        <div class="data">
            <div class="data-col">
                <div class="actions">
                    <?php if ($isInCart): ?>
                        <?= Html::a('Добавлен в корзину', '', ['class' => 'btn-square-min incart js-to-cart', 'data-id' => $model->id]) ?>
                    <?php else: ?>
                        <?php if ($price || !$model->project): ?>
                            <?= Html::a('Купить проект', '', ['class' => 'btn-square-min js-to-cart', 'data-id' => $model->id]) ?>
                        <?php else: ?>
                            <?= Html::a('Скачать проект', \yii\helpers\Url::to(['/shop/download', 'id' => $model->id]),
                                ['class' => 'btn-square-min', 'data-id' => $model->id]) ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <button type="button" class="icon-liked js-favor <?= array_key_exists($model->id, $favorites) ? 'liked' : '' ?>"
                            data-id="<?= $model->id ?>">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                 xlink:href="#icon-heart-project"/>
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
                        <span>Замена материала стен и зеркальное отображение бесплатно</span>
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
                    <a href="#" class="btn-add show-modal" data-modal="consultation"><span>Заказать расчет дома</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
