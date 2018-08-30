<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 24.08.2018
 * Time: 10:08
 */

use frontend\widgets\recently\Recently;
use modules\shop\widgets\like\Like;

/* @var $model \modules\shop\models\Item */
?>
<div class="section project-page">
    <div class="content content--lg">
        <div class="custom-row">
            <?= \modules\shop\widgets\filters\Filters::widget([
                'viewName' => 'view',
                'category' => $model->category
            ]) ?>
            <div class="custom-row-col col-elastic">

                <div class="project-page--head custom-row">
                    <?= $this->render('_photos', ['model' => $model]) ?>
                    <?= $this->render('_info', ['model' => $model]) ?>
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
                            <a href="#" class="btn-add"><span>Получить точную смету</span></a>
                        </div>
                    </div>
                </div>
                <?= $this->render('_tabs', ['model' => $model]) ?>
                <div class="project-page--reviews">
                    <i class="icon icon-vk-reviews">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-vk-reviews"/>
                        </svg>
                    </i>
                    <span class="text">Живые отзывы клиентов Вконтакте</span>
                    <a href="#" class="read">Читать</a>
                </div>
                <div class="project-page--about">
                    <h3 class="title">О проекте</h3>
                    <div class="text-box">
                        <?= $model->description ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= Like::widget() ?>
<?= Recently::widget() ?>
