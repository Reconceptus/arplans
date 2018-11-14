<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.09.2018
 * Time: 12:42
 */

/* @var $model \modules\partner\models\Builder */
$index = 1;
?>
<div class="partner-page--slider">
    <div class="content content--md">
        <div class="partner-slider" data-owl="partner">
            <ul class="owl-carousel">
                <? if ($model->getMainImage()): ?>
                    <li class="object-item" data-num="1">
                        <div class="projects-item--wrap">
                            <div class="projects-item--preview">
                                <div class="bg" style="background-image: url(<?= $model->image->file ?>)"></div>
                            </div>
                        </div>
                    </li>
                <? endif; ?>
                <? foreach ($model->images as $image): ?>
                    <? if ($image->id != $model->image_id): ?>
                        <li class="object-item" data-num="<?= ++$index ?>">
                            <div class="projects-item--wrap">
                                <div class="projects-item--preview">
                                    <div class="bg" style="background-image: url(<?= $image->file ?>)"></div>
                                </div>
                            </div>
                        </li>
                    <? endif; ?>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
</div>
