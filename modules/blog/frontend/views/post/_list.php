<?php

/* @var $model \common\models\Post */

use yii\helpers\Url;

?>

<a href="<?= Url::to('/blog/' . $model->slug) ?>" class="blog-item--wrap">
    <div class="blog-item--figure" style="background-image: url('<?= $model->image ?>')"></div>
    <div class="blog-item--header">
        <time class="blog-item--date"><?= \common\helpers\DateTimeHelper::getDateRuFormat($model->created_at) ?></time>
        <h4 class="blog-item--title"><?= $model->name ?></h4>
    </div>
</a>
