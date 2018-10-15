<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 08.10.2018
 * Time: 16:38
 */
/* @var $model \modules\shop\models\Item */
$image = $model->getMainImage();
?>
<li class="projects-item">
    <a href="<?= \yii\helpers\Url::to(['/shop/' . $model->category->slug . '/' . $model->slug, $get ?? []]) ?>"
       class="projects-item--wrap">
        <div class="projects-item--preview">
            <div class="bg" <?= $image ? 'style="background-image: url(' . $image . ')"' : '' ?>></div>
            <div class="data">
                <span class="index"><?= $model->name ?></span>
                <ul class="info">
                    <li>
                        <span><?= $model->common_area ?> м<sup>2</sup></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="projects-item--actions">
            <div class="price"><?= ($model->price - $model->discount) ?> &#8381;</div>
            <div class="icon-like" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart-like"/>
                </svg>
            </div>
        </div>
    </a>
</li>
