<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
Юзер <?=Yii::$app->user->id?>
    <a href="/blog">Перейти в блог</a>
</div>
