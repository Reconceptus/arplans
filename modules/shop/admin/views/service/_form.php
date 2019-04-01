<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 05.09.2018
 * Time: 15:20
 */

use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $model \modules\shop\models\Service */

$this->title = $model->isNewRecord ? 'Добавление услуги' : 'Редактирование услуги';
$viewPostClass = $model->isNewRecord ? 'btn btn-admin disabled' : 'btn btn-admin';
?>
<h1><?= $this->title ?></h1>

<?= $this->render('_images', ['model' => $model]) ?>
<?= $this->render('_files', ['model' => $model]) ?>
<?= \frontend\widgets\benefit\Benefit::widget(['model' => $model]) ?>

<?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="post-form">
    <?= Html::hiddenInput('new-images', '', ['class' => 'new-images-input']) ?>
    <?= Html::hiddenInput('new-files', '', ['class' => 'new-files-input']) ?>
    <?= Html::hiddenInput('new-benefits', '', ['class' => 'new-benefits-input']) ?>
    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'preview_text') ?>

    <?= $form->field($model, 'short_description') ?>

    <?= $form->field($model, 'description')->textarea()->widget(Widget::className(), [
        'settings' => [
            'lang'                     => 'ru',
            'minHeight'                => 200,
            'imageUpload'              => Url::to(['/admin/modules/shop/service/image-upload']),
            'imageUploadErrorCallback' => new JsExpression('function (response) { alert("При загрузке произошла ошибка! Максимальная ширина изображения 1200px, высота - 1000px."); }'),
            'buttons'                  => ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'link', 'image'],
            'plugins'                  => [
                'fullscreen',
                'imagemanager',
                'video'
            ],
        ]]) ?>

    <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>
    <?= $form->field($model, 'measure')->textInput() ?>

    <?= $form->field($model, 'in_cart')->checkbox() ?>
    <?= $form->field($model, 'is_active')->checkbox() ?>
    <?= $form->field($model, 'to_main_menu')->checkbox() ?>
</div>
<div class="post-form">
    <?= $form->field($model, 'seo_title') ?>
    <?= $form->field($model, 'seo_keywords') ?>
    <?= $form->field($model, 'seo_description') ?>
</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
<?php ActiveForm::end() ?>

<div class="buttons-panel" title="<?= $model->isNewRecord ? 'Услуга еще не добавлена' : '' ?>">
    <?= Html::a('Отмена', Url::to('/admin/modules/shop/service/'), ['class' => 'btn btn-admin']) ?>
    <?= Html::a('На сайте', Url::to('/shop/service/' . $model->slug), ['target' => '_blank', 'class' => $viewPostClass]) ?>
</div>
