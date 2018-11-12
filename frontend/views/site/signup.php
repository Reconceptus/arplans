<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section site-login">
    <div class="content content--lg mobile-wide">
        <div class="request--wrap gradient">
            <div class="content content--xs">
                <h1 class="title title-lg"><?= $this->title ?></h1>
                <h2 class="subtitle align-center">Пожалуйста, заполните форму</h2>
                <div class="login-form">
                    <?php $form = ActiveForm::begin([
                        'id' => 'form-signup'
                    ]); ?>
                    <div class="login-form--wrap">
                        <div class="request-form--main custom-form">
                            <div class="form-row-element">
                                <div class="input">
                                    <?= Html::activeTextInput($model, 'email', ['placeholder' => '*Email']) ?>
                                    <?= Html::error($model, 'email', ['class' => 'error-text']) ?>
                                </div>
                            </div>
                            <div class="form-row-element">
                                <div class="input">
                                    <?= Html::activePasswordInput($model, 'password', ['placeholder' => '*Пароль (не менее 6 знаков)']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row-submit">
                            <div class="submit">
                                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn--lt', 'name' => 'signup-button']) ?>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
