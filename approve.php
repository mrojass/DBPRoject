<!DOCTYPE html>
<?php
        session_start();
        if(!isset($_SESSION['username']) || !isset($_SESSION['admin']) )
        {
                session_destroy();
                header("location:index.php");
        }
	include 'database_connector.php';

	if(isset($_GET['approve']))
	{
		foreach($_GET['wantapprove'] as $depid)
		{
			// Get equipment id
			$result=mysqli_query($con, "SELECT Equipid FROM Deployed WHERE Did='$depid'");
			$Equipid=mysqli_fetch_row($result);

			// Update deployed status
			$result=mysqli_query($con, "UPDATE Equipment SET Deploy=1 WHERE Eid='$Equipid'");
			if($result){
				//update approved status
				$result=mysqli_query($con, "UPDATE Deployed SET Approved=1 WHERE Did='$depid'");
				if($result){
					header("location:approve.php");
				}
			}
		}
	}

?>


<html>
        <head>
                <link type="text/css" rel="stylesheet" href="stylesheet.css"/>
                <title>DHS Grant Equipment</title>
        </head>
        <body background="background2.jpg">
                <img align="left" width="150" src="SERTlogo.png"></img>
                <img align="right" width="150" src="SERTlogo.png"></img>
                <h1 align="middle" style="padding-top:30px; color:white">Florida State CBRNE Specialized Equipment Database</h1>
                <div id="approve"> <h2>Approve Requests</h2>
		
		<form action="approve.php" method="get">
    		<table>
		<?php
			// Get User Aid
			$username=$_SESSION['username'];
			$result = mysqli_query($con, "SELECT Aid FROM Employees WHERE Employees.Username='$username'");
			$usrAidrow=mysqli_fetch_row($result);	
			$usrAid=$usrAidrow[0];
			
			// Get all needed approval deployed for user
			$result=mysqli_query($con,"SELECT * FROM Deployed WHERE Deployed.FromAid='$usrAid'");
		
			// Output table
			$color=0;
			$i=0;
		while($row=mysqli_fetch_array($result))
		{       
        	?>
              		<tr bgcolor='<?php if(($color%2)==0) echo "#aabbcc"; else echo "#ccbbaa"; ?>'>
                		<td><input type="checkbox" name="wantapprove[]" id="wantapprove[]" value="<?php echo $row['Did']; ?>"></td>
                		<td>Equipment ID: <?php echo $row['Equipid']; ?></td>
                		<td>To Agency ID: <?php echo $row['ToAid']; ?></td>
                		<td>From Agency ID: <?php echo $row['FromAid']; ?></td>
				<td>Approved: <?php if($row['Approved']) echo "Yes"; else echo "No"; //echo $row['Approved']; ?></td>
              		</tr>

		<?php 
			$color=$color+1;
			$i++;
	        }
		?>
		</table>
			<input type="submit" name="approve" value="Approve Checked">
		</form>
		
		<br><br><form action="AdminPage.php" method="post">
		<input type="submit" name="return" value="Return"></input>
		</form>
                </div>
                <div id="bottombar"> </div>
        </body>
</html>


