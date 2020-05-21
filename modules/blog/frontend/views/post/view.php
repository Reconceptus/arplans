<?php
/* @var $model \common\models\Post */
/* @var $tags array */

/* @var $newComment \common\models\Comment */

use yii\helpers\Html;

$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Yii::$app->request->getHostInfo().'/'.Yii::$app->request->getPathInfo()]);
$this->title = $model->title;
?>

    <div class="section article-page">
        <div class="content content--md">
            <div class="custom-row">
                <div class="custom-row-col col-projects">
                    <div class="fixed-scrollbar">
                        <div class="fixing">
                            <div class="article-page--sidebar">
                                <?= \frontend\widgets\flashes\Flashes::widget() ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-row-col">
                    <div class="article-page--header">
                        <h1 class="title"><?= $model->name ?></h1>
                        <div class="auth">
                            <div class="ava">
                                <?= Html::img($model->author->profile->image ?? Yii::$app->params['defaultAvatar']) ?>
                            </div>
                            <span class="name"><?= $model->author->profile->fio ?></span>
                            <time class="date"><?= \common\helpers\DateTimeHelper::getDateRuFormat($model->created_at) ?></time>
                        </div>
                    </div>
                    <div class="article-page--main">
                        <div class="text-box">
                            <?= $model->text ?>
                        </div>
                    </div>
                    <?= \frontend\widgets\share\Share::widget(['model' => $model, 'viewName' => 'blog']) ?>
                </div>
            </div>
        </div>
    </div>
<?= \modules\blog\widgets\tagposts\TagPosts::widget(['tag' => $model->tags ? $model->tags[0] : '', 'postId'=>$model->id]) ?>