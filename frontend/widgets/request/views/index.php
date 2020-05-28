<?php

use yii\helpers\Html;
use yii\web\Request;
use yii\widgets\ActiveForm;

/* @var $model Request */
?>
    <div class="modal" data-modal="consultation">
        <div class="bg close"></div>
        <div class="modal-box">
            <span class="close">&times;</span>
            <h3 class="modal-title">Мы очень быстро свяжемся с вами</h3>
            <div class="modal-form consultation-form">
                <div id="senden-cons"></div>
                <?php $form = ActiveForm::begin([
                    'action'  => '#',
                    'method'  => 'post',
                    'options' => ['enctype' => 'multipart/form-data'],
                    'id'      => 'consultation-form',
                ]); ?>
                <?= Html::hiddenInput('Request[url]', Yii::$app->request->getAbsoluteUrl()) ?>
                <?= Html::hiddenInput('Request[contact]', '-') ?>
                <div class="modal-form--fields">
                    <div class="custom-form">
                        <div class="form-row-element">
                            <div class="input">
                                <?= Html::activeDropDownList($model, 'type', \common\models\Request::TYPES_SELECT, ['prompt' => 'Тема вопроса']) ?>
                            </div>
                        </div>
                        <div class="form-row-element">
                            <div class="input">
                                <?= Html::activeTextInput($model, 'name', ['placeholder' => '*Ваше имя']) ?>
                            </div>
                        </div>
                        <div class="form-row-element">
                            <div class="input">
                                <?= Html::activeTextInput($model, 'email', ['placeholder' => '*Ваш email']) ?>
                            </div>
                        </div>
                        <div class="form-row-element">
                            <div class="input">
                                <?= Html::activeTextInput($model, 'phone', ['placeholder' => '*Ваш телефон']) ?>
                            </div>
                        </div>
                        <div class="form-row-element">
                            <div class="textarea">
                                <?= Html::activeTextarea($model, 'text', ['placeholder' => '*Ваше сообщение', 'rows' => 3]) ?>
                            </div>
                        </div>
                        <?= $form->field($model, 'reCaptcha',
                            ['enableAjaxValidation' => false, 'enableClientValidation' => false])->widget(
                            \himiklab\yii2\recaptcha\ReCaptcha3::className(), ['action' => '/site/request']
                        )->label(false) ?>
                        <div class="form-row-element">
                            <div class="file">
                                <?= Html::activeFileInput($model, 'file', ['id' => 'supportFileUpload']) ?>
                                <label for="supportFileUpload">
                                    <i class="icon-loadFile">
                                        <svg xmlns="http://www.w3.org/2000/svg">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xlink:href="#icon-file-change"/>
                                        </svg>
                                    </i>
                                    <span id="supportFileName" data-default="Прикрепить файл">Прикрепить файл</span>
                                </label>
                                <i id="supportFileRemove" class="remove hide">&times;</i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-form">
                        <div class="form-row-element">
                            <div class="check">
                                <label>
                                    <input type="checkbox" name="Request[accept]">
                                    <span>Согласен на <a href="/page/privacy">обработку персональных данных</a></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <span class="recaptcha-notify">This site is protected by reCAPTCHA and the Google
    <a href="https://policies.google.com/privacy">Privacy Policy</a> and
    <a href="https://policies.google.com/terms">Terms of Service</a> apply.</span>
                </div>
                <div class="modal-form--submit">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn--lt submit-consult']) ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
            <div class="modal-thanks">
                <h4 class="modal-thanks--title">Спасибо!</h4>
                <p>Ваше сообщение успешно отправлено, мы свяжемся с Вами в ближайшее время! </p>
            </div>
        </div>
    </div>
<?php
$js = <<<JS
    $('#consultation-form').validate({
        onfocusout: false,
        ignore: ".ignore",
        rules: {
            'Request[type]': {required: true},
            'Request[name]': {required: true},
            'Request[email]': {required: true},
            'Request[phone]': {required: true},
            'Request[text]': {required: true},
            'Request[accept]': {required: true},
            'Request[reCaptcha]': {required: true}
        },
        messages: {
          'Request[type]': {required: ""},
          'Request[name]': {required: ""},
            'Request[email]': {required: ""},
            'Request[phone]': {required: ""},
           'Request[text]': {required: ""},
           'Request[accept]': {required: ""},
           'Request[reCaptcha]': {required: ""}
        },
        errorClass: 'invalid',
        highlight: function(element, errorClass) {
            $(element).closest('.form-row-element').addClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).closest('.form-row-element').removeClass(errorClass)
        },
        errorPlacement: $.noop,
        submitHandler:function (form) {
            if(!$('#senden-cons').hasClass('senden')){
                $('#senden-cons').addClass('senden');
                var data = $('#consultation-form');
                formData = new FormData(data.get(0));
                $.ajax({
                contentType: false, 
                processData: false,
                url: '/site/request',
                type: 'POST',
                data: formData,
                success: function(res){
                  if(res.status==='success'){
                       $('[data-modal="consultation"]').addClass('successful');
                       $('#senden-cons').removeClass('senden');
                  }else{
                       var errors = "";
                          $.each(res.message, function( i, elem ) {
                            errors+=elem+'<br/>';
                          });
                          project.alertMessage('',errors);
                            $('##senden-cons').removeClass('senden')
                  }
                },
            
          });
                }
        }
     });
JS;

$this->registerJs($js);