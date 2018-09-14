<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 13:43
 */

use common\models\Post;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $model \common\models\Post */
/* @var $tags array */

$this->title = $model->isNewRecord ? 'Добавление поста' : 'Редактирование поста';
$viewPostClass = $model->isNewRecord || !$model->status ? 'btn btn-admin disabled' : 'btn btn-admin';
?>
<h1><?= $this->title ?></h1>

<? $form = ActiveForm::begin([
    'id'      => 'edit-post-form',
    'method'  => 'post',
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>
<div class="post-form">
    <?= Html::hiddenInput('old-image', $model->image, ['class' => 'old-image-input']) ?>
    <?= $form->field($model, 'slug', ['enableAjaxValidation' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList([Post::STATUS_PUBLISHED => 'опубликована', Post::STATUS_NOT_PUBLISHED => 'скрыта']) ?>
    <div class="preview-image-block" data-id="<?= $model->id ?>">
        <?
        if ($model->image && file_exists(Yii::getAlias('@webroot', $model->image))) {
            echo Html::img($model->image, ['class' => 'img-responsive preview-image']);
            echo Html::button('Удалить изображение', ['class' => 'btn btn-admin js-delete-preview']);
        }
        ?>
        <?= $form->field($model, 'image')->fileInput(['accept' => 'image/*', 'id' => 'preview_image']) ?>
    </div>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'on_main')->checkbox() ?>
    <?= $form->field($model, 'to_menu')->checkbox() ?>
    <div class="form-group field-post-slug">
        <label class="control-label" for="tags">Теги (через запятую)</label>
        <?= Html::input('string', 'tags[ru]', $tags, ['class' => 'form-control', 'id' => 'tags']) ?>
    </div>

    <?= $form->field($model, 'text')->textarea()->widget(Widget::className(), [
        'settings' => [
            'lang'                     => 'ru',
            'minHeight'                => 200,
            'imageUpload'              => Url::to(['/admin/modules/blog/post/image-upload']),
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

<?= Html::submitButton('Save', ['class' => 'btn btn-admin save-post']) ?>
<? ActiveForm::end() ?>
<div class="buttons-panel" title="<?= $model->isNewRecord || !$model->status ? 'Пост еще не был опубликован' : '' ?>">
    <?= Html::button('cancel', ['class' => 'btn btn-admin']) ?>
    <?= Html::a('На сайте', Url::to('/blog/' . $model->slug), ['target' => '_blank', 'class' => $viewPostClass]) ?>
</div>