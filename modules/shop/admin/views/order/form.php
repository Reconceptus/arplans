<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 07.09.2018
 * Time: 13:55
 */

use yii\widgets\ActiveForm;

/* @var $model \modules\shop\models\Order */
$this->title = 'Заказ #' . $model->id;
?>
    <h1><?= $this->title ?></h1>

<? $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
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
            <? foreach ($model->orderItems as $k => $item): ?>
                <tr>
                    <td><?= $k + 1 ?></td>
                    <td><?= $item->item->name ?></td>
                    <td><?= $item->count ?></td>
                    <td><?= $item->price ?></td>
                    <td><?= $item->comment ?></td>
                </tr>
            <? endforeach; ?>
        </table>
        <? if ($model->services): ?>
            <p style="font-weight: bold">Услуги</p>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>#</th>
                    <th>Услуга</th>
                    <th>Цена</th>
                </tr>
                <? foreach ($model->orderServices as $k => $service): ?>
                    <tr>
                        <th><?= $k + 1 ?></th>
                        <th><?= $service->service->name ?></th>
                        <th><?= $service->price ?></th>
                    </tr>
                <? endforeach; ?>
            </table>
        <? endif; ?>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'status')->dropDownList(\modules\shop\models\Order::getStatusList()) ?>
        </div>
    </div>
<?= \yii\helpers\Html::submitButton('Сохранить',['class'=>'btn btn-admin']) ?>
<? ActiveForm::end() ?>