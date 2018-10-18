<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.10.2018
 * Time: 17:42
 */

/* @var $model \modules\partner\models\Collaboration */
/* @var $manager \common\models\Profile */
$manager = $model->getManager();

?>

    <div class="section collaborate-head">
        <div class="content content--lg">
            <div class="collaborate-head--main gradient">
                <div class="content content--sm">
                    <h1 class="title title-lg">Сотрудничество</h1>
                    <h2 class="subtitle">Вступите в «Клуб АРПЛАНС» и получайте выгоду от сотрудничества с нами:
                        приобретение проектов со скидкой, продажа наших проектов, реклама на нашем сайте. Наши готовые
                        проекты — продукт, которым мы гордимся и который сам себя продает. Оставьте заявку и мы
                        расскажем вам о всех преимуществах работы с нами. </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="big-header">
        <div class="content content--lg">
            <h2 class="title">Формы сотрудничества</h2>
        </div>
    </div>

    <div class="section collaborate-list">
        <div class="content content--lg">
            <div class="custom-row">

                <div class="custom-row-col col-sidebar">
                    <div class="collaborate-list--person">
                        <? if ($manager): ?>
                            <div class="photo">
                                <img src="<?= $manager->image ?>" alt="director">
                            </div>
                            <div class="post">
                                <p><?= $manager->fio ?></p>
                                <p><?= $manager->position ?></p>
                                <p><?= $manager->phone ?></p>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
                <div class="custom-row-col col-elastic">
                    <div class="collaborate-list--items">
                        <div class="item">
                            <figure>
                                <img src="<?= $model->collaboration_image_1 ?>" alt="mockup">
                                <span class="num">1</span>
                            </figure>
                            <div class="item-text">
                                <h3 class="title"><?= $model->collaboration_title_1 ?></h3>
                                <p><?= $model->collaboration_text_1 ?></p>
                            </div>
                            <div class="item-action">
                                <a href="#" class="btn-add show-modal" data-modal="consultation"><span>Запрос на партнерство</span></a>
                            </div>
                        </div>
                        <div class="item">
                            <figure>
                                <img src="<?= $model->collaboration_image_2 ?>" alt="mockup">
                                <span class="num">2</span>
                            </figure>
                            <div class="item-text">
                                <h3 class="title"><?= $model->collaboration_title_2 ?></h3>
                                <p><?= $model->collaboration_text_2 ?></p>
                            </div>
                            <div class="item-action">
                                <a href="#" class="btn-add show-modal" data-modal="consultation"><span>Запрос на партнерство</span></a>
                                <a href="/village/add" class="btn-add"><span>Добавить свой поселок</span></a>
                            </div>
                        </div>
                        <div class="item">
                            <figure>
                                <img src="<?= $model->collaboration_image_3 ?>" alt="mockup">
                                <span class="num">3</span>
                            </figure>
                            <div class="item-text">
                                <h3 class="title"><?= $model->collaboration_title_3 ?></h3>
                                <p><?= $model->collaboration_text_3 ?></p>
                            </div>
                            <div class="item-action">
                                <a href="#" class="btn-add show-modal" data-modal="consultation"><span>Запрос на партнерство</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= \frontend\widgets\recently\Recently::widget() ?>