/*
 * Fichier JavaScript : googlemaps
 * @author : Alexandre ROY <contact@aroybase.com>
 * @date : 03/03/12
 */

$(document).ready(function () {
    var $googlemap = document.getElementById('googlemap'), // Native JS selection
        $JQgooglemap = $('#googlemap'), // jQuery selection
        options = {
            zoom:12,
            mapTypeId:google.maps.MapTypeId.HYBRID
        },
        map = new google.maps.Map($googlemap, options);


    geolocate(map);
    $.each(markerList, function (i, markerJSON) {
        addMarker(map, markerJSON);
        map.setCenter(new google.maps.LatLng(markerJSON.latitude, markerJSON.longitude));
    });
    detectBrowser($JQgooglemap);
});

/**
 * Ajoute un markeur à la carte
 * @param map
 * @param position
 * @param content
 */
function addMarker(map, configJSON) {
    var icon = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/' + configJSON.couleur + '-dot.png',
        marker = new google.maps.Marker({
            map:map,
            position:new google.maps.LatLng(configJSON.latitude, configJSON.longitude),
            icon:icon
        }),
        infowindow = new google.maps.InfoWindow();

    infowindow.setContent(configJSON.html);
//    google.maps.event.addListener(marker, 'click', function () {
//        infowindow.open(map, marker);
//    });
        infowindow.open(map, marker);
}

/**
 * Géolocalise l'utilisateur
 * @param map
 */
function geolocate(map) {
    // Try HTML5 geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
                infowindow = new google.maps.InfoWindow({
                    map:map,
                    position:pos
                }),
                markerJSON = {
                    couleur:'green',
                    latitude:position.coords.latitude,
                    longitude:position.coords.longitude
                };
            addMarker(map, markerJSON);

            // Avec cette info je vais pouvoir calculer le chemin le plus court
            console.info(pos);

        }, function () {
            handleNoGeolocation(true);
        });
    } else {
        // Browser doesn't support Geolocation
        handleNoGeolocation(false);
    }
}

/**
 * Gestion d'erreur de la géolocalisation
 * @param errorFlag
 */
function handleNoGeolocation(errorFlag) {
    if (errorFlag) {
        var content = 'Error: The Geolocation service failed.';
    } else {
        var content = 'Error: Your browser doesn\'t support geolocation.';
    }

    var options = {
            map:map,
            position:new google.maps.LatLng(0, 0),
            content:content
        },
        infowindow = new google.maps.InfoWindow(options);
}


/**
 * Détecte le système et adapte la taille de la map
 * @param $JQelement
 */
function detectBrowser($JQelement) {
    var useragent = navigator.userAgent;

    if (useragent.indexOf('iPhone') != -1 || useragent.indexOf('Android') != -1) {
        $JQelement.addClass('smartphone');
    }
    $JQelement.addClass('smartphone');
}