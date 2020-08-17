<?php
/* @var $models \common\models\Post[] */
/* @var $tags \common\models\Tag[] */
?>
<?php if ($models): ?>
    <div class="section home-blog-slider blog-slider full bg">
        <div class="content content--lg">
            <div class="blog-slider--wrap">
                <h2 class="title">Блог, где есть все о проектах домов</h2>
                    <p class="title">Читайте и вдохновляйтесь</p>
                    <div class="blog-slider--carousel" data-owl="blog">
                        <ul class="owl-carousel">
                            <?php foreach ($models as $model): ?>
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
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="blog-hashes">
                        <?= \yii\helpers\Html::a('Все статьи', \yii\helpers\Url::to(['/blog']), ['class' => 'btn-small']) ?>
                        <?php foreach ($tags as $tag): ?>
                            <?= \yii\helpers\Html::a($tag->name, \yii\helpers\Url::to(['/blog/index', 'tag' => $tag->name]), ['class' => 'btn-small']) ?>
                        <?php endforeach; ?>
                    </div>
            </div>
        </div>
    </div>
<?php endif; ?>