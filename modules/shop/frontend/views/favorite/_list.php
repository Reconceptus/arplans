<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 31.08.2018
 * Time: 10:52
 */

/* @var $model \modules\shop\models\Item */
/* @var $sizeCatalog \modules\shop\models\Catalog */
/* @var $inCart Array*/
?>
<?= \modules\shop\widgets\item\Item::widget(['viewName' => 'favorite', 'model' => $model, 'sizeCatalog' => $sizeCatalog, 'inCart'=>$inCart]) ?>
