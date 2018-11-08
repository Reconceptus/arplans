<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 25.10.2018
 * Time: 14:37
 */

/* @var $models \modules\shop\models\Order[] */
$this->title = 'Мои продажи';
?>

<div class="section site-profile">
    <div class="content content--lg mobile-wide">
        <div class="request--wrap gradient">
            <div class="content content--md">
                <h1 class="title title-lg"><?= $this->title ?></h1>
                <div class="profile-sales">
                    <table>
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>№ ЗАКАЗА</th>
                            <th>Сумма заказ</th>
                            <th>Отчисления</th>
                            <th>Статус отчислений</th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach ($models as $model): ?>
                            <tr>
                                <td><?= date('d.m.Y', strtotime($model->created_at)) ?></td>
                                <td><?= $model->id ?></td>
                                <td><?= $model->price ?></td>
                                <td><?= $model->price / 100 * 5 ?></td>
                                <td><?= $model->payment_status ? 'Оплачено' : 'Не оплачено' ?></td>
                            </tr>
                        <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
