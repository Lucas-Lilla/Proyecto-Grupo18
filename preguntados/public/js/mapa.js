var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 0, lng: 0 }, // Centrar el mapa en coordenadas iniciales
        zoom: 15 // Establecer el nivel de zoom
    });

    var input = document.getElementById('ubicacion');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.bindTo('bounds', map);

    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function () {
        marker.setVisible(false);
        var place = autocomplete.getPlace();

        if (!place.geometry) {
            window.alert("No hay detalles disponibles para la entrada: '" + place.name + "'");
            return;
        }

        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    });

    // map.addListener('click', function (event) {
    //     marker.setPosition(event.latLng);
    //     map.setCenter(marker.getPosition());
    //     document.getElementById('ubicacion').value = event.latLng.lat() + ', ' + event.latLng.lng();
    // });


}

