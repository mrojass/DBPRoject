<!-- Maps page-->
<?php
/*function lookup($string){
    echo " 1";
    //echo $string;
     $string = str_replace (" ", "+", urlencode($string));
     $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=". $string ."&sensor=true&key=AIzaSyBtEkg4Nyp0xQHoU6JYK6oSm3-kp6u6WZw";
     // echo $details_url;
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
      echo "2";
      $array = array(
          'latitude' => $geometry['location']['lat'],
          'longitude' => $geometry['location']['lng'],
          'location_type' => $geometry['location_type'],
      );
   
      return $array;
 
  }*/
  session_start();
  if(!isset($_SESSION['username']))
  {
    session_destroy();
    header("location:index.php");
  }
  include 'database_connector.php';
  
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $result=mysqli_query($con, "SELECT * FROM Agencies WHERE Aid=$id");
    if (!$result)
        echo "No result";

    $row=mysqli_fetch_array($result);
    $lat = $row['Latitude'];
    $lng = $row['Longitude'];
    //echo $address;
    //$dest_coords = lookup($address);
    //if(is_null($dest_coords))
    //  echo "Nothing";
  }

  

  ?> 
<!DOCTYPE html>
<html>
  <head>
    <title> Distance Map </title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 60% }
      #outputDiv {
        text-align:center;
        top: 50%;
        border:3px solid black;
        border-radius:25px;
          
          width:500px;
          height:100px;
          margin-top: 10px; /*set to a negative number 1/2 of your height*/
          
        background-image:url("background3.jpg")
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
var origin;

var destination = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>);
var bounds = new google.maps.LatLngBounds();

function initialize() {
  var mapOptions = {
    zoom: 6
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      origin = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);

      var origin_marker = new google.maps.Marker({
        position: origin,
        map: map,
        icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
        title: 'Current Location'
      });

      var marker = new google.maps.Marker({
        position: origin,
        map: map,
        icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
        title: 'Current Location'
      });

      marker = new google.maps.Marker({
        position: destination,
        map: map,
        icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
        title: 'Equipment Location'
      });
      map.setCenter(origin);
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

google.maps.event.addDomListener(window, 'load', initialize);

var options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

function success(pos) {
  var position = new google.maps.LatLng(pos.coords.latitude,
                                       pos.coords.longitude);
  return position;
}

function error(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
};

function calculateDistances() {
      
  var service = new google.maps.DistanceMatrixService();
  service.getDistanceMatrix(
    {
      origins: [origin],
      destinations: [destination],
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
    var results = response.rows[0].elements;
    outputDiv.innerHTML = '<b>Results</b><br>';
    outputDiv.innerHTML += 'from ' + origins[0] + '<br>' + ' to ' + destinations[0]
            + ': ' + '<br>' + results[0].distance.text + ' in '
            + results[0].duration.text + '<br>';
    
    
  }
}

    </script>
  </head>
  <body background="background2.jpg">
    <img align="left" width="150" src="SERTlogo.png"></img>
    <img align="right" width="150" src="SERTlogo.png"></img>
  <h1 align="middle" style="padding-top:30px; color:white">Florida State CBRNE Specialized Equipment Database</h1>      
    <div id="map-canvas"></div>
    <center><div id="outputDiv"></div> <button type="button" onclick="calculateDistances();">Calculate
          distances</button></center>
    <div id="bottombar"> </div>
  </body>
</html>