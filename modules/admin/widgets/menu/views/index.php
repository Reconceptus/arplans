<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $modules array */
/* @var $selected array */
?>

<ul class="side-menu">
    <?php foreach ($modules as $module): ?>
        <?php if (!Yii::$app->user->can($module['name'])) {
            continue;
        }
        ?>
        <li>
            <?php if (array_key_exists('items', $module) && is_array($module['items'])): ?>
                <span class="module"><?= $module['title'] ?></span>
                <ul class="module-items">
                    <?php foreach ($module['items'] as $item): ?>
                        <?php if (!Yii::$app->user->can(str_replace('/', '_', $item['name']))) continue;
                        $options = ['class' => ''];
                        $class = isset($selected['modules']) && isset($selected['controller']) && $item['name'] === $module['name'] . '/' . $selected['controller'] ? 'active' : '';
                        Html::addCssClass($options, 'active');
                        ?>
                        <li>
                            <?= Html::a($item['title'], Url::to('/admin/modules/' . $item['name']), ['class' => $class]) ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php else: ?>
                <a href="/admin/modules/<?= $module['module'] ?>"><?= $module['title'] ?></a>
            <?php endif ?>
        </li>
    <?php endforeach ?>
    <?= Html::a('Выход ('.Yii::$app->user->identity->username.')', Url::to(['/site/logout', 'toLogin' => true])) ?>
</ul>
