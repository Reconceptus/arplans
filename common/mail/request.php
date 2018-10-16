<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 15.10.2018
 * Time: 17:47
 */
/* @var $model \common\models\Request */
?>
<h2>Новое сообщение пользователя</h2>
<? if ($model->type === \common\models\Request::PAGE_OTHER): ?>
    <p>Контактная информация: <?= $model->contact ?></p>
<? else: ?>
    <p>Имя: <?= $model->name ?></p>
    <p>Email: <?= $model->email ?></p>
    <p>Телефон: <?= $model->phone ?></p>
<? endif; ?>
<h2>Текст</h2>
<p><?= $model->text ?></p>
<? if ($model->file): ?>
    К письму приложен файл: <a href="<?= Yii::$app->request->getHostInfo() . $model->file ?>">скачать</a>
<? endif; ?>
Запрос поступил со страницы <a href="<?= $model->url ?>"><?= $model->url ?></a>
