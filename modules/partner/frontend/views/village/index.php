<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 17:19
 */

/* @var $query */

$this->title = \modules\content\models\ContentBlock::getValue('village_page_seo_title');
$this->registerMetaTag(['name' => 'keywords', 'content' => \modules\content\models\ContentBlock::getValue('village_page_seo_keywords')]);
$this->registerMetaTag(['name' => 'description', 'content' => \modules\content\models\ContentBlock::getValue('village_page_seo_description')]);

$mapSelected = boolval(Yii::$app->request->get('selector'));
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
                                            <input type="text" placeholder="Введите название населенного пункта">
                                            <?= \modules\partner\widgets\regions\Regions::widget(['viewName' => 'drop', 'type' => 'village', 'selector' => 1]) ?>
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
<?= \frontend\widgets\recently\Recently::widget() ?>

<?php
$js = <<<JS
    $(document).on('click', '.js-region-selector', function (e) {
        e.preventDefault();
        var button = $(this);
        var href = (button.attr('href')).replace('&selector=1','').replace('?selector=1','');
        
        if($('#view_map').prop('checked')){
            if(href ==='/village'){
                href+='?selector=1';
            }else{
                href+='&selector=1';
            }
        }
        window.location.href = href+'#map-anchor';
    });
JS;

$this->registerJs($js); ?>
