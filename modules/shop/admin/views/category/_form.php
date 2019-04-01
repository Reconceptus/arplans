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

<?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="post-form">

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'sort')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?= $form->field($model, 'seo_title') ?>

    <?= $form->field($model, 'seo_description') ?>

    <?= $form->field($model, 'seo_keywords') ?>
</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
<?php ActiveForm::end() ?>
<div class="buttons-panel" title="<?= $model->isNewRecord ? 'Категория еще не добавлена' : '' ?>">
    <?= Html::a('cancel', Url::to('/admin/modules/shop/category'), ['class' => 'btn btn-admin']) ?>
    <?= Html::a('На сайт', Url::to('/shop/' . $model->slug), ['target' => '_blank', 'class' => $viewPostClass]) ?>
</div>