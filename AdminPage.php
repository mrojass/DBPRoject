<!-- Admin Page -->

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

?>



<!DOCTYPE html>
<html style="background-color:#003366">
	<head>
		<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
		<title>DHS Grant Equipment</title>
	</head>
	<body>
		<img align="left" width="150" src="SERTlogo.png"></img>
		<img align="right" width="150" src="SERTlogo.png"></img>
		<h1 align="middle" style="padding-top:30px; color:white">Florida State CBRNE Specialized Equipment Database</h1>
		<div id="loginbox"> <h2>Tasks</h2>
		<p><a href="Deploy.php"><b>Deploy<b></a></p>
		<p><a href="search.php"><b>Search<b></a></p>
		<p><a href="DBChange.php"<b>Make Changes<b></a></p>
		</div>
	</body>
</html>


