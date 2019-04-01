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

<?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="post-form">

        <?= $model->isNewRecord ? $form->field($model, 'slug') : '' ?>
        <?php if (!$model->name): ?>
            параметр <?= $model->slug ?>
            <?= $form->field($model, 'name')->label('Введите название параметра') ?>
        <?php endif; ?>
        <?= $form->field($model, 'value')->label($model->name) ?>
    </div>

<?= Html::submitButton('Save', ['class' => 'btn btn-admin']) ?>
<?php ActiveForm::end() ?>