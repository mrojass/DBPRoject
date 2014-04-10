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

	$search = $_POST["description"];

	$query = "SELECT * FROM Equipment WHERE description LIKE '%$search%'";
	if (!$query)
	{
		echo 'Your search returned no results';
	}

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
		
		<form action="results.php" method="get">
			<label>Equipment ID: </label><input style="margin-left:26px" type="text" name="equipid"><br>
			<label>Agency ID: </label> <input style="margin-left:55px" type="text" name="agenid"><br>
			<label>Equipment Name: </label><input type="text" name="equipname"><br>
			<label>Section: </label><input style="margin-left:79px"  type="text" name="section"><br>
			<label>Category: </label><input style="margin-left:66px"  type="text" name="category"><br>
			<label>SubCategory: </label><input style="margin-left:38px" type="text" name="subcategory"><br>
			<label>AEL Code: </label><input style="margin-left:63px" type="text" name="aelcode"><br>
			<table style="text-align:right; border-spacing:5px; width:400px">
                        <tr>
                                <td><label>Deployable:</label>
                                <input type="checkbox" name="deployable"></td>
                                <td><label>Status:</label>
                                <input type="checkbox" name="status"></td>
                        </tr>
                        <table>
			<input type="submit" name="search" value="Search"><br><br>
		</form>
		
		<form method="post">
			<input type="submit" name="return" value="Return To Adim Page">
			<input type="submit" name="logout" value="Logout">
		</form>
		</div>
	</body>
</html>
