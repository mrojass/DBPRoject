<?php
function lookup($string){
    
    //echo $string;
    $urladdress = urlencode($string);
    $urladdress = str_replace ("%A0", "+", $urladdress);
     $details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=". $urladdress ."&sensor=true&key=AIzaSyBtEkg4Nyp0xQHoU6JYK6oSm3-kp6u6WZw";
     //echo $details_url;
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $details_url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     $response = json_decode(curl_exec($ch), true);
   
     // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
     if ($response['status'] != 'OK') {
      return null;
     }
   
     //print_r($response);
     $geometry = $response['results'][0]['geometry'];
   
      $longitude = $geometry['location']['lat'];
      $latitude = $geometry['location']['lng'];
      //echo "2";
      $array = array(
          'latitude' => $geometry['location']['lat'],
          'longitude' => $geometry['location']['lng'],
          'location_type' => $geometry['location_type'],
      );
   
      return $array;
 
  }
  //session_start();
  //if(!isset($_SESSION['username']))
  //{
  //  session_destroy();
  //  header("location:index.php");
  //}
  include 'database_connector.php';
  
  //if(isset($_GET['id'])){
  //  $id=$_GET['id'];
    $result=mysqli_query($con, "SELECT * FROM Agencies ");
    //if (!$result)
    //    echo "No result";

    while ($row=mysqli_fetch_array($result)) {
    $address = $row['Street'] . " " . $row['City'] . " " . $row['Zip'];
    //echo $address;
    $dest_coords = lookup($address);

    $id = $row['Aid'];
    $lat = $dest_coords['latitude'];
    $lng = $dest_coords['longitude'];
    $update_query = "UPDATE Agencies SET Latitude='$lat', Longitude='$lng' WHERE Aid=$id";
    $update_result = mysqli_query($con, $update_query);
    /*if ($update_result)
      echo "Success";
    else
      echo "Fail";*/
  }
  echo "All coordinates updated";
    //$dest_coords = lookup($address);
    //if(is_null($dest_coords))
    //  echo "Nothing";
  //}

  

  ?>