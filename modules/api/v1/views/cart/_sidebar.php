<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 03.09.2018
 * Time: 13:01
 */

?>
<div class="custom-row-col col-sidebar">
    <div class="compare-sidebar">
        <div class="order">
            <a href="tel:<?=\modules\content\models\ContentBlock::getValue('hot_line')?>" class="phone">
                <i class="icon icon-phone">
                    <svg xmlns="http://www.w3.org/2000/svg">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-phone"/>
                    </svg>
                </i>
                <?=\modules\content\models\ContentBlock::getValue('hot_line')?>
            </a>
            <a class="btn-round-min show-modal" data-modal="consultation">Консультация</a>
        </div>
        <div class="compare-sidebar--info">
            <div class="info-title">*Замена материала бесплатно</div>
            <p>Укажите в заказе, что требуется изменение материала, мы свяжемся и уточним.</p>
        </div>
        <div class="compare-list">
            <ul>
                <li>
                    <i class="icon icon-delivery">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-site-delivery"/>
                        </svg>
                    </i>
                    <div class="compare-list--text">
                        <h4 class="compare-list--title">Доставка в руки</h4>
                        <p>Доставка проекта курьером в руки через 3-5 дней</p>
                    </div>
                </li>
                <li>
                    <i class="icon icon-documents">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-site-documents"/>
                        </svg>
                    </i>
                    <div class="compare-list--text">
                        <h4 class="compare-list--title">Документация</h4>
                        <p>Полный пакет документации для строительства</p>
                    </div>
                </li>
                <li>
                    <i class="icon icon-money">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-site-money"/>
                        </svg>
                    </i>
                    <div class="compare-list--text">
                        <h4 class="compare-list--title">Удобная оплата</h4>
                        <p>Безопасные виды оплаты и легкий возврат</p>
                    </div>
                </li>
                <li>
                    <i class="icon icon-forrussia">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-site-forrussia"/>
                        </svg>
                    </i>
                    <div class="compare-list--text">
                        <h4 class="compare-list--title">Для России</h4>
                        <p>Учитываем специфику современного российского строительного рынка</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
