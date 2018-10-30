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

$category = Yii::$app->request->get('category');
if (!$category) {
    $slug = Yii::$app->request->get('slug');
} else {
    $slug = '';
}
?>
<nav>
    <ul>
        <? foreach ($models as $model): ?>
            <li>
                <?= Html::a($model->name, Url::to('/shop/' . $model->slug), ['class' => $category === $model->slug ? 'active' : '']) ?>
            </li>
        <? endforeach; ?>
        <? foreach ($services as $service): ?>
            <li>
                <?= Html::a($service->name, Url::to('/shop/service/' . $service->slug), ['class' => $slug === $service->slug ? 'active' : '']) ?>
            </li>
        <? endforeach; ?>
    </ul>
</nav>
