<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 16:17
 */

use yii\helpers\Html;

/* @var $model \modules\partner\models\BuilderImage */
/* @var $item \modules\partner\models\Builder */
$item = $model->builder;
?>
<div class="image-admin-preview" data-id="<?= isset($model->id) ? $model->id : '' ?>" data-file="<?= $model->file ?>">
    <? if ($model->id && $model->builder_id): ?>
        <? if ($item && $item->image_id === $model->id): ?>
            <div class="default-image">
                <span class="glyphicon glyphicon-ok" title="Основное изображение"></span>
            </div>
        <? else: ?>
            <div class="js-set-default-image">
                <span class="glyphicon glyphicon-ok" title="Сделать основным"></span>
            </div>
        <? endif; ?>
    <? endif; ?>
    <div class="js-image-admin-delete">
        <span class="glyphicon glyphicon-trash" title="Удалить изображение"></span>
    </div>
    <?= Html::img($model->file, ['class' => 'img-admin']) ?>
</div>
