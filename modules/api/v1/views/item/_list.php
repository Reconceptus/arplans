<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.08.2018
 * Time: 16:59
 */

/* @var  $model \modules\shop\models\Item */
/* @var  $favorites array */
/* @var  $inCart array */
$get = Yii::$app->request->get();
if (isset($get['category'])) {
    unset($get['category']);
}
?>
<?= \modules\shop\widgets\item\Item::widget(['model' => $model, 'favorites' => $favorites, 'get' => $get, 'inCart' => $inCart, 'api' => true]) ?>