<!-- Make Changes Page -->

<?php
	session_start();
        if(!isset($_SESSION['username']) || !isset($_SESSION['admin']) )
        {
                session_destroy();
                header("location:index.php");
        }

	include 'database_connector.php';
	
	//if(isset(
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
                <div id="searchbox"> <h2>Change Equipment Status or Return Equipment</h2>
		<form action="DBChange.php" method="post">
			<h3>Equipment Status:</h3>
				<label>Equipment ID: </label> <input name="equipid" type="text" ><br>
				<label>Status (1 or 0): </label> <input name="equipid" type="text"><br>
				<input name="change" type="submit" value="Change"><br>
			<h3>Return Equipment:</h3>
				<label>Equipment ID: </label> <input name="returnEid" type="text"><br>
				<input name="send" type="submit" value="Return Equipment"><br><br>
			<input name="return" type="submit" value="Return">
		</form>
                </div>
        </body>
</html>
	
