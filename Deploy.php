<!-- Deploy Page -->

<?php
	session_start();
	if(!isset($_SESSION['username']) || !isset($_SESSION['admin']) )
	{
		session_destroy();
		header("location:index.php");
	}
	if(isset($_POST['logout']))
		header("location:logout.php");
	if(isset($_POST['admin']))
		header("location:AdminPage.php");

        include 'database_connector.php';
	
	if(isset($_POST['send'])){
		$ToAid=$_POST['TAid'];
		$FromAid=$_POST['FAid'];
		$Equipid=$_POST['Eid'];

		$result=mysqli_query($con,"insert into Deployed values('$Equipid', '', '$ToAid', '$FromAid', '')");

		if($result) {
			header("location:Success.php");
		}
	}		
	
	if(isset($_POST['approve']))
		header("location:approve.php");	
	if(isset($_POST['pending']))
		header("location:pending.php");
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
		<div id="deploybox">
		<h2>Request Deploy:</h2>
		<form method="post">
		<label>Deploy To AgencyID:</label><input type="text" name="TAid" value=""></input><br>
		<label>Deploy From AgencyID:</label><input type="text" name="FAid" value=""></input><br>
		<label>EquipmentID:</label><input type="text" name="Eid"></input><br>
		<input type="submit" name="send" value="Send Request"></input><br><br>
		<input type="submit" name="approve" value="Approve"></input>
		<input type="submit" name="pending" value="Pending"></input>
		</form><br>
		<form method="post">
			<input type="submit" name="admin" value="Go To Admin Page"></input>
			<input type="submit" name="logout" value="Logout"></input>			
		</form>
		</div>
	</body>
</html>

