<?php

/* @var $model \modules\shop\models\Item */

$mainImage = $model->image;
$index = 1;
?>
<div class="custom-row-col col-66">
    <div class="project-page--slider">
        <div class="project-gallery">
            <div class="gallery-list-wrap">
                <div class="gallery-list">
                    <?php if ($model->getMainImage()): ?>
                        <div class="item" data-num="1">
                            <figure style="background-image: url(<?= Yii::$app->request->getHostInfo() . $model->image->image ?>)"
                                    data-url-fancybox="<?= Yii::$app->request->getHostInfo() . $model->image->image ?>"></figure>
                        </div>
                    <?php endif; ?>
                    <?php foreach ($model->getPhotos() as $image): ?>
                        <?php if ($image->id !== $model->image_id): ?>
                            <div class="item" data-num="<?= ++$index ?>">
                                <figure style="background-image: url(<?= Yii::$app->request->getHostInfo() . $image->image ?>)"
                                        data-url-fancybox="<?= Yii::$app->request->getHostInfo() . $image->image ?>"></figure>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
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
