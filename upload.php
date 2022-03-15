<?php
session_start();
//echo $_SESSION['user_id'];
if(!(isset($_SESSION['user_id'])))
{
	header('Location:user_login.php');
}

include 'conn.php';
$id=$_SESSION['user_id'];

$document_img=array();
if(!(isset($_SESSION['user_id'])))
{
	header('Location:user_login.php');
}
$service=(isset($_GET['service_name']))?$_GET['service_name']:"no";
if($service!="no")
{
	$delete="delete from temp_service where user_id=$id";
	mysqli_query($conn,$delete);

	$insert="INSERT INTO temp_service(user_id, service_name) VALUES ('$id','$service')";
	mysqli_query($conn,$insert);
	

}	
else if($service=="no")
{
	$select="select * from temp_service where user_id='$id'";
	$result=mysqli_query($conn,$select);
	if(mysqli_num_rows($result))
	{
		while($row=$result->fetch_assoc())
		{
			$service=$row['service_name'];
			
		}
	}
	
}				
	$document_name=array();
	/*array_push($certificate_name, "Income");*/
	$select="select * from services where service_name='$service'";
	$result=mysqli_query($conn,$select);
	if(mysqli_num_rows($result))
	{
		while($row=$result->fetch_assoc())
		{
			array_push($document_name, $row['document_name']);
		}
	}

include 'conn_close.php';

?>

<html>
	<head>
		<title>Upload Documents</title>
		<script type="text/javascript">
			var count=0;
			var img_name="";
			function image_validation(file)
			{
				img_name=file.value.split('\\').pop();
				var v="var"+count;

				document.getElementById(v).value=img_name;
				var FileSize = file.files[0].size; // in Bytes
			    if (FileSize > 1000000) {
	                alert("File size must under 1 KB!");
	                return false;
	            }
	            count++;

		    }
		    function all_selected()
		    {
		    	if(count==<?php echo count($document_name);?>)
		    	{
		    		return true;
		    	}
		    	else
		    	{
		    		alert("Select All Documents")
		    		return false;
		    	}
		    }
    
		</script>
		
	</head>

<body>
<?php
	include 'logo_page.html';
	echo "<br>";
	include 'user_nav.php';
?>
<br>

<div class="container-fluid" style="background-color:#D3D3D3; width:50%; height:70%; box-shadow: 5px 10px 18px grey;">

<h2 style="color:#8B008B; text-align:center;">UPLOAD DOCUMENTS FOR <?php echo $service;?></h2>


<br>

<table class='table' border='1' style='box-shadow: 10px 10px 5px grey; font-family:times new roman;'>
<thead>
	<form action="upload1.php" method="post" enctype="multipart/form-data" onsubmit="return all_selected()">
  <tr>
    <th>Documents name</th>
	<th>Select Documents</th> 
  </tr>
  </thead>

    <?php
		for ($i=0; $i < count($document_name) ; $i+=1) { 
			?>
		<tr>
			<td><font color='black' size='4' style='font-family:times new roman;'>
				<center><?php echo $document_name[$i]; ?></center></font>
			</td>
			<td>
			<center>
				<input type="file" accept="image/*" name="<?php echo $i;?>" id="imgupload" onchange="return image_validation(this)">
				<input id="<?php echo "var".$i;?>" type="hidden" name="<?php echo "var".$i;?>" value="0">
		</center>
				<br>
				<br>
			</td>
		</tr>	
			
			
		<?php	
		}
	?>
	<tr>
		<td colspan="2">
			<center><input type="submit" class="btn btn-default" name="upload" value="Upload"></center>
		</td>
	</tr>

	</form>
  </table>
	</div>
</body>
</html>
