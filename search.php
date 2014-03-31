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
	if(isset($_POST['return']))
	{
		$username=$_SESSION['username'];         
		$admin =mysqli_query($con, "select * from Employees where username='$username' and admin='1'");
                        if($admin->num_rows==1)
                                header("location:AdminPage.php");
                        else    header("location:search.php");
	}	
	
	/*if(isset($_POST['name']))
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

	}*/
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
		<div id="searchbox"><h2>Search</h2>
		<form action="search.php" method="get">
		<input type="text" name="search" value="Search Here">
		<input type="submit" name="search" value="Search"><br>
		<a href="advsearch.php">Advanced Search</a><br><br>
		</form>
		<form method="post">
		<input type="submit" name="return" value="Return To Adim Page">
		<input type="submit" name="logout" value="Logout">
		</form>
		</div>
	</body>
</html>
