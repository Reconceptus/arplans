<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 25.10.2018
 * Time: 15:47
 */
/* @var $model \modules\shop\models\Order */
$services = \yii\helpers\ArrayHelper::map($model->services, 'id', 'name');
?>
<div class="compare-table">
    <div class="compare-table--total">
        <div class="compare-table--part part-number">
            <dl>
                <dd>Номер заказа:</dd>
                <dt><?= $model->id ?></dt>
            </dl>
        </div>
        <div class="compare-table--part part-total">
            <dl>
                <dd>Дата:</dd>
                <dt><?= date('d m Y', strtotime($model->created_at)) ?></dt>
            </dl>
        </div>
        <div class="compare-table--part part-total">
            <dl>
                <dd>Цена:</dd>
                <dt><?= $model->price ?> руб.</dt>
            </dl>
        </div>
        <div class="compare-table--part part-total">
            <dl>
                <dd>Статус:</dd>
                <dt><?= \modules\shop\models\Order::STATUSES[$model->status] ?></dt>
            </dl>
        </div>
        <div class="compare-table--part part-total"><?= Yii::$app->user->can('adminPanel') ? \yii\helpers\Html::a('Оплатить', \yii\helpers\Url::to(['/shop/payment/index', 'order' => $model->id])) : '' ?></div>
    </div>
    <div class="compare-table--main">
        <? foreach ($model->orderItems as $oi): ?>
            <?
            $item = $oi->item;
            $url = '/shop/' . $item->category->slug . '/' . $item->slug;
            ?>
            <div class="compare-table--item">
                <div class="compare-table--section">
                    <div class="compare-table--part part-project">
                        <a href="<?= $url ?>" class="projects-item--preview">
                            <div class="bg"
                                 style="background-image: url(<?= $item->getMainImage() ?>)"></div>
                            <span class="look">
                                                                    <span class="look-alone data">смотреть</span>
                                                                </span>
                        </a>
                    </div>
                    <div class="compare-table--part part-articul">
                        <div class="projects-item--part-title">Артикул</div>
                        <div class="projects-item--info">
                            <a href="<?= $url ?>" class="projects-item--articul"><?= $item->name ?></a>
                        </div>
                    </div>
                    <div class="compare-table--part">
                        <div class="projects-item--part-title">Площадь</div>
                        <div class="projects-item--info">
                            <div>Жилая: <?= $item->live_area ?></div>
                            <div>Полезная: <?= $item->useful_area ?></div>
                            <div>Общая: <?= $item->common_area ?> м</div>
                            <div><?= $item->getCatalogValue('size') ?> метров</div>
                        </div>
                    </div>
                    <div class="compare-table--part">
                        <div class="projects-item--part-title">Материал</div>
                        <div class="projects-item--info">
                            <div><?= $item->getCatalogValue('walls') ?></div>
                            <div class="no-form-element">
                                <div class="check">
                                    <label>
                                        <input type="checkbox" <?= $oi->change_material ? 'checked' : '' ?>>
                                        <span>*Изменить материал</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="compare-table--part part-total-count">
                        <div class="projects-item--part-title">**Количество альбомов</div>
                        <div class="projects-item--info">
                            <div class="album-head">**Количество альбомов</div>
                            <div class="no-form-element">
                                <div class="counter">
                                    <input class="result" readonly value="<?= $oi->count ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="compare-table--part part-total-cost">
                        <div class="projects-item--actions">
                            <div class="price-box">
                                <div class="projects-item--part-title">Стоимость</div>
                                <div class="price"><?= $oi->price ?> &#8381;</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <? endforeach; ?>
    </div>
    <? if ($services): ?>
        <div class="compare-table--addition">
            Указаны дополнительные услуги: <?= implode(', ', $services) ?>
        </div>
    <? endif; ?>
</div>