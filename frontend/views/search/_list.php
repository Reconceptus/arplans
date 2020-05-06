<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model \modules\shop\models\Item */
?>

<h3 class="title">
    <?= Html::a($model->name, Url::to('/shop/' . $model->category->slug . '/' . $model->slug)) ?>
</h3>
<div class="text-box">
    <p><?= $model->description ?></p>
</div>
