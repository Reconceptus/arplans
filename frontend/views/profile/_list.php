<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 03.09.2018
 * Time: 12:49
 */
/* @var $model \modules\shop\models\OrderItem */
$item = $model->item;
?>

<div class="compare-table--item">
    <div class="compare-table--section" data-id="<?= $model->id ?>">
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
                <a href="/shop/<?= $item->category->slug ?>/<?= $item->slug ?>"
                   class="projects-item--articul"><?= $item->name ?></a>
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
            </div>
        </div>
        <div class="compare-table--part part-count">
            <div class="projects-item--part-title">**Количество альбомов</div>
            <div class="projects-item--info">
                <div class="form-row-element">
                    <?= $model->count ?>
                </div>
            </div>
        </div>
        <div class="compare-table--part part-cost">
            <div class="projects-item--actions">
                <div class="price-box">
                    <div class="projects-item--part-title">Стоимость</div>
                    <div class="price"><?= $model->price ?>
                        &#8381;
                    </div>
                </div>
                <div class="btns">

                </div>
            </div>
        </div>
    </div>
</div>
