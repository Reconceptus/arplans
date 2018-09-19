<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 17:34
 */

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $models \yii\data\ActiveDataProvider */
?>
<?= $this->render('map', ['models' => $models]) ?>
<?= $this->render('list', ['dataProvider' => $dataProvider]) ?>
