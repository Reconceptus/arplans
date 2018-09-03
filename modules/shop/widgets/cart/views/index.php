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
<a href="/shop/favorite" class="stats stats-likes">
    <span id="count-favorite"><?= intval($favoriteCount) ?></span>
    <i class="icon-likes">
        <svg xmlns="http://www.w3.org/2000/svg">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart"/>
        </svg>
    </i>
</a>
<a href="/shop/cart" class="stats stats-prods">
    <span id="count-basket"><?= intval($cartCount) ?></span>
    <i class="icon-basket">
        <svg xmlns="http://www.w3.org/2000/svg">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-basket"/>
        </svg>
    </i>
</a>
