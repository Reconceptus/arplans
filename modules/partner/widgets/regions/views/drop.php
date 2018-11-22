<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 11:22
 */
/* @var $models \common\models\Region[] */
$get = Yii::$app->request->resolve()[1];
// Для строителей
$build = [];
$works = [];
$mat = [];
$reg = [];

if (isset($get['build'])) {
    $build = $get['build'];
}
if (isset($get['works'])) {
    $works = $get['works'];
}
if (isset($get['mat'])) {
    $mat = $get['mat'];
}
if (isset($get['reg'])) {
    $reg = $get['reg'];
}

// для поселков
$networks = [];
$safety = [];
$infra = [];
$eco = [];

if (isset($get['networks'])) {
    $networks = $get['networks'];
}
if (isset($get['safety'])) {
    $safety = $get['safety'];
}
if (isset($get['infra'])) {
    $infra = $get['infra'];
}
if (isset($get['eco'])) {
    $eco = $get['eco'];
}
?>
<div class="regions-drop">
    <ul>
        <li>
            <?= \yii\helpers\Html::a('Все регионы', \yii\helpers\Url::to(['', 'build' => $build])) ?>
        </li>
        <? foreach ($models as $model): ?>
            <li>
                <?= \yii\helpers\Html::a($model->name, \yii\helpers\Url::to(['',
                    'region'   => $model->id,
                    'build'    => $build,
                    'eco'      => $eco,
                    'networks' => $networks,
                    'safety'   => $safety,
                    'infra'    => $infra,
                    'works'    => $works,
                    'mat'      => $mat,
                    'reg'      => $reg,
                ])) ?>
            </li>
        <? endforeach; ?>
    </ul>
</div>
