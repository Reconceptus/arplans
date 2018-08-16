<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 01.08.2018
 * Time: 16:53
 */

use yii\helpers\Html;

/* @var $newComment \common\models\Comment */
?>
<div class="comments-section">
    <div class="comments">
        <? foreach ($model->comments as $comment): ?>
            <?= $this->render('_comment_box', ['model' => $comment]) ?>
        <? endforeach; ?>
    </div>
    <div class="add-comment" data-lang="<?= Yii::$app->language ?>">
        <div><h2 class="control-label">Leave a reply</h2></div>
        <div class="comments-form">
            <?= Html::input('hidden', 'post_id', $model->id, ['class' => 'comment-post-id']) ?>
            <div class="comments-form-col col-60">
                <div class="form--field">
                    <label>
                        <div class="label">Comment</div>
                        <div class="input">
                            <?= Html::textarea('text', '', ['rows' => 3, 'placeholder' => 'Type your comment', 'class' => 'comment-text']) ?>
                        </div>
                    </label>
                </div>
            </div>
            <div class="comments-form-col col-40">
                <div class="form--field">
                    <label>
                        <div class="label">Name</div>
                        <div class="input">
                            <?= Html::input('text', 'name', '', ['class' => 'comment-name']) ?>
                        </div>
                    </label>
                </div>
                <div class="form--field">
                    <label>
                        <div class="label">E-mail</div>
                        <div class="input">
                            <?= Html::input('text', 'email', '', ['class' => 'comment-email']) ?>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="form--field">
            <div class="check">
                <label>
                    <?= Html::checkbox('accept', false, ['class' => 'comment-accept']) ?>
                    <span class="check-text">I have read and agree to the Terms&amp;Conditions and Privacy Policy.</span>
                    <div class="accept-error"></div>
                </label>
            </div>
        </div>
        <div class="submit">
            <?= Html::button('submit', ['class' => 'btn btn--square-dark js-submit-comment']) ?>
        </div>
    </div>
</div>
