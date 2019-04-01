<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 23.08.2018
 * Time: 11:43
 */

use yii\widgets\ActiveForm;

$this->title = $model->isNewRecord ? 'Добавление параметра' : 'Редактирование параметра';
?>
<h1><?= $this->title ?></h1>

<div class="post-form">
    <div class="row">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(); ?>
            <?=$form->field($model, 'catalog_id')->hiddenInput()->label(false)?>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'slug') ?>
            <?= $form->field($model, 'sort')->textInput(['type' => 'number']) ?>
            <?= \yii\helpers\Html::submitButton('Сохранить') ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>