<?php

use modules\shop\models\Block;
use modules\shop\models\Catalog;
use modules\shop\models\Selection;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $blocks Block[] */
/* @var $catalogs Catalog[] */
/* @var $model modules\shop\models\Selection */
/* @var $form yii\widgets\ActiveForm */
?>

<h1>Редактирование подборки</h1>
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
            <?= $form->field($model, 'block_id')->dropDownList(ArrayHelper::map(Block::find()->all(), 'id', 'name')) ?>
            <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => 10]) ?>
        </div>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>

</div>
