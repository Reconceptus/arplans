<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 12.10.2018
 * Time: 15:41
 */

/* @var $model \modules\partner\models\About */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'О компании';
?>
<h1><?= $this->title ?></h1>

<? $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'about_main_image')->fileInput(['accept' => 'image/*']) ?>
<? if ($model->about_main_image): ?>
    <div class="image-admin-preview">
        <?= Html::img($model->about_main_image, ['class' => 'img-admin']) ?>
    </div>
<? endif; ?>
<div class="clearfix"></div>
<br/>
<div class="post-form">
    <div class="row">
        <div class="col-md-6">
            <?= Html::hiddenInput('old_image', $model->about_main_image) ?>
            <?= Html::hiddenInput('new-benefits', '', ['class' => 'new-benefits-input']) ?>
            <?= $form->field($model, 'about_title') ?>
            <?= $form->field($model, 'hot_line') ?>
            <?= $form->field($model, 'phone') ?>
            <?= $form->field($model, 'email') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'vk') ?>
            <?= $form->field($model, 'fb') ?>
            <?= $form->field($model, 'instagram') ?>
            <?= $form->field($model, 'main_office_address') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= \frontend\widgets\benefit\Benefit::widget(['model' => $model, 'type' => 'partner/about']) ?>
        </div>
    </div>


    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
    <? ActiveForm::end() ?>

    <div class="buttons-panel">
        <?= Html::a('cancel', Url::to('/admin/modules/partner/builder'), ['class' => 'btn btn-admin']) ?>
        <?= Html::a('На сайте', Url::to('/about'), ['target' => '_blank', 'class' => 'btn btn-admin']) ?>
    </div>
</div>