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
                    <h1 class="title title-md">Купить готовый проект дома</h1>
                    <p>коттеджа, бани от архитектурного бюро с доставкой курьером через 3-5 дней</p>
                </section>
                <div class="actions">
                    <?= Html::a('каталог проектов', Url::to('/shop'), ['class' => 'btn btn--lt']) ?>
                    <?= Html::a('консультация', Url::to('/shop'), ['class' => 'btn btn--dk show-modal', 'data-modal' => 'consultation']) ?>
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

<div class="section projects mobile-show">
    <div class="content content--lg">
        <div class="projects-filters">
            <div class="projects-filters--item current">новые проекты</div>
        </div>
        <div class="projects-list col-4">
            <div class="projects-item">
                <div class="projects-item--wrap">
                    <a href="#" class="projects-item--preview">
                        <div class="bg" style="background-image: url('assets/images/items/item01.jpg')"></div>
                        <div class="hash">
                            <span class="new">новинка</span>
                        </div>
                        <div class="data">
                            <span class="index">K-232</span>
                            <ul class="info">
                                <li>
                                    <span class="head">Жилая</span>
                                    <span>82 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Полезная</span>
                                    <span>140 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Общая</span>
                                    <span>260 м<sup>2</sup></span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <div class="projects-item--actions">
                        <div class="prices">
                            <div class="price old">32 000 &#8381;</div>
                            <div class="price">32 000 &#8381;</div>
                        </div>
                        <a href="#" class="icon-like liked">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart-like"/>
                            </svg>
                        </a>
                        <a href="#" class="basket btn-small">в корзину</a>
                    </div>
                </div>
            </div>
            <div class="projects-item">
                <div class="projects-item--wrap">
                    <a href="#" class="projects-item--preview">
                        <div class="bg" style="background-image: url('assets/images/items/item02.jpg')"></div>
                        <div class="hash">
                            <span class="new">новинка</span>
                        </div>
                        <div class="data">
                            <span class="index">K-232</span>
                            <ul class="info">
                                <li>
                                    <span class="head">Жилая</span>
                                    <span>82 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Полезная</span>
                                    <span>140 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Общая</span>
                                    <span>260 м<sup>2</sup></span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <div class="projects-item--actions">
                        <div class="prices">
                            <div class="price">32 000 &#8381;</div>
                        </div>
                        <a href="#" class="icon-like">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart-like"/>
                            </svg>
                        </a>
                        <a href="#" class="basket btn-small">в корзину</a>
                    </div>
                </div>
            </div>
            <div class="projects-item">
                <div class="projects-item--wrap">
                    <a href="#" class="projects-item--preview">
                        <div class="bg" style="background-image: url('assets/images/items/item03.jpg')"></div>
                        <div class="hash">
                            <span class="new">новинка</span>
                        </div>
                        <div class="data">
                            <span class="index">K-232</span>
                            <ul class="info">
                                <li>
                                    <span class="head">Жилая</span>
                                    <span>82 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Полезная</span>
                                    <span>140 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Общая</span>
                                    <span>260 м<sup>2</sup></span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <div class="projects-item--actions">
                        <div class="prices">
                            <div class="price">32 000 &#8381;</div>
                        </div>
                        <a href="#" class="icon-like">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart-like"/>
                            </svg>
                        </a>
                        <a href="#" class="basket btn-small">в корзину</a>
                    </div>
                </div>
            </div>
            <div class="projects-item">
                <div class="projects-item--wrap">
                    <a href="#" class="projects-item--preview">
                        <div class="bg" style="background-image: url('assets/images/items/item04.jpg')"></div>
                        <div class="hash">
                            <span class="new">новинка</span>
                        </div>
                        <div class="data">
                            <span class="index">K-232</span>
                            <ul class="info">
                                <li>
                                    <span class="head">Жилая</span>
                                    <span>82 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Полезная</span>
                                    <span>140 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Общая</span>
                                    <span>260 м<sup>2</sup></span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <div class="projects-item--actions">
                        <div class="prices">
                            <div class="price">0 &#8381;</div>
                        </div>
                        <a href="#" class="icon-like">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart-like"/>
                            </svg>
                        </a>
                        <a href="#" class="basket btn-small">в корзину</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="btn-box">
            <a href="#" class="btn btn--lt">все новые проекты</a>
        </div>

    </div>

    <div class="content content--lg">
        <div class="projects-filters">
            <div class="projects-filters--item current">Скидки</div>
        </div>
        <div class="projects-list col-4">
            <div class="projects-item">
                <div class="projects-item--wrap">
                    <a href="#" class="projects-item--preview">
                        <div class="bg" style="background-image: url('assets/images/items/item01.jpg')"></div>
                        <div class="hash">
                            <span class="sale">скидка</span>
                        </div>
                        <div class="data">
                            <span class="index">K-232</span>
                            <ul class="info">
                                <li>
                                    <span class="head">Жилая</span>
                                    <span>82 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Полезная</span>
                                    <span>140 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Общая</span>
                                    <span>260 м<sup>2</sup></span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <div class="projects-item--actions">
                        <div class="prices">
                            <div class="price old">32 000 &#8381;</div>
                            <div class="price">32 000 &#8381;</div>
                        </div>
                        <a href="#" class="icon-like liked">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart-like"/>
                            </svg>
                        </a>
                        <a href="#" class="basket btn-small">в корзину</a>
                    </div>
                </div>
            </div>
            <div class="projects-item">
                <div class="projects-item--wrap">
                    <a href="#" class="projects-item--preview">
                        <div class="bg" style="background-image: url('assets/images/items/item02.jpg')"></div>
                        <div class="hash">
                            <span class="sale">скидка</span>
                        </div>
                        <div class="data">
                            <span class="index">K-232</span>
                            <ul class="info">
                                <li>
                                    <span class="head">Жилая</span>
                                    <span>82 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Полезная</span>
                                    <span>140 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Общая</span>
                                    <span>260 м<sup>2</sup></span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <div class="projects-item--actions">
                        <div class="prices">
                            <div class="price">32 000 &#8381;</div>
                        </div>
                        <a href="#" class="icon-like">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart-like"/>
                            </svg>
                        </a>
                        <a href="#" class="basket btn-small">в корзину</a>
                    </div>
                </div>
            </div>
            <div class="projects-item">
                <div class="projects-item--wrap">
                    <a href="#" class="projects-item--preview">
                        <div class="bg" style="background-image: url('assets/images/items/item03.jpg')"></div>
                        <div class="hash">
                            <span class="sale">скидка</span>
                        </div>
                        <div class="data">
                            <span class="index">K-232</span>
                            <ul class="info">
                                <li>
                                    <span class="head">Жилая</span>
                                    <span>82 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Полезная</span>
                                    <span>140 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Общая</span>
                                    <span>260 м<sup>2</sup></span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <div class="projects-item--actions">
                        <div class="prices">
                            <div class="price">32 000 &#8381;</div>
                        </div>
                        <a href="#" class="icon-like">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart-like"/>
                            </svg>
                        </a>
                        <a href="#" class="basket btn-small">в корзину</a>
                    </div>
                </div>
            </div>
            <div class="projects-item">
                <div class="projects-item--wrap">
                    <a href="#" class="projects-item--preview">
                        <div class="bg" style="background-image: url('assets/images/items/item04.jpg')"></div>
                        <div class="hash">
                            <span class="sale">скидка</span>
                        </div>
                        <div class="data">
                            <span class="index">K-232</span>
                            <ul class="info">
                                <li>
                                    <span class="head">Жилая</span>
                                    <span>82 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Полезная</span>
                                    <span>140 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Общая</span>
                                    <span>260 м<sup>2</sup></span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <div class="projects-item--actions">
                        <div class="prices">
                            <div class="price">0 &#8381;</div>
                        </div>
                        <a href="#" class="icon-like">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart-like"/>
                            </svg>
                        </a>
                        <a href="#" class="basket btn-small">в корзину</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="btn-box">
            <a href="#" class="btn btn--lt">все проекты со скидкой</a>
        </div>

    </div>

    <div class="content content--lg">
        <div class="projects-filters">
            <div class="projects-filters--item current">Бесплатно</div>
        </div>
        <div class="projects-list col-4">
            <div class="projects-item">
                <div class="projects-item--wrap">
                    <a href="#" class="projects-item--preview">
                        <div class="bg" style="background-image: url('assets/images/items/item01.jpg')"></div>
                        <div class="hash">
                            <span class="free">бесплатно</span>
                        </div>
                        <div class="data">
                            <span class="index">K-232</span>
                            <ul class="info">
                                <li>
                                    <span class="head">Жилая</span>
                                    <span>82 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Полезная</span>
                                    <span>140 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Общая</span>
                                    <span>260 м<sup>2</sup></span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <div class="projects-item--actions">
                        <div class="prices">
                            <div class="price old">32 000 &#8381;</div>
                            <div class="price">32 000 &#8381;</div>
                        </div>
                        <a href="#" class="icon-like liked">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart-like"/>
                            </svg>
                        </a>
                        <a href="#" class="basket btn-small">в корзину</a>
                    </div>
                </div>
            </div>
            <div class="projects-item">
                <div class="projects-item--wrap">
                    <a href="#" class="projects-item--preview">
                        <div class="bg" style="background-image: url('assets/images/items/item02.jpg')"></div>
                        <div class="hash">
                            <span class="free">бесплатно</span>
                        </div>
                        <div class="data">
                            <span class="index">K-232</span>
                            <ul class="info">
                                <li>
                                    <span class="head">Жилая</span>
                                    <span>82 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Полезная</span>
                                    <span>140 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Общая</span>
                                    <span>260 м<sup>2</sup></span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <div class="projects-item--actions">
                        <div class="prices">
                            <div class="price">32 000 &#8381;</div>
                        </div>
                        <a href="#" class="icon-like">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart-like"/>
                            </svg>
                        </a>
                        <a href="#" class="basket btn-small">в корзину</a>
                    </div>
                </div>
            </div>
            <div class="projects-item">
                <div class="projects-item--wrap">
                    <a href="#" class="projects-item--preview">
                        <div class="bg" style="background-image: url('assets/images/items/item03.jpg')"></div>
                        <div class="hash">
                            <span class="free">бесплатно</span>
                        </div>
                        <div class="data">
                            <span class="index">K-232</span>
                            <ul class="info">
                                <li>
                                    <span class="head">Жилая</span>
                                    <span>82 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Полезная</span>
                                    <span>140 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Общая</span>
                                    <span>260 м<sup>2</sup></span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <div class="projects-item--actions">
                        <div class="prices">
                            <div class="price">32 000 &#8381;</div>
                        </div>
                        <a href="#" class="icon-like">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart-like"/>
                            </svg>
                        </a>
                        <a href="#" class="basket btn-small">в корзину</a>
                    </div>
                </div>
            </div>
            <div class="projects-item">
                <div class="projects-item--wrap">
                    <a href="#" class="projects-item--preview">
                        <div class="bg" style="background-image: url('assets/images/items/item04.jpg')"></div>
                        <div class="hash">
                            <span class="free">бесплатно</span>
                        </div>
                        <div class="data">
                            <span class="index">K-232</span>
                            <ul class="info">
                                <li>
                                    <span class="head">Жилая</span>
                                    <span>82 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Полезная</span>
                                    <span>140 м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Общая</span>
                                    <span>260 м<sup>2</sup></span>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <div class="projects-item--actions">
                        <div class="prices">
                            <div class="price">0 &#8381;</div>
                        </div>
                        <a href="#" class="icon-like">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart-like"/>
                            </svg>
                        </a>
                        <a href="#" class="basket btn-small">в корзину</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="btn-box">
            <a href="#" class="btn btn--lt">все бесплатные проекты</a>
        </div>

    </div>

