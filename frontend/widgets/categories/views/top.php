<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 21.08.2018
 * Time: 12:03
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $models \frontend\widgets\categories\Categories*/
?>
<nav>
    <ul>
        <?foreach ($models as $model):?>
        <li>
            <?=Html::a($model->name, Url::to('/shop/'.$model->slug))?>
        </li>
        <? endforeach;?>
        <li>
            <?=Html::a('Индивидуальный проект', Url::to('#'))?>
        </li>
    </ul>
</nav>
