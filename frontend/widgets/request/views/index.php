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
                'id'      => 'request-form'
            ]); ?>
            <?= Html::hiddenInput('Request[url]', Yii::$app->request->getAbsoluteUrl()) ?>
            <?= Html::hiddenInput('Request[type]', \common\models\Request::PAGE_OTHER) ?>
            <?= Html::hiddenInput('Request[email]', 'no-email@exampleaaaaaaaaaaaa.com') ?>
            <?= Html::hiddenInput('Request[name]', '-') ?>
            <?= Html::hiddenInput('Request[phone]', '-') ?>
            <div class="modal-form--fields">
                <div class="custom-form">
                    <div class="form-row-element">
                        <div class="input">
                            <?= $form->field($model, 'contact')->textInput(['placeholder' => '*Ваш телефон, e-mail или любой другой контакт'])->label(false) ?>
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="textarea">
                            <?= $form->field($model, 'text')->textarea(['placeholder' => '*Ваше сообщение', 'rows' => 3])->label(false) ?>
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="file">
                            <?= $form->field($model, 'file')->fileInput(['id' => 'supportFileUpload']) ?>
                            <label for="supportFileUpload">
                                <i class="icon-loadFile">
                                    <svg xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-file-change"/>
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
                                <?= $form->field($model, 'accept')->checkbox(['label' => false]) ?>
                                <span>Согласен на <a href="#"> обработку </a> персональных данных</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-form--submit">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn--lt']) ?>
            </div>
            <? ActiveForm::end() ?>
        </div>
    </div>
</div>
<?php
$js = <<<JS
    var files; 
    $('#request-form input[type=file]').on('change', function(){
        files = this.files;
    });

     $('#request-form').on('beforeSubmit', function(){
	 var data = $(this);
	 if( typeof files !== 'undefined' ){
	    $.each( files, function( key, value ){
		    data.append( key, value );
	    });
	 }
	 
	 formData = new FormData(data.get(0));
	 // return false;
	 $.ajax({
	  contentType: false, 
      processData: false,
	    url: '/site/request',
	    type: 'POST',
	    data: formData,
	    success: function(res){
	      if(res.status==='success'){
	          alert(res.message);
	      }
	    },
	 });
	 return false;
     });
JS;

$this->registerJs($js);