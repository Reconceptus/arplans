<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:37
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $modules array */
/* @var $selected array */
?>

<ul class="side-menu">
    <? foreach ($modules as $module): ?>
        <?
        if (!Yii::$app->user->can($module['name'])) {
            continue;
        }
        ?>
        <li>
            <? if (array_key_exists('items', $module) && is_array($module['items'])): ?>
                <span class="module"><?= $module['title'] ?></span>
                <ul class="module-items">
                    <? foreach ($module['items'] as $item): ?>
                        <?
                        if (!Yii::$app->user->can(str_replace('/', '_', $item['name']))) continue;
                        $options = ['class' => ''];
                        $class = isset($selected['modules']) && isset($selected['controller']) && $item['name'] === $module['name'] . '/' . $selected['controller'] ? 'active' : '';
                        Html::addCssClass($options, 'active');
                        ?>
                        <li>
                            <?= Html::a($item['title'], Url::to('/admin/modules/' . $item['name']), ['class' => $class]) ?>
                        </li>
                    <? endforeach ?>
                </ul>
            <? else: ?>
                <a href="/admin/modules/<?= $module['module'] ?>"><?= $module['title'] ?></a>
            <? endif ?>
        </li>
    <? endforeach ?>
    <?= Html::a('Выход ('.Yii::$app->user->identity->username.')', Url::to(['/site/logout', 'toLogin' => true])) ?>
</ul>
