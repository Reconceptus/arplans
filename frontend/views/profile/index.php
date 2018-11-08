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

$this->title = 'Мои данные';
?>

<div class="section site-profile">
    <div class="content content--lg mobile-wide">
        <div class="request--wrap gradient">
            <div class="content content--sm">
                <h1 class="title title-lg"><?= $this->title ?></h1>
                <h2 class="subtitle">Внимательно заполните данные вашего профиля. На указанные данные мы вышлем проект.</h2>
                <div class="profile-form">
                    <?php $form = ActiveForm::begin(['id' => 'profile-form']); ?>
                    <div class="profile-form--wrap">
                        <div class="request-form--main custom-form">
                            <div class="form-row-element has-label">
                                <?=Html::activeLabel($profile,'last_name',['class'=>'label'])?>
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'last_name', ['placeholder' => 'Фамилия']) ?>
                                </div>
                            </div>
                            <div class="form-row-element has-label">
                                <?=Html::activeLabel($profile,'first_name',['class'=>'label'])?>
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'first_name', ['placeholder' => 'Фамилия']) ?>
                                </div>
                            </div>
                            <div class="form-row-element has-label">
                                <?=Html::activeLabel($profile,'patronymic',['class'=>'label'])?>
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'patronymic', ['placeholder' => 'Фамилия']) ?>
                                </div>
                            </div>
                            <div class="form-row-element has-label">
                                <?=Html::activeLabel($profile,'phone',['class'=>'label'])?>
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'phone', ['placeholder' => 'Фамилия']) ?>
                                </div>
                            </div>
                            <div class="form-row-element has-label">
                                <?=Html::activeLabel($profile,'country',['class'=>'label'])?>
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'country', ['placeholder' => 'Фамилия']) ?>
                                </div>
                            </div>
                            <div class="form-row-element has-label">
                                <?=Html::activeLabel($profile,'city',['class'=>'label'])?>
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'city', ['placeholder' => 'Фамилия']) ?>
                                </div>
                            </div>
                            <div class="form-row-element has-label">
                                <?=Html::activeLabel($profile,'address',['class'=>'label'])?>
                                <div class="input">
                                    <?= Html::activeTextInput($profile, 'address', ['placeholder' => 'Фамилия']) ?>
                                </div>
                            </div>
                            <div class="form-row-element has-label">
                                <?=Html::activeLabel($profile,'password',['class'=>'label'])?>
                                <div class="input">
                                    <?= Html::activePasswordInput($profile, 'password', ['placeholder' => 'Пароль']) ?>
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
