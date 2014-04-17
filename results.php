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
/*        if(isset($_POST['return']))
        {
                $username=$_SESSION['username'];
                $admin =mysqli_query($con, "select * from Employees where username='$username' and admin='1'");
                        if($admin->num_rows==1)
                                header("location:AdminPage.php");
                        else    header("location:search.php");
        }
*/

	if(isset($_GET['search']))
        {
                $equipid=$_GET['equipid'];
                $equipname=$_GET['equipname'];
                $section=$_GET['section'];
                $category=$_GET['category'];
                $subcategory=$_GET['subcategory'];
                $aelcode=$_GET['aelcode'];
		$agenid=$_GET['agenid'];
        }



		if(isset($_GET['deployable']) && !isset($_GET['status'])){
                         $deploy=0;
                         $result=mysqli_query($con, "SELECT * FROM Equipment WHERE Aid='$agenid' OR Eid='$equipid' OR Name='$equipname' OR Section='$section' OR     Category    ='$category' OR SubCategory='$subcategory' OR AELCode='$aelcode' AND Deploy='$deploy'");
                 }
                 else if(isset($_GET['status']) && !isset($_GET['deployable'])){
                         $status=1;
                         $result=mysqli_query($con, "SELECT * FROM Equipment WHERE Aid='$agenid' OR Eid='$equipid' OR Name='$equipname' OR Section='$section' OR     Category    ='$category' OR SubCategory='$subcategory' OR AELCode='$aelcode' AND Status='$status'");
                 }
                 else if(isset($_GET['status']) && isset($_GET['deployable'])){
                         $deploy=0;
                         $status=1;
                 	$result=mysqli_query($con, "SELECT * FROM Equipment WHERE Aid='$agenid' OR Eid='$equipid' OR Name='$equipname' OR Section='$section' OR Category    ='$category' OR SubCategory='$subcategory' OR AELCode='$aelcode' AND Deploy='$deploy' AND Status='$status'");
                 }
                 else {
                 	$result=mysqli_query($con, "SELECT * FROM Equipment WHERE Aid='$agenid' OR Eid='$equipid' OR Name='$equipname' OR Section='$section' OR Category        ='$category' OR SubCategory='$subcategory' OR AELCode='$aelcode'");
		}

	if(isset($_GET['direc'])){
		$id=$_GET['id'];
		header("location:maps.php?id=$id");
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
<br><br>
<table id="results" border="1"><?php
		$count=1;
	while($row=mysqli_fetch_array($result)){
		if($row['Status']==1)
			$state="Operational";
		else $state="NonOperational";
		if($row['Deploy']==0)
			$dep="Deployable";
		else $dep="Not Deployable";
		?>
			<tr><td><h3>Result: <?php echo $count; ?></h3></td></tr>

			<tr>
				<td><h4>Name: </h4><?php echo $row['Name'];?></td>
				<td><h4>Section: </h4><?php echo $row['Section'];?></td>
				<td><h4>Category: </h4><?php echo $row['Category'];?></td>
				<td><h4>SubCategory: </h4><?php echo $row['SubCategory'];?></td>
				<td><h4>AELCode: </h4><?php echo $row['AELCode'];?></td>
				<td><h4>Description: </h4><?php echo $row['Description'];?></td>
			</tr>
			<tr>	<td><h4>Status: </h4><?php echo $state;?></td>
				<td><h4>Deployable: </h4><?php echo $dep;?></td>
				<td><h4>Count: </h4><?php echo $row['Count'];?></td>
				<td><h4>Agency ID: </h4><?php echo $row['Aid'];?></td>
				<td><h4>Equipment ID: </h4><?php echo $row['Eid'];?></td>
				<td>
					<form action="results.php" method="get">
						<input type="submit" name="direc" value="Location">
						<input type="hidden" name="id" value="<?php echo $row['Aid']; ?>">
					</form>
				</td>
			</tr>
		
		<?php $count+=1;
	}
?></table>
</body>
</html>
