<?php

use modules\shop\models\Block;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\shop\models\Block */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->isNewRecord ? 'Создание группы' : 'Редактирование группы '.$model->name;
?>
<div class="container">
    <h1><?= $this->title ?></h1>
    <div class="block-form">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-xs-10">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status')->dropDownList(Block::STATUS_LIST) ?>

                <?= $form->field($model, 'sort')->textInput(['type' => 'number', 'step' => 1]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-10">
                <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'seo_description')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

