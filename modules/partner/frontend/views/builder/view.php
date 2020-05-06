<?php

/* @var $model \modules\partner\models\Builder */
$this->title = $model->seo_title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->seo_keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->seo_description]);
$backImage = $model->getBackImage(true);
?>

    <div class="section partner-page--head">
        <div class="content content--lg mobile-wide">
            <div class="partner-page--wrap" role="img"
                 aria-label="<?= $backImage ? $backImage->alt : '' ?>"
                 style="background-image: url(<?= $backImage ? $backImage->file : '' ?>)">
                <div class="content content--sm">
                    <h1 class="title title-lg"><?= $model->name ?></h1>
                </div>
                <?= \modules\partner\widgets\slider\Slider::widget(['viewName' => 'builder', 'model' => $model]) ?>
            </div>
        </div>
    </div>
<?= $this->render('_info', ['model' => $model]) ?>
    <div class="section custom-list">
        <div class="content content--md">
            <ul class="col-3">
                <?php foreach ($model->benefits as $benefit): ?>
                    <li>
                        <div class="title"><?= $benefit->name ?></div>
                        <?= $benefit->text ?>
                    </li>
                <?php endforeach; ?>
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
                            <a href="/builder">
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
                            <?= \frontend\widgets\share\Share::widget() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= \frontend\widgets\recently\Recently::widget() ?>