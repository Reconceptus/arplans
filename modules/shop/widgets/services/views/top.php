<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 12.09.2018
 * Time: 16:51
 */
/* @var $models \modules\shop\models\Service[] */
?>
<li class="has-drop">
    <a href="#" class="">Услуги+</a>
    <div class="header-top--drop">
        <?php foreach ($models as $model): ?>
            <?= \yii\helpers\Html::a($model->name, \yii\helpers\Url::to('/shop/service/' . $model->slug)) ?>
        <?php endforeach; ?>
    </div>
</li>
