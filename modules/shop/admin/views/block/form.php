<?php

use modules\shop\models\Block;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Block */
/* @var $form ActiveForm */

$selections = $model->selections;
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
        <?php if ($selections): ?>
            <h3>В группу входят подборки:</h3>
            <?php foreach ($selections as $selection): ?>
                <p><?= $selection->name ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

