<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 31.08.2018
 * Time: 10:41
 */

use modules\shop\models\Item;

/* @var $model Item */
/* @var $sizeCatalog \modules\shop\models\Catalog */
$size = $model->getItemOptionCatalogItem($sizeCatalog->id);
?>

<div class="compare-table--item">
    <div class="compare-table--section">
        <div class="compare-table--part part-project">
            <a href="<?= \yii\helpers\Url::to(['/shop/' . $model->category->slug . '/' . $model->slug]) ?>"
               class="projects-item--preview">
                <div class="bg" style="background-image: url('<?= $model->getMainImage() ?>')"></div>
                <? if ($model->is_new): ?>
                    <div class="hash">
                        <span class="new">новинка</span>
                    </div>
                <? endif; ?>
                <? if ($model->discount): ?>
                    <div class="hash">
                        <span class="sale">скидка</span>
                    </div>
                <? endif; ?>
                <? if (!$model->price): ?>
                    <div class="hash">
                        <span class="free">бесплатно</span>
                    </div>
                <? endif; ?>
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
                <? if ($size): ?>
                    <div><?= $size->name ?></div>
                <? endif; ?>
            </div>
        </div>
        <div class="compare-table--part">
            <div class="projects-item--part-title">Удобства</div>
            <div class="projects-item--info">
                <? foreach ($model->getComfort() as $item): ?>
                    <div><?= $item ?></div>
                <? endforeach; ?>
            </div>
        </div>
        <div class="compare-table--part part-rooms">
            <div class="projects-item--part-title">Этажи/комнаты</div>
            <div class="projects-item--info">
                <?
                $floors = [];
                if ($model->one_floor) $floors[] = '1';
                if ($model->two_floor) $floors[] = '2';
                if ($model->mansard) $floors[] = 'мансарда';
                ?>
                <div>
                    <? if ($floors): ?>
                        <?= implode(', ', $floors) ?>/
                    <? endif; ?>
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
                    <a href="#" class="basket btn-small">в корзину</a>
                    <button class="compare-table--remove">
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
</div>