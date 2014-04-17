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
		$lon=$row['longitude'];
		$lat=$row['latitude'];
	}

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
      #map-canvas { height: 50%; width: 75%; margin-top: 300px; margin-left: 150px }
      #loginbox { height: 150px }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtEkg4Nyp0xQHoU6JYK6oSm3-kp6u6WZw&sensor=false">
    </script>
    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(-34.397, 150.644),
          zoom: 8
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body background="background2.jpg">
		<img align="left" width="150" src="SERTlogo.png"></img>
		<img align="right" width="150" src="SERTlogo.png"></img>
	<h1 align="middle" style="padding-top:30px; color:white">Florida State CBRNE Specialized Equipment Database</h1>
   <!--<div id="loginbox">
    <h2>Search Map For Deployment:</h2><br/>
    <form name="searchmap" action="maps.php" method="post">
      <input type="text" name="search" />
      <input type="button" name="submit" value="Search" />
    </form>
  </div>-->
    <div id="map-canvas"/>
    <div id="bottombar"> </div>
  </body>
</html>
