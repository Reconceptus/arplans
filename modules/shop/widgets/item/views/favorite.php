<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 31.08.2018
 * Time: 10:41
 */

use modules\shop\models\Item;

/* @var $model Item */
/* @var $isInCart bool */
/* @var $sizeCatalog \modules\shop\models\Catalog */
$size = $model->getItemOptionCatalogItem($sizeCatalog->id);
$image = $model->getMainImage(true);
?>

<div class="compare-table--section">
    <div class="compare-table--part part-project">
        <a href="<?= \yii\helpers\Url::to(['/shop/' . $model->category->slug . '/' . $model->slug]) ?>"
           class="projects-item--preview">
            <div class="bg" role="img"
                 aria-label="<?= $image && $image->image ? $image->alt:'' ?>"  <?= $image ? 'style="background-image: url(' . $image->getThumb() . ')"' : '' ?>></div>
            <div class="hash">
                <?php if ($model->is_new): ?>
                    <span class="new">новинка</span>
                <?php endif; ?>
                <?php if ($model->discount > 0): ?>
                    <span class="sale">скидка</span>
                <?php endif; ?>
                <?php if (!$model->price): ?>
                    <span class="free">бесплатно</span>
                <?php endif; ?>
            </div>
            <span class="look data">
                    <span class="look-num"><?= $model->name ?></span>
                    <span class="look-text">смотреть</span>
                </span>
        </a>
    </div>
    <div class="compare-table--part">
        <div class="projects-item--part-title">Площадь</div>
        <div class="projects-item--info">
            <div>Жилая: <?= $model->live_area ?></div>
            <div>Полезная: <?= $model->useful_area ?></div>
            <div>Общая: <?= $model->common_area ?> м</div>
            <?php if ($size): ?>
                <div><?= $size->name ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="compare-table--part">
        <div class="projects-item--part-title">Удобства</div>
        <div class="projects-item--info">
            <?php foreach ($model->getComfort() as $item): ?>
                <div><?= $item ?></div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="compare-table--part part-rooms">
        <div class="projects-item--part-title">Этажи/комнаты</div>
        <div class="projects-item--info">
            <?php $floors = [];
            if ($model->one_floor) $floors[] = 'одноэтажный';
            if ($model->two_floor) $floors[] = 'двухэтажный';
            ?>
            <div>
                <?php if ($floors): ?>
                    <?= implode(', ', $floors) ?>
                <?php endif; ?>
                <?= $model->rooms ?> комнаты
            </div>
        </div>
    </div>
    <div class="compare-table--part">
        <div class="projects-item--part-title">Тип строения</div>
        <div class="projects-item--info">
            <div><?= $model->category->name ?></div>
        </div>
    </div>
    <div class="compare-table--part part-cost">
        <div class="projects-item--actions">
            <div class="price-box">
                <div class="projects-item--part-title">Стоимость</div>
                <div class="price"><?= intval($model->price) - intval($model->discount) ?> &#8381;</div>
            </div>
            <div class="btns">
                <a class="basket btn-small  <?= $isInCart ? 'incart' : '' ?> js-to-cart"
                   data-id="<?= $model->id ?>"><?= $isInCart ? 'в корзине' : 'в корзину' ?></a>
                <button class="compare-table--remove js-delete-favorite-item" data-id="<?= $model->id ?>">
                    <i class="icon-remove">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-remove"/>
                        </svg>
                    </i>
                </button>
            </div>
        </div>
    </div>
</div>
