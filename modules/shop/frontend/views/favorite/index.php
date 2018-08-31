<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 31.08.2018
 * Time: 9:42
 */

use yii\widgets\ListView;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $sizeCatalog \modules\shop\models\Catalog */
?>
<div class="section compare compare-page">
    <div class="content content--lg">
        <h1 class="title title-sm">Давайте сравним проекты</h1>
        <div class="custom-row">
            <div class="custom-row-col col-elastic">
                <div class="compare-table">
                    <div class="compare-table--header">
                        <div class="compare-table--part part-project">
                            <a href="javascript:void(0);">
                                Проект
                            </a>
                        </div>
                        <div class="compare-table--part">
                            <a href="javascript:void(0);" class="up">
                                Площадь
                                <i class="arrow"></i>
                            </a>
                        </div>
                        <div class="compare-table--part">
                            <a href="javascript:void(0);" class="down">
                                Удобства
                                <i class="arrow"></i>
                            </a>
                        </div>
                        <div class="compare-table--part part-rooms">
                            <a href="javascript:void(0);" class="down">
                                Этажи/комнаты
                                <i class="arrow"></i>
                            </a>
                        </div>
                        <div class="compare-table--part">
                            <a href="javascript:void(0);" class="down">
                                Тип строения
                                <i class="arrow"></i>
                            </a>
                        </div>
                        <div class="compare-table--part part-cost">
                            <a href="javascript:void(0);" class="down">
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
                        'itemView'     => function ($model, $key, $index, $widget) use ($sizeCatalog) {
                            return $this->render('_list', ['model' => $model, 'sizeCatalog' => $sizeCatalog]);
                        },
                    ]);
                    ?>
                </div>
            </div>
            <div class="custom-row-col col-sidebar">

                <div class="compare-sidebar">
                    <div class="order">
                        <a href="tel:88002001714" class="phone">
                            <i class="icon icon-phone">
                                <svg xmlns="http://www.w3.org/2000/svg">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-phone"/>
                                </svg>
                            </i>
                            8 800 200-17-14
                        </a>
                        <a href="#" class="btn-round-min">Консультация</a>
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
                <p>В этом блоке 3 стиля: основной, <a href="#">ссылка</a>, <strong>болд</strong>. Не
                    обязательное поле для текстового описания. ARPLANS.RU — сервис готовых архитектурных
                    проектов загородных домов, коттеджей, бань. По нашим проектам многократно производилось
                    строительство, а качество чертежей проектной документации проверено временем и репутацией
                    разработчиков. Все проекты созданы опытными и высококвалифицированны архитекторами и
                    инженерами ARPLANS.</p>
                <p>Здесь рыба. Сервис готовых архитектурных проектов загородных домов, коттеджей, бань. По нашим
                    проектам многократно производилось строительство, а качество чертежей проектной документации
                    проверено временем и репутацией разработчиков. Все проекты созданы опытными и
                    высококвалифицированны архитекторами и инженерами ARPLANS.</p>
            </div>
        </div>
    </div>
</div>