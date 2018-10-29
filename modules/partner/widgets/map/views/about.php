<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 15.10.2018
 * Time: 15:51
 */

/* @var $query */
/* @var $models array */
?>
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
                    <?= $this->render('about-map', ['models' => $models]) ?>
                </div>
            </div>
            <div class="map-box--aside">
                <div class="head">Офисы продаж</div>
                <div class="addresses scrolled">
                    <? foreach ($models as $k => $model): ?>
                        <div class="item">
                            <div class="name"><?= $model->name ?></div>
                            <div><?= $model->address ?></div>
                            <div><?= $model->phones ?></div>
                            <? if ($model->lat && $model->lng): ?>
                                <a target="_blank"
                                   href="https://www.google.com.ua/maps/place/%D0%9A%D0%BE%D0%BB%D0%BE%D0%BC%D0%BD%D0%B0,+%D0%9C%D0%BE%D1%81%D0%BA%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB.,+%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F/@55.0919119,38.7769944,17.33z/data=!4m5!3m4!1s0x414a711d18ed933f:0x8dbd717685102998!8m2!3d55.0937517!4d38.7688618"
                                   class="on-map mobile-show">на карте</a>
                                <a href="javascript:void(0);" class="on-map mobile-hidden"
                                   data-map-object="marker<?= $k ?>">на карте</a>
                            <? endif; ?>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
