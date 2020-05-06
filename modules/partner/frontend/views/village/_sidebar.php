<?php

/* @var $model \modules\partner\models\Village */
?>
<div class="custom-row-col col-sidebar tablet-hidden">
    <div class="fixed-scrollbar">
        <div class="fixing">
            <div class="catalog-filters scrolled">
                <div class="filter-form">
                    <div class="catalog-filters--section">
                        <div class="catalog-filters--head">
                            <h3 class="form-title">Инженерные сети</h3>
                        </div>
                        <div class="catalog-filters--main">
                            <div class="form-row">
                                <div class="form-row-col">
                                    <?php if ($model->electric): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>электроснабжение</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->gas): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>газоснабжение</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->water): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>водоснабжение</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->internet): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>интернет</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->gas_boiler): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>газовая котельная</span>
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
                            <h3 class="form-title">Безопасность</h3>
                        </div>
                        <div class="catalog-filters--main">
                            <div class="form-row">
                                <div class="form-row-col">
                                    <?php if ($model->territory_control): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>охрана территории и подъездов</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->fire_alarm): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>противопожарная сигнализация</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->security_alarm): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>охранная сигнализация</span>
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
                            <h3 class="form-title">Инфраструктура</h3>
                        </div>
                        <div class="catalog-filters--main">
                            <div class="form-row">
                                <div class="form-row-col">
                                    <?php if ($model->shop): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>магазины</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->children_club): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>детский клуб</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->sports_center): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>спортивно-оздоровительный комплекс</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->sports_ground): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>спортивные площадки</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->golf_club): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>гольф-клуб</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->beach): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>пляж</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->life_service): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>служба быта</span>
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
                            <h3 class="form-title">Экология</h3>
                        </div>
                        <div class="catalog-filters--main">
                            <div class="form-row">
                                <div class="form-row-col">
                                    <?php if ($model->forest): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>лесозона</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($model->reservoir): ?>
                                        <div class="form-row-element">
                                            <div class="checked">
                                                <label>
                                                    <span>водоем</span>
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
