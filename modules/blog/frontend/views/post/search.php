<?php

use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $tags \common\models\Tag[] */
/* @var $showTags bool */
/* @var $q string */
?>
<div id="main" class="main">

    <div class="section section--blog">

        <div class="content content--md">

            <h1 class="page-title">Search results</h1>

            <div class="blog--listing">
                <div class="blog--filters">
                    <div class="blog--tags hidden">
                    </div>
                    <div class="blog--search">
                        <form action="/blog/search">
                            <div class="blog--search-field">
                                <input type="text" name="q" placeholder="Type What you Search..." value="<?=$q?>">
                                <button type="submit" class="submit">
                                    <svg class="icon icon--search">
                                        <use xlink:href="#icon-search"></use>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="blog--articles">
                    <?php Pjax::begin(['id' => 'actionsPjax']);
                    echo ListView::widget([
                        'dataProvider' => $dataProvider,
                        'options'      => [
                            'tag'   => 'div',
                            'class' => 'grid opacity',
                            'id'    => 'grid'
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
                            'tag'   => 'article',
                            'class' => 'article'
                        ],
                        'layout'       => '{items}\n{pager}',
                        'itemView'     => function ($model, $key, $index, $widget) {
                            return $this->render('_list', ['model' => $model]);
                        },
                    ]);
                    Pjax::end();
                    ?>
                </div>
            </div>

        </div>

    </div>

</div>
