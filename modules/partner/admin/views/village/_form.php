<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 19.09.2018
 * Time: 16:33
 */

use common\models\Region;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;


/* @var $model \modules\partner\models\Village */

$this->title = $model->isNewRecord ? 'Добавление поселка' : 'Редактирование поселка';
$viewPostClass = $model->isNewRecord ? 'btn btn-admin disabled' : 'btn btn-admin';
?>
<h1><?= $this->title ?></h1>
<!--Фото товара-->
<div class="images-block" data-type="partner/village">
    <p style="font-weight: bold">Фото</p>
    <div class="images-panel">
        <? foreach ($model->images as $image): ?>
            <?= $this->render('_image', ['model' => $image]) ?>
        <? endforeach; ?>
    </div>
    <div class="clearfix"></div>
    <form name="uploader" enctype="multipart/form-data" method="POST">
        <div class="upload">
            <?= Html::hiddenInput('type', 1) ?>
            <div class="upload-input">
                <?= Html::fileInput('images[]', '', ['class' => 'item-image-input', 'multiple' => true, 'accept' => 'image/*']) ?>
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
        <div class="col-md-6">
            <?= Html::hiddenInput('new-images', '', ['class' => 'new-images-input']) ?>
            <?= Html::hiddenInput('new-benefits', '', ['class' => 'new-benefits-input']) ?>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'is_active')->checkbox() ?>
            <?= $form->field($model, 'is_office')->checkbox() ?>
            <?= $form->field($model, 'no_page')->checkbox() ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-5">
            <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map(Region::find()->all(), 'id', 'name'), ['prompt' => '']) ?>
            <?= $form->field($model, 'phones') ?>
            <?= $form->field($model, 'lat') ?>
            <?= $form->field($model, 'sort') ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'address') ?>
            <?= $form->field($model, 'url') ?>
            <?= $form->field($model, 'lng') ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <?= $form->field($model, 'logo')->fileInput(['accept' => 'image/*']) ?>
            <? if ($model->logo): ?>
                <div class="image-admin-preview">
                    <?= Html::img($model->logo, ['class' => 'img-admin']) ?>
                </div>
            <? endif; ?>
        </div>
    </div>
    <div class="project-block">
        <? if ($model->price_list): ?>
            <div class="old-project">
                <p style="font-weight: bold">Прайслист</p>
                <?= Html::a('Скачать', Url::to($model->price_list), ['class' => 'btn btn-admin']) ?>
                <div class="js-show-project-field btn btn-admin">Заменить</div>
            </div>
        <? endif; ?>
        <div class="item-project-field" <?= $model->price_list ? 'style="display:none;"' : '' ?>>
            <?= $form->field($model, 'price_list')->fileInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= \frontend\widgets\benefit\Benefit::widget(['model' => $model, 'type' => 'partner/village']) ?>
        </div>
    </div>
    <?= $form->field($model, 'description')->textarea()->widget(Widget::className(), [
        'settings' => [
            'lang'                     => 'ru',
            'minHeight'                => 200,
            'imageUpload'              => Url::to(['village/image-upload']),
            'imageUploadErrorCallback' => new JsExpression('function (response) { alert("При загрузке произошла ошибка! Максимальная ширина изображения 1200px, высота - 1000px."); }'),
            'buttons'                  => ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'link', 'image'],
            'plugins'                  => [
                'fullscreen',
                'imagemanager',
                'video'
            ],
        ]]) ?>
    <div class="row">
        <p class="check-title">Инженерные сети</p>
        <div class="checkbox-panel">
            <div class="col-sm-4">
                <?= $form->field($model, 'electric')->checkbox() ?>
                <?= $form->field($model, 'gas')->checkbox() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'water')->checkbox() ?>
                <?= $form->field($model, 'internet')->checkbox() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'gas_boiler')->checkbox() ?>
            </div>
        </div>
    </div>
    <div class="row">
        <p class="check-title">Инфраструктура</p>
        <div class="checkbox-panel">
            <div class="col-sm-4">
                <?= $form->field($model, 'shop')->checkbox() ?>
                <?= $form->field($model, 'children_club')->checkbox() ?>
                <?= $form->field($model, 'golf_club')->checkbox() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'sports_center')->checkbox() ?>
                <?= $form->field($model, 'sports_ground')->checkbox() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'beach')->checkbox() ?>
                <?= $form->field($model, 'life_service')->checkbox() ?>
            </div>
        </div>
    </div>
    <div class="row">
        <p class="check-title">Безопасность</p>
        <div class="checkbox-panel">
            <div class="col-sm-4">
                <?= $form->field($model, 'territory_control')->checkbox() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'fire_alarm')->checkbox() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'security_alarm')->checkbox() ?>
            </div>
        </div>
    </div>
    <div class="row">
        <p class="check-title">Экология</p>
        <div class="checkbox-panel">
            <div class="col-sm-4">
                <?= $form->field($model, 'forest')->checkbox() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'reservoir')->checkbox() ?>
            </div>
        </div>
    </div>
</div>
<div class="post-form" style="margin-top: 40px;">
    <?= $form->field($model, 'seo_title') ?>
    <?= $form->field($model, 'seo_keywords') ?>
    <?= $form->field($model, 'seo_description') ?>
</div>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
<? ActiveForm::end() ?>

<div class="buttons-panel" title="<?= $model->isNewRecord ? 'Поселок еще не добавлен' : '' ?>">
    <?= Html::a('cancel', Url::to('/admin/modules/partner/village'), ['class' => 'btn btn-admin']) ?>
    <?= Html::a('На сайте', Url::to('/village/' . $model->slug), ['target' => '_blank', 'class' => $viewPostClass]) ?>
</div>
