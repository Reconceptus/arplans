<?php

use modules\shop\models\Block;
use yii\web\View;

/* @var $blocks Block[] */
/* @var $this View */
$this->title = "Мы подобрали для вас";
$this->registerMetaTag(['name' => 'description', 'content' => 'Подборки проектов']);
?>

<div class="section bg-head">
    <div class="content content--lg">
        <div class="bg-head--main gradient"><h1 class="title title-lg"><?=$this->title?></h1></div>
    </div>
</div>

<div class="section projects-compilation bg">
    <div class="services-more">
        <div class="content content--md">
            <div class="services-more--wrap">
                <div class="add-service--list">
                    <?php foreach ($blocks as $block): ?>
                        <div class="add-service show-more-parent">
                            <div class="add-service--header">
                                <div class="check">
                                    <label>
                                        <div><?= $block->name ?></div>
                                    </label>
                                </div>
                                <span class="show-more"></span>
                            </div>
                            <div class="add-service--main show-more-hidden">
                                <div class="add-service--main-text">
                                    <div class="contact-page--partners">
                                        <ul>
                                            <?php foreach ($block->selections as $selection): ?>
                                                <li><a href="<?= $selection->url ?>"><?= $selection->name ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>