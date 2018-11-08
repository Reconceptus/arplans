<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 25.10.2018
 * Time: 14:37
 */

/* @var $models \modules\shop\models\Order[] */
$this->title = 'Мои заказы';

?>
<div class="section site-profile">
    <div class="content content--lg mobile-wide">
        <div class="request--wrap gradient">
            <div class="content content--md">
                <h1 class="title title-lg"><?= $this->title ?></h1>
                <div class="profile-orders">
                    <? foreach ($models as $model) : ?>
                        <?= $this->render('order', ['model' => $model]) ?>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
