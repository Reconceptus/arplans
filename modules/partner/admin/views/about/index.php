<?php
/* @var $model \modules\partner\models\About */
/* @var $readyProjects \modules\partner\models\AboutReady[] */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'О компании';
?>
<h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'about_main_image')->fileInput(['accept' => 'image/*']) ?>
<?php if ($model->about_main_image): ?>
    <div class="image-admin-preview">
        <?= Html::img($model->about_main_image, ['class' => 'img-admin']) ?>
    </div>
<?php endif; ?>
<div class="clearfix"></div>
<?= $form->field($model, 'share_image')->fileInput(['accept' => 'image/*']) ?>
<?php if ($model->share_image): ?>
    <div class="image-admin-preview">
        <?= Html::img($model->share_image, ['class' => 'img-admin']) ?>
    </div>
<?php endif; ?>
<div class="clearfix"></div>
<br/>
<div class="post-form">
    <div class="row">
        <div class="col-md-6">
            <?= Html::hiddenInput('old_share_image', $model->share_image) ?>
            <?= Html::hiddenInput('old_image', $model->about_main_image) ?>
            <?= Html::hiddenInput('new-benefits', '', ['class' => 'new-benefits-input']) ?>
            <?= Html::hiddenInput('new-ready', '', ['class' => 'new-ready-input']) ?>
            <?= $form->field($model, 'about_title') ?>
            <?= $form->field($model, 'hot_line') ?>
            <?= $form->field($model, 'phone') ?>
            <?= $form->field($model, 'email') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'vk') ?>
            <?= $form->field($model, 'vk_reviews') ?>
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
    <?php ActiveForm::end() ?>

    <div class="images-block">
        <p style="font-weight: bold">Готовые проекты</p>
        <div class="images-panel">
            <?php foreach ($readyProjects as $project): ?>
                <?= $this->render('_image', ['model' => $project]) ?>
            <?php endforeach; ?>
        </div>
        <div class="clearfix"></div>
        <form name="uploader" enctype="multipart/form-data" method="POST">
            <div class="upload">
                <div class="upload-input">
                    <?= Html::fileInput('images[]', '', ['class' => 'item-image-input', 'multiple' => true, 'accept' => 'image/*']) ?>
                </div>
                <div class="upload-button">
                    <?= Html::submitButton('Загрузить фото', ['class' => 'btn btn-admin add-photo']) ?>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p style="font-weight: bold;">SEO</p>
            <?= $form->field($model, 'about_page_seo_title') ?>
            <?= $form->field($model, 'about_page_seo_description') ?>
            <?= $form->field($model, 'about_page_seo_keywords') ?>
        </div>
    </div>

    <div class="buttons-panel">
        <?= Html::a('cancel', Url::to('/admin/modules/partner/builder'), ['class' => 'btn btn-admin']) ?>
        <?= Html::a('На сайте', Url::to('/about'), ['target' => '_blank', 'class' => 'btn btn-admin']) ?>
    </div>
</div>