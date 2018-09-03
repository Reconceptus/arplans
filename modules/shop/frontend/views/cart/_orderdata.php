<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 03.09.2018
 * Time: 12:59
 */
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
                            <input type="text" placeholder="*Ф.И.О." name="name">
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="input">
                            <input type="text" placeholder="*Ваш телефон" name="phone">
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="input">
                            <input type="text" placeholder="Ваш e-mail">
                        </div>
                    </div>
                </div>
                <div class="form-row-col col-50">
                    <div class="form-row-element">
                        <div class="input">
                            <input type="text" placeholder="Страна">
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="input">
                            <input type="text" placeholder="Город">
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="input">
                            <input type="text" placeholder="Адрес">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-row-col col-50">
                    <div class="form-row-element">
                        <div class="textarea">
                                                            <textarea cols="30" rows="3"
                                                                      placeholder="Опишите ваш поселок"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-row-col col-50">
                    <div class="form-row-element">
                        <div class="check">
                            <label>
                                <input type="checkbox" name="processing_agree">
                                <span>Согласен на обработку персональных данных</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ordering-pays filter-form">
            <div class="form-title">Выберите способ оплаты:</div>
            <div class="form-row">
                <div class="form-row-col col-33">
                    <div class="form-row-element">
                        <div class="check">
                            <label>
                                <input type="radio" name="pay-method">
                                <span class="centered">
                                                                    Банковская карта
                                                                    <i class="ico"><img
                                                                            src="http://webiconspng.com/wp-content/uploads/2017/09/Visa-PNG-Image-49098.png"
                                                                            alt="visa"></i>
                                                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="check">
                            <label>
                                <input type="radio" name="pay-method">
                                <span class="centered">
                                                                    Сбербанк онлайн
                                                                    <i class="ico"><img
                                                                            src="https://apptractor.ru/wp-content/uploads/2016/05/sber.png"
                                                                            alt="visa"></i>
                                                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="check">
                            <label>
                                <input type="radio" name="pay-method">
                                <span class="centered">
                                                                    Кошелёк Яндекс.Деньги
                                                                    <i class="ico"><img
                                                                            src="http://www.sostav.ru/app/public/images/news/2015/03/31/0_137264_b72f3c17_orig.png"
                                                                            alt="visa"></i>
                                                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="check">
                            <label>
                                <input type="radio" name="pay-method">
                                <span class="centered">
                                                                    Кошелёк WebMoney
                                                                    <i class="ico"><img
                                                                            src="http://pngimg.com/uploads/webmoney/webmoney_PNG17.png"
                                                                            alt="visa"></i>
                                                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row-col col-33">
                    <div class="form-row-element">
                        <div class="check">
                            <label>
                                <input type="radio" name="pay-method">
                                <span class="centered">
                                                                    Альфа-клик
                                                                    <i class="ico"><img
                                                                            src="http://sparkysite.ru/small/bank/alfabank/alfabank01/salfabank03.png"
                                                                            alt="visa"></i>
                                                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="check">
                            <label>
                                <input type="radio" name="pay-method">
                                <span class="centered">
                                                                    MasterPass
                                                                    <i class="ico"><img
                                                                            src="https://png.icons8.com/color/1600/mastercard-logo.png"
                                                                            alt="visa"></i>
                                                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="check">
                            <label>
                                <input type="radio" name="pay-method">
                                <span class="centered">
                                                                    Интернет-банк Промсвязьбанка
                                                                    <i class="ico"><img
                                                                            src="https://www.psbank.ru/~/media/Images/PSB_logo_for_sharing.ashx"
                                                                            alt="visa"></i>
                                                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="check">
                            <label>
                                <input type="radio" name="pay-method">
                                <span class="centered">
                                                                    Безналичный расчёт (для юридических лиц)
                                                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row-col col-33">
                    <div class="form-row-element">
                        <div class="check">
                            <label>
                                <input type="radio" name="pay-method">
                                <span class="centered">
                                                                    Наличными через кассы и терминалы
                                                                    <i class="ico"><img
                                                                            src="https://ru.seaicons.com/wp-content/uploads/2016/04/coins-icon.png"
                                                                            alt="visa"></i>
                                                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-row-element">
                        <div class="check">
                            <label>
                                <input type="radio" name="pay-method">
                                <span class="centered">
                                                                    Со счета мобильного телефона
                                                                    <i class="ico"><img
                                                                            src="https://images.vexels.com/media/users/3/136857/isolated/preview/a9e86748f463c75ad1a6a58e06abf25d-tel-fono-inteligente-icono-plana-by-vexels.png"
                                                                            alt="visa"></i>
                                                                </span>
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
                        <ul>
                            <li>Проект K-123 (альбомов: 3шт) на сумму 20 000</li>
                            <li>Проект П-367 (альбомов: 1 шт) на сумму 15 000 ₽</li>
                            <li>Заявка Заказ услуги «Адаптация фундамента»</li>
                        </ul>
                    </div>
                </div>
                <div class="form-row-col col-50">
                    <div class="ordering-submit--title">К оплате:</div>
                    <div class="ordering-submit--subtitle">товаров на сумму 35 000</div>
                    <div class="form-row-submit">
                        <div class="submit">
                            <button class="btn btn--og">Перейти к оплате <i
                                    class="arrow"></i></button>
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
