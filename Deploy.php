<!-- Deploy Page -->

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
		<div id="loginbox"> <h2>Login here</h2>
		<p>Request Deploy:</p>
		<form action="deploy" method="post">
		<label>Deploy To AgencyID:</label><input type="text" name="TAid" value=""></input><br>
		<label>Deploy From AgencyID:</label><input type="text" name="FAid" value=""></input><br>
		<label>EquipmentID:</label><input type="text" name="Eid"></input><br>
		<p>Approve Deploy:</p>
		<!-- List approvable deploys here, if any-->
		</form>
		<p><a href="search.php">Go To Search Page</a></p>
		</div>
	</body>
</html>

