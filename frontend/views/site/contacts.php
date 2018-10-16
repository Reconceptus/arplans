<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $form yii\bootstrap\ActiveForm */
/* @var $query */
/* @var $request \common\models\Request */
/* @var $model \modules\partner\models\About */

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="section contact-page">
        <div class="content content--lg mobile-wide">
            <div class="contact-page--wrap">
                <div class="content content--sm">
                    <h1 class="title title-lg">Контакты</h1>
                </div>
                <div class="content content--md">
                    <div class="contact-page--data">
                        <div class="form-row">
                            <div class="form-row-col col-33 col-tel">
                                <div class="dd">
                                    <a href="#" class="tel">
                                        <i class="icon icon-phone">
                                            <svg xmlns="http://www.w3.org/2000/svg">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     xlink:href="#icon-phone"/>
                                            </svg>
                                        </i>
                                        <span><?= $model->hot_line ?></span>
                                    </a>
                                </div>
                                <div class="dt">горячая линия</div>
                            </div>
                            <div class="form-row-col col-66">
                                <ul class="list">
                                    <li>
                                        <div class="dd questions">
                                            <a><?= $model->phone ?></a><br/>
                                            <a><?= $model->email ?></a>
                                        </div>
                                        <div class="dt">по всем вопросам</div>
                                    </li>
                                    <li>
                                        <div class="dd socials">
                                            <a href="<?= $model->vk ?>" target="_blank">Вконтакте</a>
                                            <a href="<?= $model->fb ?>" target="_blank">Facebook</a><br/>
                                            <a href="<?= $model->instagram ?>" target="_blank">Instagram</a>
                                        </div>
                                        <div class="dt">официальные страницы</div>
                                    </li>
                                    <li class="col-addr">
                                        <div class="dd address"><?= $model->main_office_address ?></div>
                                        <div class="dt">адрес главного офиса</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="contact-form">
                        <? $form = ActiveForm::begin([
                            'method'  => 'post',
                            'options' => ['enctype' => 'multipart/form-data'],
                            'id'      => 'contacts-form',
                        ]); ?>
                        <?= Html::hiddenInput('Request[url]', Yii::$app->request->getAbsoluteUrl()) ?>
                        <?= Html::hiddenInput('Request[type]', \common\models\Request::PAGE_CONTACT) ?>
                        <?= Html::hiddenInput('Request[contact]', '-') ?>
                        <div class="contact-form--wrap">
                            <div class="contact-form--main custom-form">
                                <div class="form-row stretched">
                                    <div class="form-row-col col-66">
                                        <div class="form-row-element to-stretch">
                                            <div class="textarea">
                                                <?= $form->field($request, 'text')->textarea(['placeholder' => '*Ваш вопрос', 'cols' => 30, 'rows' => 3])->label(false) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row-col col-33">
                                        <div class="form-row-element">
                                            <div class="input">
                                                <?= $form->field($request, 'name')->textInput(['placeholder' => '*Ваше имя'])->label(false) ?>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="input">
                                                <?= $form->field($request, 'phone')->textInput(['placeholder' => '*Ваш телефон'])->label(false) ?>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="input">
                                                <?= $form->field($request, 'email')->textInput(['placeholder' => '*Ваш e-mail'])->label(false) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row centered">
                                    <div class="form-row-col col-66">
                                        <div class="form-row-element">
                                            <div class="form-text">
                                                <p>*Обязательные поля</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row-col col-33">
                                        <div class="form-row-element">
                                            <div class="file">
                                                <?= $form->field($request, 'file')->fileInput(['id' => 'customFileUpload']) ?>
                                                <label for="customFileUpload">
                                                    <i class="icon-loadFile">
                                                        <svg xmlns="http://www.w3.org/2000/svg">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 xlink:href="#icon-file-change"/>
                                                        </svg>
                                                    </i>
                                                    <span id="customFileName"
                                                          data-default="Прикрепить файл">Прикрепить файл</span>
                                                </label>
                                                <i id="customFileRemove" class="remove hide">&times;</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="contact-form--submit">
                                <div class="form-row centered">
                                    <div class="form-row-col col-33">
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <?= Html::activeCheckbox($request, 'accept', ['label' => false, 'class' => 'js-accept-contact']) ?>
                                                    <span>Согласен на обработку персональных данных</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row-col col-66">
                                        <div class="form-row-submit">
                                            <div class="submit">
                                                <?= Html::submitButton('Отправить', ['class' => 'btn btn--lt']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <? ActiveForm::end() ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="big-header">
        <div class="content content--lg">
            <h2 class="title">Офисы продаж АРПЛАНС</h2>
        </div>
    </div>
<?= \modules\partner\widgets\map\Map::widget(['viewName' => 'about', 'query' => $query]) ?>
<?= \frontend\widgets\recently\Recently::widget() ?>
<?php
$js = <<<JS
    var files; 
    $('#contacts-form input[type=file]').on('change', function(){
        files = this.files;
    });

     $('#contacts-form').on('beforeSubmit', function(){
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