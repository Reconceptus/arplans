<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 24.08.2018
 * Time: 11:32
 */

/* @var $model \modules\shop\models\Item */

$mainImage = $model->getMainImage(true);
$index = 1;
?>
<div class="custom-row-col col-66">
    <div class="project-page--slider">
        <div class="project-gallery">
            <div class="gallery-list-wrap">
                <div class="gallery-list">
                    <? if ($mainImage): ?>
                        <div class="item" data-num="1">
                            <figure style="background-image: url(<?= $mainImage->getThumb() ?>)"
                                    data-url-fancybox="<?= $mainImage->image ?>"></figure>
                        </div>
                    <? endif; ?>
                    <? foreach ($model->getPhotos() as $image): ?>
                    <? /* @var $image \modules\shop\models\ItemImage*/?>
                        <? if ($image->id !== $model->image_id): ?>
                            <div class="item" data-num="<?= ++$index ?>">
                                <figure style="background-image: url(<?= $image->getThumb() ?>)"
                                        data-url-fancybox="<?= $image->image ?>"></figure>
                            </div>
                        <? endif; ?>
                    <? endforeach; ?>
                </div>
            </div>
            <div class="buttons">
                <button class="prev back"></button>
                <button class="next forw"></button>
                <button class="up back"></button>
                <button class="down forw"></button>
            </div>
        </div>
    </div>
</div>
