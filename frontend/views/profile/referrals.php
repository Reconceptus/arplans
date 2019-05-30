<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 25.10.2018
 * Time: 14:37
 */

use common\models\User;
use modules\shop\models\Order;
use yii\helpers\Html;

/* @var $models Order[] */
/* @var $referrals integer */
/* @var $user User */
$this->title = 'Доходы с реферралов';
$user = Yii::$app->user->identity;
?>

<div class="section site-profile">
    <div class="content content--lg mobile-wide">
        <div class="request--wrap gradient">
            <div class="content content--md">
                <h1 class="title title-lg"><?= $this->title ?></h1>
                <div class="summary">
                    <p>Ваша ссылка для привлечения реферралов: <?=Yii::$app->request->getHostInfo().'?inv='.$user->id?></p>
                    <p>По Вашей ссылке зарегистрированы <?= $referrals ?> человек</p>
                    <p>За все время Вами заработано <?= floatval($user->bonus_total) ?> р.</p>
                    <p>Не выведено <?= $user->bonusRemnants ?> р.</p>
                    <?php if ($user->bonusRemnants >= 2000): ?>
                        <?= Html::a('Вывести', '/profile/bonus', ['class' => 'btn-small']) ?>
                    <?php endif; ?>
                </div>
                <div class="profile-sales">
                    <table>
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Сумма заказ</th>
                            <th>Отчисления</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($models as $model): ?>
                            <tr>
                                <td><?= date('d.m.Y', strtotime($model->created_at)) ?></td>
                                <td><?= $model->price ?></td>
                                <td><?= $model->referrer_bonus ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
