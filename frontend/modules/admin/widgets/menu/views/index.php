<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:37
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<ul class="side-menu-list">
    <? if (Yii::$app->user->can('posts')): ?>
        <li>
            <?= Html::a('Technology', Url::to('/admin/posts')) ?>
        </li>
    <? endif; ?>
    <? if (Yii::$app->user->can('pages')): ?>
        <li>
            <?= Html::a('Materials', Url::to('/admin/page')) ?>
        </li>
    <? endif; ?>
    <? if (Yii::$app->user->can('users')): ?>
        <li>
            <?= Html::a('Users', Url::to('/admin/user')) ?>
        </li>
        <li>
            <?= Html::a('Roles', Url::to('/admin/role')) ?>
        </li>
    <? endif; ?>
</ul>