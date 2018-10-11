<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ResetPasswordForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Новый пароль';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="section site-login">
    <div class="content content--lg mobile-wide">
        <div class="request--wrap gradient">
            <div class="content content--xs">
                <h1 class="title title-lg"><?= $this->title ?></h1>
                <h2 class="subtitle align-center">Пожалуйста, введите новый пароль</h2>
                <div class="login-form">
                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                    <div class="login-form--wrap">
                        <div class="request-form--main custom-form">
                            <div class="form-row-element">
                                <div class="input">
                                    <?= Html::activePasswordInput($model, 'password', ['autofocus' => true]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row-submit">
                            <div class="submit">
                                <?= Html::submitButton('Изменить', ['class' => 'btn btn--lt', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
