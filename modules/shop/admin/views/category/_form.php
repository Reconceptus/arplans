<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 10:53
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $model \modules\shop\models\Category */

$this->title = $model->isNewRecord ? 'Создание категории' : 'Редактирование категории';
$viewPostClass = $model->isNewRecord ? 'btn btn-admin disabled' : 'btn btn-admin';
?>
<h1><?= $this->title ?></h1>

<? $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="post-form">
    <?= Html::hiddenInput('old-image', $model->image, ['class' => 'old-image-input']) ?>
    <?= $form->field($model, 'slug') ?>
    <div class="preview-image-block" data-id="<?= $model->id ?>">
        <?
        if ($model->image && file_exists(Yii::getAlias('@webroot', $model->image))) {
            echo Html::img($model->image, ['class' => 'img-responsive preview-image']);
            echo Html::button('удалить изображение', ['class' => 'btn btn-admin js-delete-preview', 'data-type' => 'category']);
        }
        ?>
        <?= $form->field($model, 'image')->fileInput(['accept' => 'image/*', 'id' => 'preview_image']) ?>
    </div>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'sort')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
<? ActiveForm::end() ?>
<div class="buttons-panel" title="<?= $model->isNewRecord ? 'Категория еще не добавлена' : '' ?>">
    <?= Html::button('cancel', ['class' => 'btn btn-admin']) ?>
    <?= Html::a('На сайт', Url::to('/shop/' . $model->slug), ['target' => '_blank', 'class' => $viewPostClass]) ?>
</div>