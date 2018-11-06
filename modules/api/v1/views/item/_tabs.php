<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 24.08.2018
 * Time: 12:16
 */

/* @var $model \modules\shop\models\Item */
$ready = $model->getReady();
?>

<div class="project-page--tabs">
    <input type="radio" checked name="tabs" class="tab01" id="tab01">
    <input type="radio" name="tabs" class="tab02" id="tab02">
    <input type="radio" name="tabs" class="tab03" id="tab03">
    <input type="radio" name="tabs" class="tab04" id="tab04">
    <input type="radio" name="tabs" class="tab05" id="tab05">
    <input type="radio" name="tabs" class="tab06" id="tab06">
    <nav class="tabs-nav">
        <span class="selected">Основное</span>
        <ul>
            <li class="tab01"><label for="tab01">Основное</label></li>
            <li class="tab02"><label for="tab02">Стоимость строительства</label></li>
            <? if ($model->video): ?>
                <li class="tab03"><label for="tab03">Видеообзор</label></li>
            <? endif; ?>
            <!--            <li class="tab04"><label for="tab04">3D-тур</label></li>-->
            <? if ($ready): ?>
                <li class="tab05"><label for="tab05">Фото строительства</label></li>
            <? endif; ?>
            <li class="tab06"><label for="tab06">Доп. услуги</label></li>
        </ul>
    </nav>
    <div class="tabs-sections">
        <div class="tab-section tab-main tab01">
            <div class="custom-row">
                <div class="custom-row-col col-50">
                    <div class="tab-main-slider" data-owl="plans">
                        <ul class="owl-carousel">
                            <? foreach ($model->getPlans() as $k => $plan): ?>
                                <li class="plan-item">
                                    <img src="<?= $plan->image ?>" alt="plan">
                                </li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="custom-row-col col-50">
                    <div class="tab-main-table">
                        <table>
                            <tr>
                                <td class="name">Тип дома</td>
                                <td><?= $model->category->name ?></td>
                            </tr>
                            <? foreach ($model->itemOptions as $io): ?>
                                <? if ($io->catalog->basic): ?>
                                    <tr>
                                        <td class="name"><?= $io->catalog->name ?></td>
                                        <td><?= $io->catalogItem->name ?></td>
                                    </tr>
                                <? endif; ?>
                            <? endforeach; ?>
                            <tr>
                                <td class="name">
                                    <div class="flex">Площадь <i class="icon-sign">i</i></div>
                                </td>
                                <td>
                                    <span>жилая: <?= $model->live_area ?>м<sup>2</sup></span>
                                    <span>полезная: <?= $model->useful_area ?>м<sup>2</sup></span>
                                    <span>общая: <?= $model->common_area ?>м<sup>2</sup></span>
                                </td>
                            </tr>
                            <?
                            $floors = [];
                            if ($model->one_floor) $floors[] = 'одноэтажный';
                            if ($model->two_floor) $floors[] = 'двухэтажный';
                            ?>
                            <? if ($floors): ?>
                                <tr>
                                    <td class="name">Этажность</td>
                                    <td><?= implode(', ', $floors) ?></td>
                                </tr>
                            <? endif; ?>
                            <tr>
                                <td class="name">Количество комнат</td>
                                <td><?= $model->rooms == 6 ? '6+' : $model->rooms ?></td>
                            </tr>
                            <tr>
                                <td class="name">Количество с/у</td>
                                <td><?= $model->bathrooms ?></td>
                            </tr>
                            <tr>
                                <td class="name">Удобства</td>
                                <td><?= implode(', ', $model->getComfort()) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


        </div>
        <div class="tab-section tab-cost tab02">
            <div class="custom-row">
                <div class="custom-row-col col-50">
                    <h4 class="title">Стоимость строительства "коробки"</h4>
                    <?= $model->build_price ?>
                    <div class="estimate">
                        <a href="#" class="btn-add"><span>Получить точную смету</span></a>
                    </div>
                </div>
                <div class="custom-row-col col-50">
                    <h4 class="title">Примечания</h4>
                    <ul>
                        <li>Стоимость строительства дома — ориентировочная! Для более детального расчета стоимости
                            строительства необходима разработка сметы, согласно стоимости материалов в вашем регионе
                        </li>
                        <li>Мы не учитываем стоимость доставки материалов.</li>
                        <li>Смотрите советы по выбору материала в нашем <?=\yii\helpers\Html::a('советы', \yii\helpers\Url::to('/blog'))?>.</li>
                    </ul>
                </div>
            </div>
        </div>
        <? if ($model->video): ?>
            <div class="tab-section tab-video tab03">
                <div class="video">
                    <figure>
                        <iframe width="560" height="315" src="<?= str_replace('watch', 'embed', $model->video) ?>"
                                frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </figure>
                </div>
            </div>
        <? endif; ?>
        <!--        <div class="tab-section tab-3d tab04">-->
        <!--            <div class="tour">-->
        <!--                <iframe src=""></iframe>-->
        <!--            </div>-->
        <!--        </div>-->
        <? if ($ready): ?>
            <div class="tab-section tab-objects tab05">
                <div class="tab-objects-slider" data-owl="objects">
                    <ul class="owl-carousel">
                        <? foreach ($ready as $readyImage): ?>
                            <li class="object-item">
                                <div class="projects-item--wrap">
                                    <a href="#" class="projects-item--preview">
                                        <div class="bg"
                                             style="background-image: url(<?= $readyImage->image ?>)"></div>
                                    </a>
                                </div>
                            </li>
                        <? endforeach; ?>
                    </ul>
                </div>
            </div>
        <? endif; ?>
        <div class="tab-section tab-services tab06">
            <?= \modules\shop\widgets\services\Services::widget(['viewName' => 'index']) ?>
        </div>
    </div>
</div>
