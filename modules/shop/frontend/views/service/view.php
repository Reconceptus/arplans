<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 12.09.2018
 * Time: 10:17
 */

/* @var $model \modules\shop\models\Service */
$this->title = $model->seo_title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->seo_keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->seo_description]);
?>
    <div class="section service--head">
        <div class="content content--lg mobile-wide">
            <div class="service--wrap gradient">
                <div class="content content--sm">
                    <h1 class="title title-lg"><?= $model->name ?></h1>
                    <h2 class="subtitle"><?= $model->short_description ?></h2>
                </div>
                <? if ($model->images): ?>
                    <div class="service--slider">
                        <div class="content content--md">
                            <div class="services-slider" data-owl="objects">
                                <ul class="owl-carousel">
                                    <? foreach ($model->images as $image): ?>
                                        <li class="object-item" data-num="1">
                                            <div class="projects-item--wrap">
                                                <div class="projects-item--preview">
                                                    <div class="bg" role="img"
                                                         aria-label="<?= $image->alt ?>"
                                                         style="background-image: url(<?= $image->file ?>)"></div>
                                                </div>
                                            </div>
                                        </li>
                                    <? endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <? endif; ?>
            </div>
        </div>
    </div>

    <div class="section custom-list">
        <div class="content content--md">
            <div class="custom-list--flexed">
                <? if ($model->benefits): ?>
                    <ul class="col-2">
                        <? foreach ($model->benefits as $benefit): ?>
                            <li>
                                <div class="title"><?= $benefit->name ?></div>
                                <?= $benefit->text ?>
                            </li>
                        <? endforeach; ?>
                    </ul>
                <? endif; ?>
                <div class="custom-list--info">
                    <div class="price"><?= intval($model->price) ?> <span
                                class="pt-sans">&#8381;</span> <?= $model->measure ?></div>
                    <p><strong>Срок:</strong> <?= $model->time ?></p>
                    <a href="#" class="order btn-square-min show-modal" data-modal="consultation">Заказать услугу</a>
                </div>
            </div>

        </div>
    </div>

    <div class="section service--profit content">
        <div class="text-box">
            <?= $model->description ?>
        </div>
        <? if ($model->files): ?>
            <div class="examples-box">
                <h3 class="title">Примеры:</h3>
                <ul class="examples">
                    <? foreach ($model->files as $file): ?>
                        <?
                        $ext = explode('.', $file->file);
                        $name = explode('/', $file->file);
                        ?>
                        <li>
                            <a href="<?= $file->file ?>">
                                <i class="icon-pdf">
                                    <svg xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#icon-<?= end($ext) ?>"/>
                                    </svg>
                                </i>
                                <span><?= str_replace('_', ' ', end($name)) ?></span>
                            </a>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
        <? endif; ?>
    </div>

<?= \modules\shop\widgets\services\Services::widget(['id' => $model->id, 'viewName' => 'another']) ?>
<?= \frontend\widgets\recently\Recently::widget() ?>