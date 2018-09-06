<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 05.09.2018
 * Time: 15:39
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model \common\models\Config */

$this->title = 'Редактирование параметра';
?>

    <h1><?= $this->title ?></h1>

<? $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="post-form">

        <?= $model->isNewRecord ? $form->field($model, 'slug') : '' ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'value') ?>
    </div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin']) ?>
<? ActiveForm::end() ?>