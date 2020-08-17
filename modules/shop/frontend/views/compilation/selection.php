<?php

use frontend\widgets\recently\Recently;
use modules\shop\models\Selection;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $favorites array */
/* @var $selection Selection */

if ($_SERVER['REQUEST_URI']=='/shop/selection/proekty-dvuhetazhnyh-domov-i-kottedzhej') {
    $this->title = 'Проекты двухэтажных домов и коттеджей купить онлайн';
}elseif ($_SERVER['REQUEST_URI']=='/shop/selection/proekty-domov-i-kottedzhej-s-mansardoi') {
    $this->title = 'Проекты домов и коттеджей с мансардой купить онлайн';
}elseif ($_SERVER['REQUEST_URI']=='/shop/selection/proekty-odnoetazhnyh-domov-s-mansardoi') {
    $this->title = 'Проекты одноэтажных домов и коттеджей с мансардой заказать онлайн';
}elseif ($_SERVER['REQUEST_URI']=='/shop/selection/proekty-odnoetazhnyh-domov-s-terrasoj') {
    $this->title = 'Проекты одноэтажных домов с террасой купить по доступной цене';
}elseif ($_SERVER['REQUEST_URI']=='/shop/selection/proekty-odnoetazhnyh-domov-s-3-spalnyami') {
    $this->title = 'Проекты одноэтажных домов с тремя спальнями купить в интернет-магазине';
}elseif ($_SERVER['REQUEST_URI']=='/shop/selection/proekty-odnoetazhnyh-domov-do-100') {
    $this->title = 'Проекты одноэтажных домов до 100 кв м купить с гарантией';
}elseif ($_SERVER['REQUEST_URI']=='/shop/selection/proekty-odnoetazhnyh-domov-150') {
    $this->title = 'Проекты домов одноэтажных до 150 м2 заказать онлайн';
}elseif ($_SERVER['REQUEST_URI']=='/shop/selection/proekty-odnoetazhnyh-domov-iz-gazobetona') {
    $this->title = 'Одноэтажные проекты домов из газобетона купить с гарантией';
}elseif ($_SERVER['REQUEST_URI']=='/shop/selection/proekty-odnoetazhnyh-domov-iz-brusa') {
    $this->title = 'Проекты одноэтажных домов из бруса купить готовый проект';
}elseif ($_SERVER['REQUEST_URI']=='/shop/selection/proekty-odnoetazhnyh-domov-iz-kirpicha') {
    $this->title = 'Проекты одноэтажных домов и коттеджей из кирпича купить по выгодной цене';
}elseif ($_SERVER['REQUEST_URI']=='/shop/selection/proekty-domov-i-kottedzhej-s-garazhom') {
    $this->title = 'Проекты домов и коттеджей с гаражом - купить готовый проект онлайн';
}elseif ($_SERVER['REQUEST_URI']=='/shop/selection/proekty-domov-s-mansardoj-i-garazhom') {
    $this->title = 'Проекты домов и коттеджей с мансардой и гаражом купить с гарантией';
}elseif ($_SERVER['REQUEST_URI']=='/shop/selection/proekty-odnoetazhnyh-domov-i-kottedzhej') {
    $this->title = 'Готовые проекты одноэтажных домов и коттеджей купить онлайн';
}else {
    $this->title = $selection->name;
}
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