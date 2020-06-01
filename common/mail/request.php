<?php

use common\models\Request;
use yii\helpers\ArrayHelper;

/* @var $model Request */
$type = (int) $model->type;
?>
<?php if ($type > 0): ?>
    <h2><?= ArrayHelper::getValue(Request::TYPES_SELECT, $type) ?></h2>
<?php endif; ?>

    <p>Имя: <?= $model->name ?></p>
    <p>Email: <?= $model->email ?></p>
    <p>Телефон: <?= $model->phone ?></p>
    <p>Контакт: <?= $model->contact ?></p>
<?php if ($model->region): ?>
    <p>Регион: <?= $model->region ?></p>
<?php endif; ?>

    <h2>Текст</h2>
    <p><?= $model->text ?></p>
<?php if ((int) $model->url > 0): ?>
    <?php $item = \modules\shop\models\Item::findOne((int) $model->url);?>
    <?php if ($item): ?>
        Требуется просчитать смету на проект <a
                href="<?= Yii::$app->request->getHostInfo().'/shop/'.$item->category->slug.'/'.$item->slug ?>"><?= $item->name ?></a>
    <?php endif; ?>
<?php else: ?>
    Запрос поступил со страницы <a href="<?= $model->url ?>"><?= $model->url ?></a>
<?php endif; ?>

<?php if ($model->partner_id): ?>
    Заявка с сайта партнера <?= $model->partner->name.' ('.$model->partner->url.')' ?>
<?php endif; ?>