<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 16:17
 */

use modules\shop\models\Item;
use modules\shop\models\ItemImage;
use yii\helpers\Html;

/* @var $model ItemImage */
/* @var $item Item */
$item = $model->item;
?>
<div class="image-admin-preview" data-id="<?= isset($model->id) ? $model->id : '' ?>" data-file="<?= $model->image ?>">
    <? if ($model->id && $model->item_id): ?>
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
    <?= Html::img($model->image, ['class' => 'img-admin']) ?>
</div>
