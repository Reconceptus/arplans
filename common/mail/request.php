<?php

/**
 * Created by PhpStorm.
 * User: borod
 * Date: 15.10.2018
 * Time: 17:47
 */

use common\models\Request;

/* @var $model Request */
$type = (int) $model->type;
?>
<?php if (isset($type)): ?>
    <?php if ($type === Request::PAGE_CALCULATION): ?>
        <h2>Запрос сметы</h2>
    <?php elseif ($type === Request::PAGE_CONTACT): ?>
        <h2>Сообщение со страницы контактов</h2>
    <?php elseif ($type === Request::PAGE_PARTNER): ?>
        <h2>Запрос на партнертво</h2>
    <?php else: ?>
        <h2>Новое сообщение пользователя</h2>
    <?php endif; ?>
<?php endif; ?>

<?php if ($model->type === Request::PAGE_CONTACT): ?>
    <p>Имя: <?= $model->name ?></p>
    <p>Email: <?= $model->email ?></p>
    <p>Телефон: <?= $model->phone ?></p>
<?php else: ?>
    <?php if ($model->name && $model->name != '-'): ?>
        <p>Имя: <?= $model->name ?></p>
    <?php endif; ?>
    <?php if ($model->region): ?>
        <p>Регион: <?= $model->region ?></p>
    <?php endif; ?>
    <?php if ($model->email): ?>
        <p>Email: <?= $model->email ?></p>
    <?php endif; ?>
    <?php if ($model->phone): ?>
        <p>Phone: <?= $model->email ?></p>
    <?php endif; ?>

<?php endif; ?>
    <h2>Текст</h2>
    <p><?= $model->text ?></p>
<?php if ((int) $model->url > 0): ?>
    <?php $item = \modules\shop\models\Item::findOne((int) $model->url);
    ?>
    <?php if ($item): ?>
        Требуется просчитать смету на проект <a
                href="<?= Yii::$app->request->getHostInfo() . '/shop/' . $item->category->slug . '/' . $item->slug ?>"><?= $item->name ?></a>
    <?php endif; ?>
<?php else: ?>
    Запрос поступил со страницы <a href="<?= $model->url ?>"><?= $model->url ?></a>
<?php endif; ?>

<?php if ($model->partner_id): ?>
    Заявка с сайта партнера <?= $model->partner->name . ' (' . $model->partner->url . ')' ?>
<?php endif; ?>