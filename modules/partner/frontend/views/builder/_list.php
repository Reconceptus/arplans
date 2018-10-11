<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 11:52
 */

use yii\helpers\Html;

/* @var $model \modules\partner\models\Builder */
?>

<div class="partners-list--item">
    <figure class="bg" style="background-image: url(<?= $model->getMainImage() ?>)">
        <?= Html::a('', \yii\helpers\Url::to('/builder/' . $model->slug)) ?>
    </figure>
    <div class="partners-list--data">
        <div class="name">
            <?= Html::a($model->name, \yii\helpers\Url::to('/builder/' . $model->slug)) ?>
        </div>
        <div class="address"><?=$model->address?></div>
        <div class="tel"><?=$model->phones?></div>
    </div>
</div>