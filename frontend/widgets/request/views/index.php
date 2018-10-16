<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.10.2018
 * Time: 11:27
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model \frontend\widgets\request\Request */
?>
<div class="modal" data-modal="consultation">
    <div class="bg close"></div>
    <div class="modal-box">
        <span class="close">&times;</span>
        <h3 class="modal-title">Мы очень быстро свяжемся с вами</h3>
        <div class="modal-form">
            <? $form = ActiveForm::begin([
                'action'  => '/site/contacts',
                'method'  => 'post',
                'options' => ['enctype' => 'multipart/form-data'],
            ]); ?>
            <div class="modal-form--fields">
                <div class="custom-form">
                    <div class="form-row-element">
                        <div class="input">
                            <?= Html::activeTextInput($model, 'contact', ['placeholder' => '*Ваш телефон, e-mail или любой другой контакт']) ?>
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="textarea">
                            <?= Html::activeTextarea($model, 'text', ['placeholder' => '*Ваше сообщение', 'rows' => 3]) ?>
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="file">
                            <?= Html::activeFileInput($model, 'file', ['id' => 'fileUpload']) ?>
                            <label for="fileUpload">
                                <i class="icon-loadFile">
                                    <svg xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-file-change"/>
                                    </svg>
                                </i>
                                <span id="fileName" data-default="Прикрепить файл">Прикрепить файл</span>
                            </label>
                            <i id="fileRemove" class="remove hide">&times;</i>
                        </div>
                    </div>
                </div>
                <div class="filter-form">
                    <div class="form-row-element">
                        <div class="check">
                            <label>
                                <?= Html::activeCheckbox($model, 'accept', ['label' => false, 'class' => 'js-accept-contact']) ?>
                                <span>Согласен на <a href="#"> обработку </a> персональных данных</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-form--submit">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn--lt js-submit-contact']) ?>
            </div>
            <? ActiveForm::end() ?>
        </div>
        <div class="modal-thanks">
            <h4 class="modal-thanks--title">Спасибо!</h4>
            <p>На указанную Вами почту строители-патртнеры АРПЛАНС вышлют сметы на строительство выбранного вами
                дома. </p>
        </div>
    </div>
</div>
