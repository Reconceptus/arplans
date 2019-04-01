<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.09.2018
 * Time: 13:12
 */

/* @var $model \modules\partner\models\Builder */
?>
<div class="custom-row-col col-sidebar tablet-hidden">
    <div class="fixed-scrollbar">
        <div class="fixing">
            <div class="catalog-filters scrolled">
                <div class="filter-form">
                    <div class="catalog-filters--section">
                        <div class="catalog-filters--head">
                            <h3 class="form-title">Строительство домов</h3>
                        </div>
                        <div class="catalog-filters--main">
                            <div class="form-row">
                                <div class="form-row-col">
                                    <?php if ($model->glued_timber): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>из клееного бруса</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->profiled_timber): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>из профилированного бруса</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->wooden_frame): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>на основе деревянного каркаса</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->lstk): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>на основе каркаса из ЛСТК</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->carcass): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>каркасные дома</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->combined): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>комбинированные дома</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->brick): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>из блоков и кирпича</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->block): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>из газобетонных блоков</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="catalog-filters--section">
                        <div class="catalog-filters--head">
                            <h3 class="form-title">Работы</h3>
                        </div>
                        <div class="catalog-filters--main">
                            <div class="form-row">
                                <div class="form-row-col">
                                    <?php if ($model->finishing): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>отделочные</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->santech): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>сантехнические</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->electric): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>электромонтажные</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="catalog-filters--section">
                        <div class="catalog-filters--head">
                            <h3 class="form-title">Материалы</h3>
                        </div>
                        <div class="catalog-filters--main">
                            <div class="form-row">
                                <div class="form-row-col">
                                    <?php if ($model->wooden): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>деревянные</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->stone): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>каменные</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->roof): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>кровельные</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->windows): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>окна и двери</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->stretch_ceiling): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>натяжные потолки</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="catalog-filters--section">
                        <div class="catalog-filters--head">
                            <h3 class="form-title">География</h3>
                        </div>
                        <div class="catalog-filters--main">
                            <div class="form-row">
                                <div class="form-row-col">
                                    <?php if ($model->surround_region): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>возможен выезд в соседний регион</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->any_region): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>возможен выезд в любую часть России</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
