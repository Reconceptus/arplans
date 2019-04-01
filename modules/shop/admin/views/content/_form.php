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
    <div class="post-form" style="margin-top: 30px;">
        <?php if ($model->isNewRecord): ?>
            <?= $form->field($model, 'page') ?>
            <?= $form->field($model, 'page_title') ?>
            <?= $form->field($model, 'page_url') ?>
            <?= $form->field($model, 'slug') ?>
            <?= $form->field($model, 'name') ?>
        <?php else: ?>
            <p style="font-weight: bold"><?= $model->name ?></p>
        <?php endif; ?>
        <?= $form->field($model, 'text')->textarea(['rows' => 4])->label(false) ?>
    </div>

<?= Html::submitButton('Save', ['class' => 'btn btn-admin']) ?>
<?php ActiveForm::end() ?>