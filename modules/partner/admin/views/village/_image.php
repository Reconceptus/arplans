<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 16:17
 */

use yii\helpers\Html;

/* @var $model \modules\partner\models\VillageImage */
/* @var $item \modules\partner\models\Village */
$item = $model->village;
?>
<div class="image-admin-preview" data-id="<?= isset($model->id) ? $model->id : '' ?>" data-file="<?= $model->file ?>">
    <? if ($model->id && $model->village_id): ?>
        <? if ($item && $item->image_id === $model->id): ?>
            <div class="default-image" data-path="partner/village">
                <span class="glyphicon glyphicon-ok" title="Основное изображение"></span>
            </div>
        <? else: ?>
            <div class="js-set-default-image" data-path="partner/village">
                <span class="glyphicon glyphicon-ok" title="Сделать основным"></span>
            </div>
        <? endif; ?>
        <? if ($item && $item->back_image_id === $model->id): ?>
            <div class="back-image" data-path="partner/village">
                <span class="glyphicon glyphicon-ok" title="Фоновое изображение"></span>
            </div>
        <?else:?>
            <div class="js-set-back-image" data-path="partner/village">
                <span class="glyphicon glyphicon-ok" title="Сделать фоновым"></span>
            </div>
        <? endif; ?>
        <div class="img-alt <?= $model->alt ? 'green' : '' ?>" data-toggle="modal" data-id="<?= $model->id ?>"
             data-path="partner/village" data-target="#setAlt"
             title="<?= $model->alt ?? 'Добавить подпись' ?>">
            <span class="glyphicon glyphicon-pencil"></span>
        </div>
    <? endif; ?>
    <div class="js-image-admin-delete" data-path="partner/village">
        <span class="glyphicon glyphicon-trash" title="Удалить изображение"></span>
    </div>
    <?= Html::img($model->file, ['class' => 'img-admin']) ?>
</div>
