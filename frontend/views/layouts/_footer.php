<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 13.08.2018
 * Time: 10:41
 */
?>
<footer class="footer" id="footer">
    <div class="content content--md">
        <div class="footer-top">
            <div class="footer-top--order">
                <div class="order">
                    <span class="title">Заказ проекта:</span>
                    <a href="tel:88002001714">8 800 200-17-14</a>
                </div>
                <div class="consultation">
                    <a href="#" class="btn btn--round">Консультация</a>
                </div>
            </div>

            <div class="sharing ">
                <div class="title">Поделиться</div>
                <ul>
                    <li>
                        <a href="#" class="ico ico-fb">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-fb"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="ico ico-gg">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-gg"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="ico ico-vk">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-vk"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="ico ico-ok">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-ok"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="footer-main">
            <div class="footer-main--nav">
                <section class="section columns">
                    <h4 class="title">проекты</h4>
                    <ul>
                        <li><a href="#">Деревянные дома</a></li>
                        <li><a href="#">Каменные дома</a></li>
                        <li><a href="#">Каркасные дома</a></li>
                        <li><a href="#">Комбинированные дома</a></li>
                        <li><a href="#">Бани</a></li>
                        <li><a href="#">Индивидуальное проектирование</a></li>
                        <li><a href="#">Новинки</a></li>
                        <li><a href="#">Скидки</a></li>
                        <li><a href="#">Бесплатные проекты</a></li>
                        <li><a href="#">Как купить проект</a></li>
                    </ul>
                </section>
                <?= \frontend\widgets\posts\Posts::widget(['viewName' => 'footer']) ?>
                <?= \modules\shop\widgets\services\Services::widget(['viewName' => 'bottom']) ?>
                <section class="section">
                    <h4 class="title">Arplans</h4>
                    <ul>
                        <li><a href="#">Все контакты</a></li>
                        <li><a href="#">О компании</a></li>
                        <li><a href="#">Клуб партнеров</a></li>
                        <li><a href="#">Коттеджные поселки</a></li>
                        <li><a href="#">Сотрудничество</a></li>
                        <li><?= \yii\helpers\Html::a('Блог', \yii\helpers\Url::to('/blog')) ?></li>
                    </ul>
                </section>
            </div>
            <div class="footer-main--logo">
                <a href="index.html">
                    <img src="/svg/partials/logo-mini.svg" alt="ARPLANS">
                </a>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-bottom--copyright">© 2008-2018 ARPLANCE готовые проекты домов и индивидуальное
                проектирование
            </div>
            <div class="footer-bottom--auth">Сделано <a href="http://reconcept.ru" target="_blank">Reconcept</a></div>
        </div>
    </div>
</footer>
