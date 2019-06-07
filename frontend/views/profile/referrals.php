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
$this->title = 'Доходы с рефералов';
$user = Yii::$app->user->identity;
?>
<div class="section site-profile">
    <div class="content content--lg mobile-wide">
        <div class="request--wrap gradient">
            <div class="content content--md">
                <h1 class="title title-lg"><?= $this->title ?></h1>
                <div class="referral-box">
                    <div class="referral-sections">
                        <div class="section">
                            <div class="referral-item">
                                <div class="section-title">Ваша уникальная ссылка</div>
                                <div class="link">
                                    <div class="custom-form">
                                        <div class="input">
                                            <input type="text" readonly
                                                   value="<?= Yii::$app->request->getHostInfo() . '?inv=' . $user->id ?>">
                                        </div>
                                    </div>
<!--                                    <button type="button" class="copy-btn btn-square-dark">Copy</button>-->
                                </div>
                                <div class="link-info">
                                    Поделитесь ссылкой и зарабатывайте. Если вы авторизованы, то на каждой странице
                                    сайта есть ссылка на эту страницу (внизу справа). О реферальной системе
                                    <a href="/page/refinfo" target="_blank">подробнее</a>.
                                </div>
                            </div>
                        </div>
                        <div class="section">
                            <div class="referral-item">
                                <div class="section-title">Статистика за все время</div>
                                <div class="form-text">
                                    <p>По вашей ссылке зарегистрировано: <strong><?= intval($referrals) ?> чел.</strong>
                                    </p>
                                    <p>Баланс за все время: <strong><?= floatval($user->bonus_total) ?> руб.</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="section">
                            <div class="referral-item">
                                <div class="section-title">Остаток на счете</div>
                                <div class="form-text">
                                    <p>Текущий баланс: <strong><?= $user->bonusRemnants ?> руб</strong></p>
                                    <p>Запрос на вывод возможен для суммы больше <strong>2000&nbsp;р</strong></p>
                                </div>
                                <?php if ($user->bonusRemnants >= 2000): ?>
                                    <?= Html::a('ЗАПРОСИТЬ ВЫВОД СРЕДСТВ', '/profile/bonus', ['class' => 'btn-round-min-orange']) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-sales">
                    <div class="table">
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
</div>
