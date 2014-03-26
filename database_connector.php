<?php
	$host="localhost";
	$user="root";
	$password="cop4710";
	$dbName="FloridaDHSEquipment";
	
	$con=mysqli_connect($host,$user,$password,$dbName);
	
	if(!$con)
		echo "Could not connect to database";
?>
