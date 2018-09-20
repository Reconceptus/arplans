<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 11.09.2018
 * Time: 10:53
 */

use yii\helpers\Html;

/* @var $model \modules\shop\models\Service */
?>
<div class="images-block" data-type="shop/service">
    <p style="font-weight: bold">Файлы</p>
    <div class="images-panel">
        <? foreach ($model->files as $file): ?>
            <?= $this->render('_file', ['model' => $file]) ?>
        <? endforeach; ?>
    </div>
    <div class="clearfix"></div>
    <form name="uploader" enctype="multipart/form-data" method="POST">
        <div class="upload">
            <?= Html::hiddenInput('type', \modules\shop\models\Service::TYPE_FILE) ?>
            <div class="upload-input">
                <?= Html::fileInput('images[]', '', ['class' => 'item-image-input', 'multiple' => true]) ?>
            </div>
            <div class="upload-button">
                <?= Html::submitButton('Загрузить файл', ['class' => 'btn btn-admin']) ?>
            </div>
        </div>
    </form>
</div>

