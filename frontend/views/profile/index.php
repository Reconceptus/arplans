<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 22.10.2018
 * Time: 14:51
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $profile \common\models\Profile */

$this->title = 'Профиль';
?>

<div class="section">
    <div class="content content--lg mobile-wide">
        <div class="request--wrap gradient">
            <div class="content content--xs">
                <h1 class="title title-lg"><?= $this->title ?></h1>
                <div class="profile-form">
                   <?=$this->render('_tabs')?>
                    <?php $form = ActiveForm::begin(['id' => 'profile-form']); ?>
                    <div class="login-form--wrap">
                        <div class="request-form--main custom-form">
                            <div class="form-row-element">
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'last_name', ['placeholder' => 'Фамилия']) ?>
                                </div>
                            </div>
                            <div class="form-row-element">
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'first_name', ['placeholder' => 'Имя']) ?>
                                </div>
                            </div>
                            <div class="form-row-element">
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'patronymic', ['placeholder' => 'Отчество']) ?>
                                </div>
                            </div>
                            <div class="form-row-element">
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'phone', ['placeholder' => 'Телефон']) ?>
                                </div>
                            </div>
                            <div class="form-row-element">
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'country', ['placeholder' => 'Страна']) ?>
                                </div>
                            </div>
                            <div class="form-row-element">
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'city', ['placeholder' => 'Город']) ?>
                                </div>
                            </div>
                            <div class="form-row-element">
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'address', ['placeholder' => 'Адрес']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row-submit">
                            <div class="submit">
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn--lt', 'name' => 'profile-button']) ?>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
