<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 29.08.2018
 * Time: 16:22
 */

use modules\shop\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $models Item[] */
/* @var $favorites array */
$get = Yii::$app->request->get();
if (isset($get['category'])) {
    unset($get['category']);
}
?>
<div class="section projects mobile-hidden ">
    <div class="content content--lg">
        <div class="projects-filters">
            <?= Html::a('скидки', Url::to('/shop/compilation/discount'), ['class' => 'projects-filters--item']) ?>
            <?= Html::a('новые проекты', Url::to('/shop/compilation/new'), ['class' => 'projects-filters--item current']) ?>
            <?= Html::a('бесплатно', Url::to('/shop/compilation/free'), ['class' => 'projects-filters--item']) ?>
        </div>
        <div class="projects-list col-4">
            <? foreach ($models['new'] as $model): ?>
                <div class="projects-item">
                    <?= \modules\shop\widgets\item\Item::widget([
                        'model'     => $model,
                        'get'       => $get,
                        'favorites' => $favorites
                    ]) ?>
                </div>
            <? endforeach; ?>
        </div>
        <div class="btn-box">
            <?= Html::a('все новые проекты', Url::to('/shop/compilation/new'), ['class' => 'btn btn--lt']) ?>
        </div>
    </div>
</div>
