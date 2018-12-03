<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 03.12.2018
 * Time: 14:45
 */
/* @var $model \modules\shop\models\Payment */
?>
<? if ($model->status === \modules\shop\models\Payment::STATUS_COMPLETE): ?>
    <h2>Заказ #<?= $model->order->id ?> успешно оплачен</h2>
<? else: ?>
    <? if ($model->reason): ?>
        <h2>При оплате произошла ошибка: <?= $model->getReasonName() ?></h2>
    <? else: ?>
        <h2>Заказ #<?= $model->order->id ?> не был оплачен</h2>
    <? endif; ?>
<? endif; ?>
