<?php

/**
 * Created by PhpStorm.
 * User: borod
 * Date: 15.10.2018
 * Time: 17:47
 */

use common\models\Request;

/* @var $model Request */
$type = intval($model->type);
?>
<? if (isset($type)): ?>
    <? if ($type === Request::PAGE_CALCULATION): ?>
        <h2>Запрос сметы</h2>
    <? elseif ($type === Request::PAGE_CONTACT): ?>
        <h2>Сообщение со страницы контактов</h2>
    <? elseif ($type === Request::PAGE_PARTNER): ?>
        <h2>Запрос на партнертво</h2>
    <? else: ?>
        <h2>Новое сообщение пользователя</h2>
    <? endif; ?>
<? endif; ?>

<? if ($model->type === Request::PAGE_CONTACT): ?>
    <p>Имя: <?= $model->name ?></p>
    <p>Email: <?= $model->email ?></p>
    <p>Телефон: <?= $model->phone ?></p>
<? else: ?>
    <p>Контактная информация: <?= $model->contact ?></p>
<? endif; ?>
    <h2>Текст</h2>
    <p><?= $model->text ?></p>
<? if (intval($model->url)>0): ?>
    <?
    $item = \modules\shop\models\Item::findOne(intval($model->url));
    ?>
    <? if ($item): ?>
        Смету треюуется посчитать на <a
                href="<?= Yii::$app->request->getHostInfo() . '/shop/' . $item->category->slug . '/' . $item->slug ?>"><?= $item->name ?></a>
    <? endif; ?>
<? else: ?>
    Запрос поступил со страницы <a href="<?= $model->url ?>"><?= $model->url ?></a>
<? endif; ?>