<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.08.2018
 * Time: 14:57
 */

use frontend\widgets\recently\Recently;
use frontend\widgets\share\Share;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $dataProvider ActiveDataProvider */
/* @var $category \modules\shop\models\Category */
/* @var $favorites array */
/* @var $inCart array */
$sort = Yii::$app->request->get('sort');
$this->title = $category->seo_title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $category->seo_keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $category->seo_description]);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Yii::$app->request->getHostInfo().'/'.Yii::$app->request->getPathInfo()]);
?>

    <div class="section bg-head">
        <div class="content content--lg">
            <div class="bg-head--main gradient">
                <h1 class="title title-lg"><?= $this->title ?></h1>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="content content--lg">
            <div class="custom-row filter-row show-more-parent">
                <?= \modules\shop\widgets\filters\Filters::widget([
                    'category' => $category,
                ]) ?>
                <div class="custom-row-col col-elastic">
                    <div class="catalog">
                        <div class="catalog-header show-more-hidden">
                            <a href="<?= $dataProvider->sort->createUrl('cost') ?>"
                               class="filter <?= $sort === '-cost' ? 'down' : '' ?><?= $sort === 'cost' ? 'up' : '' ?>">
                                <?php if ($sort === '-cost') {
                                    echo 'По убыванию цены';
                                } elseif ($sort === 'cost') {
                                    echo 'По возрастанию цены';
                                } else {
                                    echo 'По цене';
                                }
                                ?>
                                <i class="arrow"></i>
                            </a>
                            <a href="<?= $dataProvider->sort->createUrl('common_area') ?>"
                               class="filter <?= $sort === '-common_area' ? 'down' : '' ?><?= $sort === 'common_area' ? 'up' : '' ?>">
                                <?php if ($sort === '-common_area') {
                                    echo 'По убыванию площади';
                                } elseif ($sort === 'common_area') {
                                    echo 'По возрастанию площади';
                                } else {
                                    echo 'По площади';
                                }
                                ?>
                                <i class="arrow"></i>
                            </a>
                        </div>
                        <div class="catalog-main">
                            <?php echo ListView::widget([
                                'dataProvider' => $dataProvider,
                                'options'      => [
                                    'tag'   => 'div',
                                    'class' => 'projects-list col-3',
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
                                'itemView'     => function ($model, $key, $index, $widget) use ($favorites, $inCart) {
                                    return $this->render('_list', ['model' => $model, 'favorites' => $favorites, 'inCart' => $inCart]);
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

                            <?= Share::widget(['viewName' => 'catalog']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php if ($category->description): ?>
    <div class="section info-box ">
        <div class="content content--md">
            <div class="ready-projects--info">
                <h3 class="title"><?= $category->name ?></h3>
                <div class="info-box--text">
                    <?= $category->description ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?= Recently::widget() ?>