<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 17:18
 */
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
                        <a href="/village/add" class="btn--lt btn">+ добавить свой поселок</a>
                    </div>
                    <form action="/village">
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
                                                    <span>Инженерные сети</span>
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
                                                                   name="networks[electric]" <?= isset($get['networks']['electric']) ? 'checked' : '' ?>>
                                                            <span>электроснабжение</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row-element">
                                                    <div class="check">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="networks[gas]" <?= isset($get['networks']['gas']) ? 'checked' : '' ?>>
                                                            <span>газоснабжение</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row-element">
                                                    <div class="check">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="networks[water]" <?= isset($get['networks']['water']) ? 'checked' : '' ?>>
                                                            <span>водоснабжение</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row-element">
                                                    <div class="check">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="networks[internet]" <?= isset($get['networks']['internet']) ? 'checked' : '' ?>>
                                                            <span>интернет</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row-element">
                                                    <div class="check">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="networks[gas_boiler]" <?= isset($get['networks']['gas_boiler']) ? 'checked' : '' ?>>
                                                            <span>газовая котельная</span>
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
                                                    <span>Безопасность</span>
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
                                                                   name="safety[territory_control]" <?= isset($get['safety']['territory_control']) ? 'checked' : '' ?>>
                                                            <span>охрана территории и подъездов</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row-element">
                                                    <div class="check">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="safety[fire_alarm]" <?= isset($get['safety']['fire_alarm']) ? 'checked' : '' ?>>
                                                            <span>противопожарная сигнализация</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row-element">
                                                    <div class="check">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="safety[security_alarm]" <?= isset($get['safety']['security_alarm']) ? 'checked' : '' ?>>
                                                            <span>охранная сигнализация</span>
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
                                                    <span>Инфраструктура</span>
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
                                                                   name="infra[shop]" <?= isset($get['infra']['shop']) ? 'checked' : '' ?>>
                                                            <span>магазины</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row-element">
                                                    <div class="check">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="infra[children_club]" <?= isset($get['infra']['children_club']) ? 'checked' : '' ?>>
                                                            <span>детский клуб</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row-element">
                                                    <div class="check">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="infra[sports_center]" <?= isset($get['infra']['sports_center']) ? 'checked' : '' ?>>
                                                            <span>спортивно-оздоровительный комплекс</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row-element">
                                                    <div class="check">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="infra[sports_ground]" <?= isset($get['infra']['sports_ground']) ? 'checked' : '' ?>>
                                                            <span>спортивные площадки</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row-element">
                                                    <div class="check">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="infra[golf_club]" <?= isset($get['infra']['golf_club']) ? 'checked' : '' ?>>
                                                            <span>гольф-клуб</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row-element">
                                                    <div class="check">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="infra[beach]" <?= isset($get['infra']['beach']) ? 'checked' : '' ?>>
                                                            <span>пляж</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row-element">
                                                    <div class="check">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="infra[life_service]" <?= isset($get['infra']['life_service']) ? 'checked' : '' ?>>
                                                            <span>служба быта</span>
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
                                                    <span>Экология</span>
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
                                                                   name="eco[forest]" <?= isset($get['eco']['forest']) ? 'checked' : '' ?>>
                                                            <span>лесозона</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row-element">
                                                    <div class="check">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="eco[reservoir]" <?= isset($get['eco']['reservoir']) ? 'checked' : '' ?>>
                                                            <span>водоем</span>
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
