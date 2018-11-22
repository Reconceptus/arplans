<?php

/* @var $this yii\web\View */
/* @var $model \modules\partner\models\About */
/* @var $benefits \modules\partner\models\AboutBenefit[] */
/* @var $reviews \modules\partner\models\Reviews[] */
/* @var $readyProjects \modules\partner\models\AboutReady[] */
/* @var $query */


$this->title = 'О нас';
$this->params['breadcrumbs'][] = $this->title;
\yii\widgets\Pjax::begin();
?>
    <div class="section about--head">
        <div class="content content--lg mobile-wide">
            <div class="about--wrap">
                <div class="gradient absolute"></div>
                <div class="content content--sm">
                    <h1 class="title title-lg">О нас</h1>
                    <h2 class="subtitle"><?= $model->about_title ?></h2>
                </div>
                <div class="about--image">
                    <div class="content content--md">
                        <figure>
                            <img src="<?= $model->about_main_image ?>" alt="villa">
                        </figure>
                    </div>
                    <img src="/img/branch2.png" alt="branch" class="img-branch">
                </div>
            </div>
        </div>
    </div>
<? if ($benefits): ?>
    <div class="section custom-list">
        <div class="content content--md">
            <ul class="col-3">
                <? foreach ($benefits as $benefit): ?>
                    <li>
                        <div class="title"><?= $benefit->name ?></div>
                        <p><?= $benefit->text ?></p>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
<? endif; ?>

    <div class="big-header">
        <div class="content content--lg">
            <h2 class="title">РЕАЛИЗАЦИЯ НАШИХ ПРОЕКТОВ</h2>
        </div>
    </div>

    <div class="our-projects">
        <img src="img/branch3.png" alt="branch" class="img-branch">
        <div class="content content--md">
            <? if ($readyProjects): ?>
                <div class="our-projects-slider" data-owl="objects">
                    <ul class="owl-carousel">
                        <? foreach ($readyProjects as $project): ?>
                            <li class="object-item">
                                <div class="projects-item--wrap">
                                    <a href="#" class="projects-item--preview">
                                        <div class="bg" style="background-image: url(<?= $project->file ?>)"></div>
                                    </a>
                                </div>
                            </li>
                        <? endforeach; ?>
                    </ul>
                </div>
            <? endif; ?>
            <div class="project-page--reviews">
                <i class="icon icon-vk-reviews">
                    <svg xmlns="http://www.w3.org/2000/svg">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-vk-reviews"/>
                    </svg>
                </i>
                <span class="text">Живые отзывы клиентов Вконтакте</span>
                <a href="<?=\modules\content\models\ContentBlock::getValue('vk_reviews')?>" class="read" target="_blank">Читать</a>
            </div>
        </div>
    </div>
<? if ($reviews): ?>
    <div class="reviews">
        <div class="content content--md">
            <div class="reviews-carousel--box">
                <div class="reviews-carousel--wrap">
                    <div class="reviews-carousel" data-owl="reviews">
                        <ul class="owl-carousel">
                            <? foreach ($reviews as $review): ?>
                                <li class="item">
                                    <div class="review-header">
                                        <div class="author">
                                            <div class="name"><?= $review->author_name ?></div>
                                            <div class="position"><?= $review->author_status ?>></div>
                                        </div>
                                        <a href="#" class="load">PDF отзыв</a>
                                    </div>
                                    <div class="review-text">
                                        <p><?= $review->text ?></p>
                                    </div>
                                </li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="temp-nav">
            <button class="temp-nav-prev" id="t_prev"></button>
            <button class="temp-nav-next" id="t_next"></button>
        </div>
    </div>
<? endif; ?>
    <div class="big-header">
        <div class="content content--lg">
            <h2 class="title" id="map-anchor">Офисы продаж</h2>
        </div>
    </div>
<?= \modules\partner\widgets\map\Map::widget(['viewName' => 'about', 'query' => $query]) ?>
<?= \frontend\widgets\recently\Recently::widget() ?>
<script>
    initMap();
    $('html,body').stop().animate({ scrollTop: $('#map-anchor').offset().top }, 1);
    project.regionDropBox();
    project.customScroll();
</script>
<? \yii\widgets\Pjax::end()?>
