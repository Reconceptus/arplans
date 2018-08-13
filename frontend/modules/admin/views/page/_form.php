<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 13:43
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\web\JsExpression;

/* @var $model \common\models\Page */
/* @var $tags array */

$this->title = $model->isNewRecord ? 'Create page' : 'Edit page';
$viewPostClass = $model->isNewRecord ? 'btn btn-admin disabled' : 'btn btn-admin';
?>
<h1><?= $this->title ?></h1>

<? $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="post-form">
    <?= Html::hiddenInput('old-image', $model->image) ?>
    <?= $form->field($model, 'slug') ?>
    <div class="preview-image-block" data-id="<?= $model->id ?>">
        <?
        if ($model->image && file_exists(Yii::getAlias('@webroot', $model->image))) {
            echo Html::img($model->image, ['class' => 'img-responsive preview-image']);
            echo Html::button('delete image', ['class' => 'btn btn-admin js-delete-preview-page']);
        }
        ?>
        <?= $form->field($model, 'image')->fileInput(['accept' => 'image/*', 'id' => 'preview_image']) ?>
    </div>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'text')->textarea()->widget(Widget::className(), [
        'settings' => [
            'lang'                     => Yii::$app->language,
            'minHeight'                => 200,
            'imageUpload'              => Url::to(['page/image-upload']),
            'imageUploadErrorCallback' => new JsExpression('function (response) { alert("An error occurred during the upload process! Max image width 1200px. Max image height 1000px."); }'),
            'buttons'                  => ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'orderedlist', 'link', 'image'],
            'plugins'                  => [
                'fullscreen',
                'imagemanager',
                'video'
            ],
        ]]) ?>
    <div class="seo-form">
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'keywords') ?>
        <?= $form->field($model, 'description')->textarea() ?>
    </div>
</div>

<?= Html::submitButton('Save', ['class' => 'btn btn-admin save-post']) ?>
<? ActiveForm::end() ?>
<div class="buttons-panel" title="<?= $model->isNewRecord ? 'The page was not published' : '' ?>">
    <?= Html::button('cancel', ['class' => 'btn btn-admin']) ?>
    <?= Html::a('Go to page', Url::to('/' . $model->slug), ['target' => '_blank', 'class' => $viewPostClass]) ?>
</div>