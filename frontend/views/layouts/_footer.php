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
                    <a href="#" class="btn btn--round show-modal" data-modal="consultation">Консультация</a>
                </div>
            </div>

            <div class="sharing ">
                <div class="title">Поделиться</div>
                <?= \frontend\widgets\share\Share::widget() ?>
            </div>

        </div>
        <div class="footer-main">
            <div class="footer-main--nav">
                <?= \frontend\widgets\categories\Categories::widget(['viewName' => 'footer']) ?>
                <?= \frontend\widgets\posts\Posts::widget(['viewName' => 'footer']) ?>
                <?= \modules\shop\widgets\services\Services::widget(['viewName' => 'bottom']) ?>
                <section class="section">
                    <h4 class="title">Arplans</h4>
                    <ul>
                        <li><a href="/contacts">Все контакты</a></li>
                        <li><a href="/about">О компании</a></li>
                        <li><?= \yii\helpers\Html::a('Клуб партнеров', \yii\helpers\Url::to('/builder')) ?></li>
                        <li><?= \yii\helpers\Html::a('Коттеджные поселки', \yii\helpers\Url::to('/village')) ?></li>
                        <li><?= \yii\helpers\Html::a('Сотрудничество', \yii\helpers\Url::to('/collaboration')) ?></li>
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
<?=\frontend\widgets\request\Request::widget()?>
<div class="modal" data-modal="addToBasket">
    <div class="bg close"></div>
    <div class="modal-box">
        <span class="close">&times;</span>
        <h3 class="modal-title">Проект добавлен в корзину!</h3>
        <div class="modal-content">
            <div class="links">
                <a href="#" class="link">Продолжить покупки</a>
                <a href="#" class="btn-square-min">Оформить заказ</a>
            </div>
        </div>
    </div>
</div>
