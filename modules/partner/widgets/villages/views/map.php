<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 17.09.2018
 * Time: 17:32
 */
?>
<div class="view-map" data-map="settlements-map">
    <div class="selected-items">
        <div class="partners-list--item map-item" data-item="partner001">
            <figure class="bg" style="background-image: url('assets/images/items/item08.jpg')"></figure>
            <div class="partners-list--data">
                <div class="name">Лебежья поляна</div>
                <div class="address">Московская область, р-н. Раменки, ул. Красная, 5</div>
                <div class="tel">+7 895 456-67-88</div>
            </div>
            <span class="close">&times;</span>
        </div>
        <div class="partners-list--item map-item" data-item="partner002">
            <figure class="bg" style="background-image: url('assets/images/items/item06.jpg')"></figure>
            <div class="partners-list--data">
                <div class="name">Букатин луг</div>
                <div class="address">Московская область, р-н. Раменки, ул. Красная, 5</div>
                <div class="tel">+7 895 456-67-88</div>
            </div>
            <span class="close">&times;</span>
        </div>
    </div>
    <div id="map"></div>
    <script type="text/javascript">
        var map;
        function initMap() {

            var icon = './assets/images/map-mark.png';

            var mapOptions = {
                zoom: 10,
                mapTypeControl: false,
                streetViewControl: false,
                styles: [{ "featureType": "water", "elementType": "geometry", "stylers": [{ "color": "#e9e9e9"}, { "lightness": 17}]}, { "featureType": "landscape", "elementType": "geometry", "stylers": [{ "color": "#f5f5f5"}, { "lightness": 20}]}, { "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{ "color": "#ffffff"}, { "lightness": 17}]}, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{ "color": "#ffffff"}, { "lightness": 29}, { "weight": 0.2}]}, { "featureType": "road.arterial", "elementType": "geometry", "stylers": [{ "color": "#ffffff"}, { "lightness": 18}]}, { "featureType": "road.local", "elementType": "geometry", "stylers": [{ "color": "#ffffff"}, { "lightness": 16}]}, { "featureType": "poi", "elementType": "geometry", "stylers": [{ "color": "#f5f5f5"}, { "lightness": 21}]}, { "featureType": "poi.park", "elementType": "geometry", "stylers": [{ "color": "#dedede"}, { "lightness": 21}]}, { "elementType": "labels.text.stroke", "stylers": [{ "visibility": "on"}, { "color": "#ffffff"}, { "lightness": 16}]}, { "elementType": "labels.text.fill", "stylers": [{ "saturation": 36}, { "color": "#333333"}, { "lightness": 40}]}, { "elementType": "labels.icon", "stylers": [{ "visibility": "off"}]}, { "featureType": "transit", "elementType": "geometry", "stylers": [{ "color": "#f2f2f2"}, { "lightness": 19}]}, { "featureType": "administrative", "elementType": "geometry.fill", "stylers": [{ "color": "#fefefe"}, { "lightness": 20}]}, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{ "color": "#fefefe"}, { "lightness": 17}, { "weight": 1.2}]}],
                scrollwheel: false,
                center: new google.maps.LatLng(55.754080, 37.619151)
            };
            map = new google.maps.Map(document.getElementById('map'), mapOptions );

            var locations = [
                {lat: 55.754080, lng: 37.619151},
                {lat: 55.846140, lng: 37.849396}
            ];

            var partners = [
                'partner001',
                'partner002'
            ];

            var marker;

            for(var i = 0; i < locations.length; i++){
                marker = new google.maps.Marker({
                    position: locations[i],
                    map: map,
                    icon: icon,
                    partner: partners[i]
                });
                google.maps.event.addListener(
                    marker,
                    "click",
                    function () {
                        var $thisMarkerItem = this.partner,
                            $thisItem = document.querySelectorAll('[data-item='+$thisMarkerItem+']')[0],
                            elems = document.querySelectorAll(".map-item");

                        [].forEach.call(elems, function(el) {
                            el.classList.remove("active");
                        });

                        $thisItem.classList.add("active");
                    }
                );
            }
        }
    </script>
    <!-- API KEY for ARPLANS:  AIzaSyDTe4a3uDvnMx11fyEgPXA6UEEsNYh5Eg8-->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6PFq1z3G7_YGiZl1KUuVVH_kxI2YAdaA&callback=initMap"></script>

</div>
