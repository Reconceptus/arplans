<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 14:25
 */

use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;


/* @var $model \modules\shop\models\Item */
/* @var $catalogs \modules\shop\models\Catalog[] */

$this->title = $model->isNewRecord ? 'Добавление товара' : 'Редактирование товара';
$viewPostClass = $model->isNewRecord ? 'btn btn-admin disabled' : 'btn btn-admin';
$rooms = [
    1 => '1',
    2 => '2',
    3 => '3',
    4 => '4',
    5 => '5',
    6 => '6+',
];

$bathrooms = [
    1 => '1',
    2 => '2',
    3 => '3',
    4 => '4',
    5 => '5',
];
?>
<h1><?= $this->title ?></h1>
<!--Фото товара-->
<div class="images-block">
    <p style="font-weight: bold">Фото</p>
    <div class="images-panel">
        <? foreach ($model->images as $image): ?>
            <? if ($image->type == \modules\shop\models\ItemImage::TYPE_PHOTO): ?>
                <?= $this->render('_image', ['model' => $image]) ?>
            <? endif; ?>
        <? endforeach; ?>
    </div>
    <div class="clearfix"></div>
    <form name="uploader" enctype="multipart/form-data" method="POST">
        <div class="upload">
            <?= Html::hiddenInput('type', \modules\shop\models\ItemImage::TYPE_PHOTO) ?>
            <div class="upload-input">
                <?= Html::fileInput('images[]', '', ['class' => 'item-image-input', 'multiple' => true, 'accept' => 'image/*']) ?>
            </div>
            <div class="upload-button">
                <?= Html::submitButton('Загрузить фото', ['class' => 'btn btn-admin add-photo']) ?>
            </div>
        </div>
    </form>
</div>
<!--План товара-->
<div class="images-block">
    <p style="font-weight: bold">План</p>
    <div class="images-panel">
        <? foreach ($model->images as $image): ?>
            <? if ($image->type == \modules\shop\models\ItemImage::TYPE_PLAN): ?>
                <?= $this->render('_image', ['model' => $image]) ?>
            <? endif; ?>
        <? endforeach; ?>
    </div>
    <div class="clearfix"></div>
    <form name="uploader" enctype="multipart/form-data" method="POST">
        <div class="upload">
            <?= Html::hiddenInput('type', \modules\shop\models\ItemImage::TYPE_PLAN) ?>
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
        <div class="col-md-5">
            <?= Html::hiddenInput('new-images', '', ['class' => 'new-images-input']) ?>
            <?= Html::hiddenInput('new-plans', '', ['class' => 'new-plans-input']) ?>
            <?= Html::hiddenInput('new-ready', '', ['class' => 'new-ready-input']) ?>

            <span class="hidden"><?= $form->field($model, 'category_id')->hiddenInput()->label(false) ?></span>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'is_active')->checkbox() ?>
            <?= $form->field($model, 'price') ?>
            <?= $form->field($model, 'discount') ?>
            <?= $form->field($model, 'live_area') ?>
            <?= $form->field($model, 'useful_area') ?>
            <?= $form->field($model, 'common_area') ?>
            <?= $form->field($model, 'exact_gab') ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'rooms')->dropDownList($rooms) ?>
            <?= $form->field($model, 'bathrooms')->dropDownList($bathrooms) ?>
            <?= $form->field($model, 'video') ?>
            <?= $form->field($model, 'sort')->textInput(['type' => 'number']) ?>
            <? foreach ($catalogs as $catalog): ?>
                <?
                $iO = $model->getItemOptionCatalogItem($catalog->id);
                $iOid = $iO ? $iO->id : null;
                $items = \yii\helpers\ArrayHelper::map($catalog->catalogItems, 'id', 'name')
                ?>
                <? if ($catalog->catalogItems): ?>
                    <div class="form-group">
                        <label class="control-label"><?= $catalog->name ?></label>
                        <?= Html::dropDownList(
                            'Catalogs[' . $catalog->id . ']',
                            $iOid,
                            $items,
                            ['prompt' => 'Не выбрано', 'class' => 'form-control']) ?>
                    </div>
                <? endif; ?>
            <? endforeach; ?>
        </div>
    </div>
    <p style="font-weight: bold; margin-top: 30px;">Этажность</p>
    <div class="checkbox-panel row">
        <div class="col-sm-4"><?= $form->field($model, 'one_floor')->checkbox() ?></div>
        <div class="col-sm-4"><?= $form->field($model, 'two_floor')->checkbox() ?></div>
    </div>
    <p style="font-weight: bold; margin-top: 30px;">Удобства</p>
    <div class="checkbox-panel row">
        <div class="col-sm-4">
            <?= $form->field($model, 'mansard')->checkbox() ?>
            <?= $form->field($model, 'pedestal')->checkbox() ?>
            <?= $form->field($model, 'cellar')->checkbox() ?>
            <?= $form->field($model, 'garage')->checkbox() ?>
            <?= $form->field($model, 'double_garage')->checkbox() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'tent')->checkbox() ?>
            <?= $form->field($model, 'terrace')->checkbox() ?>
            <?= $form->field($model, 'balcony')->checkbox() ?>
            <?= $form->field($model, 'light2')->checkbox() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'pool')->checkbox() ?>
            <?= $form->field($model, 'sauna')->checkbox() ?>
            <?= $form->field($model, 'gas_boiler')->checkbox() ?>
            <?= $form->field($model, 'is_new')->checkbox() ?>
        </div>
    </div>
    <?= $form->field($model, 'description')->textarea()->widget(Widget::className(), [
        'settings' => [
            'lang'                     => 'ru',
            'minHeight'                => 200,
            'imageUpload'              => Url::to(['post/image-upload']),
            'imageUploadErrorCallback' => new JsExpression('function (response) { alert("При загрузке произошла ошибка! Максимальная ширина изображения 1200px, высота - 1000px."); }'),
            'buttons'                  => ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'link', 'image'],
            'plugins'                  => [
                'fullscreen',
                'imagemanager',
                'video'
            ],
        ]]) ?>

    <?= $form->field($model, 'build_price')->textarea()->widget(Widget::className(), [
        'settings' => [
            'lang'                     => 'ru',
            'minHeight'                => 200,
            'imageUpload'              => Url::to(['post/image-upload']),
            'imageUploadErrorCallback' => new JsExpression('function (response) { alert("При загрузке произошла ошибка! Максимальная ширина изображения 1200px, высота - 1000px."); }'),
            'buttons'                  => ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'link', 'image'],
            'plugins'                  => [
                'fullscreen',
                'imagemanager',
                'video'
            ],
        ]]) ?>
    <div class="project-block">
        <? if ($model->project): ?>
            <div class="old-project">
                <p style="font-weight: bold">Бесплатный проект</p>
                <?= Html::a('Скачать', Url::to($model->project), ['class' => 'btn btn-admin']) ?>
                <div class="js-show-project-field btn btn-admin">Заменить</div>
            </div>
        <? endif; ?>
        <div class="item-project-field" <?= $model->project ? 'style="display:none;"' : '' ?>>
            <?= $form->field($model, 'project')->fileInput() ?>
        </div>
    </div>
