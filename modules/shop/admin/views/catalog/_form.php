<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 14:25
 */

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
            <? $form = ActiveForm::begin([
                'method'               => 'post',
                'options'              => ['enctype' => 'multipart/form-data'],
                'id'                   => 'admin-catalog-form',
                'enableAjaxValidation' => true
            ]); ?>
            <? if ($model->isNewRecord): ?>
                <? $categories = Category::getList() ?>
                <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Все категории', 'class' => 'cat-category form-control']) ?>
            <? endif; ?>

            <?= $form->field($model, 'slug')->textInput(['class' => 'cat-slug form-control']) ?>
            <?= $form->field($model, 'name')->textInput(['class' => 'cat-name form-control']) ?>
            <?= $form->field($model, 'sort')->textInput(['type' => 'number', 'class' => 'cat-sort form-control']) ?>
            <?= $form->field($model, 'filter')->checkbox() ?>
            <? if ($model->isNewRecord): ?>
                <div class="btn btn-admin js-save-catalog">Сохранить</div>
            <? else: ?>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin']) ?>
            <? endif; ?>
            <? ActiveForm::end() ?>
        </div>
    </div>
    <div class="row filter-panel <?= $model->isNewRecord ? 'hidden' : '' ?>">
        <span id="catalog-id-span" data-id="<?= $model->isNewRecord ? 0 : $model->id ?>"></span>
        <h3>Добавить варианты значений</h3>
        <? foreach ($model->catalogItems as $catalogItem): ?>
            <div class="filter" data-id="<?= $catalogItem->id ?>">
                <?= Html::a('<span>' . $catalogItem->name . '</span>', Url::to(['catalog/update-item', 'id' => $catalogItem->id])) ?>
            </div>
        <? endforeach; ?>
        <div class="filter add js-add-filter">
            <span class="glyphicon glyphicon-plus"></span>
        </div>
    </div>
</div>

<div class="buttons-panel" title="<?= $model->isNewRecord ? 'Фильтр еще не добавлен' : '' ?>">
    <?= Html::button('cancel', ['class' => 'btn btn-admin']) ?>
    <?= Html::a('На сайт', Url::to('/shop'), ['target' => '_blank', 'class' => $viewPostClass]) ?>
</div>