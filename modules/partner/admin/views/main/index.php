<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 01.11.2018
 * Time: 12:59
 */

use common\models\User;
use modules\partner\models\Main;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $users User[] */
/* @var $model Main */

$this->title = 'Главная страница';
?>
<h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin(['method' => 'post']); ?>
<?= Html::hiddenInput('old_main_page_photo_1', $model->main_page_photo_1) ?>
<?= Html::hiddenInput('old_main_page_photo_2', $model->main_page_photo_2) ?>
<?= Html::hiddenInput('old_main_page_video_1', $model->main_page_video_1) ?>
<?= Html::hiddenInput('old_main_page_video_2', $model->main_page_video_2) ?>
<div class="post-form">
    <div class="row">
        <div class="col-md-6">
            <p style="font-weight: bold;">Информация на странице</p>
            <?= $form->field($model, 'main_page_offer') ?>
            <?= $form->field($model, 'main_page_offer_annotation')->textarea(['rows' => 4]) ?>
            <?= $form->field($model, 'main_page_text')->textarea(['rows' => 4]) ?>
            <?= $form->field($model, 'main_page_author')->dropDownList($users) ?>
            <?= $form->field($model, 'main_page_description')->textarea(['rows' => 4]) ?>
            <?php if ($model->main_page_video_1): ?>
                <video width="200" height="120" controls="controls">
                    <source src="<?= $model->main_page_video_1 ?>">
                </video>
            <?php endif; ?>
            <?= $form->field($model, 'main_page_video_1')->fileInput(['accept' => 'video/mp4']) ?>
            <?php if ($model->main_page_video_2): ?>
                <video width="200" height="120" controls="controls">
                    <source src="<?= $model->main_page_video_2 ?>">
                </video>
            <?php endif; ?>
            <?= $form->field($model, 'main_page_video_2')->fileInput(['accept' => 'video/webm']) ?>
            <div class="clearfix"></div>
            <?= $form->field($model, 'main_page_photo_1')->fileInput(['accept' => 'image/*']) ?>
            <?php if ($model->main_page_photo_1): ?>
                <div class="image-admin-preview">
                    <?= Html::img($model->main_page_photo_1, ['class' => 'img-admin']) ?>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>
            <?= $form->field($model, 'main_page_photo_2')->fileInput(['accept' => 'image/*']) ?>
            <?php if ($model->main_page_photo_2): ?>
                <div class="image-admin-preview">
                    <?= Html::img($model->main_page_photo_2, ['class' => 'img-admin']) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p style="font-weight: bold;">SEO</p>
            <?= $form->field($model, 'main_page_seo_title') ?>
            <?= $form->field($model, 'main_page_seo_description') ?>
            <?= $form->field($model, 'main_page_seo_keywords') ?>
        </div>
    </div>

    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
    <?php ActiveForm::end() ?>

    <div class="buttons-panel">
        <?= Html::a('cancel', Url::to('/admin/modules/partner/builder'), ['class' => 'btn btn-admin']) ?>
        <?= Html::a('На сайте', Url::to('/'), ['target' => '_blank', 'class' => 'btn btn-admin']) ?>
    </div>
</div>