</div>

<div class="section home-about">
    <div class="home-about-menu">
        <div class="content content--lg">
            <ul class="home-about-menu--wrap">
                <li>
                    <a href="#" class="home-about-menu--item">
                        <article>
                            <h4 class="title">Как заказать проект?</h4>
                            <div class="subtitle">Инструкция</div>
                            <div class="read">
                                <button class="btn-small" type="button">Читать</button>
                            </div>
                        </article>
                    </a>
                </li>
                <li>
                    <a href="#" class="home-about-menu--item">
                        <article>
                            <h4 class="title">Что входит в проект?</h4>
                            <div class="subtitle">Описание состава проекта</div>
                            <div class="read">
                                <button class="btn-small" type="button">Читать</button>
                            </div>
                        </article>
                    </a>
                </li>
                <li>
                    <a href="#" class="home-about-menu--item">
                        <article>
                            <h4 class="title">Безопасность</h4>
                            <div class="subtitle">Оплата, возврат, гарантии</div>
                            <div class="read">
                                <button class="btn-small" type="button">Читать</button>
                            </div>
                        </article>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="home-about-main">
        <img src="assets/images/elements/branch.png" alt="branch" class="img-branch">
        <div class="content content--lg">
            <div class="home-about-main--wrap">
                <div class="home-about-main--chief">
                    <div class="home-about-main--photo">
                        <img src="assets/images/people/ava01.jpg" alt="director">
                    </div>
                    <div class="home-about-main--post">
                        <p>Петр Васильевич,</p>
                        <p>руководитель</p>
                    </div>
                </div>
                <div class="home-about-main--speech">
                    <div class="text">
                        <p>Мы — архитектурное бюро Арпланс и мы знаем все о строительстве домов в России, за 10 лет по
                            нашим проектам построено более 2000 домов. Наши дома комфортны, а проекты созданы с учетом
                            современного строительно рынка России. Мы растем и становимся доступнее — более 300
                            профессиональных готовых проектов на сайте.</p>
                        <p>Мы благодарны нашим клиентам за отзывы и рекомендации, вы даете нам самый мощный импульс для
                            творчества! </p>
                    </div>
                    <div class="blog-hashes">
                        <a href="#" class="btn-small">о компании</a>
                        <a href="#" class="btn-small">сотрудничество</a>
                        <a href="#" class="btn-small">живые отзывы вконтакте</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section home-blog-slider blog-slider full bg">
    <div class="content content--lg">
        <div class="blog-slider--wrap">
            <h3 class="title">полезное из блога</h3>
            <div class="blog-slider--carousel" data-owl="blog">
                <ul class="owl-carousel">
                    <li class="item">
                        <a href="article.html" class="blog-slider--item">
                            <div class="blog-slider--item-figure"
                                 style="background-image: url('assets/images/blog/blog01.png')"></div>
                            <div class="blog-slider--item-header">
                                <time class="blog-slider--item-date">3 марта 2018</time>
                                <h4 class="blog-slider--item-title">Как купить проект</h4>
                            </div>
                        </a>
                    </li>
                    <li class="item">
                        <a href="article.html" class="blog-slider--item">
                            <div class="blog-slider--item-figure"
                                 style="background-image: url('assets/images/blog/blog02.jpg')"></div>
                            <div class="blog-slider--item-header">
                                <time class="blog-slider--item-date">3 марта 2018</time>
                                <h4 class="blog-slider--item-title">Как правильно выбрать проект</h4>
                            </div>
                        </a>
                    </li>
                    <li class="item">
                        <a href="article.html" class="blog-slider--item">
                            <div class="blog-slider--item-figure"
                                 style="background-image: url('assets/images/blog/blog03.jpg')"></div>
                            <div class="blog-slider--item-header">
                                <time class="blog-slider--item-date">3 марта 2018</time>
                                <h4 class="blog-slider--item-title">ПРОВЕРКА ВРЕМЕНЕМ: НАШИ ПРОЕКТЫ В РЕАЛИЗАЦИИ,
                                    ИСТОРИИ СЕМЕЙ</h4>
                            </div>
                        </a>
                    </li>
                    <li class="item">
                        <a href="article.html" class="blog-slider--item">
                            <div class="blog-slider--item-figure"
                                 style="background-image: url('assets/images/blog/blog04.jpg')"></div>
                            <div class="blog-slider--item-header">
                                <time class="blog-slider--item-date">3 марта 2018</time>
                                <h4 class="blog-slider--item-title">ПРОВЕРКА ВРЕМЕНЕМ: НАШИ ПРОЕКТЫ В РЕАЛИЗАЦИИ,
                                    ИСТОРИИ СЕМЕЙ</h4>
                            </div>
                        </a>
                    </li>
                    <li class="item">
                        <a href="article.html" class="blog-slider--item">
                            <div class="blog-slider--item-figure"
                                 style="background-image: url('assets/images/blog/blog05.jpg')"></div>
                            <div class="blog-slider--item-header">
                                <time class="blog-slider--item-date">3 марта 2018</time>
                                <h4 class="blog-slider--item-title">Как купить проект</h4>
                            </div>
                        </a>
                    </li>
                    <li class="item">
                        <a href="article.html" class="blog-slider--item">
                            <div class="blog-slider--item-figure"
                                 style="background-image: url('assets/images/blog/blog06.jpg')"></div>
                            <div class="blog-slider--item-header">
                                <time class="blog-slider--item-date">3 марта 2018</time>
                                <h4 class="blog-slider--item-title">Как правильно выбрать проект</h4>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="blog-hashes">
                <a href="#" class="btn-small">как начать строительство</a>
                <a href="#" class="btn-small">советы</a>
                <a href="#" class="btn-small">строители и материалы</a>
            </div>
        </div>
    </div>
</div>

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
