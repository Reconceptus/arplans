<?php

use modules\shop\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


/* @var $model \modules\shop\models\Catalog */

$this->title = $model->isNewRecord ? 'Добавление фильтра' : 'Редактирование фильтра';
$viewPostClass = $model->isNewRecord ? 'btn btn-admin disabled' : 'btn btn-admin';
?>

<h1><?= $this->title ?></h1>

<div class="post-form">
    <div class="row catalog-panel">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin([
                'method'               => 'post',
                'options'              => ['enctype' => 'multipart/form-data'],
                'id'                   => 'admin-catalog-form',
                'enableAjaxValidation' => true
            ]); ?>
            <?php if ($model->isNewRecord): ?>
                <?php $categories = Category::getList() ?>
                <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Все категории', 'class' => 'cat-category form-control']) ?>
            <?php endif; ?>

            <?= $form->field($model, 'slug')->textInput(['class' => 'cat-slug form-control']) ?>
            <?= $form->field($model, 'name')->textInput(['class' => 'cat-name form-control']) ?>
            <?= $form->field($model, 'sort')->textInput(['type' => 'number', 'class' => 'cat-sort form-control']) ?>
            <?= $form->field($model, 'filter')->checkbox() ?>
            <?= $form->field($model, 'basic')->checkbox() ?>
            <?php if ($model->isNewRecord): ?>
                <div class="btn btn-admin js-save-catalog">Сохранить</div>
            <?php else: ?>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin']) ?>
            <?php endif; ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
    <div class="row filter-panel <?= $model->isNewRecord ? 'hidden' : '' ?>">
        <span id="catalog-id-span" data-id="<?= $model->isNewRecord ? 0 : $model->id ?>"></span>
        <h3>Добавить варианты значений</h3>
        <?php foreach ($model->catalogItems as $catalogItem): ?>
            <div class="filter" data-id="<?= $catalogItem->id ?>">
                <div class="js-delete-ci">
                    <span class="glyphicon glyphicon-trash"></span>
                </div>
                <?= Html::a('<span>' . $catalogItem->name . '</span>', Url::to(['/admin/modules/shop/catalog/update-item', 'id' => $catalogItem->id])) ?>
            </div>
        <?php endforeach; ?>
        <div class="filter add js-add-filter">
            <span class="glyphicon glyphicon-plus"></span>
        </div>
    </div>
</div>

<div class="buttons-panel" title="<?= $model->isNewRecord ? 'Фильтр еще не добавлен' : '' ?>">
    <?= Html::a('Cancel', Url::to('/admin/modules/shop/catalog'), ['class' => 'btn btn-admin']) ?>
    <?= Html::a('На сайт', Url::to('/shop'), ['target' => '_blank', 'class' => $viewPostClass]) ?>
</div>