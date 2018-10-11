<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Сброс пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section site-login">
    <div class="content content--lg mobile-wide">
        <div class="request--wrap gradient">
            <div class="content content--xs">
                <h1 class="title title-lg"><?= $this->title ?></h1>
                <h2 class="subtitle align-center">Пожалуйста, введите свой email. Туда будет выслана ссылка для сброса
                    пароля</h2>
                <div class="login-form">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                    <div class="login-form--wrap">
                        <div class="request-form--main custom-form">
                            <div class="form-row-element">
                                <div class="input">
                                    <?= Html::activeTextInput($model, 'email', ['placeholder' => '*Email']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row-submit">
                            <div class="submit">
                                <?= Html::submitButton('Сбросить', ['class' => 'btn btn--lt', 'name'=>'login-button']) ?>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>