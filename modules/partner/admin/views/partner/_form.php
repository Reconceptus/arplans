<?php

use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


/* @var $model \modules\partner\models\Partner */
/* @var $categories \modules\shop\models\Category[] */

$this->title = $model->isNewRecord ? 'Добавление партнера' : 'Редактирование партнера';
$viewPostClass = $model->isNewRecord ? 'btn btn-admin disabled' : 'btn btn-admin';
?>
<h1><?= $this->title ?></h1>
<?php if (!$model->isNewRecord): ?>
   <?=Html::a('Скачать конфиг', Url::to(['/admin/modules/partner/partner/config','id'=>$model->id]), ['class' => 'btn btn-admin add-big-button'])?>

    <div class="row">
        <div class="col-md-6">
            <?php foreach ($categories as $category): ?>
                <div class="form-group">
                    <?= Html::checkbox($category->slug, $category->isAllowToPartner($model->id), ['id' => $category->slug, 'class' => 'js-category-checkbox', 'data-category' => $category->id, 'data-partner' => $model->id]) ?>
                    <?= Html::label($category->name, '#' . $category->slug) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif;?>

<?php $form = ActiveForm::begin(['method' => 'post']); ?>
<div class="post-form">
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'url') ?>
            <?= $form->field($model, 'api_url') ?>
            <?= $form->field($model, 'contract') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'contacts') ?>
            <?= $form->field($model, 'is_active')->checkbox() ?>
            <?= $form->field($model, 'send_notify')->checkbox() ?>
            <?= $form->field($model, 'agent_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'username'), ['prompt' => '']) ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
<?php ActiveForm::end() ?>

<div class="buttons-panel">
    <?= Html::a('cancel', Url::to('/admin/modules/partner/partner'), ['class' => 'btn btn-admin']) ?>
</div>
