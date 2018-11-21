<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 17:19
 */

/* @var $query */

$this->title = 'Клуб АРПЛАНС: коттеджные поселки';
\yii\widgets\Pjax::begin();
?>
    <div class="section bg-head">
        <div class="content content--lg">
            <div class="bg-head--main gradient"><h1 class="title title-lg"><?= $this->title ?></h1></div>
        </div>
    </div>
    <div class="section">
        <div class="content content--lg">
            <div class="custom-row filter-row">
                <?= \modules\partner\widgets\filters\Filters::widget(['viewName' => 'villages']) ?>
                <div class="custom-row-col col-elastic">
                    <div class="map-box">
                        <div class="map-box--main view-box">
                            <input type="radio" id="view_map" name="view">
                            <input type="radio" checked id="view_list" name="view">
                            <div class="custom-search">
                                <form action="#">
                                    <div class="custom-search--field">
                                        <div class="custom-search--inputs">
                                            <div class="input region-dropbox">
                                                <input type="text" placeholder="Введите название населенного пункта">
                                                <?= \modules\partner\widgets\regions\Regions::widget(['viewName' => 'drop']) ?>
                                            </div>
                                            <button class="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg">
                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                         xlink:href="#icon-search"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="custom-search--nav">
                                            <label for="view_map" class="view view-map">
                                                На карте
                                            </label>
                                            <label for="view_list" class="view view-list">
                                                списком
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="map-box--field">
                                <?= \modules\partner\widgets\map\Map::widget(['viewName' => 'both', 'query' => $query]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section info-box ">
        <div class="content content--md">
            <div class="ready-projects--info">
                <h3 class="title">Котеджные поселки</h3>
                <div class="info-box--text">
                    <?=\modules\content\models\ContentBlock::getValue('village_index_description')?>
                </div>
            </div>
        </div>
    </div>
<?= \frontend\widgets\recently\Recently::widget() ?>
<script>initMap()</script>
<? \yii\widgets\Pjax::end(); ?>
