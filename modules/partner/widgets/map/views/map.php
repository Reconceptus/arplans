<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 17:32
 */
/* @var $models \modules\partner\models\Village[] */
$builders = [];
$coordinates = [];
?>
<div class="view-map" data-map="settlements-map">
    <div class="selected-items">
        <?php foreach ($models as $model): ?>
            <?php if ($model->lat && $model->lng) {
                $builders[] = 'builder' . $model->id;
                $coordinates[] = ['lat' => $model->lat, 'lng' => $model->lng];
            }
            ?>
            <div class="partners-list--item map-item" data-item="builder<?= $model->id ?>">
                <figure class="bg" style="background-image: url(<?= $model->getMainImage() ?>)"></figure>
                <a href="/village/<?= $model->slug ?>">
                    <div class="partners-list--data">
                        <div class="name"><?= $model->name ?></div>
                        <div class="address"><?= $model->address ?></div>
                        <div class="tel"><?= $model->phones ?></div>
                        <?php if ($model->email): ?>
                            <div class="email"><?= $model->email ?></div>
                        <?php endif; ?>
                    </div>
                </a>
                <span class="close">&times;</span>
            </div>
        <?php endforeach; ?>
    </div>
    <div id="map"></div>
    <script type="text/javascript">
        var map;

        function initMap() {

            var icon = '/img/map-mark.png';

            var mapOptions = {
                zoom: 3,
                mapTypeControl: false,
                streetViewControl: false,
                scrollwheel: false,
                center: new google.maps.LatLng(61.110217, 101.464168)
            };
            map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var locations = [
                <?foreach ($coordinates as $coordinate):?>
                {lat: <?=$coordinate['lat']?>, lng: <?=$coordinate['lng']?>},
                <?endforeach;?>
            ];

            var builders = [
                <?foreach ($builders as $builder):?>
                '<?=$builder?>',
                <?endforeach;?>
            ];

            var marker;
            for (var i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: locations[i],
                    map: map,
                    icon: icon,
                    builder: builders[i]
                });
                google.maps.event.addListener(
                    marker,
                    "click",
                    function () {
                        var $thisMarkerItem = this.builder,
                            $thisItem = document.querySelectorAll('[data-item=' + $thisMarkerItem + ']')[0],
                            elems = document.querySelectorAll(".map-item");

                        [].forEach.call(elems, function (el) {
                            el.classList.remove("active");
                        });

                        $thisItem.classList.add("active");
                    }
                );
            }
        }
    </script>
    <!-- API KEY for ARPLANS:  AIzaSyAq3bYt2V4QqFvLcak_2ajt34wbfFuU8qY-->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmJmuofNtaxw8ZFp1IPgcRjCocajdNhbU&callback=initMap"></script>

</div>
