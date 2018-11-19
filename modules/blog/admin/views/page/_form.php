<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 13:43
 */

use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $model \common\models\Page */
/* @var $tags array */

$this->title = $model->isNewRecord ? 'Создание страницы' : 'Редактирование страницы';
$viewPostClass = $model->isNewRecord ? 'btn btn-admin disabled' : 'btn btn-admin';
?>
<h1><?= $this->title ?></h1>

<? $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="post-form">
<!--    --><?//= Html::hiddenInput('old-image', $model->image, ['class' => 'old-image-input']) ?>
    <?= $form->field($model, 'slug') ?>
<!--    <div class="preview-image-block" data-id="--><?//= $model->id ?><!--">-->
<!--        --><?//
//        if ($model->image && file_exists(Yii::getAlias('@webroot', $model->image))) {
//            echo Html::img($model->image, ['class' => 'img-responsive preview-image']);
//            echo Html::button('удалить изображение', ['class' => 'btn btn-admin js-delete-preview-page']);
//        }
//        ?>
<!--        --><?//= $form->field($model, 'image')->fileInput(['accept' => 'image/*', 'id' => 'preview_image']) ?>
<!--    </div>-->

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'text')->textarea()->widget(Widget::className(), [
        'settings' => [
            'lang'                     => Yii::$app->language,
            'minHeight'                => 200,
            'imageUpload'              => Url::to(['/admin/modules/blog/page/image-upload']),
            'imageUploadErrorCallback' => new JsExpression('function (response) { alert("При загрузке произошла ошибка! Максимальная ширина изображения 1200px, высота - 1000px."); }'),
            'buttons'                  => ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'link', 'image'],
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

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
<? ActiveForm::end() ?>
<div class="buttons-panel" title="<?= $model->isNewRecord ? 'Страница еще не опубликована' : '' ?>">
    <?= Html::button('cancel', ['class' => 'btn btn-admin']) ?>
    <?= Html::a('На сайт', Url::to('/page/' . $model->slug), ['target' => '_blank', 'class' => $viewPostClass]) ?>
</div>