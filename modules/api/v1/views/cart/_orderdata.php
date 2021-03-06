<?php

use modules\shop\models\Cart;

/* @var $models Cart[] */
/* @var $user \common\models\User */
/* @var $albumPrice float */
$totalSum = 0;
?>
<div class="basket-form--section">
    <section class="basket-form--ordering">
        <h2 class="title title-sm">2. Оформление заказа</h2>
        <div class="ordering-data custom-form">
            <div class="form-title">Заполните данные:</div>
            <div class="form-row">
                <div class="form-row-col col-50">
                    <div class="form-row-element">
                        <div class="input">
                            <input type="text" placeholder="*Ф.И.О." name="name"
                                   value="<?= $user ? $user->profile->fio : '' ?>" id="order-fio">
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="input">
                            <input type="text" placeholder="*Ваш телефон" name="phone"
                                   value="<?= $user ? $user->profile->phone : '' ?>" id="order-phone">
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="input">
                            <input type="text" placeholder="*Ваш e-mail" name="email"
                                   value="<?= $user ? $user->email : '' ?>" id="order-email">
                        </div>
                    </div>
                </div>
                <div class="form-row-col col-50">
                    <div class="form-row-element">
                        <div class="input">
                            <input type="text" placeholder="Страна"
                                   value="<?= $user ? $user->profile->country : '' ?>" id="order-country">
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="input">
                            <input type="text" placeholder="*Город" value="<?= $user ? $user->profile->city : '' ?>"
                                   id="order-city">
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="input">
                            <input type="text" placeholder="*Адрес" value="<?= $user ? $user->profile->address : '' ?>"
                                   id="order-address">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-row-col col-50">
                    <div class="form-row-element">
                        <div class="textarea">
                            <textarea cols="30" rows="3" placeholder="Дополнительная информация"
                                      id="order-village"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-row-col col-50">
                    <div class="form-row-element">
                        <div class="check">
                            <label>
                                <input type="checkbox" name="processing_agree" id="order-accept">
                                <span>Согласен на обработку персональных данных</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ordering-submit filter-form">
            <div class="form-row">
                <div class="form-row-col col-50">
                    <div class="form-title">К оплате:</div>
                    <div class="ordering-submit--total">
                        <div class="total-head">Вы выбрали:</div>
                        <ul id="items-to-buy">
                            <?php foreach ($models as $model) {
                                $item = $model->item;
                                $price = $model->getLotPrice($albumPrice);
                                $totalSum += $price;
                                echo '<li class="you-buy" data-id="' . $item->id . '">Проект ' . $item->name . ' на сумму <span class="price-num" data-id="' . $item->id . '">' . $price . '</span></li>';
                            } ?>
                        </ul>
                    </div>
                </div>
                <div class="form-row-col col-50">
                    <div class="ordering-submit--title">К оплате:</div>
                    <div class="ordering-submit--subtitle">товаров на сумму <span id="totalsum"><?= $totalSum ?></span></div>
                    <div class="form-row-submit">
                        <div class="submit">
                            <button class="btn btn--og js-order">Перейти к оплате <i class="arrow"></i></button>
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="form-text">
                            <p>После нажатия кнопки вы перейдете на сервис оплаты</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
