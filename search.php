<!-- Regular Search page -->
<?php
	session_start();
	if(!isset($_SESSION['username']))
	{
		session_destroy();
		header("location:index.php");
	}
	if(isset($_POST['logout']))
		header("location:logout.php");
	include 'database_connector.php';
	
	if(isset($_POST['name']))
	{
		$name=$_POST['name'];
		$email=$_POST['email'];
		$userid=$_POST['userid'];
		$password=$_POST['password'];
		
		$result=mysqli_query($con,"insert into stu_info values('','$name','$email','$userid','$password')");
		if($result)
		{
		echo 'Values updated successfully';
		}

	}
?>
<!DOCTYPE html>
<html style="background-color:#003366">
	<head>
		<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
		<title>DHS Grant Equipment</title>
	</head>
	<body>
		<img align="left" width="150" src="SERTlogo.jpg"></img>
		<img align="right" width="150" src="SERTlogo.jpg"></img>
		<h1 align="middle" style="padding-top:30px; color:white">Florida State CBRNE Specialized Equipment Database</h1>
		<div id="searchbox"><h2>Search</h2>
		<form action="search.php" method="get">
		<input type="text" name="search" value="Search Here">
		<input type="submit" name="search" value="Search"><br>
		<a href="advsearch.html">Advanced Search</a>
		</form>
		</div>
	</body>
</html>