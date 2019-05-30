<?php

use modules\shop\models\RefRequest;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\shop\models\RefRequest */
/* @var $form yii\widgets\ActiveForm */
$referrer = $model->referrer;
?>

<div class="ref-request-form">

    <?php $form = ActiveForm::begin(); ?>


    <p>Запрос от пользователя <?= $referrer->username ?></p>
    <p>На счету пользователя <?= $model->referrer->bonusRemnants ?></p>
    <p>Запрос создан <?= $model->created_at ?></p>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'info')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(RefRequest::STATUS_LIST) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
