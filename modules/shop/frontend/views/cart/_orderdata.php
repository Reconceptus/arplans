<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 03.09.2018
 * Time: 12:59
 */

use modules\shop\models\Cart;

/* @var $models Cart[] */
/* @var $user \common\models\User */
/* @var $albumPrice float */
$totalSum = 0;
?>
    <div class="basket-form--section">
        <section class="basket-form--ordering">
            <h2 class="title title-sm">3. Оформление заказа</h2>
            <div class="ordering-data custom-form">
                <div class="form-title">Заполните данные:</div>
                <div class="form-row">
                    <div class="form-row-col col-50">
                        <div class="form-row-element">
                            <div class="input">
                                <?php if ($user): ?>
                                    <input type="text" placeholder="*Ф.И.О." name="name"
                                           value="<?= $user->profile->fio ? $user->profile->fio : mb_substr($user->profile->last_name.' '.$user->profile->first_name.' '.$user->profile->patronymic,
                                               0, 254) ?>"
                                           id="order-fio">
                                <?php else: ?>
                                    <input type="text" placeholder="*Ф.И.О." name="name" value="" id="order-fio">
                                <?php endif; ?>
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
                                    <span>Согласен на <a href="/page/privacy">обработку персональных данных</a></span>
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
                                    echo '<li class="you-buy" data-id="'.$model->id.'">Проект '.$item->name.' на сумму <span class="sum" data-id="'.$model->id.'">'.$price.'</span></li>';
                                } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="form-row-col col-50">
                        <div class="ordering-submit--title">К оплате:</div>
                        <div class="ordering-submit--subtitle">товаров на сумму <span id="totalsum"><?= $totalSum ?></span></div>
                        <div class="form-row-element">
                            <div class="input">
                                <input type="text" placeholder="Промокод (если есть)" id="order-promocode">
                            </div>
                            <span id="js-promocode-info"></span>
                        </div>
                        <div class="form-row-submit">
                            <div class="submit">
                                <button class="btn btn--og js-order" <?= Yii::$app->user->isGuest ? 'data-guest="1"' : '' ?>>
                                    Перейти к оплате <i class="arrow"></i></button>
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
<?php
$js = <<<JS
$(document).on('input', '#order-promocode', function () {
  var elem = $(this);
  var code = elem.val();
  var infotext = $('#js-promocode-info');   
  if (code.length >= 5){
   $.ajax({
        type: 'GET',
        url: '/shop/cart/promocode',
        data: {
            code: code,
        },
        success: function (data) {
            if (data.status === 'success') {
                var type = parseInt(data.type);
                var discount = parseFloat(data.discount);
                var minimal = parseInt(data.minimal);
                var fullPrice = parseInt($('#totalsum').text());
                var remnants = parseInt(data.remnants);
                var text = '';
                if(fullPrice > minimal){
                    var price = 0;
                    if(type===1){
                        price = fullPrice-discount;
                        text = 'Промокод дает скидку '+discount+' руб. Можно применить еще '+remnants+' раз. При использовании этого промокода цена заказа будет составлять '+price+' руб.'
                    }else if(type ===2){
                        price = fullPrice - (fullPrice/100*discount);
                        text = 'Промокод дает скидку '+data.discount+'%. Можно применить еще '+remnants+' раз. При использовании этого промокода цена заказа будет составлять '+price+' руб.'
                    }
                    infotext.text(text);
                }else{
                    infotext.text('Этот промокод может быть применен только при сумме заказа больше '+minimal+' руб.');
                }
            } else {
                infotext.text('Промокод введен неправильно или срок его действия закончился');
            }
        }
    });
   }else{
      infotext.text('');
   }
});
JS;
$this->registerJs($js);