<?php

use modules\shop\models\Catalog;
use modules\shop\models\Selection;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $catalogs Catalog[] */
/* @var $model modules\shop\models\Selection */
/* @var $form yii\widgets\ActiveForm */
$this->title = $model->isNewRecord ? 'Добавление подборки' : 'Редактирование подборки';
?>

<h1><?= $this->title ?></h1>
<div class="selection-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-xs-5">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'status')->dropDownList(Selection::STATUS_LIST) ?>
        </div>
        <div class="col-xs-5">
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-10">
            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-5">
            <?= $form->field($model, 'min_price')->textInput(['type' => 'number', 'step' => 1]) ?>
        </div>
        <div class="col-xs-5">
            <?= $form->field($model, 'max_price')->textInput(['type' => 'number', 'step' => 1]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-5">
            <?= $form->field($model, 'min_bedrooms')->textInput(['type' => 'number', 'step' => 1]) ?>
        </div>
        <div class="col-xs-5">
            <?= $form->field($model, 'max_bedrooms')->textInput(['type' => 'number', 'step' => 1]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-5">
            <?= $form->field($model, 'min_bathrooms')->textInput(['type' => 'number', 'step' => 1]) ?>
        </div>
        <div class="col-xs-5">
            <?= $form->field($model, 'max_bathrooms')->textInput(['type' => 'number', 'step' => 1]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-5">
            <?= $form->field($model, 'min_area')->textInput(['type' => 'number', 'step' => 1]) ?>
        </div>
        <div class="col-xs-5">
            <?= $form->field($model, 'max_area')->textInput(['type' => 'number', 'step' => 1]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'one_floor')->checkbox() ?>

            <?= $form->field($model, 'two_floor')->checkbox() ?>

            <?= $form->field($model, 'mansard')->checkbox() ?>

            <?= $form->field($model, 'cellar')->checkbox() ?>

            <?= $form->field($model, 'garage')->checkbox() ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'double_garage')->checkbox() ?>

            <?= $form->field($model, 'tent')->checkbox() ?>

            <?= $form->field($model, 'terrace')->checkbox() ?>

            <?= $form->field($model, 'balcony')->checkbox() ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'light2')->checkbox() ?>

            <?= $form->field($model, 'pool')->checkbox() ?>

            <?= $form->field($model, 'sauna')->checkbox() ?>

            <?= $form->field($model, 'gas_boiler')->checkbox() ?>
        </div>
    </div>
    <?php if ($catalogs): ?>
        <div class="row">
            <div class="grid-2-col col-xs-12">
                <?php foreach ($catalogs as $catalog): ?>
                    <?php $iO = $model->getSelectionOptionCatalogItem($catalog->id);
                    $iOid = $iO ? $iO->id : null;
                    $items = ArrayHelper::map($catalog->catalogItems, 'id', 'name')
                    ?>
                    <?php if ($catalog->catalogItems): ?>
                        <div class="form-group">
                            <label class="control-label"><?= $catalog->name ?></label>
                            <?= Html::dropDownList(
                                'Catalogs['.$catalog->id.']',
                                $iOid,
                                $items,
                                ['prompt' => 'Не выбрано', 'class' => 'form-control']) ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!$model->isNewRecord): ?>
        <div class="row">
            <div class="col-xs-3">
                <?= Html::checkbox('recollect', false, ['label' => 'Пересобрать подборку']) ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
