<?php

use modules\shop\models\Block;
use modules\shop\models\Item;
use yii\helpers\Html;

/* @var $blocks Block[] */
/* @var $model Item */
/* @var $ins array */

$this->title = 'Выберите подборки, в которые входит товар'
?>
    <h1><?= $this->title ?></h1>
    <div class="row">
        <div class="col-xs-12 grid-2-col">
            <?php foreach ($blocks as $block): ?>
                <div class="block-section">
                    <h4><?= $block->name ?></h4>
                    <?php foreach ($block->selections as $selection): ?>
                        <label>
                        <span class="js-item-selection">
                        <?= Html::checkbox('sel_'.$selection->id, array_key_exists($selection->id, $ins),
                            ['class' => 'js-selection-checkbox', 'data-id' => $selection->id]) ?>
                        <?= $selection->name ?>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php
$js = <<<JS
var id = $model->id;
$(document).on('click', '.js-selection-checkbox', function (e) {
    e.prependDefault;
    e.stopPropagation();
    var button = $(this);
    var selectionId = button.data('id');
     $.post('item-selection', {id: id, selectionId:selectionId}).done(function(data) {
        if(data.status === 'success'){
            if(data.action === 'add'){
                button.attr('checked','checked');
            }else{
                button.attr('checked',false);
            }
        }
    });
});
JS;
$this->registerJs($js);