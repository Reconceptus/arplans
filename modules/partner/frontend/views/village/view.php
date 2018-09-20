<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.09.2018
 * Time: 11:50
 */

/* @var $model \modules\partner\models\Village */
?>

    <div class="section partner-page--head">
        <div class="content content--lg mobile-wide">
            <div class="partner-page--wrap" style="background-image: url(<?= $model->image->file ?>)">
                <div class="content content--sm">
                    <h1 class="title title-lg"><?= $model->name ?></h1>
                </div>
                <?= \modules\partner\widgets\slider\Slider::widget(['viewName' => 'partner', 'model' => $model]) ?>
            </div>
        </div>
    </div>
<?= $this->render('_info', ['model' => $model]) ?>
    <div class="section custom-list">
        <div class="content content--md">
            <ul class="col-3">
                <? foreach ($model->benefits as $benefit): ?>
                    <li>
                        <div class="title"><?= $benefit->name ?></div>
                        <?= $benefit->text ?>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="section partner-page--text">
        <div class="content content--lg">
            <div class="custom-row">
                <?= $this->render('_sidebar', ['model' => $model]) ?>
                <div class="custom-row-col col-elastic">
                    <div class="project-page--about">
                        <h3 class="title">О поселке</h3>
                        <div class="text-box">
                            <?= $model->description ?>
                        </div>
                    </div>

                    <div class="catalog-actions">
                        <div class="page-back">
                            <a href="/village">
                            <span class="icon-arrow-left">
                                <svg xmlns="http://www.w3.org/2000/svg">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow-left-long"/>
                                </svg>
                            </span>
                                <span class="text">Все поселки</span>
                            </a>
                        </div>
                        <div class="sharing title-end">
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
                </div>
            </div>
        </div>
    </div>
<?= \frontend\widgets\recently\Recently::widget() ?>