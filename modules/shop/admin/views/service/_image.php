<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 16:17
 */

use modules\shop\models\Item;
use yii\helpers\Html;

/* @var $model \modules\shop\models\ServiceImage */
/* @var $item Item */;
?>

<div class="image-admin-preview" data-id="<?= isset($model->id) ? $model->id : '' ?>" data-file="<?= $model->file ?>">
    <div class="js-image-admin-delete" data-path="shop/service">
        <span class="glyphicon glyphicon-trash" title="Удалить изображение"></span>
    </div>
    <div class="img-alt <?= $model->alt ? 'green' : '' ?>" data-toggle="modal" data-id="<?= $model->id ?>"
         data-path="shop/service" data-target="#setAlt"
         title="<?= $model->alt ?? 'Добавить подпись' ?>">
        <span class="glyphicon glyphicon-pencil"></span>
    </div>
    <?= Html::img($model->file, ['class' => 'img-admin']) ?>
</div>
