<!DOCTYPE html>
<html>
<body>
	<?php
		$username = "your_name";
		$password = "your_password";
		$hostname = "localhost"; 
	
		//connection to the database
		$dbhandle = mysql_connect($hostname, $username, $password)
  		or die("Unable to connect to MySQL");
		echo "Connected to MySQL<br>";

		//select a database to work with
		$selected = mysql_select_db("examples",$dbhandle)
	  	or die("Could not select examples");

		//code here

		//close the connection
		mysql_close($dbhandle);
	?>
</body>
</html>
