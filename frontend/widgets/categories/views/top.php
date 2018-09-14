<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 21.08.2018
 * Time: 12:03
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $models \modules\shop\models\Category */
/* @var $services \modules\shop\models\Service */
?>
<nav>
    <ul>
        <? foreach ($models as $model): ?>
            <li>
                <?= Html::a($model->name, Url::to('/shop/' . $model->slug)) ?>
            </li>
        <? endforeach; ?>
        <? foreach ($services as $service): ?>
            <li>
                <?= Html::a($service->name, Url::to('/shop/service/' . $service->slug)) ?>
            </li>
        <? endforeach; ?>
    </ul>
</nav>
