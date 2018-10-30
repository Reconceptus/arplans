<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 30.10.2018
 * Time: 17:04
 */

use yii\widgets\ListView;

/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Поиск';
?>

    <div class="section bg-head">
        <div class="content content--lg">
            <div class="bg-head--main gradient"><h1 class="title title-lg"><?= $this->title ?></h1></div>
        </div>
    </div>
    <div class="section search-results">
        <div class="content content--md">
            <div class="search-results--field">
                <div class="custom-search">
                    <form action="">
                        <div class="custom-search--field">
                            <div class="custom-search--inputs">
                                <div class="input">
                                    <input type="text" placeholder="Поисковый запрос" name="q" value="<?=Yii::$app->request->get('q')?>">
                                </div>
                                <button class="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-search"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="content content--sm">
            <div class="search-results--list">
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'options'      => [
                        'tag'   => 'ul',
                        'class' => '',
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
                        'tag'   => 'li',
                        'class' => ''
                    ],
                    'layout'       => "{items}",
                    'itemView'     => function ($model)  {
                        return $this->render('_list', ['model' => $model]);
                    },
                ]);
                ?>
            </div>
        </div>
    </div>

