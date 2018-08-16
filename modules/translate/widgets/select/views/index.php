<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 02.08.2018
 * Time: 17:36
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $langs array */
?>
<div class="lang">
    <div class="lang-sign"><?= Yii::$app->language ?></div>
    <div class="lang-select">
        <? foreach ($langs as $lang): ?>
            <?= Html::a($lang, Url::to([mb_substr(Yii::$app->request->getUrl(), 3), 'language' => $lang]), ['class' => $lang === Yii::$app->language ? 'current' : '']) ?>
        <? endforeach; ?>
    </div>
</div>
