<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 11.09.2018
 * Time: 14:49
 */

/* @var $model \modules\shop\models\ServiceBenefit */
/* @var $type string */
?>

<div class="benefit">
    <div class="js-delete-benefit" data-id="<?= $model->id ?>" data-type="<?= $type ?>">
        <span class="glyphicon glyphicon-trash"></span>
    </div>
    <div class="title"><?= $model->name ?></div>
    <div class="text"><?= $model->text ?></div>
</div>
