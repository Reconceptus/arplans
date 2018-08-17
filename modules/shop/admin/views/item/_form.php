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


/* @var $model \modules\shop\models\Item */

$this->title = $model->isNewRecord ? 'Добавление товара' : 'Редактирование товара';
$viewPostClass = $model->isNewRecord ? 'btn btn-admin disabled' : 'btn btn-admin';
?>
<h1><?= $this->title ?></h1>
<div class="images-block">
    <div class="images-panel">
        <? foreach ($model->images as $image): ?>
            <?= $this->render('_image', ['model' => $image]) ?>
        <? endforeach; ?>
    </div>
    <div class="clearfix"></div>
    <form name="uploader" enctype="multipart/form-data" method="POST">
        <div class="upload">
            <div class="upload-input">
                <?= Html::fileInput('ItemImage[image]','',['class'=>'item-image-input']) ?>
            </div>
            <div class="upload-button">
                <?= Html::submitButton('Загрузить фото', ['class' => 'btn btn-admin add-photo']) ?>
            </div>
        </div>
    </form>
</div>

<? $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="post-form">
    <div class="row">
        <div class="col-md-5">
            <?= Html::hiddenInput('new-images', '', ['class' => 'new-images-input']) ?>
            <? if ($model->isNewRecord): ?>
                <?= $form->field($model, 'category_id')->dropDownList(Category::getList()) ?>
            <? endif; ?>

            <?= $form->field($model, 'slug') ?>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'description')->textarea() ?>
            <?= $form->field($model, 'video') ?>
            <?= $form->field($model, 'sort')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'price') ?>
            <?= $form->field($model, 'discount') ?>
            <?= $form->field($model, 'live_area') ?>
            <?= $form->field($model, 'common_area') ?>
            <?= $form->field($model, 'useful_area') ?>
            <?= $form->field($model, 'is_active')->checkbox() ?>
        </div>
    </div>

    <div class="checkbox-panel row">
        <div class="col-sm-4">
            <?= $form->field($model, 'one_floor')->checkbox() ?>
            <?= $form->field($model, 'two_floor')->checkbox() ?>
            <?= $form->field($model, 'mansard')->checkbox() ?>
            <?= $form->field($model, 'pedestal')->checkbox() ?>
            <?= $form->field($model, 'cellar')->checkbox() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'garage')->checkbox() ?>
            <?= $form->field($model, 'double_garage')->checkbox() ?>
            <?= $form->field($model, 'tent')->checkbox() ?>
            <?= $form->field($model, 'terrace')->checkbox() ?>
            <?= $form->field($model, 'balcony')->checkbox() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'light2')->checkbox() ?>
            <?= $form->field($model, 'pool')->checkbox() ?>
            <?= $form->field($model, 'sauna')->checkbox() ?>
            <?= $form->field($model, 'gas_boiler')->checkbox() ?>
            <?= $form->field($model, 'is_new')->checkbox() ?>
        </div>
    </div>

</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
<? ActiveForm::end() ?>
<div class="buttons-panel" title="<?= $model->isNewRecord ? 'Категория еще не добавлена' : '' ?>">
    <?= Html::button('cancel', ['class' => 'btn btn-admin']) ?>
    <?= Html::a('На сайт', Url::to('/shop/' . $model->slug), ['target' => '_blank', 'class' => $viewPostClass]) ?>
</div>
