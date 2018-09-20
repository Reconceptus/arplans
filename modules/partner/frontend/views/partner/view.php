<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.09.2018
 * Time: 11:50
 */

/* @var $model \modules\partner\models\Partner */
?>

    <div class="section partner-page--head">
        <div class="content content--lg mobile-wide">
            <div class="partner-page--wrap" style="background-image: url(<?= $model->image->file ?>)">
                <div class="content content--sm">
                    <h1 class="title title-lg"><?=$model->name?></h1>
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
                        <h3 class="title">О партнере</h3>
                        <div class="text-box">
                            <?= $model->description ?>
                        </div>
                    </div>

                    <div class="catalog-actions">
                        <div class="page-back">
                            <a href="/partner">
                            <span class="icon-arrow-left">
                                <svg xmlns="http://www.w3.org/2000/svg">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow-left-long"/>
                                </svg>
                            </span>
                                <span class="text">Все партнеры</span>
                            </a>
                        </div>
                        <div class="sharing title-end">
                            <div class="title">Поделиться</div>
                            <?=\frontend\widgets\share\Share::widget()?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= \frontend\widgets\recently\Recently::widget() ?>