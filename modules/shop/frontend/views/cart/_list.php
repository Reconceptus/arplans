<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 03.09.2018
 * Time: 12:49
 */
/* @var $model \modules\shop\models\Cart */
$item = $model->item;
?>
<div class="compare-table--item">
    <div class="compare-table--section">
        <div class="compare-table--part part-project">
            <a href="/shop/<?= $item->category->slug ?>/<?= $item->slug ?>" class="projects-item--preview">
                <div class="bg" style="background-image: url('<?= $item->getMainImage() ?>')"></div>
                <span class="look">
                    <span class="look-alone data">смотреть</span>
                </span>
            </a>
        </div>
        <div class="compare-table--part part-articul">
            <div class="projects-item--part-title">Артикул</div>
            <div class="projects-item--info">
                <a href="#" class="projects-item--articul"><?= $item->name ?></a>
            </div>
        </div>
        <div class="compare-table--part">
            <div class="projects-item--part-title">Площадь</div>
            <div class="projects-item--info">
                <?= $item->live_area ? '<div>Жилая: ' . $item->live_area . '</div>' : '' ?>
                <?= $item->useful_area ? '<div>Полезная: ' . $item->useful_area . '</div>' : '' ?>
                <?= $item->common_area ? '<div>Общая: ' . $item->common_area . '</div>' : '' ?>
                <div><?= $item->getCatalogValue('size') ?></div>
            </div>
        </div>
        <div class="compare-table--part">
            <div class="projects-item--part-title">Материал</div>
            <div class="projects-item--info">
                <div><?= $item->getCatalogValue('walls') ?></div>
                <div class="form-row-element">
                    <div class="check">
                        <label>
                            <input type="checkbox" name="material[<?= $item->id ?>]">
                            <span>*Изменить материал</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="compare-table--part part-count">
            <div class="projects-item--part-title">**Количество альбомов</div>
            <div class="projects-item--info">
                <div class="album-head">**Количество альбомов</div>
                <div class="form-row-element">
                    <div class="counter">
                        <span class="minus">
                            <i class="icon icon-minus">
                                <svg xmlns="http://www.w3.org/2000/svg">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-count-minus"/>
                                </svg>
                            </i>
                        </span>
                        <input class="result" readonly value="1" min="1">
                        <span class="plus">
                            <i class="icon icon-plus">
                                <svg xmlns="http://www.w3.org/2000/svg">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-count-plus"/>
                                </svg>
                            </i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="compare-table--part part-cost">
            <div class="projects-item--actions">
                <div class="price-box">
                    <div class="projects-item--part-title">Стоимость</div>
                    <div class="price"><?= ($item->price - $item->discount) >= 0 ? $item->price - $item->discount : 0 ?>
                        &#8381;
                    </div>
                </div>
                <div class="btns">
                    <button class="compare-table--remove">
                        <i class="icon-remove">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                     xlink:href="#icon-remove"/>
                            </svg>
                        </i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
