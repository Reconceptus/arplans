<?php

use modules\shop\models\Block;
use modules\shop\models\Item;

/* @var $blocks Block[] */
/* @var $model Item */

$this->title = 'Выберите подборки, в которые входит товар'
?>
<h1><?= $this->title ?></h1>
<div class="row">
    <div class="col-xs-10 grid-2-col">
        <?php foreach ($blocks as $block): ?>

        <?php endforeach; ?>
    </div>
</div>
