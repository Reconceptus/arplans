<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 08.10.2018
 * Time: 16:38
 */
/* @var $models \modules\shop\models\Item[] */
?>
<div class="content content--lg">
    <div class="projects-slider--wrap">
        <h3 class="title">Недавно смотрели</h3>
        <div class="projects-slider--carousel" data-owl="projects">
            <ul class="owl-carousel">
                <?php foreach ($models as $model): ?>
                    <?= $this->render('_history_item', ['model' => $model]) ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
