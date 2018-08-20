<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.08.2018
 * Time: 9:45
 */

use modules\shop\models\Catalog;

/* @var $filters Catalog[] */
?>
<div class="custom-row-col col-sidebar">
    <div class="btn-box multiple">
        <button class="btn btn--lt show-modal-filter">показать фильтры</button>
        <div class="show-more btn btn--sort mobile-show">
            <span>Сортировать</span>
        </div>
    </div>
    <div class="fixed-scrollbar modal-filter">
        <div class="modal-bg close"></div>
        <div class="fixing">
            <div class="catalog-filters scrolled">
                <form action="#">
                    <div class="filter-form">
                        <? foreach ($filters as $catalog): ?>
                            <? if ($catalog->view_type === Catalog::VIEW_CHECKBOX): ?>
                                <?= $this->render('_checkbox', ['catalog' => $catalog]) ?>
                            <? endif; ?>
                        <? endforeach; ?>
                        <div class="catalog-filters--section show-more-parent">
                            <div class="catalog-filters--head">
                                <h3 class="form-title">Общая площадь</h3>
                                <span class="show-more"></span>
                            </div>
                            <div class="catalog-filters--main show-more-hidden" style="display: none;">
                                <div class="form-row-element">
                                    <div class="range">
                                        <div id="keypress" class="range-field"></div>
                                        <div class="range-inputs">
                                            от
                                            <input type="text" id="input-with-keypress-0">
                                            до
                                            <input type="text" id="input-with-keypress-1">
                                            м<sup>2</sup>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="catalog-filters--section show-more-parent">
                            <div class="catalog-filters--head">
                                <h3 class="form-title">Этажность</h3>
                                <span class="show-more"></span>
                            </div>
                            <div class="catalog-filters--main show-more-hidden" style="display: none;">
                                <div class="form-row">
                                    <div class="form-row-col col-50">
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>1-этажные</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>2-этажные</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>с мансардой</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row-col col-50">
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>с цоколем</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>с подвалом</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="catalog-filters--section show-more-parent">
                            <div class="catalog-filters--head">
                                <h3 class="form-title">Габариты</h3>
                                <span class="show-more"></span>
                            </div>
                            <div class="catalog-filters--main show-more-hidden" style="display: none;">
                                <div class="form-row-element">
                                    <div class="range-inputs">
                                        <span style="width: 75px;">Длина:</span>
                                        <input type="text">
                                        -
                                        <input type="text">
                                        м
                                    </div>
                                </div>
                                <div class="form-row-element">
                                    <div class="range-inputs">
                                        <span style="width: 75px;">Ширина:</span>
                                        <input type="text">
                                        -
                                        <input type="text">
                                        м
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="catalog-filters--section show-more-parent">
                            <div class="catalog-filters--head">
                                <h3 class="form-title">Количество комнат</h3>
                                <span class="show-more"></span>
                            </div>
                            <div class="catalog-filters--main show-more-hidden" style="display: none;">
                                <div class="form-row-element">
                                    <div class="radio-flex">
                                        <label>
                                            <input type="radio" name="rooms">
                                            <span>2</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="rooms">
                                            <span>3</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="rooms">
                                            <span>4</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="rooms">
                                            <span>5</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="rooms">
                                            <span>6+</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="catalog-filters--section show-more-parent">
                            <div class="catalog-filters--head">
                                <h3 class="form-title">Удобства</h3>
                                <span class="show-more"></span>
                            </div>
                            <div class="catalog-filters--main show-more-hidden" style="display: none;">
                                <div class="form-row">
                                    <div class="form-row-col col-50">
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>гараж</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>гараж на 2 места</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>второй свет</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>сауна</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row-col col-50">
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>навес</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>терасса</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>балкон</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>бассейн</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="catalog-filters--section show-more-parent">
                            <div class="catalog-filters--head">
                                <h3 class="form-title">Подборки</h3>
                                <span class="show-more"></span>
                            </div>
                            <div class="catalog-filters--main show-more-hidden" style="display: none;">
                                <div class="form-row">
                                    <div class="form-row-col col-50">
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>новинки</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>скидки</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row-col col-50">
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox">
                                                    <span>бесплатно</span>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="reset">
                            <button type="reset">
                                <span>&times;</span>
                                сбросить фильтр
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
