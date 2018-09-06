<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 03.09.2018
 * Time: 12:52
 */

/* @var $services \modules\shop\models\Service[] */
?>
<div class="basket-form--section">
    <section class="basket-form--additional filter-form">
        <h2 class="title title-sm">2. Выберите дополнительные услуги</h2>
        <div class="add-service--list">
            <div class="add-service--part">
                <? foreach ($services as $service): ?>
                    <div class="add-service show-more-parent">
                        <div class="add-service--header">
                            <div class="check">
                                <label>
                                    <input type="checkbox" class="cart-service" data-id="<?= $service->id ?>">
                                    <span><?= $service->name ?>, <?= $service->price ?>&nbsp;&#8381;</span>
                                </label>
                            </div>
                            <span class="show-more"></span>
                        </div>
                        <div class="add-service--main show-more-hidden">
                            <div class="add-service--main-text">
                                <p><?= $service->preview_text ?></p>
                                <p class="link"><a href="#">Подробней</a></p>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </section>
</div>
