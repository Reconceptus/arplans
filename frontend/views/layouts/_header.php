<?php
?>
<header id="header" class="header">
    <div class="header-top">
        <div class="content content--lg">
            <div class="header-top--wrap">
                <div class="header-top--telephone">
                    <a href="tel:<?=\modules\content\models\ContentBlock::getValue('hot_line')?>"><?=\modules\content\models\ContentBlock::getValue('hot_line')?></a>
                </div>
                <div class="header-top--nav">
                    <nav>
                        <ul>
                            <li><a href="#" class="show-modal " data-modal="consultation">Консультация</a></li>
                            <li><a href="/about" class="">О нас</a></li>
                            <?= \modules\shop\widgets\services\Services::widget(['viewName' => 'top']) ?>
                            <li><a href="/collaboration" class="">Сотрудничество</a></li>
                            <li><a href="/village" class="">Коттеджные поселки России</a></li>
                            <li><a href="/builder" class="">Строители и материалы</a></li>
                            <li><a href="/contacts" class="">Контакты</a></li>
                        </ul>
                    </nav>
                    <div class="header-top--search">
                        <div id="searchForm">
                            <form action="/search">
                                <div class="fieldset">
                                    <input class="input" type="text" id="site-search" name="q">
                                </div>
                                <label class="label" for="site-search">
                                    <svg xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-search"/>
                                    </svg>
                                </label>
                                <button class="submit" type="submit"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-main">
        <div class="content content--lg">
            <div class="header-main--wrap">
                <div class="header-main--logo">
                    <a href="/">
                        <img src="/svg/partials/logo.svg" alt="ARPLANS">
                    </a>
                </div>
                <div class="header-main--nav">
                    <?= \frontend\widgets\categories\Categories::widget(['viewName' => 'top', 'showServices' => 1]) ?>
                </div>
                <div class="header-main--stats">
                    <?= \modules\shop\widgets\cart\Cart::widget() ?>
                    <div class="burger desktop-hidden">
                        <span></span>
                        <span></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="header-mobile desktop-hidden">
        <div class="bg"></div>
        <nav class="header-mobile--nav">
            <?= \frontend\widgets\categories\Categories::widget(['viewName' => 'top-mobile', 'showServices' => 1]) ?>
        </nav>
    </div>
</header>