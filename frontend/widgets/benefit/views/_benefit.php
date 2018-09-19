<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 11.09.2018
 * Time: 14:49
 */

/* @var $model \modules\shop\models\ServiceBenefit */
?>

<div class="benefit">
    <div class="js-benefit" data-id="<?= $model->id ?>"><span class="glyphicon glyphicon-trash"></span></div>
    <div class="title"><?= $model->name ?></div>
    <div class="text"><?= $model->text ?></div>
</div>
