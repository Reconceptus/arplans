<?php

use modules\content\models\ContentBlock;
use modules\partner\models\Main;
use modules\shop\widgets\compilation\Compilation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
$this->title = ContentBlock::getValue('main_page_seo_title');
$this->registerMetaTag(['name' => 'keywords', 'content' => ContentBlock::getValue('main_page_seo_keywords')]);
$this->registerMetaTag(['name' => 'description', 'content' => ContentBlock::getValue('main_page_seo_description')]);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]);
$author = Main::getAuthorMain();
?>
    <script>
        var v1 = "<?=ContentBlock::getValue('main_page_video_1')?>";
        var v2 = "<?=ContentBlock::getValue('main_page_video_2')?>";
    </script>
    <div class="section video-box">
        <div class="video-box--bg">
            <?php if (ContentBlock::getValue('main_page_video_1')): ?>
                <video autoplay muted loop id="video-main">

                </video>
            <?php else: ?>
                <figure>
                    <img class="video-box--img img-desktop" src="<?= ContentBlock::getValue('main_page_photo_1') ?>"
                         alt="">
                    <img class="video-box--img img-mobile" src="<?= ContentBlock::getValue('main_page_photo_2') ?>"
                         alt="">
                </figure>
            <?php endif; ?>
        </div>
        <div class="content content--lg">
            <div class="video-box--wrap">
                <div class="video-box--about">
                    <section>
                        <h1 class="title title-md"> <?= ContentBlock::getValue('main_page_offer') ?></h1>
                        <p><?= ContentBlock::getValue('main_page_offer_annotation') ?></p>
                    </section>
                    <div class="actions">
                        <?= Html::a('сотрудничество', Url::to('/collaboration'), ['class' => 'btn btn--lt']) ?>
                        <?= Html::a('консультация', Url::to('#'), ['class' => 'btn btn--dk show-modal', 'data-modal' => 'consultation']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="section site-info">
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
    </div> -->
    <br>
    <div class="row_1psdiv">
        <h2>Готовые проекты домов и коттеджей по цене от 15 000 рублей</h2>
        <br>
        <p>В бюро Арпланс предлагаем вам не просто красивые картинки «квадратных метров» мечты – занимаемся продажей реальных проектов домов и коттеджей по всей России. За 10 лет работы наши архитекторы научились предугадывать желания клиентов, поэтому планы в процессе сотрудничества можем адаптировать под конкретный запрос и предпочтения.</p>
        <br>
        <h2>Сохраните свои ресурсы – купите готовый проект дома</h2>
        <br>
        <div class="row_1ps">
            <div class="col-md-1">
                <i class="icon icon-delivery">
                    <svg xmlns="http://www.w3.org/2000/svg">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-site-delivery"/>
                    </svg>
                </i>
            </div>
            <div class="col-md-11">
                <p class="bold_1ps">Экономим ваше время </p>
                <p>Не ждите месяцами разработку плана, в базе бюро Арпланс больше 1 000 готовых проектов домов: деревянных, каркасных, каменных и комбинированных зданий. Получите чертежи в течение 3-5 рабочих дней после оформления.</p>
                <p>При необходимости посоветуем застройщика в вашем регионе – у нас много партнеров по всей стране. </p>
            </div>
        </div>
        <div class="row_1ps">
            <div class="col-md-1">
                <i class="icon icon-changes">
                    <svg xmlns="http://www.w3.org/2000/svg">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-site-changes"/>
                    </svg>
                </i>
            </div>
            <div class="col-md-11">
                <p class="bold_1ps">Вносим изменения в проект</p>
                <p>Проконсультируйтесь с опытными архитекторами, если хотите что-то поправить. Специалисты на связи с заказчиком 24/7.</p>
                <p>Бесплатно адаптируем готовые проекты домов под материалы, отвечаем на вопросы, поясняем и даем рекомендации при строительстве – делаем все, чтобы «картинка» стала реальностью. Желаете построить «замок» по своему эскизу – наши конструкторы помогут и с этим. Срок – от 21 до 45 рабочих дней. Учтем все ваши предпочтения.</p>
            </div>
        </div>
        <div class="row_1ps">
            <div class="col-md-1">
                <i class="icon icon-documents">
                    <svg xmlns="http://www.w3.org/2000/svg">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-site-documents"/>
                    </svg>
                </i>
            </div>
            <div class="col-md-11">
                <p class="bold_1ps">Отправляем полный пакет документов</p>
                <p>Смело контролируйте процесс строительства с готовым проектом дома – от фундамента до крыши.</p>
                <p>Кроме красивых изображений, получите всю документацию: карты, схемы с архитектурными, функционально-технологическими решениями, измерения, заказ на материал.</p>
            </div>
        </div>
        <div class="row_1ps">
            <div class="col-md-1">
                <i class="icon icon-money">
                    <svg xmlns="http://www.w3.org/2000/svg">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-site-money"/>
                    </svg>
                </i>
            </div>
            <div class="col-md-11">
                <p class="bold_1ps">Ценим ваши вложения</p>
                <p>Не тратьте четверть бюджета на создание документации с нуля, купите готовый проект дома или коттеджа – выйдет на 50% дешевле.</p>
                <p>Следите за нашими ежемесячными и предпраздничными акциями – и заказывайте проект еще выгоднее.</p>
            </div>
        </div>
    </div>

<?= Compilation::widget(['limit' => 8]) ?>

    <div class="section home-about">
        <?= \frontend\widgets\fromblogtop\FromBlogTop::widget() ?>
        <div class="home-about-main">
            <img src="/img/branch.png" alt="branch" class="img-branch">
            <div class="content content--lg">
                <div class="home-about-main--wrap">
                    <div class="home-about-main--chief">
                        <div class="home-about-main--photo">
                            <img src="<?= $author['photo'] ?>" alt="director">
                        </div>
                        <div class="home-about-main--post">
                            <?= $author['name'] ?>
                        </div>
                    </div>
                    <div class="home-about-main--speech">
                        <div class="text">
                            <?= ContentBlock::getValue('main_page_text') ?>
                        </div>
                        <div class="blog-hashes">
                            <a href="/about" class="btn-small">о компании</a>
                            <a href="/collaboration" class="btn-small">сотрудничество</a>
                            <a href="<?= ContentBlock::getValue('vk_reviews') ?>"
                               class="btn-small"
                               target="_blank">живые отзывы вконтакте</a>
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
                <div class="info-box--text">
                    <?= ContentBlock::getValue('main_page_description') ?>
                    <p class="strong_1ps"><strong>Готовые проекты домов – экономьте свое время</strong></p>
                </div>
            </div>
        </div>
    </div>

<?php
$js = <<<JS
  $(function () {
      $('#video-main').append('<source src="'+v1+'" type="video/mp4">');
      $('#video-main').append('<source src="'+v2+'" type="video/webm">');
  })
JS;

$this->registerJs($js); ?>