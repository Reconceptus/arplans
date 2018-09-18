<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 11:22
 */
/* @var $models \common\models\Region[] */
$get = Yii::$app->request->resolve()[1];
if (isset($get['region'])) {
    unset($get['region']);
}
?>
<div class="regions-drop">
    <ul>
        <? foreach ($models as $model): ?>
            <li>
                <?= \yii\helpers\Html::a($model->name, \yii\helpers\Url::to(['', $get, 'region' => $model->id])) ?>
            </li>
        <? endforeach; ?>
    </ul>
</div>
