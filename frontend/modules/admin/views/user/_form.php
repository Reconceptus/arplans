<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 09.08.2018
 * Time: 9:32
 */

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $rolesItems array */

/* @var $userRole */

use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit ' . $model->username
?>
<h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'email') ?>
<div class="form-group">
    <?= Html::label('Пароль', 'password-field', ['class' => 'control-label']) ?>
    <?= Html::textInput('password', '', ['class' => 'form-control', 'id' => 'password-field']) ?>
</div>
<?= $form->field($model, 'status')->dropDownList(User::getStatuses()) ?>
<div class="form-group">
    <?= Html::label('User role', 'userRole', ['class' => 'control-label']) ?>
    <?= Html::dropDownList('userRole', $userRole, $rolesItems, ['class' => 'form-control', 'id' => 'userRole']) ?>
</div>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-admin']) ?>
</div>
<?php ActiveForm::end(); ?>

