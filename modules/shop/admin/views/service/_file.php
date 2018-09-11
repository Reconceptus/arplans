<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 11.09.2018
 * Time: 12:54
 */

use yii\helpers\Html;

/* @var $model \modules\shop\models\ServiceFile*/
$fileName = explode('/',$model->file);
$fileName = end($fileName);
?>
<div class="image-admin-preview file-preview" data-id="<?= isset($model->id) ? $model->id : '' ?>" data-file="<?= $model->file ?>">
    <div class="js-image-admin-delete">
        <span class="glyphicon glyphicon-trash" title="Удалить изображение"></span>
    </div>
    <?= Html::img('/img/file-icon.png', ['class' => 'img-admin file-admin']) ?>
    <div style="word-wrap: break-word"><?=$fileName?></div>
</div>
