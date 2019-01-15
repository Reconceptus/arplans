<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 23.10.2018
 * Time: 16:54
 */

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

<? $form = ActiveForm::begin(['method' => 'post']); ?>
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
<? ActiveForm::end() ?>

<div class="buttons-panel">
    <?= Html::a('cancel', Url::to('/admin/modules/partner/partner'), ['class' => 'btn btn-admin']) ?>
</div>
