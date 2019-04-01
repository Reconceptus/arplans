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
            <?php if ($model->video): ?>
                <li class="tab03"><label for="tab03">Видеообзор</label></li>
            <?php endif; ?>
            <!--            <li class="tab04"><label for="tab04">3D-тур</label></li>-->
            <?php if ($ready): ?>
                <li class="tab05"><label for="tab05">Фото строительства</label></li>
            <?php endif; ?>
            <li class="tab06"><label for="tab06">Доп. услуги</label></li>
        </ul>
    </nav>
    <div class="tabs-sections">
        <div class="tab-section tab-main tab01">
            <div class="custom-row">
                <div class="custom-row-col col-50">
                    <div class="tab-main-slider" data-owl="plans">
                        <ul class="owl-carousel">
                            <?php foreach ($model->getPlans() as $k => $plan): ?>
                            <?php /* @var $plan \modules\shop\models\ItemImage*/?>
                                <li class="plan-item">
                                    <img data-plan="<?= $plan->id ?>" src="<?= $plan->getThumb() ?>" alt="plan">
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="gallery-items">
                        <?php foreach ($model->getPlans() as $k => $plan): ?>
                            <a data-plan="<?= $plan->id ?>" href="<?= $plan->image ?>" data-fancybox="plans"></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="custom-row-col col-50">
                    <div class="tab-main-table">
                        <table>
                            <tr>
                                <td class="name">Тип дома</td>
                                <td><?= $model->category->name ?></td>
                            </tr>
                            <?php foreach ($model->itemOptions as $io): ?>
                                <?php if ($io->catalog->basic): ?>
                                    <tr>
                                        <td class="name"><?= $io->catalog->name ?></td>
                                        <td><?= $io->catalogItem->name ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
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
                            <?php if ($model->exact_gab): ?>
                                <tr>
                                    <td class="name">
                                        <div class="flex">Точные габариты <i class="icon-sign">i</i></div>
                                    </td>
                                    <td>
                                        <?= $model->exact_gab ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php $floors = [];
                            if ($model->one_floor) $floors[] = 'одноэтажный';
                            if ($model->two_floor) $floors[] = 'двухэтажный';
                            ?>
                            <?php if ($floors): ?>
                                <tr>
                                    <td class="name">Этажность</td>
                                    <td><?= implode(', ', $floors) ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td class="name">Количество комнат</td>
                                <td><?= $model->rooms == 6 ? '6+' : $model->rooms ?></td>
                            </tr>
                            <tr>
                                <td class="name">Количество с/у</td>
                                <td><?= $model->bathrooms ?></td>
                            </tr>
                            <?php if ($comfort = $model->getComfort()): ?>
                                <tr>
                                    <td class="name">Удобства</td>
                                    <td><?= implode(', ', $comfort) ?></td>
                                </tr>
                            <?php endif; ?>
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
                        <a href="#" class="btn-add show-modal"
                           data-modal="calculation"><span>Получить точную смету</span></a>
                    </div>
                </div>
                <div class="custom-row-col col-50">
                    <h4 class="title">Примечания</h4>
                    <ul>
                        <li>Стоимость строительства дома — ориентировочная! Для более детального расчета стоимости
                            строительства необходима разработка сметы, согласно стоимости материалов в вашем регионе
                        </li>
                        <li>Мы не учитываем стоимость доставки материалов.</li>
                        <li>Смотрите советы по выбору материала в
                            нашем <?= \yii\helpers\Html::a('блоге', \yii\helpers\Url::to('/blog')) ?>.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if ($model->video): ?>
            <div class="tab-section tab-video tab03">
                <div class="video">
                    <figure>
                        <?= \frontend\widgets\youtube\Youtube::widget([
                            'url' => $model->video,
                        ]) ?>
                    </figure>
                </div>
            </div>
        <?php endif; ?>
        <!--        <div class="tab-section tab-3d tab04">-->
        <!--            <div class="tour">-->
        <!--                <iframe src=""></iframe>-->
        <!--            </div>-->
        <!--        </div>-->
        <?php if ($ready): ?>
            <div class="tab-section tab-objects tab05">
                <div class="tab-objects-slider" data-owl="objects">
                    <ul class="owl-carousel">
                        <?php foreach ($ready as $readyImage): ?>
                            <li class="object-item">
                                <div class="projects-item--wrap">
                                    <a href="#" class="projects-item--preview">
                                        <div class="bg"
                                             style="background-image: url(<?= $readyImage->image ?>)"></div>
                                    </a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <div class="tab-section tab-services tab06">
            <?= \modules\shop\widgets\services\Services::widget(['viewName' => 'index']) ?>
        </div>
    </div>
</div>
