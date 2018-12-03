<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 18.09.2018
 * Time: 10:11
 */
/* @var $model \modules\partner\models\Village */
?>
<div class="partners-list--item">
    <figure class="bg" style="background-image: url(<?= $model->getMainImage(true)->getThumb() ?>)">
        <?= \yii\helpers\Html::a('#', \yii\helpers\Url::to('/village/' . $model->slug)) ?>
    </figure>
    <div class="partners-list--data">
        <div class="name">
            <?= \yii\helpers\Html::a($model->name, \yii\helpers\Url::to('/village/' . $model->slug)) ?>
        </div>
        <div class="address"><?= $model->address ?></div>
        <div class="tel"><?= $model->phones ?></div>
        <? if ($model->email): ?>
            <div class="email"><?= $model->email ?></div>
        <? endif; ?>
        <a href="#" class="on-map">на карте</a>
    </div>
</div>
