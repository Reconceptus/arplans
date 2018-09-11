<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 11.09.2018
 * Time: 11:02
 */

/* @var $model \modules\shop\models\Service */
?>
<p style="font-weight: bold">Преимущества</p>
<div class="benefits">
    <? foreach ($model->benefits as $benefit): ?>
        <?= $this->render('_benefit', ['model' => $benefit]) ?>
    <? endforeach; ?>
</div>
<div class="clearfix"></div>
<div class="benefit-form">
    <div class="form-group">
        <label class="control-label">Заголовок</label>
        <input class="form-control benefit-title">
    </div>
    <div class="form-group">
        <label class="control-label">Текст</label>
        <input class="form-control benefit-text">
    </div>
    <div class="btn btn-admin js-add-benefit">Добавить</div>
</div>