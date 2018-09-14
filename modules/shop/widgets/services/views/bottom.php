<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 12.09.2018
 * Time: 17:12
 */
/* @var $models \modules\shop\widgets\services\Services[] */
?>
<section class="section">
    <h4 class="title">Услуги</h4>
    <ul>
        <? foreach ($models as $model): ?>
            <li><?= \yii\helpers\Html::a($model->name, \yii\helpers\Url::to('/shop/service/' . $model->slug)) ?></li>
        <? endforeach; ?>
    </ul>
</section>
