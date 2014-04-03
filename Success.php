<?php
	session_start();
        if(!isset($_SESSION['username']) || !isset($_SESSION['admin']) )
        {
                session_destroy();
                header("location:index.php");
        }
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Success</title>
	</head>

<body background="background2.jpg">
	<h1 style="color:white">Deploy Request Successful, Now Pending</h1>
	<form action="AdminPage.php" method="get">
		<input type="submit" name="return" value="Return"></input>
	</form>
</body>

