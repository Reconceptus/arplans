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
        <? foreach ($models as $model): ?>
            <?
            if ($model->lat && $model->lng) {
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
                        <? if ($model->email): ?>
                            <div class="email"><?= $model->email ?></div>
                        <? endif; ?>
                    </div>
                </a>
                <span class="close">&times;</span>
            </div>
        <? endforeach; ?>
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
                styles: [{
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{"color": "#e9e9e9"}, {"lightness": 17}]
                }, {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [{"color": "#f5f5f5"}, {"lightness": 20}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{"color": "#ffffff"}, {"lightness": 17}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#ffffff"}, {"lightness": 29}, {"weight": 0.2}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{"color": "#ffffff"}, {"lightness": 18}]
                }, {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{"color": "#ffffff"}, {"lightness": 16}]
                }, {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{"color": "#f5f5f5"}, {"lightness": 21}]
                }, {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [{"color": "#dedede"}, {"lightness": 21}]
                }, {
                    "elementType": "labels.text.stroke",
                    "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]
                }, {
                    "elementType": "labels.text.fill",
                    "stylers": [{"saturation": 36}, {"color": "#333333"}, {"lightness": 40}]
                }, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [{"color": "#f2f2f2"}, {"lightness": 19}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [{"color": "#fefefe"}, {"lightness": 20}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]
                }],
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
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAq3bYt2V4QqFvLcak_2ajt34wbfFuU8qY&callback=initMap"></script>

</div>
