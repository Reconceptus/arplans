<?php

use modules\shop\models\Item;
use modules\shop\models\ItemImage;
use yii\helpers\Html;

/* @var $model ItemImage */
/* @var $item Item */
$item = $model->item;
?>
<div class="image-admin-preview" data-id="<?= isset($model->id) ? $model->id : '' ?>" data-file="<?= $model->image ?>">
    <?php if ($model->id && $model->item_id): ?>
        <?php if ($item && $item->image_id === $model->id): ?>
            <div class="default-image">
                <span class="glyphicon glyphicon-ok" title="Основное изображение"></span>
            </div>
        <?php else: ?>
            <div class="js-set-default-image">
                <span class="glyphicon glyphicon-ok" title="Сделать основным"></span>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="js-image-admin-delete" data-path="shop/item">
        <span class="glyphicon glyphicon-trash" title="Удалить изображение"></span>
    </div>
    <div class="img-alt <?= $model->alt ? 'green' : '' ?>" data-toggle="modal" data-id="<?= $model->id ?>"
         data-path="shop/item" data-target="#setAlt"
         title="<?= $model->alt ?? 'Добавить подпись' ?>">
        <span class="glyphicon glyphicon-pencil"></span>
    </div>
    <?= Html::img($model->image, ['class' => 'img-admin']) ?>
</div>
