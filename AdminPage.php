<!-- Admin Page -->

<?php
        session_start();
        if(!isset($_SESSION['username']) || !isset($_SESSION['admin']) )
        {
                session_destroy();
                header("location:index.php");
        }
        if(isset($_POST['logout']))
                header("location:logout.php");
	if(isset($_POST['deploy']))
		header("location:Deploy.php");
	if(isset($_POST['search']))
		header("location:search.php");
	if(isset($_POST['change']))
		header("location:DBChange.php");
        include 'database_connector.php';

?>



<!DOCTYPE html>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
		<title>DHS Grant Equipment</title>
	</head>
	<body background="background2.jpg">
		<img align="left" width="150" src="SERTlogo.png"></img>
		<img align="right" width="150" src="SERTlogo.png"></img>
		<h1 align="middle" style="padding-top:30px; color:white">Florida State CBRNE Specialized Equipment Database</h1>
		<div id="loginbox"> <h2>Tasks</h2>
			<form method="post">
				<input type="submit" name="deploy" value="Deploy"><br><br>
				<input type="submit" name="search" value="Search"><br><br>
				<input type="submit" name="change" value="Change Status/Return Equipment"><br><br>
				<input type="submit" name="logout" value="Logout">
			</form>
		</div>
	</body>
</html>


