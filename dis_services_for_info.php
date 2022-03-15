<?php
	session_start();
	//echo $_SESSION['user_id'];
	if(!(isset($_SESSION['user_id'])))
	{
		header('Location:user_login.php');
	}
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
	include 'conn_close.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Services</title>
	<style>
		form-control
		{
			text-color:green;

		}
	</style>

</head>

<body>
	<?php 
		include 'logo_page.html';
		echo "<br>";
		include 'user_nav.php';
	?>
<br>
	<br>
	<br>
	<center>

	<center>
	<table border="0" width="500">
		<form action="dis_services_for_info.php" method="post">
		<?php
			if(count($certificate_name)%2==0)
			{
				for ($i=0; $i < count($certificate_name) ; $i+=2) { 
					?>
					<tr>
						<td>
					<button><a href="upload.php?service_name=<?php echo $certificate_name[$i];?>"><?php echo $certificate_name[$i];?></a></button>
					<br><br></td>
					

					<?php
					$inc=$i+1;
					?>
					<td>
					<button><a href="upload.php?service_name=<?php echo $certificate_name[$inc];?>"><?php echo $certificate_name[$inc];?></a></button>
					<br>
					<br></td>
				</tr>
				<?php	
				}

			}
			else
			{
				for ($i=0; $i < count($certificate_name)-1 ; $i+=2) { 
					?>
					<tr>
						<td>
							<button><a href="upload.php?service_name=<?php echo $certificate_name[$i];?>"><?php echo $certificate_name[$i];?></a></button>
					<br><br></td>

					<?php
					$inc=$i+1;
					?>
					<td>
						<button><a href="upload.php?service_name=<?php echo $certificate_name[$inc];?>"><?php echo $certificate_name[$inc];?></a></button>
					<br>
					<br></td>
					<br>
					<br>
				</tr>
				<?php	
				}
				?>
				<tr>
					<td colspan="2">
						
					<button><a href="upload.php?service_name=<?php echo $certificate_name[count($certificate_name)-1]; ?>"><?php echo $certificate_name[count($certificate_name)-1]; ?></a></button>
					<br>
					<br></div></td>
				</tr>
				<?php	
			}
			
		?>
		</form>
	 </table>
	 </form>
</center>
<br><br><br><br><br>
<br><br><br><br><br>
<br><br><br><br><br>

<?php
	include 'footer.html';
?>
</body>
</html>

