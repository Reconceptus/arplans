<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

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
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-phone"/>
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
                                        <a><?= $model->phone ?></a>
                                        <a><?=$model->email?></a>
                                    </div>
                                    <div class="dt">по всем вопросам</div>
                                </li>
                                <li>
                                    <div class="dd socials">
                                        <a href="<?=$model->vk?>">Вконтакте</a>
                                        <a href="<?=$model->fb?>">Facebook</a>
                                        <a href="<?=$model->instagram?>">Instagram</a>
                                    </div>
                                    <div class="dt">официальные страницы</div>
                                </li>
                                <li class="col-addr">
                                    <div class="dd address"><?=$model->main_office_address?></div>
                                    <div class="dt">адрес главного офиса</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <form>
                        <div class="contact-form--wrap">
                            <div class="contact-form--main custom-form">
                                <div class="form-row stretched">
                                    <div class="form-row-col col-66">
                                        <div class="form-row-element to-stretch">
                                            <div class="textarea">
                                                <textarea cols="30" rows="3" placeholder="Ваш вопрос"
                                                          name="question"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row-col col-33">
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
                                                <input type="file" id="fileUpload">
                                                <label for="fileUpload">
                                                    <i class="icon-loadFile">
                                                        <svg xmlns="http://www.w3.org/2000/svg">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 xlink:href="#icon-file-change"/>
                                                        </svg>
                                                    </i>
                                                    <span id="fileName"
                                                          data-default="Прикрепить файл">Прикрепить файл</span>
                                                </label>
                                                <i id="fileRemove" class="remove hide">&times;</i>
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
                    </form>
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
<div class="map-box">
    <div class="content content--lg">
        <div class="map-box--wrap">
            <div class="map-box--main">
                <div class="custom-search">
                    <form action="#">
                        <div class="custom-search--field">
                            <div class="custom-search--inputs">
                                <div class="input region-dropbox">
                                    <input type="text" placeholder="Введите регион">
                                    <?= \modules\partner\widgets\regions\Regions::widget(['viewName' => 'drop']) ?>
                                </div>
                                <button class="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-search"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="map-box--field">
                    <?= \modules\partner\widgets\map\Map::widget(['viewName' => 'about', 'query' => $query]) ?>
                </div>
            </div>
            <div class="map-box--aside">
                <div class="head">Офисы продаж</div>
                <div class="addresses scrolled">
                    <? foreach ($query->all() as $office): ?>
                        <div class="item">
                            <div class="name"><?=$office->name?></div>
                            <div><?=$office->address?></div>
                            <div><?=$office->phones?></div>
                            <!--                                <a href="#" class="on-map">на карте</a>-->
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= \frontend\widgets\recently\Recently::widget() ?>