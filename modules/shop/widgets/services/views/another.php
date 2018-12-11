<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 12.09.2018
 * Time: 11:48
 */
/* @var $models \modules\shop\models\Service[] */
?>
<? if ($models): ?>
    <div class="services-more">
        <div class="content content--lg">
            <div class="bg">
                <div class="content content--md">
                    <div class="services-more--wrap">
                        <div class="title">Остальные услуги</div>
                        <div class="add-service--list">
                            <div class="add-service--part">
                                <? foreach ($models as $model): ?>
                                    <div class="add-service show-more-parent">
                                        <div class="add-service--header">
                                            <div class="check">
                                                <label>
                                                    <div><?=$model->name?>, <?=$model->price?> <span class="pt-sans">&#8381;</span> <?= $model->measure ?></div>
                                                </label>
                                            </div>
                                            <span class="show-more"></span>
                                        </div>
                                        <div class="add-service--main show-more-hidden">
                                            <div class="add-service--main-text">
                                                <?=$model->preview_text?>
                                                <p class="link"><a href="/shop/service/<?=$model->slug?>">Подробнее</a></p>
                                            </div>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? endif; ?>