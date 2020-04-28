<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\shop\models\Promocode */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->isNewRecord ? 'Создание промокода' : 'Редактирование промокода';
?>
<div class="container">
    <h1><?= $this->title ?></h1>
    <div class="promocode-form">

        <?php $form = ActiveForm::begin(
            [
                'method'               => 'post',
                'id'                   => 'promocode-form',
                'enableAjaxValidation' => true
            ]
        ); ?>
        <div class="row">
            <div class="col-xs-10">
                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'min_amount')->textInput() ?>

                <?= $form->field($model, 'number_of_uses')->textInput() ?>

                <?= $form->field($model, 'used')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-5">
                <?= $form->field($model, 'fixed_discount')->textInput() ?>
            </div>
            <div class="col-xs-5">
                <?= $form->field($model, 'percent_discount')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-5">
                <?= $form->field($model, 'start_date')->widget(DatePicker::class, [
                    'language'      => 'ru',
                    'dateFormat'    => 'yyyy-MM-dd',
                    'options'       => [
                        'placeholder'  => Yii::$app->formatter->asDate($model->start_date),
                        'class'        => 'form-control',
                        'autocomplete' => 'off'
                    ],
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear'  => true,
                        'yearRange'   => '2020:2030',
                    ]
                ])->textInput(['placeholder' => 'Действует с']) ?>
            </div>
            <div class="col-xs-5">
                <?= $form->field($model, 'end_date')->widget(DatePicker::class, [
                    'language'      => 'ru',
                    'dateFormat'    => 'yyyy-MM-dd',
                    'options'       => [
                        'placeholder'  => Yii::$app->formatter->asDate($model->end_date),
                        'class'        => 'form-control',
                        'autocomplete' => 'off'
                    ],
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear'  => true,
                        'yearRange'   => '2020:2030',
                    ]
                ])->textInput(['placeholder' => 'Действует до']) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>