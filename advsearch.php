<!-- Advance Search Page -->
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
		<div id="advsearchbox"><h2>Search</h2>
			<form action="search.php" method="get">
				<input type="search" name="search">
				<input type="submit" name="search" value="Search"><br>
			<table style="text-align:right; border-spacing:5px; width:400px">
			<tr>
				<td><label>Name:</label>
			    	<input type="checkbox" name="name"></td>
				<td><label>AEL-Code:</label>
			    	<input type="checkbox" name="aelcode"></td>
			</tr><tr>
				<td><label>Category:</label>
				<input type="checkbox" name="category"></td>
				<td><label>Subcategory:</label>
				<input type="checkbox" name="subcategory"></td>
			</tr><tr>
				<td><label>Agency:</label>
				<input type="checkbox" name="agency"></td>
				<td><label>Section:</label>
				<input type="checkbox" name="section"></td>
			</tr><tr>
				<td><label>Deployable:</label>
				<input type="checkbox" name="deployable"></td>
				<td><label>Status:</label>
				<input type="checkbox" name="status"></td>
			</tr>
			<table>
			</form>
		</div>
	</body>
</html>
