<?php
/* @var $models array */
$coordinates = [];
$icons = [];
?>
<div data-map="offices-map">
    <?php foreach ($models as $k => $model): ?>
        <?php if ($model->lat && $model->lng) {
            $coordinates[$k] = ['lat' => $model->lat, 'lng' => $model->lng];
            $icons[$k] = ['url' => '/svg/partials/map-mark.svg?i=custom_marker' . $k];
        }
        ?>
    <?php endforeach; ?>
    <div id="map"></div>
    <script type="text/javascript">
        var map;

        function initMap() {

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

            var icons = [
                <?foreach ($icons as $icon):?>
                {url: '<?=$icon['url']?>', size: new google.maps.Size(36, 41)},
                <?endforeach;?>
            ];

            var marker;

            for (var i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: locations[i],
                    map: map,
                    icon: icons[i]
                });
            }
        }
    </script>
    <!-- API KEY for ARPLANS:  AIzaSyAq3bYt2V4QqFvLcak_2ajt34wbfFuU8qY-->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmJmuofNtaxw8ZFp1IPgcRjCocajdNhbU&callback=initMap"></script>

</div>
