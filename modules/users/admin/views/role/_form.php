<?php /**
 * Created by PhpStorm.
 * User: borod
 * Date: 08.08.2018
 * Time: 15:54
 */

/* @var $role */
/* @var $isNewModel bool */
/* @var $errors array */

/* @var $models array */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Редактирование роли ' . $role->description
?>
<h1><?= $this->title ?></h1>
<?php ActiveForm::begin() ?>
<div class="roles-form">
    <div class="form-group">
        <label class="control-label">Описание роли</label>
        <?= Html::textInput('role[description]', $role->description ?: Yii::$app->request->post('role')['description'], ["class" => "form-control"]) ?>
    </div>
    <?php if (array_key_exists('description', $errors) && is_array($errors['description'])): ?>
        <?php foreach ($errors['description'] as $error): ?>
            <br><?= $error ?>
        <?php endforeach ?>
    <?php endif ?>

    <?php if ($isNewModel): ?>
        <div class="form-group">
            <label class="control-label">Код</label>
            <?= Html::textInput('role[code]', Yii::$app->request->post('role')['code'], ["class" => "form-control"]) ?>
        </div>
        <?php if (array_key_exists('code', $errors) && is_array($errors['code'])): ?>
            <?php foreach ($errors['code'] as $error): ?>
                <br><?= $error ?>
            <?php endforeach ?>
        <?php endif ?>

    <?php endif ?>
    <span class="clear"></span>
    <div class="permissions-list">
        <?php foreach ($models as $model): ?>
            <div class="fll w25">
                <?= Html::checkbox('permissions[' . $model['name'] . ']', $model['assigned'], ['id' => 'permissions_' . $model['name'], 'class' => 'checkbox role-checkbox']) ?>
                <?= Html::label($model['description'], 'permissions_' . $model['name'], ['class' => 'checkbox-label']) ?>
            </div>
        <?php endforeach ?>
    </div>
    <div class="clearfix"></div>
    <?= Html::submitButton('Save', ['class' => 'btn btn-admin']) ?>
</div>
<?php ActiveForm::end() ?>
