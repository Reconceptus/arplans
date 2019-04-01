<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 14.09.2018
 * Time: 13:09
 */

use yii\helpers\Html;

/* @var $models \common\models\Post[] */
?>
<section class="section">
    <h4 class="title">проектирование</h4>
    <ul>
        <?php foreach ($models as $model): ?>
            <li><?= Html::a($model->name, \yii\helpers\Url::to('/blog/' . $model->slug)) ?></li>
        <?php endforeach; ?>
    </ul>
</section>
