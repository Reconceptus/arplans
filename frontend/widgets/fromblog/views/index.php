<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 30.08.2018
 * Time: 15:18
 */

/* @var $models \common\models\Post[] */
/* @var $tags \common\models\Tag[] */
?>
<? if ($models): ?>
    <div class="section home-blog-slider blog-slider full bg">
        <div class="content content--lg">
            <div class="blog-slider--wrap">
                <h3 class="title">полезное из блога</h3>
                <div class="blog-slider--carousel" data-owl="blog">
                    <ul class="owl-carousel">
                        <? foreach ($models as $model): ?>
                            <li class="item">
                                <a href="/blog/<?= $model->slug ?>" class="blog-slider--item">
                                    <div class="blog-slider--item-figure"
                                         style="background-image: url('<?= $model->image ?>')"></div>
                                    <div class="blog-slider--item-header">
                                        <time class="blog-slider--item-date"><?= \common\helpers\DateTimeHelper::getDateRuFormat($model->created_at) ?></time>
                                        <h4 class="blog-slider--item-title"><?= $model->name ?></h4>
                                    </div>
                                </a>
                            </li>
                        <? endforeach; ?>
                    </ul>
                </div>
                <div class="blog-hashes">
                    <?= \yii\helpers\Html::a('Все статьи', \yii\helpers\Url::to(['/blog']), ['class' => 'btn-small']) ?>
                    <? foreach ($tags as $tag): ?>
                        <?= \yii\helpers\Html::a($tag->name, \yii\helpers\Url::to(['/blog/index', 'tag' => $tag->name]), ['class' => 'btn-small']) ?>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<? endif; ?>