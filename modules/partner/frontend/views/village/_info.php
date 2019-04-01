<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.09.2018
 * Time: 13:14
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model \modules\partner\models\Village*/
?>
<div class="section">
    <div class="content content--lg mobile-wide">
        <div class="partner-page--info">
            <div class="content content--md">
                <div class="partner-page--info-table">
                    <div class="cell-logo">
                        <a class="logo"><img width="100" height="100"
                                                                       src="<?= $model->logo ?>"
                                                                       alt="<?= $model->name ?>"></a>
                    </div>
                    <div class="cell cell-location">
                        <p><strong>Расположение</strong></p>
                        <?= $model->address ?>
                    </div>
                    <div class="cell cell-contacts">
                        <p><strong>Контакты отдела продаж</strong></p>
                        <?= $model->phones ?>
                    </div>
                    <div class="cell cell-contacts">
                        <p><?= $model->email ?></p>
                        <a href="<?=$model->url?>" target="_blank">сайт</a>
                    </div>
                    <?php if ($model->price_list) : ?>
                        <div class="cell cell-contacts">
                            <p><strong>Цены</strong></p>
                            <?= Html::a('скачать прайс', Url::to($model->price_list),['target'=>'_blank']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
