
	var marker, infoWindow;
function initialize()
{
var mapProp = {
center:new google.maps.LatLng(-36.8626662,174.7253873),  
zoom:17,
mapTypeId:google.maps.MapTypeId.ROADMAP
};
var map=new google.maps.Map(document.getElementById("googleMap")
,mapProp);

infoWindow = new google.maps.InfoWindow;

if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Your current location.');
            infoWindow.open(map);
            map.setCenter(pos);
            document.getElementById('displayLat').value = pos.lat;
			document.getElementById('displayLong').value = pos.lng;
			placeMarker(pos);
            google.maps.event.addListener(infoWindow, 'click', function(event) {
			  
			});	

          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

citMarker=new google.maps.Marker();

citMarker.setMap(map);

google.maps.event.addListener(citMarker, 'click', function() {
map.setZoom(15);
map.setCenter(citMarker.getPosition());
infowindow.open(map,citMarker);
});


var input = document.getElementById('pac-input');
var searchBox = new google.maps.places.SearchBox(input);
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

// Bias the SearchBox results towards current map's viewport.
map.addListener('bounds_changed', function() {
searchBox.setBounds(map.getBounds());
});

var markers = [];
// Listen for the event fired when the user selects a prediction and retrieve
// more details for that place.
searchBox.addListener('places_changed', function() {
var places = searchBox.getPlaces();

if (places.length == 0) {
return;
}


// Clear out the old markers.
markers.forEach(function(marker) {
marker.setMap(null);
});
markers = [];

// For each place, get the icon, name and location.
var bounds = new google.maps.LatLngBounds();
places.forEach(function(place) {

if (places.length == 1) {
latLng = place.geometry.location;
placeMarker(latLng);
  document.getElementById('displayLat').value = latLng.lat();
  document.getElementById('displayLong').value = latLng.lng();
  
}

if (!place.geometry) {
  console.log("Returned place contains no geometry");
  return;
}
var icon = {
  url: place.icon,
  size: new google.maps.Size(71, 71),
  origin: new google.maps.Point(0, 0),
  anchor: new google.maps.Point(17, 34),
  scaledSize: new google.maps.Size(25, 25)
};

// Create a marker for each place.
markers.push(new google.maps.Marker({
  map: map,
  icon: icon,
  title: place.name,
  position: place.geometry.location
}));

if (place.geometry.viewport) {
  // Only geocodes have viewport.
  bounds.union(place.geometry.viewport);
} else {
  bounds.extend(place.geometry.location);
}



//add code here


});
map.fitBounds(bounds);
});



google.maps.event.addListener(map, 'rightclick', function(event) {
  document.getElementById('displayLat').value = event.latLng.lat();
  document.getElementById('displayLong').value = event.latLng.lng();
  placeMarker(event.latLng);
});

google.maps.event.addListener(map, 'click', function(event) {
  placeMarker(event.latLng);
  document.getElementById('displayLat').value = event.latLng.lat();
  document.getElementById('displayLong').value = event.latLng.lng();
  
});

function placeMarker(location) {
	if (marker && marker.setMap) {
    marker.setMap(null);
}
marker = new google.maps.Marker({
position: location,
map: map,
});

// var lat = location.lat;
// var long = location.lng;

var infowindow = new google.maps.InfoWindow({
// content: 'Latitude: ' + location.lat() +
// '<br>Longitude: ' + location.lng()
 content: "You've selected this location. <br>" +
 'Latitude: ' + location.lat() +
'<br>Longitude: ' + location.lng()
});
infowindow.open(map,marker);

google.maps.event.addListener(marker, 'click', function() {
infowindow.open(map,marker);
placeMarker(event.latLng);
  document.getElementById('displayLat').value = event.latLng.lat();
  document.getElementById('displayLong').value = event.latLng.lng();

});
}
}

google.maps.event.addDomListener(window, 'load', initialize);
