<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

?>
<div class="section video-box">
    <div class="video-box--bg">
        <video autoplay muted loop>
            <source src="/media/bg.mp4" type='video/mp4'>
        </video>
    </div>
    <div class="content content--lg">
        <div class="video-box--wrap">
            <div class="video-box--about">
                <section>
                    <h1 class="title title-md"> <?=\modules\content\models\ContentBlock::getValue('main_page_offer')?></h1>
                    <p><?=\modules\content\models\ContentBlock::getValue('main_page_offer_annotation')?></p>
                </section>
                <div class="actions">
                    <?= Html::a('каталог проектов', Url::to('/shop'), ['class' => 'btn btn--lt']) ?>
                    <?= Html::a('консультация', Url::to('#'), ['class' => 'btn btn--dk show-modal', 'data-modal' => 'consultation']) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section site-info">
    <div class="content content--lg">
        <div class="site-info--wrap">
            <ul>
                <li>
                    <i class="icon icon-delivery">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-site-delivery"/>
                        </svg>
                    </i>
                    <div class="site-info--text">
                        <h4 class="title">Доставка в руки</h4>
                        <p>Доставка проекта курьером в руки через 3-5 дней</p>
                    </div>
                </li>
                <li>
                    <i class="icon icon-changes">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-site-changes"/>
                        </svg>
                    </i>
                    <div class="site-info--text">
                        <h4 class="title">Изменения в проекте</h4>
                        <p>Бесплатная адаптация проектов под материалы, консультируем при строительстве</p>
                    </div>
                </li>
                <li>
                    <i class="icon icon-documents">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-site-documents"/>
                        </svg>
                    </i>
                    <div class="site-info--text">
                        <h4 class="title">Документация</h4>
                        <p>Полный пакет документации для строительства</p>
                    </div>
                </li>
                <li>
                    <i class="icon icon-money">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-site-money"/>
                        </svg>
                    </i>
                    <div class="site-info--text">
                        <h4 class="title">Удобная оплата</h4>
                        <p>Безопасные виды оплаты и легкий возврат</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<?= \modules\shop\widgets\compilation\Compilation::widget(['limit' => 8, 'showMobile' => true]) ?>

<div class="section home-about">
    <?=\frontend\widgets\fromblogtop\FromBlogTop::widget()?>
    <div class="home-about-main">
        <img src="/img/branch.png" alt="branch" class="img-branch">
        <div class="content content--lg">
            <div class="home-about-main--wrap">
                <div class="home-about-main--chief">
                    <div class="home-about-main--photo">
                        <img src="/img/ava01.jpg" alt="director">
                    </div>
                    <div class="home-about-main--post">
                       <?=\modules\content\models\ContentBlock::getValue('main_page_author')?>
                    </div>
                </div>
                <div class="home-about-main--speech">
                    <div class="text">
                        <?=\modules\content\models\ContentBlock::getValue('main_page_text')?>
                    </div>
                    <div class="blog-hashes">
                        <a href="/about" class="btn-small">о компании</a>
                        <a href="/collaboration" class="btn-small">сотрудничество</a>
                        <a href="<?=\modules\content\models\ContentBlock::getValue('vk_reviews')?>" class="btn-small" target="_blank">живые отзывы вконтакте</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= \frontend\widgets\fromblog\FromBlog::widget() ?>

<div class="section info-box home-info-box">
    <div class="content content--md">
        <div class="ready-projects--info">
            <h3 class="title">Готовые проекты</h3>
            <div class="info-box--text">
                <p>В этом блоке 3 стиля: основной, <a href="#">ссылка</a>, <strong>болд</strong>. Не обязательное поле
                    для текстового описания. ARPLANS.RU — сервис готовых архитектурных проектов загородных домов,
                    коттеджей, бань. По нашим проектам многократно производилось строительство, а качество чертежей
                    проектной документации проверено временем и репутацией разработчиков. Все проекты созданы опытными и
                    высококвалифицированны архитекторами и инженерами ARPLANS.</p>
                <p>Здесь рыба. Сервис готовых архитектурных проектов загородных домов, коттеджей, бань. По нашим
                    проектам многократно производилось строительство, а качество чертежей проектной документации
                    проверено временем и репутацией разработчиков. Все проекты созданы опытными и высококвалифицированны
                    архитекторами и инженерами ARPLANS.</p>
            </div>
        </div>
    </div>
</div>
