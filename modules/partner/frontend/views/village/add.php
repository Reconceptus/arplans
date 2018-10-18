<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 18.10.2018
 * Time: 10:25
 */
?>
    <div class="section request">
        <div class="content content--lg mobile-wide">
            <div class="request--wrap gradient">
                <div class="content content--sm">
                    <h1 class="title title-lg">Запрос на добавление посёлка</h1>
                    <h2 class="subtitle">Заполните форму и мы свяжемся с вами для обсуждения сотрудничества или же
                        заполните <a href="#" class="show-modal" data-modal="consultation">короткую форму</a></h2>
                </div>
                <div class="content content--md">
                    <div class="request-form">
                        <? $form = \yii\widgets\ActiveForm::begin([
                            'options' => [
                                'enctype' => 'multipart/form-data'
                            ]
                        ]) ?>
                        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                        <div class="request-form--main custom-form">
                            <div class="form-row">
                                <div class="form-row-col col-66">
                                    <div class="form-row">
                                        <div class="form-row-col col-50">
                                            <div class="form-row-element">
                                                <div class="input">
                                                    <input type="text" placeholder="*Ваше имя" name="name">
                                                </div>
                                            </div>
                                            <div class="form-row-element">
                                                <div class="input">
                                                    <input type="text" placeholder="*Ваш телефон" name="phone">
                                                </div>
                                            </div>
                                            <div class="form-row-element">
                                                <div class="input">
                                                    <input type="text" placeholder="*Ваш e-mail" name="mail">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row-col col-50">
                                            <div class="form-row-element">
                                                <div class="input">
                                                    <input type="text" placeholder="*Название поселка"
                                                           name="city_name">
                                                </div>
                                            </div>
                                            <div class="form-row-element">
                                                <div class="input">
                                                    <input type="text" placeholder="*Область" name="region">
                                                </div>
                                            </div>
                                            <div class="form-row-element">
                                                <div class="input">
                                                    <input type="text" placeholder="*Ближайший город"
                                                           name="nearest_city">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-row-col">
                                            <div class="form-row-element">
                                                <div class="textarea">
                                                        <textarea cols="30" rows="3" placeholder="Опишите ваш поселок"
                                                                  name="description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row-col col-33">
                                    <div class="form-row-element">
                                        <div class="input">
                                            <input type="text" placeholder="Телефон отдела продаж"
                                                   name="sale_phone">
                                        </div>
                                    </div>
                                    <div class="form-row-element">
                                        <div class="input">
                                            <input type="text" placeholder="Сайт отдела продаж" name="sale_url">
                                        </div>
                                    </div>
                                    <div class="form-row-element">
                                        <div class="file">
                                            <input type="file" id="customFileUpload" name="file">
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
                                    <div class="form-row-element">
                                        <div class="check">
                                            <label>
                                                <input type="checkbox">
                                                <span>Хочу разместить каталог проектов АРПЛАНС на сайте поселка и зарабатывать на продаже проектов</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-row-element">
                                        <div class="form-text">
                                            <p>*Обязательные поля</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-form">
                            <div class="request-form--bottom">
                                <div class="request-form--checks">
                                    <div class="form-row nowrap-tablet">
                                        <div class="form-row-col col-66">
                                            <div class="form-row">
                                                <div class="form-row-col col-50">
                                                    <div class="form-title">Инженерные сети</div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox" name="electric">
                                                                <span>электроснабжение</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox" name="gas">
                                                                <span>газоснабжение</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox" name="water">
                                                                <span>водоснабжение</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox" name="internet">
                                                                <span>интернет</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row-col col-50">
                                                    <div class="form-title">Инфраструктура</div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox" name="stores">
                                                                <span>магазины</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox" name="children_club">
                                                                <span>детский клуб</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox" name="sports_center">
                                                                <span>спортивно-оздоровительный комплекс</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox" name="sports_ground">
                                                                <span>спортивные площадки</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox" name="golf_club">
                                                                <span>гольф-клуб</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox" name="beach">
                                                                <span>пляж</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox" name="life_service">
                                                                <span>службы быта</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row-col col-33">
                                            <div class="form-title">Безопасность</div>
                                            <div class="form-row-element">
                                                <div class="check">
                                                    <label>
                                                        <input type="checkbox" name="territory_control">
                                                        <span>охрана территории и подъездов</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-row-element">
                                                <div class="check">
                                                    <label>
                                                        <input type="checkbox" name="fire_alarm">
                                                        <span>противопожарная сигнализация</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-row-element">
                                                <div class="check">
                                                    <label>
                                                        <input type="checkbox" name="security_alarm">
                                                        <span>охранная сигнализация</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-title">Экология</div>
                                            <div class="form-row-element">
                                                <div class="check">
                                                    <label>
                                                        <input type="checkbox" name="forest">
                                                        <span>лесозона</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-row-element">
                                                <div class="check">
                                                    <label>
                                                        <input type="checkbox" name="reservoir">
                                                        <span>водоем</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="request-form--submit">
                                    <div class="form-row centered">
                                        <div class="form-row-col col-33">
                                            <div class="form-row-element">
                                                <div class="check">
                                                    <label>
                                                        <input type="checkbox" name="processing_agree">
                                                        <span>Согласен на обработку персональных данных</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row-col col-66">
                                            <div class="form-row-submit">
                                                <div class="submit">
                                                    <button class="btn btn--lt">Отправить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <? \yii\widgets\ActiveForm::end() ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?= \frontend\widgets\recently\Recently::widget() ?>
<?
$js=<<<JS
 
    $('.request-form form').validate({
        onfocusout: false,
        ignore: ".ignore",
        rules: {
            name: {required: true},
            phone: {required: true},
            mail: {required: true},
            city_name: {required: true},
            region: {required: true},
            nearest_city: {required: true},
            description: {required: true},
            processing_agree: {required: true}
        },
        messages: {
            name: {required: ""},
            phone: {required: ""},
            mail: {required: ""},
            city_name: {required: ""},
            region: {required: ""},
            nearest_city: {required: ""},
            description: {required: ""},
            processing_agree: {required: ""}
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
//            $('.contact-form').addClass('successful');
//            if (form.valid()){
//                form.submit();
//            }
            return false;
        }
    })


JS;
$this->registerJs($js)
?>
