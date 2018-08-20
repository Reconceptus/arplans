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
/* @var $category_id integer */
?>

    <div class="section bg-head">
        <div class="content content--lg">
            <div class="bg-head--main gradient"><h1 class="title title-lg">Проекты деревянных домов</h1></div>
        </div>
    </div>
    <div class="section">
        <div class="content content--lg">
            <div class="custom-row filter-row show-more-parent">
                <?= \modules\shop\widgets\filters\Filters::widget([
                    'category_id' => $category_id
                ]) ?>
                <div class="custom-row-col col-elastic">
                    <div class="catalog">
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
                        <div class="catalog-main">
                            <?
                            echo ListView::widget([
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
                                'itemView'     => function ($model, $key, $index, $widget) {
                                    return $this->render('_list', ['model' => $model]);
                                },
                            ]);
                            ?>
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
    </div>
    <div class="section info-box ">
        <div class="content content--md">
            <div class="ready-projects--info">
                <h3 class="title">Проекты Арпланс</h3>
                <div class="info-box--text">
                    <p>В этом блоке 3 стиля: основной, <a href="#">ссылка</a>, <strong>болд</strong>. Не обязательное
                        поле для текстового описания. ARPLANS.RU — сервис готовых архитектурных проектов загородных
                        домов, коттеджей, бань. По нашим проектам многократно производилось строительство, а качество
                        чертежей проектной документации проверено временем и репутацией разработчиков. Все проекты
                        созданы опытными и высококвалифицированны архитекторами и инженерами ARPLANS.</p>
                    <p>Здесь рыба. Сервис готовых архитектурных проектов загородных домов, коттеджей, бань. По нашим
                        проектам многократно производилось строительство, а качество чертежей проектной документации
                        проверено временем и репутацией разработчиков. Все проекты созданы опытными и
                        высококвалифицированны архитекторами и инженерами ARPLANS.</p>
                </div>
            </div>
        </div>
    </div>
<?= Recently::widget() ?>