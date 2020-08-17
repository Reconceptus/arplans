<?php

use modules\shop\models\Service;

/* @var $models Service[] */
?>
<section class="section">
    <h4 class="title">Услуги</h4>
    <ul>
        <?php foreach ($models as $model): ?>
            <li><?= \yii\helpers\Html::a($model->name, \yii\helpers\Url::to('/shop/service/' . $model->slug)) ?></li>
        <?php endforeach; ?>
    </ul>
</section>
