<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 12.09.2018
 * Time: 13:57
 */

/* @var $models \modules\shop\models\Service[] */
$models = \common\helpers\FormatHelper::divideArray($models);
?>
<div class="custom-row">
    <div class="custom-row-col col-50">
        <? foreach ($models[0] as $model): ?>
            <article>
                <?= \yii\helpers\Html::a('<h4 class="title">' . $model->name . ', ' . $model->price . '<span class="pt-sans">&nbsp;&#8381;</span></h4>', \yii\helpers\Url::to('/shop/service/' . $model->slug), ['class'=>'service-link']) ?>
                <div class="text">
                    <?= $model->preview_text ?>
                </div>
                <div class="link">
                    <?= \yii\helpers\Html::a('Читать полностью', \yii\helpers\Url::to('/shop/service/' . $model->slug)) ?>
                </div>
            </article>
        <? endforeach; ?>
    </div>
    <div class="custom-row-col col-50">
        <? foreach ($models[1] as $model): ?>
            <article>
                <?= \yii\helpers\Html::a('<h4 class="title">' . $model->name . ', ' . $model->price . '<span class="pt-sans">&nbsp;&#8381;</span></h4>', \yii\helpers\Url::to('/shop/service/' . $model->slug), ['class'=>'service-link']) ?>
                <div class="text">
                    <?= $model->preview_text ?>
                </div>
                <div class="link">
                    <?= \yii\helpers\Html::a('Читать полностью', \yii\helpers\Url::to('/shop/service/' . $model->slug)) ?>
                </div>
            </article>
        <? endforeach; ?>
    </div>
</div>
