<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 19.11.2018
 * Time: 10:56
 */

/* @var $model \modules\shop\models\Order */
?>

    <h3><?= $model->fio ?></h3>
    Статус вашего заказа №<?= $model->id ?> изменен. Новый статус - <?= \modules\shop\models\Order::getStatusName($model->status) ?>