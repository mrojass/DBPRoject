<!-- First page-->

<?php
session_start();
include 'database_connector.php';

if(isset($_POST['login']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	//get query
	$result=mysqli_query($con,"select *from Employees where username='$username' and password='$password'");
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
		
		$admin =mysqli_query($con, "select * from Employees where username='$username' and admin='1'");
		if($admin->num_rows==1)
			header("location:AdminPage.php");
		else	header("location:search.php");
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
		<img align="left" width="150" src="SERTlogo.jpg"></img>
		<img align="right" width="150" src="SERTlogo.jpg"></img>
		<h1 align="middle" style="padding-top:30px; color:white">Florida State CBRNE Specialized Equipment Database</h1>
		<div id="loginbox"> <h2>Login here</h2>
		<form action="index.php" method="post">
		<label>Username:</label><input type="text" name="username" value=""></input><br>
		<label>Password :</label><input type="password" name="password" value=""></input><br>
		<input type="submit" name="login" value="Login"></input><br>
		</form>
		</div>
	</body>
</html>
