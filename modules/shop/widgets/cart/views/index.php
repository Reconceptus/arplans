<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 31.08.2018
 * Time: 15:20
 */

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $cartCount int */
/* @var $favoriteCount int */
/* @var $user User */
$user = Yii::$app->user->identity;
?>

<?php if (!Yii::$app->user->isGuest): ?>
    <div class="stats stats-profile has-drop">
        <span>Профиль</span>
        <div class="header-main--drop">
            <?= Html::a('Мои данные', Url::to('/profile')) ?>
            <?= Html::a('Мои заказы', Url::to('/profile/orders')) ?>
            <?php if ($user->is_referrer): ?>
                <?= Html::a('Мои рефералы', Url::to('/profile/referrals')) ?>
            <?php endif; ?>
            <?php if ($user->partner): ?>
                <?= Html::a('Мои продажи', Url::to('/profile/sales')) ?>
            <?php endif; ?>
            <?php if (Yii::$app->user->can('adminPanel')): ?>
                <?= Html::a('Админка', Url::to('/admin')) ?>
            <?php endif; ?>
            <?= Html::a('Выйти', Url::to('/site/logout')) ?>
        </div>
    </div>
<?php endif; ?>
<?php if (!Yii::$app->user->isGuest): ?>
    <a href="/shop/favorite" class="stats stats-likes">
        <span id="count-favorite"><?= intval($favoriteCount) ?></span>
        <i class="icon-likes">
            <svg xmlns="http://www.w3.org/2000/svg">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart"/>
            </svg>
        </i>
    </a>
<?php else: ?>
    <?= Html::a('Войти', Url::to('/site/login'), ['class' => 'stats stats-enter']) ?>
<?php endif; ?>
<a href="/shop/cart" class="stats stats-prods">
    <span id="count-basket"><?= intval($cartCount) ?></span>
    <i class="icon-basket">
        <svg xmlns="http://www.w3.org/2000/svg">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-basket"/>
        </svg>
    </i>
</a>
