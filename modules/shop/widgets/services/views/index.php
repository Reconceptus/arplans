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
                <h4 class="title"><?= $model->name ?>, <?= $model->price ?> &#8381;</h4>
                <div class="text">
                    <?= $model->preview_text ?>
                </div>
                <div class="link"><a href="#">Читать полностью</a></div>
            </article>
        <? endforeach; ?>
    </div>
    <div class="custom-row-col col-50">
        <? foreach ($models[1] as $model): ?>
            <article>
                <h4 class="title"><?= $model->name ?>, <?= $model->price ?> &#8381;</h4>
                <div class="text">
                    <?= $model->preview_text ?>
                </div>
                <div class="link"><a href="#">Читать полностью</a></div>
            </article>
        <? endforeach; ?>
    </div>
</div>
