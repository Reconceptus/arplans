<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 17:19
 */

/* @var $query */

$this->title = 'Клуб АРПЛАНС: строители и материалы';
?>
    <div class="section bg-head">
        <div class="content content--lg">
            <div class="bg-head--main gradient"><h1 class="title title-lg"><?= $this->title ?></h1></div>
        </div>
    </div>
    <div class="section">
        <div class="content content--lg">
            <div class="custom-row filter-row">
                <?= \modules\partner\widgets\filters\Filters::widget(['viewName' => 'villages']) ?>
                <div class="custom-row-col col-elastic">
                    <div class="map-box">
                        <div class="map-box--main view-box">
                            <input type="radio" id="view_map" name="view">
                            <input type="radio" checked id="view_list" name="view">
                            <div class="custom-search">
                                <form action="#">
                                    <div class="custom-search--field">
                                        <div class="custom-search--inputs">
                                            <div class="input region-dropbox">
                                                <input type="text" placeholder="Введите название населенного пункта">
                                                <?= \modules\partner\widgets\regions\Regions::widget(['viewName' => 'drop']) ?>
                                            </div>
                                            <button class="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg">
                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                         xlink:href="#icon-search"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="custom-search--nav">
                                            <label for="view_map" class="view view-map">
                                                На карте
                                            </label>
                                            <label for="view_list" class="view view-list">
                                                списком
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="map-box--field">
                                <?= \modules\partner\widgets\map\Map::widget(['viewName' => 'both', 'query' => $query]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section info-box ">
        <div class="content content--md">
            <div class="ready-projects--info">
                <h3 class="title">Клуб Арпланс</h3>
                <div class="info-box--text">
                    <p>В этом блоке 3 стиля: основной, <a href="#">ссылка</a>, <strong>болд</strong>. Не
                        обязательное поле для текстового описания. ARPLANS.RU — сервис готовых архитектурных
                        проектов загородных домов, коттеджей, бань. По нашим проектам многократно производилось
                        строительство, а качество чертежей проектной документации проверено временем и репутацией
                        разработчиков. Все проекты созданы опытными и высококвалифицированны архитекторами и
                        инженерами ARPLANS.</p>
                    <p>Здесь рыба. Сервис готовых архитектурных проектов загородных домов, коттеджей, бань. По нашим
                        проектам многократно производилось строительство, а качество чертежей проектной документации
                        проверено временем и репутацией разработчиков. Все проекты созданы опытными и
                        высококвалифицированны архитекторами и инженерами ARPLANS.</p>
                </div>
            </div>
        </div>
    </div>
<?= \frontend\widgets\recently\Recently::widget() ?>