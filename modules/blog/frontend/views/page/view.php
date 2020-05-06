<?php
/* @var $model \common\models\Page */
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
$this->title = $model->title;
?>

<div class="section article-page">
    <div class="content content--md">
        <div class="custom-row">
            <div class="custom-row-col">
                <div class="article-page--header">
                    <h1 class="title"><?= $model->name ?></h1>
                </div>
                <div class="article-page--main">
                    <div class="text-box">
                        <?= $model->text ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
