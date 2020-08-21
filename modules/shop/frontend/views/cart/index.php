<?php

/* @var $models \modules\shop\widgets\cart\Cart[] */
/* @var $services \modules\shop\models\Service[] */
/* @var $user \common\models\User */
$this->title = \modules\content\models\ContentBlock::getValue('cart_page_seo_title');
$this->registerMetaTag(['name' => 'keywords', 'content' => \modules\content\models\ContentBlock::getValue('cart_page_seo_keywords')]);
$this->registerMetaTag(['name' => 'description', 'content' => \modules\content\models\ContentBlock::getValue('cart_page_seo_description')]);

$albumPrice = (float) \common\models\Config::getValue('albumPrice');
?>
<script>
    var albumPrice = <?=$albumPrice?>;
</script>
<div class="section basket-order">
    <div class="content content--lg">
        <div class="basket-form--section">
            <h1 class="title title-sm">Проекты в корзине</h1>
        </div>
        <div class="custom-row">
            <div class="custom-row-col col-elastic">
                <div class="basket-form">
                    <div>
                        <section class="compare filter-form">
                            <div class="compare-table">
                                <div class="compare-table--header">
                                    <div class="compare-table--part part-project">
                                        <a href="javascript:void(0);">
                                            Проект
                                        </a>
                                    </div>
                                    <div class="compare-table--part">
                                        <a href="javascript:void(0);">
                                            Артикул
                                        </a>
                                    </div>
                                    <div class="compare-table--part">
                                        <a href="javascript:void(0);">
                                            Площадь
                                        </a>
                                    </div>
                                    <div class="compare-table--part part-count">
                                        <a href="javascript:void(0);">
                                            Количество альбомов
                                        </a>
                                    </div>
                                    <div class="compare-table--part part-cost">
                                        <a href="javascript:void(0);">
                                            Стоимость
                                        </a>
                                    </div>
                                </div>
                                <div class="compare-table--main">
                                    <?php foreach ($models as $model): ?>
                                        <?= $this->render('_list', ['model' => $model, 'albumPrice' => $albumPrice]) ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </section>
                    </div>
                    <?= $this->render('_orderdata', ['models' => $models, 'user' => $user, 'albumPrice' => $albumPrice]) ?>
                </div>
            </div>
            <?= $this->render('_sidebar') ?>
        </div>
    </div>
</div>
<div class="section info-box ">
    <div class="content content--md">
        <div class="ready-projects--info">
            <div class="info-box--text">
                <?=\modules\content\models\ContentBlock::getValue('cart_description')?>
            </div>
        </div>
    </div>
</div>
<?= \frontend\widgets\recently\Recently::widget() ?>


