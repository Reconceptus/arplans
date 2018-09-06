<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 05.09.2018
 * Time: 15:20
 */

use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $model \modules\shop\models\Service */

$this->title = $model->isNewRecord ? 'Добавление услуги' : 'Редактирование услуги';
?>
    <h1><?= $this->title ?></h1>

<? $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="post-form">
        <?= $form->field($model, 'slug') ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'preview_text') ?>

        <?= $form->field($model, 'description')->textarea()->widget(Widget::className(), [
            'settings' => [
                'lang'                     => 'ru',
                'minHeight'                => 200,
                'imageUpload'              => Url::to(['/admin/modules/shop/service/image-upload']),
                'imageUploadErrorCallback' => new JsExpression('function (response) { alert("При загрузке произошла ошибка! Максимальная ширина изображения 1200px, высота - 1000px."); }'),
                'buttons'                  => ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'orderedlist', 'link', 'image'],
                'plugins'                  => [
                    'fullscreen',
                    'imagemanager',
                    'video'
                ],
            ]]) ?>

        <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>

        <?= $form->field($model, 'in_cart')->checkbox() ?>
    </div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin']) ?>
<? ActiveForm::end() ?>