</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
<? ActiveForm::end() ?>
<div class="images-block">
    <p style="font-weight: bold">Фото готового дома</p>
    <div class="images-panel">
        <? foreach ($model->images as $image): ?>
            <? if ($image->type == \modules\shop\models\ItemImage::TYPE_READY): ?>
                <?= $this->render('_image', ['model' => $image]) ?>
            <? endif; ?>
        <? endforeach; ?>
    </div>
    <div class="clearfix"></div>
    <form name="uploader" enctype="multipart/form-data" method="POST">
        <div class="upload">
            <?= Html::hiddenInput('type', \modules\shop\models\ItemImage::TYPE_READY) ?>
            <div class="upload-input">
                <?= Html::fileInput('images[]', '', ['class' => 'item-image-input', 'multiple' => true, 'accept' => 'image/*']) ?>
            </div>
            <div class="upload-button">
                <?= Html::submitButton('Загрузить фото', ['class' => 'btn btn-admin add-photo']) ?>
            </div>
        </div>
    </form>
</div>
<div class="post-form">
    <?= $form->field($model, 'seo_title') ?>
    <?= $form->field($model, 'seo_keywords') ?>
    <?= $form->field($model, 'seo_description') ?>
</div>
<?= Html::a('Клонировать', Url::to(['/admin/modules/shop/item/clone', 'id' => $model->id]), ['target' => '_blank', 'class' => $viewPostClass]) ?>
<div class="buttons-panel" title="<?= $model->isNewRecord ? 'Товар еще не добавлен' : '' ?>">
    <?= Html::a('cancel', Url::to('/admin/modules/shop/item'), ['class' => 'btn btn-admin']) ?>
    <?= Html::a('На сайте', Url::to('/shop/' . $model->category->slug . '/' . $model->slug), ['target' => '_blank', 'class' => $viewPostClass]) ?>
</div>
