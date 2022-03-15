<?php
	include 'conn.php';
	$certificate_name=array();
	/*array_push($certificate_name, "Income");*/
	$select="select DISTINCT service_name from services";
	$result=mysqli_query($conn,$select);
	if(mysqli_num_rows($result))
	{
		while($row=$result->fetch_assoc())
		{
			array_push($certificate_name, $row['service_name']);
		}
	}

	for ($i=0; $i < count($certificate_name) ; $i++) { 
		if(isset($_POST[$i]))
		{
			//echo $certificate_name[$i];
			header('Location:dis_info.php?service_name='.$certificate_name[$i]);
			break;
		}
	}
	include 'conn_close.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Services</title>
	<style type="text/css">
		.dropbtn {
		  padding: 16px;
		  font-size: 16px;
		  border: none;
		}

		.dropdown {
		  position: relative;
		  display: inline-block;
		}

		.dropdown-content {
		  display: none;
		  position: absolute;
		  background-color: #f1f1f1;
		  min-width: 300px;
		  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		  z-index: 1;
		}

		.dropdown-content a {
		  color: black;
		  padding: 12px 16px;
		  text-decoration: none;
		  display: block;
		}

		.btn {
		  padding: 16px 15px;
		  background-color:navy;
		  font-size: 30px;
		  margin:30px;
		  color:white;
		  border: none;
		}
	</style>
</head>
<body  style="background-color:#F5F5F5;">
	<?php 
		include 'logo_page.html';
		echo "<br>";
		include 'navigation_bar5.php'; 
	
	?>
<center>
<h2 style="font-family:Lucida, sans-serif; font-size:200%; font-weight:bold;">Information about the documents</h2>
	
	<table border="0">
		<form action="dis_services.php" method="post">
		<?php
			if(count($certificate_name)%2==0)
			{
				for ($i=0; $i < count($certificate_name) ; $i+=2) { 
					?>
					<tr>
						<td>
					<input class="btn" type="submit" name="<?php echo $i; ?>" value="<?php echo $certificate_name[$i]; ?>"><br><br></td>
					&nbsp&nbsp

					<?php
					$inc=$i+1;
					?>
					<td>
					<input class="btn" type="submit" name="<?php echo $inc; ?>" value="<?php echo $certificate_name[$inc]; ?>">
					<br>
					<br></td>
				</tr>
				&nbsp&nbsp&nbsp
				<?php	
				}

			}
			else
			{
				for ($i=0; $i < count($certificate_name)-1 ; $i+=2) { 
					?>
					<tr >
						<td>
					<input class="btn" type="submit" name="<?php echo $i; ?>" value="<?php echo $certificate_name[$i]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br></td>
					&nbsp&nbsp

					<?php
					$inc=$i+1;
					?>&nbsp&nbsp&nbsp&nbsp
					<td>
					<input class="btn" type="submit" name="<?php echo $inc; ?>" value="<?php echo $certificate_name[$inc]; ?>"><br><br></td>
					<br>
					<br>
				</tr>
				<?php	
				}
				?>
				<tr>
					<td colspan="2">
				<input class="btn" type="submit" name="<?php echo count($certificate_name)-1; ?>" value="<?php echo $certificate_name[count($certificate_name)-1]; ?>">
				</td>
				</tr>
				<?php	
			}
			
		?>
		</form>
	</table>

<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br>
<?php include "footer.html" ?>
</body>
</html>