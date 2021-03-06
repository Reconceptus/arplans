<?php

/* @var $services \modules\shop\models\Service[] */
$services = \common\helpers\FormatHelper::divideArray($services)
?>
<div class="basket-form--section">
    <section class="basket-form--additional filter-form">
        <h2 class="title title-sm">2. Запрос на дополнительные услуги</h2>
        <div class="add-service--list">
            <div class="add-service--part">
                <?php foreach ($services[0] as $service): ?>
                    <div class="add-service show-more-parent">
                        <div class="add-service--header">
                            <div class="check">
                                <label>
                                    <input type="checkbox" class="cart-service" data-id="<?= $service->id ?>">
                                    <span><span class="service-name"><?=$service->name?></span> <span class="service-price" style="display: none">0</span></span>
                                </label>
                            </div>
                            <span class="show-more"></span>
                        </div>
                        <div class="add-service--main show-more-hidden" style="display: none">
                            <div class="add-service--main-text">
                                <p><?= $service->preview_text ?></p>
                                <p class="link"><a href="/shop/service/<?= $service->slug ?>">Подробнее</a></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="add-service--part">
                <?php foreach ($services[1] as $service): ?>
                    <div class="add-service show-more-parent">
                        <div class="add-service--header">
                            <div class="check">
                                <label>
                                    <input type="checkbox" class="cart-service" data-id="<?= $service->id ?>">
                                    <span><?=$service->name?>, <?=$service->price?> &nbsp;<span class="pt-sans">&#8381;</span></span>
                                </label>
                            </div>
                            <span class="show-more"></span>
                        </div>
                        <div class="add-service--main show-more-hidden" style="display: none">
                            <div class="add-service--main-text">
                                <p><?= $service->preview_text ?></p>
                                <p class="link"><a href="/shop/service/<?= $service->slug ?>">Подробнее</a></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>
