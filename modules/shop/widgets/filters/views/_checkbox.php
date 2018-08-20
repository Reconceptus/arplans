<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.08.2018
 * Time: 14:44
 */

/* @var $catalog \modules\shop\models\Catalog */
?>
<div class="catalog-filters--section show-more-parent show">
    <div class="catalog-filters--head">
        <h3 class="form-title"><?= $catalog->name ?></h3>
        <span class="show-more"></span>
    </div>
    <div class="catalog-filters--main show-more-hidden" style="display: block;">
        <
        <div class="form-row-element">
            <div class="check">
                <label>
                    <input type="checkbox">
                    <span>из бруса</span>
                </label>
            </div>
        </div>
        <div class="form-row-element">
            <div class="check">
                <label>
                    <input type="checkbox">
                    <span>из бревна</span>
                </label>
            </div>
        </div>
    </div>
</div>
