<?php

use frontend\widgets\recently\Recently;
use modules\shop\models\Selection;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $favorites array */
/* @var $selection Selection */

$this->title = $selection->name;
$this->registerMetaTag(['name' => 'description', 'content' => $selection->description]);

?>


    <div class="section bg-head">
        <div class="content content--lg">
            <div class="bg-head--main gradient"><h1 class="title title-lg"><?= $selection->name ?></h1></div>
        </div>
    </div>
    <div class="section">
        <div class="content content--lg">
            <div class="custom-row">
                <div class="custom-row-col">
                    <div class="catalog show-more-parent">
                        <div class="catalog-main">
                            <?= ListView::widget([
                                'dataProvider' => $dataProvider,
                                'options'      => [
                                    'tag'   => 'div',
                                    'class' => 'projects-list col-4',
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
                                    'class' => 'projects-item'
                                ],
                                'layout'       => "{items}",
                                'itemView'     => function ($model, $key, $index, $widget) use ($favorites) {
                                    return $this->render('_list', ['model' => $model->item, 'favorites' => $favorites]);
                                },
                            ]);
                            ?>
                        </div>
                        <div class="catalog-actions">

                            <?= LinkPager::widget([
                                'pagination'         => $dataProvider->getPagination(),
                                'linkOptions'        => ['class' => 'page'],
                                'activePageCssClass' => 'current',
                                'nextPageLabel'      => '>',
                                'prevPageLabel'      => '<',
                                'prevPageCssClass'   => 'prev',
                                'nextPageCssClass'   => 'next',
                            ]) ?>

                            <div class="sharing title-end">
                                <div class="title">Поделиться</div>
                                <?= \frontend\widgets\share\Share::widget() ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section info-box ">
        <div class="content content--md">
            <div class="ready-projects--info">
                <h3 class="title"><?= $selection->name ?></h3>
                <div class="info-box--text">
                    <?= $selection->description ?>
                </div>
            </div>
        </div>
    </div>
<?= Recently::widget() ?>