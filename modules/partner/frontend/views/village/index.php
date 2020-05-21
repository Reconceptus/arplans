<?php

/* @var $query */

use yii\helpers\Url;

$reg = Yii::$app->request->get('region');

$this->title = \modules\content\models\ContentBlock::getValue('village_page_seo_title');
$this->registerMetaTag(['name' => 'keywords', 'content' => \modules\content\models\ContentBlock::getValue('village_page_seo_keywords')]);
$this->registerMetaTag(['name' => 'description', 'content' => \modules\content\models\ContentBlock::getValue('village_page_seo_description')]);
\yii\widgets\Pjax::begin();
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]);
$mapSelected = (bool)Yii::$app->request->get('selector');
?>
<a name="map-anchor"></a>
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
                        <input type="radio" <?= $mapSelected ? 'checked' : '' ?> id="view_map" name="view">
                        <input type="radio" <?= $mapSelected ? '' : 'checked' ?> id="view_list" name="view">
                        <div class="custom-search">
                            <form action="#">
                                <div class="custom-search--field">
                                    <div class="custom-search--inputs">
                                        <div class="input region-dropbox">
                                            <input type="text"
                                                   value="<?= $reg ? \common\models\Region::getNameById($reg) : '' ?>"
                                                   placeholder="Выберите регион">
                                            <?= \modules\partner\widgets\regions\Regions::widget(['viewName' => 'drop', 'type' => 'village']) ?>
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
                <?= \modules\content\models\ContentBlock::getValue('village_index_description') ?>
            </div>
        </div>
    </div>
</div>
<script>
    if (typeof google !== 'undefined') {
        initMap();
    }
    if (typeof project !== 'undefined') {
        project.regionDropBox();
        project.customScroll();
        project.mapMarkers();
        project.showMore();
        project.fixedSidebar();
    }
</script>
<?= \frontend\widgets\recently\Recently::widget() ?>

<?php
$js = <<<JS
    $(document).on('click', '#view_map', function (e) {
       $('.js-region-selector').each(function(index,i) {
         var href=$(i).attr('href').replace('&selector=1','').replace('?selector=1','');;
            if(href==='/village'){
                href+='?selector=1';
            }else{
                href+='&selector=1';
            }
            $(i).attr('href',href)
       });
    });
$(document).on('click', '#view_list', function (e) {
       $('.js-region-selector').each(function(index,i) {
         var href=$(i).attr('href').replace('&selector=1','').replace('?selector=1','');;
            $(i).attr('href',href)
       });
    });
JS;

$this->registerJs($js);
\yii\widgets\Pjax::end();
?>
