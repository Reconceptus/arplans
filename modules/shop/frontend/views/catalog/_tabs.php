<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 24.08.2018
 * Time: 12:16
 */

/* @var $model \modules\shop\models\Item */
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
            <li class="tab03"><label for="tab03">Видеообзор</label></li>
            <li class="tab04"><label for="tab04">3D-тур</label></li>
            <li class="tab05"><label for="tab05">Готовые объекты</label></li>
            <li class="tab06"><label for="tab06">Доп. услуги</label></li>
        </ul>
    </nav>
    <div class="tabs-sections">
        <div class="tab-section tab-main tab01">
            <div class="custom-row">
                <div class="custom-row-col col-50">
                    <div class="tab-main-slider" data-owl="plans">
                        <ul class="owl-carousel">
                            <li class="plan-item">
                                <img src="assets/images/plans/plan01.png" alt="plan">
                            </li>
                            <li class="plan-item">
                                <img src="assets/images/plans/plan02.jpg" alt="plan">
                            </li>
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
                                <tr>
                                    <td class="name"><?= $io->catalog->name ?></td>
                                    <td><?= $io->catalogItem->name ?></td>
                                </tr>
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
                            <tr>
                                <td class="name">Этажность</td>
                                <?
                                $floors = [];
                                if ($model->one_floor) $floors[] = '1';
                                if ($model->two_floor) $floors[] = '2';
                                if ($model->mansard) $floors[] = 'мансарда';
                                ?>
                                <td><?= implode(', ', $floors) ?></td>
                            </tr>
                            <tr>
                                <td class="name">Габариты</td>
                                <td>7,5м на 10м</td>
                            </tr>
                            <tr>
                                <td class="name">Количество комнат</td>
                                <td><?= $model->rooms ?></td>
                            </tr>
                            <tr>
                                <td class="name">Тип фундамента</td>
                                <td>ленточный</td>
                            </tr>
                            <tr>
                                <td class="name">Перекрытия 1-го этажа</td>
                                <td>по деревянным балкам</td>
                            </tr>
                            <tr>
                                <td class="name">Перекрытия 2-го этажа</td>
                                <td>по деревянным балкам</td>
                            </tr>
                            <tr>
                                <td class="name">Тип кровли</td>
                                <td>скатная</td>
                            </tr>
                            <tr>
                                <td class="name">Количество с/у</td>
                                <td>2</td>
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
                    <p>Фундамент (ростверк со сваями), стены, перекрытия и крыши утепленные.</p>
                    <ul>
                        <li>Оцилиндрованное бревно — от 1 785 680 руб</li>
                        <li>Профилированный брус — от 2 205 840 руб</li>
                        <li>Клееный брус — от 2 731040 руб</li>
                        <li>Каркас — от 1 575 600 руб</li>
                        <li>Газобетон (пеноблок, газосиликат) — от 2 205 840 руб</li>
                        <li>Керамический блок — от 2 520 960 руб</li>
                        <li>Кирпич — 2 626 000 руб</li>
                    </ul>
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
                        <li>Смотрите <a href="#">советы</a> по выбору материала в нашем блоге.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-section tab-video tab03">
            <div class="video">
                <figure>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/GLfhar0tbfY?rel=0"
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </figure>
            </div>
        </div>
        <div class="tab-section tab-3d tab04">
            <div class="tour">
                <iframe src="assets/frames/pano-tour"></iframe>
            </div>
        </div>
        <div class="tab-section tab-objects tab05">
            <div class="tab-objects-slider" data-owl="objects">
                <ul class="owl-carousel">
                    <li class="object-item">
                        <div class="projects-item--wrap">
                            <a href="#" class="projects-item--preview">
                                <div class="bg" style="background-image: url('assets/images/items/item01.jpg')"></div>
                                <div class="data">
                                    <div class="data-details">
                                        <span class="index">K-232</span>
                                        <span class="cost">Стоимость проекта: 25&nbsp;000&nbsp;&#8381;</span>
                                    </div>
                                    <ul class="info">
                                        <li>
                                            <span class="head">Жилая</span>
                                            <span>82 м<sup>2</sup></span>
                                        </li>
                                        <li>
                                            <span class="head">Полезная</span>
                                            <span>140 м<sup>2</sup></span>
                                        </li>
                                        <li>
                                            <span class="head">Общая</span>
                                            <span>260 м<sup>2</sup></span>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="object-item">
                        <div class="projects-item--wrap">
                            <a href="#" class="projects-item--preview">
                                <div class="bg" style="background-image: url('assets/images/items/item02.jpg')"></div>
                                <div class="data">
                                    <div class="data-details">
                                        <span class="index">K-232</span>
                                        <span class="cost">Стоимость проекта: 25&nbsp;000&nbsp;&#8381;</span>
                                    </div>
                                    <ul class="info">
                                        <li>
                                            <span class="head">Жилая</span>
                                            <span>82 м<sup>2</sup></span>
                                        </li>
                                        <li>
                                            <span class="head">Полезная</span>
                                            <span>140 м<sup>2</sup></span>
                                        </li>
                                        <li>
                                            <span class="head">Общая</span>
                                            <span>260 м<sup>2</sup></span>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-section tab-services tab06">
            <div class="custom-row">
                <div class="custom-row-col col-50">
                    <article>
                        <h4 class="title">Адаптация фундамента, 5 000 &#8381;</h4>
                        <div class="text">
                            <p>Документ, содержащий основные текстовые данные и схематические изображения,
                                характеризующие техническое решение, экономическую целесообразность и условия применения
                                проекта</p>
                        </div>
                        <div class="link"><a href="#">Читать полностью</a></div>
                    </article>
                    <article>
                        <h4 class="title">РАЗРАБОТКА РАЗДЕЛА ИР, 5 000 &#8381;</h4>
                        <div class="text">
                            <p>Документ, содержащий основные текстовые данные и схематические изображения,
                                характеризующие техническое решение, экономическую целесообразность и условия применения
                                проекта</p>
                        </div>
                        <div class="link"><a href="#">Читать полностью</a></div>
                    </article>
                </div>
                <div class="custom-row-col col-50">
                    <article>
                        <h4 class="title">ПОСАДКА ДОМА НА ГРУНТ, 5 000 &#8381;</h4>
                        <div class="text">
                            <p>Документ, содержащий основные текстовые данные и схематические изображения,
                                характеризующие техническое решение, экономическую целесообразность и условия применения
                                проекта</p>
                        </div>
                        <div class="link"><a href="#">Читать полностью</a></div>
                    </article>
                    <article>
                        <h4 class="title">РАЗРАБОТКА ПАСПОРТА ПРОЕКТА, 5 000 &#8381;</h4>
                        <div class="text">
                            <p>Документ, содержащий основные текстовые данные и схематические изображения,
                                характеризующие техническое решение, экономическую целесообразность и условия применения
                                проекта</p>
                        </div>
                        <div class="link"><a href="#">Читать полностью</a></div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
