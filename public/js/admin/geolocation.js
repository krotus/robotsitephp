var map = new Array();
var marker = new Array();
var geocoder = null;
var location_global = null;
$(document).ready(function(){
	$('#mapModal').on('shown.bs.modal', function () {
        initializeMap("newMap", "mapdiv", 41.5994502, 2.2885268, "");
    });
    $("#save_ubication").on("click", function(){
	    $("#robot_latitude").val(location_global.lat());
		$("#robot_longitude").val(location_global.lng());
    	toggleMap();
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
    location_global = location;
}


function  initializeMap(id, div_id, lat, lng, editStr) {
    if (!geocoder)
        geocoder = new google.maps.Geocoder();

    if (!map[id]) {
        var coordinates = new google.maps.LatLng(lat, lng);
        var myOptions = {
        	zoom: 12, 
        	center: coordinates, 
        	mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map[id] = new google.maps.Map(document.getElementById(div_id), myOptions);
        google.maps.event.addListener(map[id], 'click', function(event) {
            placeMarker(event.latLng, editStr, id);
        });

        placeMarker(coordinates, editStr, id);

    }
}

function toggleMap(){
	$('#mapModal').modal('toggle');
}