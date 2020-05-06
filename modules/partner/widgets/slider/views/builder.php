<?php
/* @var $model \modules\partner\models\Builder */
$index = 1;
$mainImage = $model->getMainImage(true);
?>
<div class="partner-page--slider">
    <div class="content content--md">
        <div class="partner-slider" data-owl="partner">
            <ul class="owl-carousel">
                <?php if ($model->getMainImage()): ?>
                    <li class="object-item" data-num="1">
                        <div class="projects-item--wrap">
                            <div class="projects-item--preview">
                                <div class="bg" role="img"
                                     aria-label="<?= $mainImage ? $mainImage->alt : '' ?>"
                                     style="background-image: url(<?= $mainImage ? $mainImage->file : '' ?>)"></div>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
                <?php foreach ($model->images as $image): ?>
                    <?php if ($image->id != $model->image_id): ?>
                        <li class="object-item" data-num="<?= ++$index ?>">
                            <div class="projects-item--wrap">
                                <div class="projects-item--preview">
                                    <div class="bg" role="img"
                                         aria-label="<?= $image->alt ?>"
                                         style="background-image: url(<?= $image->file ?>)"></div>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
