<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 03.12.2018
 * Time: 14:45
 */
/* @var $model \modules\shop\models\Payment */
?>
<div class="section">
    <div class="bg-head--error gradient">
        <div class="content content--sm">
            <?php if ($model->status === \modules\shop\models\Payment::STATUS_COMPLETE): ?>
                <h1 class="title-sm">Заказ оплачен</h1>
                <h2 class="subtitle">Заказ #<?= $model->order->id ?> успешно оплачен. Скоро мы свяжемся с вами.</h2>
            <?php else: ?>
                <h1 class="title-sm">Ошибка</h1>
                <?php if ($model->reason): ?>
                    <h2 class="subtitle">При оплате произошла ошибка: <?= $model->getReasonName() ?></h2>
                <?php else: ?>
                    <h2 class="subtitle">Заказ #<?= $model->order->id ?> не был оплачен</h2>
                <?php endif; ?>
            <?php endif; ?>
            <div class="actions">
                <?= \yii\helpers\Html::a('Вернуться к заказам', \yii\helpers\Url::to('/profile/orders'), ['class' => 'btn']) ?>
                <?php if ($model->status === \modules\shop\models\Payment::STATUS_COMPLETE): ?>
                    <?= \yii\helpers\Html::a('Вернуться на главную', \yii\helpers\Url::to('/'), ['class' => 'btn']) ?>
                <?php else: ?>
                    <?= \yii\helpers\Html::a('Оплатить повторно', \yii\helpers\Url::to(['/shop/payment/index', 'order' => $model->order->id]), ['class' => 'btn']) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>