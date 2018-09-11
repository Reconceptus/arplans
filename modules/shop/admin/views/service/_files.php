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
<div class="images-block">
    <p style="font-weight: bold">Файлы</p>
    <div class="images-panel">
        <? foreach ($model->files as $file): ?>
            <?= $this->render('_file', ['model' => $file]) ?>
        <? endforeach; ?>
    </div>
    <div class="clearfix"></div>
    <form name="uploader-service" enctype="multipart/form-data" method="POST">
        <div class="upload">
            <?= Html::hiddenInput('type', \modules\shop\models\Service::TYPE_FILE) ?>
            <div class="upload-input">
                <?= Html::fileInput('ServiceFile[file]', '', ['class' => 'item-image-input']) ?>
            </div>
            <div class="upload-button">
                <?= Html::submitButton('Загрузить файл', ['class' => 'btn btn-admin js-add-photo']) ?>
            </div>
        </div>
    </form>
</div>

