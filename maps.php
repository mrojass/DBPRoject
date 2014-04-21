<!-- Maps page-->
<?php
  session_start();
  if(!isset($_SESSION['username']))
  {
    session_destroy();
    header("location:index.php");
  }
	include 'database_connector.php';
	
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$result=mysqli_query($con, "SELECT * FROM Agencies WHERE Aid='$id'");
		$row=mysqli_fetch_array($result);
		$address = $row['Street'] . $row['City'] . $row['Zip'];
	}

  function lookup($string){
 
     $string = str_replace (" ", "+", urlencode($string));
     $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=". $string ."&sensor=false";
   
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $details_url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     $response = json_decode(curl_exec($ch), true);
   
     // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
     if ($response['status'] != 'OK') {
      return null;
     }
   
     print_r($response);
     $geometry = $response['results'][0]['geometry'];
   
      $longitude = $geometry['location']['lat'];
      $latitude = $geometry['location']['lng'];
   
      $array = array(
          'latitude' => $geometry['location']['lat'],
          'longitude' => $geometry['location']['lng'],
          'location_type' => $geometry['location_type'],
      );
   
      return $array;
 
  }

  $destination_coordinates = lookup($address);

  ?> 
<!DOCTYPE html>
<html>
  <head>
  	<title> Deployments Map </title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 75% }
      #content-pane {
        float:right;
        width:48%;
        padding-left: 2%;
      }
      #outputDiv {
        font-size: 11px;
      }
    </style>
     <!--
    Include the maps javascript with sensor=true because this code is using a
    sensor (a GPS locator) to determine the user's location.
    See: https://developers.google.com/maps/documentation/javascript/tutorial#Loading_the_Maps_API
    -->
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtEkg4Nyp0xQHoU6JYK6oSm3-kp6u6WZw&sensor=true">
    </script>
   
    <script>
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see a blank space instead of the map, this
// is probably because you have denied permission for location sharing.

var map;
var geocoder;
var bounds = new google.maps.LatLngBounds();
var markersArray = [];

function initialize() {
  var mapOptions = {
    zoom: 6
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);

      var infowindow = new google.maps.InfoWindow({
        map: map,
        position: pos,
        content: 'You Are Here'
      });

      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }

}


function handleNoGeolocation(errorFlag) {
  if (errorFlag) {
    var content = 'Error: The Geolocation service failed.';
  } else {
    var content = 'Error: Your browser doesn\'t support geolocation.';
  }

  var options = {
    map: map,
    position: new google.maps.LatLng(60, 105),
    content: content
  };

  var infowindow = new google.maps.InfoWindow(options);
  map.setCenter(options.position);
}

function calculateDistances() {
  var service = new google.maps.DistanceMatrixService();
  service.getDistanceMatrix(
    {
      origins: [origin, destination],
      destinations: [destination, origin],
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.IMPERIAL,
      avoidHighways: false,
      avoidTolls: false
    }, callback);
}

function callback(response, status) {
  if (status != google.maps.DistanceMatrixStatus.OK) {
    alert('Error was: ' + status);
  } else {
    var origins = response.originAddresses;
    var destinations = response.destinationAddresses;
    var outputDiv = document.getElementById('outputDiv');
    outputDiv.innerHTML = '';
    deleteOverlays();

    for (var i = 0; i < origins.length; i++) {
      var results = response.rows[i].elements;
      addMarker(origins[i]);
      for (var j = 0; j < results.length; j++) {
        addMarker(destinations[j]);
        outputDiv.innerHTML += origins[i] + ' to ' + destinations[j]
            + ': ' + results[j].distance.text + ' in '
            + results[j].duration.text + '<br>';
      }
    }
  }
}

function addMarker(location) {
  geocoder.geocode({'address': location}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      bounds.extend(results[0].geometry.location);
      map.fitBounds(bounds);
      var marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location,
        icon: icon
      });
      markersArray.push(marker);
    } else {
      alert('Geocode was not successful for the following reason: '
        + status);
    }
  });
}

function deleteOverlays() {
  for (var i = 0; i < markersArray.length; i++) {
    markersArray[i].setMap(null);
  }
  markersArray = [];
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body background="background2.jpg">
		<img align="left" width="150" src="SERTlogo.png"></img>
		<img align="right" width="150" src="SERTlogo.png"></img>
	<h1 align="middle" style="padding-top:30px; color:white">Florida State CBRNE Specialized Equipment Database</h1>
   <div id="content-pane">
      <div id="inputs">
        <pre>
  var origin = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);
  var destination = new google.maps.LatLng(<?php echo $destination_coordinates['latitude']; ?>, <?php echo $destination_coordinates['longitude']; ?>);
        </pre>
        <p><button type="button" onclick="calculateDistances();">Calculate
          Distance From Current Location</button></p>
      </div>
      <div id="outputDiv"></div>
    <div id="map-canvas"/>

    <div id="bottombar"> </div>
  </body>
</html>
