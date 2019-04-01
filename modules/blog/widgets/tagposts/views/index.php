<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 30.08.2018
 * Time: 15:18
 */

/* @var $models \common\models\Post[] */
?>
<?php if ($models): ?>
    <div class="section blog-slider simple">
        <div class="content content--lg">
            <div class="blog-slider--wrap">
                <div class="blog-slider--carousel" data-owl="blog">
                    <ul class="owl-carousel">
                        <?php foreach ($models as $model):?>
                        <li class="item">
                            <a href="/blog/<?=$model->slug?>" class="blog-slider--item">
                                <div class="blog-slider--item-figure" style="background-image: url('<?= $model->image ?>')"></div>
                                <div class="blog-slider--item-header">
                                    <time class="blog-slider--item-date"><?= \common\helpers\DateTimeHelper::getDateRuFormat($model->created_at) ?></time>
                                    <h4 class="blog-slider--item-title"><?= $model->name ?></h4>
                                </div>
                            </a>
                        </li>
    <?endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>