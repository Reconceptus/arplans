<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 31.08.2018
 * Time: 9:42
 */

use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $sizeCatalog \modules\shop\models\Catalog */
/* @var $inCart array */
$this->title = \modules\content\models\ContentBlock::getValue('favorite_page_seo_title');
$this->registerMetaTag(['name' => 'keywords', 'content' => \modules\content\models\ContentBlock::getValue('favorite_page_seo_keywords')]);
$this->registerMetaTag(['name' => 'description', 'content' => \modules\content\models\ContentBlock::getValue('favorite_page_seo_description')]);

?>
<div class="section compare compare-page">
    <div class="content content--lg">
        <h1 class="title title-sm">Давайте сравним проекты</h1>
        <div class="custom-row">
            <div class="custom-row-col col-elastic">
                <div class="compare-table">
                    <?  Pjax::begin(); ?>
                    <div class="compare-table--header">
                        <div class="compare-table--part part-project">
                            <a href="<?=$dataProvider->sort->createUrl('id')?>">
                                Проект
                            </a>
                        </div>
                        <div class="compare-table--part">
                            <a href="<?=$dataProvider->sort->createUrl('common_area')?>" class="down">
                                Площадь
                                <i class="arrow"></i>
                            </a>
                        </div>
                        <div class="compare-table--part">
                            <a href="javascript:void(0);" class="down">
                                Удобства
                            </a>
                        </div>
                        <div class="compare-table--part part-rooms">
                            <a href="javascript:void(0);" class="down">
                                Этажи/комнаты
                            </a>
                        </div>
                        <div class="compare-table--part">
                            <a href="javascript:void(0);" class="down">
                                Тип строения
                            </a>
                        </div>
                        <div class="compare-table--part part-cost">
                            <a href="<?=$dataProvider->sort->createUrl('cost')?>" class="down">
                                Стоимость
                                <i class="arrow"></i>
                            </a>
                        </div>
                    </div>
                    <?
                    echo ListView::widget([
                        'dataProvider' => $dataProvider,
                        'options'      => [
                            'tag'   => 'div',
                            'class' => 'compare-table--main',
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
                            'tag'   => 'div',
                            'class' => 'compare-table--item'
                        ],
                        'layout'       => "{items}",
                        'itemView'     => function ($model, $key, $index, $widget) use ($sizeCatalog, $inCart) {
                            return $this->render('_list', ['model' => $model, 'sizeCatalog' => $sizeCatalog, 'inCart' => $inCart]);
                        },
                    ]);
                    Pjax::end();
                    ?>
                </div>
            </div>
            <div class="custom-row-col col-sidebar">

                <div class="compare-sidebar">
                    <div class="order">
                        <a href="tel:<?=\modules\content\models\ContentBlock::getValue('hot_line')?>" class="phone">
                            <i class="icon icon-phone">
                                <svg xmlns="http://www.w3.org/2000/svg">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-phone"/>
                                </svg>
                            </i>
                            <?=\modules\content\models\ContentBlock::getValue('hot_line')?>
                        </a>
                        <a href="#" class="btn-round-min show-modal" data-modal="consultation">Консультация</a>
                    </div>
                    <div class="compare-sidebar--info">
                        <div class="info-title">*Замена материала бесплатно</div>
                        <p>Укажите в заказе, что требуется изменение материала, мы свяжемся и уточним.</p>
                    </div>
                    <div class="compare-list">
                        <ul>
                            <li>
                                <i class="icon icon-delivery">
                                    <svg xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#icon-site-delivery"/>
                                    </svg>
                                </i>
                                <div class="compare-list--text">
                                    <h4 class="compare-list--title">Доставка в руки</h4>
                                    <p>Доставка проекта курьером в руки через 3-5 дней</p>
                                </div>
                            </li>
                            <li>
                                <i class="icon icon-documents">
                                    <svg xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#icon-site-documents"/>
                                    </svg>
                                </i>
                                <div class="compare-list--text">
                                    <h4 class="compare-list--title">Документация</h4>
                                    <p>Полный пакет документации для строительства</p>
                                </div>
                            </li>
                            <li>
                                <i class="icon icon-money">
                                    <svg xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#icon-site-money"/>
                                    </svg>
                                </i>
                                <div class="compare-list--text">
                                    <h4 class="compare-list--title">Удобная оплата</h4>
                                    <p>Безопасные виды оплаты и легкий возврат</p>
                                </div>
                            </li>
                            <li>
                                <i class="icon icon-forrussia">
                                    <svg xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#icon-site-forrussia"/>
                                    </svg>
                                </i>
                                <div class="compare-list--text">
                                    <h4 class="compare-list--title">Для России</h4>
                                    <p>Учитываем специфику современного российского строительного рынка</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section info-box ">
    <div class="content content--md">
        <div class="ready-projects--info">
            <h3 class="title">Как сравнивать проекты</h3>
            <div class="info-box--text">
                <?=\modules\content\models\ContentBlock::getValue('favorite_description')?>
            </div>
        </div>
    </div>
</div>