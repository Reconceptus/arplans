<?php

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $models \yii\data\ActiveDataProvider */
?>
<?= $this->render('map', ['models' => $models]) ?>
<?= $this->render('list', ['dataProvider' => $dataProvider]) ?>
