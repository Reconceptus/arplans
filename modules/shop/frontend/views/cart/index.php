<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 03.09.2018
 * Time: 11:43
 */

/* @var $models \modules\shop\widgets\cart\Cart[] */
?>

<div class="section basket-order">
    <div class="content content--lg">
        <div class="basket-form--section">
            <h1 class="title title-sm">1. Проекты в корзине</h1>
        </div>
        <div class="custom-row">
            <div class="custom-row-col col-elastic">
                <div class="basket-form">
                    <form action="#">
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
                                        <div class="compare-table--part">
                                            <a href="javascript:void(0);">
                                                Материал
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
                                        <? foreach ($models as $model): ?>
                                            <?= $this->render('_list', ['model' => $model]) ?>
                                        <? endforeach; ?>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <?= $this->render('_additional') ?>
                        <?= $this->render('_orderdata') ?>
                    </form>
                </div>
            </div>
            <?= $this->render('_sidebar') ?>
        </div>
    </div>
</div>
<div class="section info-box ">
    <div class="content content--md">
        <div class="ready-projects--info">
            <h3 class="title">Безопасность при оплате</h3>
            <div class="info-box--text">
                <p>В этом блоке 3 стиля: основной, <a href="#">ссылка</a>, <strong>болд</strong>. Не
                    обязательное поле для текстового описания. ARPLANS.RU — сервис готовых архитектурных
                    проектов загородных домов, коттеджей, бань. По нашим проектам многократно производилось
                    строительство, а качество чертежей проектной документации проверено временем и
                    репутацией разработчиков. Все проекты созданы опытными и высококвалифицированны
                    архитекторами и инженерами ARPLANS.</p>
                <p>Здесь рыба. Сервис готовых архитектурных проектов загородных домов, коттеджей, бань. По
                    нашим проектам многократно производилось строительство, а качество чертежей проектной
                    документации проверено временем и репутацией разработчиков. Все проекты созданы опытными
                    и высококвалифицированны архитекторами и инженерами ARPLANS.</p>
            </div>
        </div>
    </div>
</div>
<?= \frontend\widgets\recently\Recently::widget() ?>


