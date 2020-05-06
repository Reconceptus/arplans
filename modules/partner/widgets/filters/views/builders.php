<?php
$get = Yii::$app->request->get();
?>
    <div class="custom-row-col col-sidebar">
        <div class="btn-box">
            <button class="btn btn--lt show-modal-filter">показать фильтры</button>
        </div>
        <div class="fixed-scrollbar modal-filter">
            <div class="modal-bg close"></div>
            <div class="fixing">
                <div class="catalog-filters dynamic">
                    <div class="catalog-filters--container" data-catalog="partners">
                        <div class="catalog-filters--btn">
                            <a href="#" class="btn--lt btn show-modal" data-modal="partnership">+ запрос на
                                партнерство</a>
                        </div>
                        <form action="/builder">
                            <?php if (isset($get['region'])): ?>
                                <input type="hidden" name="region" value="<?= $get['region'] ?>">
                            <?php endif; ?>
                            <div class="catalog-filters--form scrolled">
                                <div class="filter-form">
                                    <div class="catalog-filters--section show-more-parent show">
                                        <div class="catalog-filters--head">
                                            <h3 class="form-title">
                                                <div class="check">
                                                    <label>
                                                        <input type="checkbox" class="main-checkbox">
                                                        <span>Строительство домов</span>
                                                    </label>
                                                </div>
                                            </h3>
                                            <span class="show-more"></span>
                                        </div>
                                        <div class="catalog-filters--main show-more-hidden" style="display: block;">
                                            <div class="form-row">
                                                <div class="form-row-col">
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="build[glued_timber]" <?= isset($get['build']['glued_timber']) ? 'checked' : '' ?>>
                                                                <span>из кленного бруса</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="build[profiled_timber]" <?= isset($get['build']['profiled_timber']) ? 'checked' : '' ?>>
                                                                <span>из профилированного бруса</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="build[wooden_frame]" <?= isset($get['build']['wooden_frame']) ? 'checked' : '' ?>>
                                                                <span>на основе деревянного каркаса</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="build[lstk]" <?= isset($get['build']['lstk']) ? 'checked' : '' ?>>
                                                                <span>на основе каркаса из ЛСТК</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="build[carcass]" <?= isset($get['build']['carcass']) ? 'checked' : '' ?>>
                                                                <span>каркасные дома</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="build[combined]" <?= isset($get['build']['combined']) ? 'checked' : '' ?>>
                                                                <span>комбинированные дома</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="build[brick]" <?= isset($get['build']['brick']) ? 'checked' : '' ?>>
                                                                <span>из блоков и кирпича</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="build[block]" <?= isset($get['build']['block']) ? 'checked' : '' ?>>
                                                                <span>из газобетонных блоков</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="catalog-filters--section show-more-parent">
                                        <div class="catalog-filters--head">
                                            <h3 class="form-title">
                                                <div class="check">
                                                    <label>
                                                        <input type="checkbox" class="main-checkbox">
                                                        <span>Работы</span>
                                                    </label>
                                                </div>
                                            </h3>
                                            <span class="show-more"></span>
                                        </div>
                                        <div class="catalog-filters--main show-more-hidden" style="display: none;">
                                            <div class="form-row">
                                                <div class="form-row-col">
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="works[finishing]" <?= isset($get['works']['finishing']) ? 'checked' : '' ?>>
                                                                <span>отделочные</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="works[santech]" <?= isset($get['works']['santech']) ? 'checked' : '' ?>>
                                                                <span>сантехнические</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="works[electric]" <?= isset($get['works']['electric']) ? 'checked' : '' ?>>
                                                                <span>электромонтажные</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="catalog-filters--section show-more-parent">
                                        <div class="catalog-filters--head">
                                            <h3 class="form-title">
                                                <div class="check">
                                                    <label>
                                                        <input type="checkbox" class="main-checkbox">
                                                        <span>Материалы</span>
                                                    </label>
                                                </div>
                                            </h3>
                                            <span class="show-more"></span>
                                        </div>
                                        <div class="catalog-filters--main show-more-hidden" style="display: none;">
                                            <div class="form-row">
                                                <div class="form-row-col">
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="mat[wooden]" <?= isset($get['mat']['wooden']) ? 'checked' : '' ?>>
                                                                <span>деревянные</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="mat[stone]" <?= isset($get['mat']['stone']) ? 'checked' : '' ?>>
                                                                <span>каменные</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="mat[roof]" <?= isset($get['mat']['roof']) ? 'checked' : '' ?>>
                                                                <span>кровельные</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="mat[windows]" <?= isset($get['mat']['windows']) ? 'checked' : '' ?>>
                                                                <span>окна и двери</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="mat[stretch_ceiling]" <?= isset($get['mat']['stretch_ceiling']) ? 'checked' : '' ?>>
                                                                <span>натяжные потолки</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="catalog-filters--section show-more-parent">
                                        <div class="catalog-filters--head">
                                            <h3 class="form-title">
                                                <div class="check">
                                                    <label>
                                                        <input type="checkbox" class="main-checkbox">
                                                        <span>География</span>
                                                    </label>
                                                </div>
                                            </h3>
                                            <span class="show-more"></span>
                                        </div>
                                        <div class="catalog-filters--main show-more-hidden" style="display: none;">
                                            <div class="form-row">
                                                <div class="form-row-col">
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="reg[surround_region]" <?= isset($get['reg']['surround_region']) ? 'checked' : '' ?>>
                                                                <span>возможен выезд в соседний регион</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row-element">
                                                        <div class="check">
                                                            <label>
                                                                <input type="checkbox"
                                                                       name="reg[any_region]" <?= isset($get['reg']['any_region']) ? 'checked' : '' ?>>
                                                                <span>возможен выезд в любую часть России</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="actions">
                                <div class="reset">
                                    <a href="/<?= \yii\helpers\Url::to(Yii::$app->request->getPathInfo()) ?>"
                                       class="btn-reset">
                                        <span>&times;</span>
                                        сбросить фильтр
                                    </a>
                                </div>
                                <div class="submit">
                                    <button class="btn-square-min">показать</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= \frontend\widgets\request\Request::widget(['viewName' => 'partnership']) ?>