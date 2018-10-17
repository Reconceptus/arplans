<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 29.08.2018
 * Time: 15:56
 */

use frontend\widgets\recently\Recently;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $favorites array */
/* @var string $name */
/* @var string $description */
?>


    <div class="section bg-head">
        <div class="content content--lg">
            <div class="bg-head--main gradient"><h1 class="title title-lg">Все проекты со скидкой</h1></div>
        </div>
    </div>
    <div class="section">
        <div class="content content--lg">
            <div class="custom-row">
                <div class="custom-row-col">
                    <div class="catalog show-more-parent">
                        <? if (false): ?>
                            <div class="btn-box">
                                <div class="show-more btn btn--sort mobile-show">
                                    <span>Сортировать</span>
                                </div>
                            </div>
                            <div class="catalog-header show-more-hidden">
                                <a href="#" class="filter down">
                                    С меньшей ценой вниз
                                    <i class="arrow"></i>
                                </a>
                                <a href="#" class="filter up">
                                    С большей площадью вверх
                                    <i class="arrow"></i>
                                </a>
                                <a href="#" class="filter down">
                                    Новинки вверх
                                    <i class="arrow"></i>
                                </a>
                            </div>
                        <? endif; ?>
                        <div class="catalog-main">
                            <?
                            echo ListView::widget([
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
                                    return $this->render('_list', ['model' => $model, 'favorites' => $favorites]);
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
                <h3 class="title"><?= $name ?></h3>
                <div class="info-box--text">
                    <?= $description ?>
                </div>
            </div>
        </div>
    </div>
<?= Recently::widget() ?>