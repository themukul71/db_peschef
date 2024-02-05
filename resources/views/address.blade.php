<?php echo Request::ip(); ?>
<!DOCTYPE html>
<html>
<body>
<h1>HTML Geolocation</h1>
<p>Click the button to get your coordinates.</p>

<button onclick="getLocation()">Try It</button>

<p id="demo"></p>
<p id="address"></p> <!-- New paragraph to display the address -->

<script>
const x = document.getElementById("demo");
const addressDisplay = document.getElementById("address");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;

  // Use the Google Maps Geocoding API to convert coordinates to address
  const geocoder = new google.maps.Geocoder();
  const latlng = {
    lat: position.coords.latitude,
    lng: position.coords.longitude
  };

  geocoder.geocode({ location: latlng }, (results, status) => {
    if (status === 'OK') {
      if (results[0]) {
        const formattedAddress = results[0].formatted_address;
        addressDisplay.innerHTML = "Address: " + formattedAddress;
      } else {
        addressDisplay.innerHTML = "No address found for these coordinates.";
      }
    } else {
      addressDisplay.innerHTML = "Geocoder failed due to: " + status;
    }
  });
}

function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      x.innerHTML = "User denied the request for Geolocation."
      break;
    case error.POSITION_UNAVAILABLE:
      x.innerHTML = "Location information is unavailable."
      break;
    case error.TIMEOUT:
      x.innerHTML = "The request to get user location timed out."
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML = "An unknown error occurred."
      break;
  }
}
</script>

<!-- Load the Google Maps JavaScript API with the Geocoder library -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBm2BhTFwHkpc0P0Pn_p3ATxGbnCQMpPSA&libraries=places"></script>
<!-- Replace YOUR_API_KEY with your actual API key -->
</body>
</html>
