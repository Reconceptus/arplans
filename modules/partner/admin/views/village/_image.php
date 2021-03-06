<?php

use yii\helpers\Html;

/* @var $model \modules\partner\models\VillageImage */
/* @var $item \modules\partner\models\Village */
$item = $model->village;
?>
<div class="image-admin-preview" data-id="<?= isset($model->id) ? $model->id : '' ?>" data-file="<?= $model->file ?>">
    <?php if ($model->id && $model->village_id): ?>
        <?php if ($item && $item->image_id === $model->id): ?>
            <div class="default-image" data-path="partner/village">
                <span class="glyphicon glyphicon-ok" title="Основное изображение"></span>
            </div>
        <?php else: ?>
            <div class="js-set-default-image" data-path="partner/village">
                <span class="glyphicon glyphicon-ok" title="Сделать основным"></span>
            </div>
        <?php endif; ?>
        <?php if ($item && $item->back_image_id === $model->id): ?>
            <div class="back-image" data-path="partner/village">
                <span class="glyphicon glyphicon-ok" title="Фоновое изображение"></span>
            </div>
        <?else:?>
            <div class="js-set-back-image" data-path="partner/village">
                <span class="glyphicon glyphicon-ok" title="Сделать фоновым"></span>
            </div>
        <?php endif; ?>
        <div class="img-alt <?= $model->alt ? 'green' : '' ?>" data-toggle="modal" data-id="<?= $model->id ?>"
             data-path="partner/village" data-target="#setAlt"
             title="<?= $model->alt ?? 'Добавить подпись' ?>">
            <span class="glyphicon glyphicon-pencil"></span>
        </div>
    <?php endif; ?>
    <div class="js-image-admin-delete" data-path="partner/village">
        <span class="glyphicon glyphicon-trash" title="Удалить изображение"></span>
    </div>
    <?= Html::img($model->file, ['class' => 'img-admin']) ?>
</div>
