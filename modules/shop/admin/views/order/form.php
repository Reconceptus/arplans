<?php

use yii\widgets\ActiveForm;

/* @var $model \modules\shop\models\Order */
$this->title = 'Заказ #' . $model->id;
?>
    <h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="post-form">
        <table class="table table-bordered table-striped">
            <tr>
                <td>Номер заказа</td>
                <td><?= $model->id ?></td>
            </tr>
            <tr>
                <td>ФИО заказчика</td>
                <td><?= $model->fio ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= $model->email ?></td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td><?= $model->phone ?></td>
            </tr>
            <tr>
                <td>Страна</td>
                <td><?= $model->country ?></td>
            </tr>
            <tr>
                <td>Город</td>
                <td><?= $model->city ?></td>
            </tr>
            <tr>
                <td>Адрес</td>
                <td><?= $model->address ?></td>
            </tr>
            <tr>
                <td>Дата и время</td>
                <td><?= $model->created_at ?></td>
            </tr>
            <tr>
                <td>Комментарий</td>
                <td><?= $model->village ?></td>
            </tr>
        </table>
        <p style="font-weight: bold">Товары</p>
        <table class="table table-bordered table-striped">
            <tr>
                <th>#</th>
                <th>Проект</th>
                <th>Альбомов</th>
                <th>Цена</th>
                <th>Комментарий</th>
            </tr>
            <?php foreach ($model->orderItems as $k => $item): ?>
                <tr>
                    <td><?= $k + 1 ?></td>
                    <td><?= $item->item->name ?></td>
                    <td><?= $item->count ?></td>
                    <td><?= $item->price ?></td>
                    <td><?= $item->comment ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php if ($model->services): ?>
            <p style="font-weight: bold">Услуги</p>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>#</th>
                    <th>Услуга</th>
                    <th>Цена</th>
                </tr>
                <?php foreach ($model->orderServices as $k => $service): ?>
                    <tr>
                        <th><?= $k + 1 ?></th>
                        <th><?= $service->service->name ?></th>
                        <th><?= $service->price ?></th>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'track') ?>
            <?php if ($model->type === \modules\shop\models\Order::TYPE_API): ?>
                <?= $form->field($model, 'payment_status')->dropDownList([0 => 'Не оплачен', 1 => 'Оплачен']) ?>
            <?php endif; ?>
            <?= $form->field($model, 'status')->dropDownList(\modules\shop\models\Order::getStatusList()) ?>
        </div>
    </div>
<?= \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-admin']) ?>
<?php ActiveForm::end() ?>