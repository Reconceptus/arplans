<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:18
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $tags \common\models\Tag[] */
/* @var $showTags bool */
/* @var $mainTag string */

$this->title = 'Блог';
?>

<div class="section bg-head">
    <div class="content content--lg">
        <div class="bg-head--main gradient">
            <h1 class="title title-lg"><?= $this->title ?></h1>
        </div>
    </div>
</div>
<div class="section blog-page">
    <div class="content content--lg show-more-parent">
        <div class="blog-hashes--title mobile-show">
            <span class="show-more">Фильтры</span>
        </div>
        <div class="show-more-hidden">
            <div class="blog-hashes <?= $showTags ? '' : 'hidden' ?>">

                <?php
                $options = ['class' => 'btn-small'];
                if (!$mainTag) {
                    Html::addCssClass($options, 'active');
                }
                ?>
                <?= Html::a('Все статьи', Url::to(['/blog']), $options) ?>

                <?php foreach ($tags as $tag): ?>
                    <?php
                    $options = ['class' => 'btn-small'];
                    if ($tag->name == $mainTag) {
                        Html::addCssClass($options, 'active');
                    }
                    ?>
                    <?= Html::a($tag->name, Url::to(['index', 'tag' => $tag->name]), $options) ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'options'      => [
                'tag'   => 'div',
                'class' => 'blog-list col-3',
            ],
            'pager'        => [
                'nextPageLabel'      => '',
                'prevPageLabel'      => '',
                'maxButtonCount'     => '10',
                'activePageCssClass' => 'current',
                'linkOptions'        => [
                    'class' => 'pager-el',
                ],
                'options'            => [
                    'class' => 'pager'
                ],
            ],
            'itemOptions'  => [
                'tag'   => 'div',
                'class' => 'blog-item'
            ],
            'layout'       => "{items}",
            'itemView'     => function ($model, $key, $index, $widget) {
                return $this->render('_list', ['model' => $model]);
            },
        ]);
        ?>

        <?= \yii\widgets\LinkPager::widget([
            'pagination'         => $dataProvider->getPagination(),
            'linkOptions'        => ['class' => 'page'],
            'activePageCssClass' => 'current',
            'nextPageLabel'      => '>',
            'prevPageLabel'      => '<',
            'prevPageCssClass'   => 'prev',
            'nextPageCssClass'   => 'next',
        ]) ?>
    </div>
    <?= \frontend\widgets\recently\Recently::widget() ?>
</div>

