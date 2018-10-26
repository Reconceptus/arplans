<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 22.10.2018
 * Time: 16:10
 */
$user = Yii::$app->user->identity;
/* @var $user \common\models\User */
$type = $user->access_token || $user->partner;
?>
<div class="tabs">
    <div class="tab"><a href="/profile">Профайл</a></div>
    <div class="tab"><a href="/profile/orders">Заказы</a></div>
    <? if ($type): ?>
        <div class="tab"><a href="/profile/sales">Продажи</a></div>
    <? endif; ?>
</div>
