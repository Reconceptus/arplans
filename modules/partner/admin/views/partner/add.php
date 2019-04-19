<?php

use modules\partner\models\AddPartnerForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $model AddPartnerForm */

$this->title = 'Добавление партнера';
?>
<h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin(['method' => 'post']); ?>
<div class="post-form">
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'fio') ?>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'phone') ?>
            <?= $form->field($model, 'site') ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
<?php ActiveForm::end() ?>

<div class="buttons-panel">
    <?= Html::a('cancel', Url::to('/admin/modules/partner/partner'), ['class' => 'btn btn-admin']) ?>
</div>
