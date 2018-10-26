<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.10.2018
 * Time: 17:28
 */

use yii\helpers\Html;

/* @var $model \modules\partner\models\Partner */
/* @var $categories \modules\shop\models\Category[] */
$this->title = 'Категории для партнера ' . $model->name;
?>
<h1><?= $this->title ?></h1>
<div class="post-form">
    <div class="row">
        <div class="col-md-6">
            <? foreach ($categories as $category): ?>
                <div class="form-group">
                    <?= Html::checkbox($category->slug, $category->isAllowToPartner($model->id), ['id' => $category->slug, 'class' => 'js-category-checkbox', 'data-category' => $category->id, 'data-partner' => $model->id]) ?>
                    <?= Html::label($category->name, '#' . $category->slug) ?>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>