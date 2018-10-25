<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 25.10.2018
 * Time: 15:47
 */
/* @var $model \modules\shop\models\Order */
?>

<?= $this->render('_tabs') ?>
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
                            <? foreach ($model->orderItems as $item): ?>
                                <?= $this->render('_list', ['model' => $item]) ?>
                            <? endforeach; ?>
                        </div>
                    </div>
                </section>
                Услуги: <br/>
                <? foreach ($model->orderServices as $service): ?>
                    <p><?= $service->service->name ?>, <?= $service->price ?></p>
                <? endforeach; ?>
            </div>
            Данные заказа:
            <table>
                <tr>
                    <td>Email</td>
                    <td><?= $model->email ?></td>
                </tr>
                <tr>
                    <td>Телефон</td>
                    <td><?= $model->phone ?></td>
                </tr>
                <tr>
                    <td>ФИО</td>
                    <td><?= $model->fio ?></td>
                </tr>
                <tr>
                    <td>Страна</td>
                    <td><?= $model->country ?></td>
                </tr>
                <tr>
                    <td>Город</td>
                    <td><?= $model->city ?></td>
                </tr>
                <tr>
                    <td>Адрес</td>
                    <td><?= $model->address ?></td>
                </tr>
                <tr>
                    <td>Комментарий</td>
                    <td><?= $model->comment ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

