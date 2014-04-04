<!DOCTYPE html>
<?php
        session_start();
        if(!isset($_SESSION['username']) || !isset($_SESSION['admin']) )
        {
                session_destroy();
                header("location:index.php");
        }
        include 'database_connector.php';
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
                <div id="approve"> <h2>Pending Requests</h2>
                
                <table>
                <?php
                	// Get User Aid
                        $username=$_SESSION['username'];
                        $result = mysqli_query($con, "SELECT Aid FROM Employees WHERE Employees.Username='$username'");
                        $usrAidrow=mysqli_fetch_row($result);
                        $usrAid=$usrAidrow[0];

                        // Get all pending deployed for user
                        $result=mysqli_query($con,"SELECT * FROM Deployed WHERE Deployed.ToAid='$usrAid'");

                        // Output table
                        $color=0;
                        $i=0;
                while($row=mysqli_fetch_array($result))
                {
                ?>
                        <tr bgcolor='<?php if(($color%2)==0) echo "#aabbcc"; else echo "#ccbbaa"; ?>'>
                                <td>Equipment ID: <?php echo $row['Equipid']; ?></td>
                                <td>To Agency ID: <?php echo $row['ToAid']; ?></td>
                                <td>From Agency ID: <?php echo $row['FromAid']; ?></td>
                                <td>Approved: <?php if($row['Approved']) echo "Yes"; else echo "No";?></td>
                        </tr>

                <?php
                        $color=$color+1;
                        $i++;
                }
                ?>
                </table>
               
		<br><br><form action="AdminPage.php" method="post">
		<input type="submit" name="return" value="Return"></input>
		</form>
                </div>
                <div id="bottombar"> </div>
        </body>
</html>


