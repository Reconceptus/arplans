<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 24.08.2018
 * Time: 10:08
 */

/* @var $model \modules\shop\models\Item */
/* @var $favorites array */
/* @var $isInCart bool */
$this->title = $model->seo_title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->seo_keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->seo_description]);
?>
<div class="section project-page">
    <div class="content content--lg">
        <div class="custom-row">
            <?= \modules\shop\widgets\filters\Filters::widget([
                'viewName' => 'empty',
                'api'      => true,
                'category' => $model->category
            ]) ?>
            <div class="custom-row-col col-elastic">

                <div class="project-page--head custom-row">
                    <?= $this->render('_photos', ['model' => $model]) ?>
                    <?= $this->render('_info', ['model' => $model, 'favorites' => [], 'isInCart' => $isInCart]) ?>
                </div>
                <div class="project-page--info temp">
                    <div class="data">
                        <div class="info">
                            <i class="icon-sign">i</i>
                            <ul>
                                <li>
                                    <span class="head">Жилая:</span>
                                    <span class="text"><?= $model->live_area ?> м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Полезная:</span>
                                    <span class="text"><?= $model->useful_area ?> м<sup>2</sup></span>
                                </li>
                                <li>
                                    <span class="head">Общая:</span>
                                    <span class="text"><?= $model->common_area ?> м<sup>2</sup></span>
                                </li>
                            </ul>
                        </div>
                        <div class="estimate">
                            <a href="#" class="btn-add show-modal"
                               data-modal="calculation"><span>Заказать расчет дома</span></a>
                        </div>
                    </div>
                </div>
                <?= $this->render('_tabs', ['model' => $model]) ?>
                <!--                <div class="project-page--reviews">-->
                <!--                    <i class="icon icon-vk-reviews">-->
                <!--                        <svg xmlns="http://www.w3.org/2000/svg">-->
                <!--                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-vk-reviews"/>-->
                <!--                        </svg>-->
                <!--                    </i>-->
                <!--                    <span class="text">Живые отзывы клиентов Вконтакте</span>-->
                <!--                    <a href="-->
                <?php //= \modules\content\models\ContentBlock::getValue('vk_reviews') ?><!--"-->
                <!--                       class="read" target="_blank">Читать</a>-->
                <!--                </div>-->
                <?php if ($model->description): ?>
                    <div class="project-page--about">
                        <h3 class="title">О проекте</h3>
                        <div class="text-box">
                            <?= $model->description ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>