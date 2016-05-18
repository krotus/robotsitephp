var map = new Array();
var marker = new Array();
var geocoder = null;
$(document).ready(function(){
	$('#mapModal').on('shown.bs.modal', function () {
        initializeMap("newMap", "mapdiv", 10.444598, -66.9287, "");
    });
});


function addPoint(location, id, mapId) {
    if (!marker[id]) {
        marker[id] = new google.maps.Marker({
            position: location,
            map: map[mapId],
            draggable: true
        });
    }

}


function placeMarker(location, editStr, id) {
    if (!marker[id]) {
        marker[id] = new google.maps.Marker({
            position: location,
            map: map[id],
            draggable: false
        });
    }
    marker[id].setPosition(location);
    map[id].setCenter(location);
    $("#longitud").val(location.lat());
    $("#latitud").val(location.lng());
}


function  initializeMap(id, div_id, lat, lng, editStr) {
    if (!geocoder)
        geocoder = new google.maps.Geocoder();

    if (!map[id]) {
        var coordinates = new google.maps.LatLng(lat, lng);
        var myOptions = {zoom: 12, center: coordinates, mapTypeId: google.maps.MapTypeId.ROADMAP}
        map[id] = new google.maps.Map(document.getElementById(div_id), myOptions);
        google.maps.event.addListener(map[id], 'click', function(event) {
            placeMarker(event.latLng, editStr, id);
        });

        placeMarker(coordinates, editStr, id);

    }
}

function openMap(e){
	$('#mapModal').modal('toggle');
}