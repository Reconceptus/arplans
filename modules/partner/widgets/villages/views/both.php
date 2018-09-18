<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 17:34
 */

/* @var $dataProvider \yii\data\ActiveDataProvider */
?>
<?= $this->render('map') ?>
<?= $this->render('list', ['dataProvider' => $dataProvider]) ?>
