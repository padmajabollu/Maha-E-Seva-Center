<?php
	session_start();
	if(!(isset($_SESSION['admin'])))
	{
		header('Location:admin_login.php');
	}
?>

<?php
include 'conn.php';
$flag=0;
if(isset($_POST['delete_service']))
{
	$service_name=strtoupper(($_POST['service_name']));
	$select="SELECT * FROM services where service_name='$service_name' ";
	$result = mysqli_query($conn,$select);
	$resultcount=mysqli_num_rows($result);
	if($resultcount==0)
	{
		$flag+=1;
	}
	if($resultcount>0)
	{
		$flag+=2;
		$delete = "DELETE FROM services WHERE service_name='$service_name'";
		mysqli_query($conn,$delete);

		$delete = "DELETE FROM service_image WHERE service_name='$service_name'";
		mysqli_query($conn,$delete);

	}
	
	if($flag==2)
	{
		header('Location:alert.php?delete_ser=yes');
	}
	else if($flag==1)
	{
		header('Location:alert.php?delete_ser=no');
	}

}
include 'conn_close.php';

?>

?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Service</title>
	<script type="text/javascript">
		
			function field_validation()
			{
				var service_name=document.forms['delete_service']['service_name'].value;
				var i=0;
				var chars=0;
				var fname1=service_name.toLowerCase();
				for(i=0;i<fname1.length;i++)
				{
					var ch=fname1.charAt(i);
					if(ch=='a' || ch=='b' || ch=='c' || ch=='d' || ch=='e' || ch=='f' || ch=='g' || ch=='h'
						 || ch=='i' || ch=='j' || ch=='k' || ch=='l' || ch=='m' || ch=='n' || ch=='o' || ch=='p'
						 || ch=='q' || ch=='r' || ch=='s' || ch=='t' || ch=='u' || ch=='v' || ch=='w' || ch=='x'
						   || ch=='y' || ch=='z' || ch==" ")
					{
						chars=chars+1;
					}
				}
				
				if(!(service_name != "" && chars === service_name.length && service_name.length >= 4))
				{
					alert("\nEnter Valid Service Name");	
					return false;
                    
                }
                	return true;
			
				}
				
			
	</script>
</head>
<style>
		.dropbtn {
  			padding: 14px;
  			font-size:14px;
  			background-color:#26267d;
  			border: none;
 			color:white;
		}
	</style>
<body>
	<br>
	<?php
	include 'logo_page.html';
	echo "<br>";
	include 'admin_nav.php';
?>
	<br>
	<center>
	<div class="container-fluid" style=" width:36%; height:50%;">
	
		<h2 style="color:black; text-align:center; font-size:180%; font-weight:bold;">Delete Service</h2>
		<br>
		<form name="delete_service" action="delete_service.php" method="post" onsubmit="return field_validation()">
			
			<h3 style="text-align:left; font-family:Helvetica; color:black;">Service Name:</h3><br>
			<input type="text" id="service_name" class="form-control" name="service_name"><br><br>
			<input type="submit" name="delete_service" class="dropbtn" value="Delete Service"><br>
				<br>
		</form>

	</div>
	</center>
<br><br><br><br><br>
	<?php
		include 'footer.html';
	?>
</body>
</html>