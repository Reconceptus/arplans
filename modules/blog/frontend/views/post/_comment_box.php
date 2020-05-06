<?php
/* @var $model \common\models\Comment */
?>
<div class="comment" data-id="<?= $model->id ?>">
    <div class="comment-head">
        <div class="comment-user-data">
            <div class="comment-name"><?= $model->name ?></div>
            <div class="comment-date"><?= \common\helpers\DateTimeHelper::getDateRuFormat($model->created_at) ?></div>
        </div>
        <div class="comment-reply"></div>
    </div>

    <div class="comment-text"><?= $model->text ?></div>
</div>
