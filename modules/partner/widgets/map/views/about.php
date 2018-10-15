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
                    <? foreach ($models as $model): ?>
                        <div class="item">
                            <div class="name"><?= $model->name ?></div>
                            <div><?= $model->address ?></div>
                            <div><?= $model->phones ?></div>
                            <!--                                <a href="#" class="on-map">на карте</a>-->
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
