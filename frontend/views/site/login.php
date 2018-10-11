<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section site-login">
    <div class="content content--lg mobile-wide">
        <div class="request--wrap gradient">
            <div class="content content--xs">
                <h1 class="title title-lg"><?= $this->title ?></h1>
                <h2 class="subtitle align-center">Пожалуйста, заполните форму</h2>
                <div class="login-form">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <div class="login-form--wrap">
                        <div class="request-form--main custom-form">
                            <div class="form-row-element">
                                <div class="input">
                                    <?= Html::activeTextInput($model, 'username', ['placeholder' => '*Email']) ?>
                                </div>
                            </div>
                            <div class="form-row-element">
                                <div class="input">
                                    <?= Html::activePasswordInput($model, 'password', ['placeholder' => '*Пароль']) ?>
                                </div>
                            </div>
                            <div class="form-row-element">
                                <div class="check">
                                    <label>
                                        <?= Html::activeCheckbox($model, 'rememberMe', ['label' => false]) ?>
                                        <span>Запомнить меня</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-row-element">
                                <div class="form-text">
                                    <p>Если вы забыли пароль, то
                                        можете <?= Html::a('сбросить его', ['site/request-password-reset']) ?>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-row-submit">
                            <div class="submit">
                                <?= Html::submitButton('Войти', ['class' => 'btn btn--lt', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
