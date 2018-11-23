<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 10:24
 */

use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $dataProvider \yii\data\ActiveDataProvider */
$reg = Yii::$app->request->get('region');
$this->title = \modules\content\models\ContentBlock::getValue('builder_page_seo_title');
$this->registerMetaTag(['name' => 'keywords', 'content' => \modules\content\models\ContentBlock::getValue('builder_page_seo_keywords')]);
$this->registerMetaTag(['name' => 'description', 'content' => \modules\content\models\ContentBlock::getValue('builder_page_seo_description')]);

\yii\widgets\Pjax::begin();
?>

<div class="section bg-head">
    <div class="content content--lg">
        <div class="bg-head--main gradient">
            <h1 class="title title-lg"><?= $this->title ?></h1>
        </div>
    </div>
</div>
<div class="section">
    <div class="content content--lg">
        <div class="custom-row filter-row">
            <?= \modules\partner\widgets\filters\Filters::widget(['viewName' => 'builders']) ?>
            <div class="custom-row-col col-elastic">
                <div class="map-box">
                    <div class="map-box--main">
                        <div class="custom-search">
                            <form action="#">
                                <div class="custom-search--field">
                                    <div class="custom-search--inputs">
                                        <div class="input region-dropbox">
                                            <input type="text"
                                                   value="<?= $reg ? \common\models\Region::getNameById($reg) : '' ?>"
                                                   placeholder="Выберите регион">
                                            <?= \modules\partner\widgets\regions\Regions::widget(['viewName' => 'drop', 'type' => 'builder']) ?>
                                        </div>
                                        <button class="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     xlink:href="#icon-search"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="map-box--field">
                            <div class="partners-list">
                                <?= ListView::widget([
                                    'dataProvider' => $dataProvider,
                                    'options'      => [
                                        'tag' => 'ul'
                                    ],
                                    'pager'        => [
                                        'nextPageLabel'      => '',
                                        'prevPageLabel'      => '',
                                        'maxButtonCount'     => '10',
                                        'activePageCssClass' => 'current',
                                        'linkOptions'        => [
                                            'class' => 'pager-el',
                                        ],
                                        'options'            => [
                                            'class' => 'pager'
                                        ],
                                    ],
                                    'itemOptions'  => [
                                        'tag' => 'li',
                                    ],
                                    'layout'       => "{items}",
                                    'itemView'     => function ($model, $key, $index, $widget) {
                                        return $this->render('_list', ['model' => $model]);
                                    },
                                ]); ?>
                                <div class="catalog-actions">
                                    <?= LinkPager::widget([
                                        'pagination'         => $dataProvider->getPagination(),
                                        'linkOptions'        => ['class' => 'page'],
                                        'activePageCssClass' => 'current',
                                        'nextPageLabel'      => '>',
                                        'prevPageLabel'      => '<',
                                        'prevPageCssClass'   => 'prev',
                                        'nextPageCssClass'   => 'next',
                                    ]) ?>
                                </div>
                            </div>
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
            <h3 class="title">Клуб Арпланс</h3>
            <div class="info-box--text">
                <?= \modules\content\models\ContentBlock::getValue('builder_index_description') ?>
            </div>
        </div>
    </div>
</div>

<?= \frontend\widgets\recently\Recently::widget() ?>
<script>
    if (typeof project !== 'undefined') {
        project.regionDropBox();
        project.showMore();
        project.mapMarkers();
        project.fixedSidebar();
    }
</script>
<? \yii\widgets\Pjax::end(); ?>
