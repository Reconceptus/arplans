<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 31.08.2018
 * Time: 15:20
 */

/* @var $cartCount int */
/* @var $favoriteCount int */
?>

<?php if (!Yii::$app->user->isGuest): ?>
    <div class="stats stats-profile has-drop">
        <span>Профиль</span>
        <div class="header-main--drop">
            <?= \yii\helpers\Html::a('Мои данные', \yii\helpers\Url::to('/profile')) ?>
            <?= \yii\helpers\Html::a('Мои заказы', \yii\helpers\Url::to('/profile/orders')) ?>
            <?php if (Yii::$app->user->identity->partner): ?>
                <?= \yii\helpers\Html::a('Мои продажи', \yii\helpers\Url::to('/profile/sales')) ?>
            <?php endif; ?>
            <?php if (Yii::$app->user->can('adminPanel')): ?>
                <?= \yii\helpers\Html::a('Админка', \yii\helpers\Url::to('/admin')) ?>
            <?php endif; ?>
            <?= \yii\helpers\Html::a('Выйти', \yii\helpers\Url::to('/site/logout')) ?>
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
    <?= \yii\helpers\Html::a('Войти', \yii\helpers\Url::to('/site/login'), ['class' => 'stats stats-enter']) ?>
<?php endif; ?>
<a href="/shop/cart" class="stats stats-prods">
    <span id="count-basket"><?= intval($cartCount) ?></span>
    <i class="icon-basket">
        <svg xmlns="http://www.w3.org/2000/svg">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-basket"/>
        </svg>
    </i>
</a>
