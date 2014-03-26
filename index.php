<!-- First page-->

<?php
session_start();
include 'database_connector.php';

if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	//get query
	//$result=
	if($result)
	{
		//echo "Successfully deleted".$id;
		$count=mysqli_num_rows($result);	
		//echo $count;
	}
	if($count==1)
	{
		$_SESSION['username']=$username;
		$_SESSION['password']=$password;
		header("location:insert.php");
	}
	else
	{	
		header("location:index.php");	
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
		<img align="left" width="150" src="dhs.png"></img>
		<img align="right" width="150" src="dhs.png"></img>
		<h1 align="middle" style="padding-top:30px; color:white">Florida State CBRNE Specialized Equipment Database</h1>
		<div id="loginbox"> <h2>Login here</h2>
		<form action="login.php" method="get">
		<label>Username:</label><input type="text" name="username" value=""></input><br>
		<label>Password :</label><input type="password" name="password" value=""></input><br>
		<input type="submit" name="login" value="Login"></input><br>
		</form>
		</div>
	</body>
</html>
