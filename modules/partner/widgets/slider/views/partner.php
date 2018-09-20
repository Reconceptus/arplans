<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.09.2018
 * Time: 12:42
 */

/* @var $models array */
?>
<div class="partner-page--slider">
    <div class="content content--md">
        <div class="partner-slider" data-owl="partner">
            <ul class="owl-carousel">
                <? foreach ($models as $k => $model): ?>
                    <li class="object-item" data-num="<?= $k + 1 ?>">
                        <div class="projects-item--wrap">
                            <div class="projects-item--preview">
                                <div class="bg" style="background-image: url(<?= $model->file ?>)"></div>
                            </div>
                        </div>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
</div>
