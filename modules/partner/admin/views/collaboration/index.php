<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 12.10.2018
 * Time: 15:41
 */

/* @var $model \modules\partner\models\Collaboration */

/* @var $readyProjects \modules\partner\models\AboutReady[] */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Сотрудничество';
?>
<h1><?= $this->title ?></h1>

<? $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<?= Html::hiddenInput('old_collaboration_image_1', $model->collaboration_image_1) ?>
<?= Html::hiddenInput('old_collaboration_image_2', $model->collaboration_image_2) ?>
<?= Html::hiddenInput('old_collaboration_image_3', $model->collaboration_image_3) ?>

<?= $form->field($model, 'collaboration_image_1')->fileInput(['accept' => 'image/*']) ?>
<? if ($model->collaboration_image_1): ?>
    <div class="image-admin-preview">
        <?= Html::img($model->collaboration_image_1, ['class' => 'img-admin']) ?>
    </div>
<? endif; ?>
<div class="clearfix"></div>
<div class="post-form">
    <div class="row">
        <div class="col-lg-10">
            <?= $form->field($model, 'collaboration_title_1') ?>
            <?= $form->field($model, 'collaboration_text_1')->textarea(['rows' => 4]) ?>
        </div>
    </div>
</div>

<?= $form->field($model, 'collaboration_image_2')->fileInput(['accept' => 'image/*']) ?>
<? if ($model->collaboration_image_2): ?>
    <div class="image-admin-preview">
        <?= Html::img($model->collaboration_image_2, ['class' => 'img-admin']) ?>
    </div>
<? endif; ?>
<div class="post-form">
    <div class="row">
        <div class="col-lg-10">
            <?= $form->field($model, 'collaboration_title_2') ?>
            <?= $form->field($model, 'collaboration_text_2')->textarea(['rows' => 4]) ?>
        </div>
    </div>
</div>

<?= $form->field($model, 'collaboration_image_3')->fileInput(['accept' => 'image/*']) ?>
<? if ($model->collaboration_image_3): ?>
    <div class="image-admin-preview">
        <?= Html::img($model->collaboration_image_3, ['class' => 'img-admin']) ?>
    </div>
<? endif; ?>
<div class="post-form">
    <div class="row">
        <div class="col-lg-10">
            <?= $form->field($model, 'collaboration_title_3') ?>
            <?= $form->field($model, 'collaboration_text_3')->textarea(['rows' => 4]) ?>
        </div>
    </div>
</div>
<div class="post-form">
    <?= $form->field($model, 'collaboration_manager')->dropDownList(\common\models\User::getAuthors()) ?>
</div>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
<? ActiveForm::end() ?>

<div class="buttons-panel">
    <?= Html::a('cancel', Url::to('/admin/modules/partner/builder'), ['class' => 'btn btn-admin']) ?>
    <?= Html::a('На сайте', Url::to('/about'), ['target' => '_blank', 'class' => 'btn btn-admin']) ?>
</div>
</div>