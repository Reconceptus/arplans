<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $form yii\bootstrap\ActiveForm */
/* @var $query */
/* @var $request \common\models\ContactForm */
/* @var $model \modules\partner\models\About */
/* @var $partners \modules\partner\models\Partner[] */

$this->registerMetaTag(['name' => 'keywords', 'content' => \modules\content\models\ContentBlock::getValue('about_page_seo_keywords')]);
$this->registerMetaTag(['name' => 'description', 'content' => \modules\content\models\ContentBlock::getValue('about_page_seo_description')]);

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
\yii\widgets\Pjax::begin();
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
                        <div id="senden-contacts"></div>
                        <?php $form = ActiveForm::begin([
                            'action'  => '#',
                            'options' => ['enctype' => 'multipart/form-data'],
                            'id'      => 'contacts-form',
                        ]); ?>
                        <?= Html::hiddenInput('ContactForm[url]', Yii::$app->request->getAbsoluteUrl()) ?>
                        <?= Html::hiddenInput('ContactForm[type]', \common\models\Request::PAGE_CONTACT) ?>
                        <?= Html::hiddenInput('ContactForm[contact]', '-') ?>
                        <div class="contact-form--wrap">
                            <div class="contact-form--main custom-form">
                                <div class="form-row stretched">
                                    <div class="form-row-col col-66">
                                        <div class="form-row-element to-stretch">
                                            <div class="textarea">
                                                <?= Html::activeTextarea($request, 'text', ['placeholder' => '*Ваш вопрос', 'cols' => 30, 'rows' => 3]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row-col col-33">
                                        <div class="form-row-element">
                                            <div class="input">
                                                <?= Html::activeTextInput($request, 'name', ['placeholder' => '*Ваше имя']) ?>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="input">
                                                <?= Html::activeTextInput($request, 'phone', ['placeholder' => '*Ваш телефон']) ?>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="input">
                                                <?= Html::activeTextInput($request, 'email', ['placeholder' => '*Ваш e-mail']) ?>
                                            </div>
                                        </div>
                                        <?= $form->field($request, 'reCaptcha',
                                            ['enableAjaxValidation' => false, 'enableClientValidation' => false])->widget(
                                            \himiklab\yii2\recaptcha\ReCaptcha2::className()
                                        )->label(false) ?>
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
                                                <?= Html::activeFileInput($request, 'file', ['id' => 'customFileUpload']) ?>
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
                                                    <input type="checkbox" name="ContactForm[accept]">
                                                    <span>Согласен на <a href="/page/privacy">обработку персональных данных</a></span>
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
                        <?php ActiveForm::end() ?>
                        <div class="modal-thanks">
                            <h4 class="modal-thanks--title">Спасибо!</h4>
                            <p>Ваше сообщение успешно отправлено, мы свяжемся с Вами в ближайшее время!</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div itemscope itemtype="http://schema.org/Organization">
        <meta itemprop="name" content="ООО Арпланс">
        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <meta itemprop="streetAddress" content="ул. Чехова, д.2, оф. 2.8">
            <meta itemprop="postalCode" content="150054">
            <meta itemprop="addressLocality" content="Россия, г. Ярославль">
        </div>
        <meta itemprop="telephone" content="8-800-200-17-14">
        <meta itemprop="email" content="arplans@yandex.ru">
    </div>
    <div itemscope itemtype="http://schema.org/Organization">
        <meta itemprop="name" content="Традиция">
        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <meta itemprop="streetAddress" content="ул. Матуринская 63а, офис 1">
            <meta itemprop="postalCode" content="162602">
            <meta itemprop="addressLocality" content="Россия, г. Череповец">
        </div>
        <meta itemprop="telephone" content="+7 (8202) 62-57-22">
        <meta itemprop="email" content="info@traditsiya.su">
    </div>
    <div itemscope itemtype="http://schema.org/Organization">
        <meta itemprop="name" content="СК Стандарты качества">
        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <meta itemprop="streetAddress" content="Выборгское шоссе 212. Павильон 11 А">
            <meta itemprop="postalCode" content="197022">
            <meta itemprop="addressLocality" content="Россия, г. Санкт-Петербург">
        </div>
        <meta itemprop="telephone" content="+7 (921) 417-27-62">
        <meta itemprop="telephone" content="+7 (981) 181-00-68">
    </div>
    <div itemscope itemtype="http://schema.org/Organization">
        <meta itemprop="name" content="SokolDom">
        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <meta itemprop="streetAddress" content="ул. Валовая д. 37, строение 1">
            <meta itemprop="postalCode" content="162602">
            <meta itemprop="addressLocality" content="Россия, г. Москва">
        </div>
        <meta itemprop="telephone" content="8 951 733-73-73">
        <meta itemprop="email" content="mail@sokoldom.com">
    </div>
    <div class="big-header">
        <div class="content content--lg">
            <h2 class="title">Офисы продаж АРПЛАНС</h2>
        </div>
    </div>
<?= \modules\partner\widgets\map\Map::widget(['viewName' => 'about', 'query' => $query]) ?>
<?php if ($partners): ?>
    <div class="big-header">
        <div class="content content--lg">
            <h2 class="title">Официальные сайты-партнеры</h2>
        </div>
    </div>

    <div class="contact-page--partners">
        <div class="content content--lg">
            <ul>
                <?php foreach ($partners as $partner): ?>
                    <?php if ($partner->url): ?>
                        <li><a href="<?= $partner->url ?>" target="_blank"><?= $partner->url ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

<?php endif; ?>
<?= \frontend\widgets\recently\Recently::widget() ?>
    <script>
        if (typeof google !== 'undefined') {
            initMap();
        }
        if (typeof project !== 'undefined') {
            project.regionDropBox();
            project.customScroll();
            project.mapMarkers();
        }
    </script>
<?php
$js = <<<JS
       $('.contact-form form').validate({
        onfocusout: false,
        ignore: ".ignore",
        rules: {
            'ContactForm[text]': {required: true},
            'ContactForm[name]': {required: true},
            'ContactForm[email]': {required: true},
             'ContactForm[phone]': {required: true},
            'ContactForm[accept]': {required: true},
             'ContactForm[reCaptcha]': {required: true}
        },
        messages: {
           'ContactForm[text]': {required: ""},
           'ContactForm[name]': {required: ""},
           'ContactForm[email]': {required: ""},
           'ContactForm[accept]': {required: ""},
             'ContactForm[phone]': {required: ""},
              'ContactForm[reCaptcha]': {required: ""}
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
            if(!$('#senden-contacts').hasClass('senden')){
                $('#senden-contacts').addClass('senden');
                var data = $('#contacts-form');
                formData = new FormData(data.get(0));
                    $.ajax({
                    contentType: false, 
                    processData: false,
                    url: '/site/request',
                    type: 'POST',
                    data: formData,
                    success: function(res){
                      if(res.status==='success'){
                          $('.contact-form').addClass('successful');
                          $('#senden-contacts').removeClass('senden');
                      }else{
                          var errors = "";
                          $.each(res.message, function( i, elem ) {
                            errors+=elem+'<br/>';
                          });
                          project.alertMessage('',errors);
                            $('#senden-contacts').removeClass('senden')
                      }
                       return false;
                    },
                  });
            }
        }
    })
JS;

$this->registerJs($js);
\yii\widgets\Pjax::end();