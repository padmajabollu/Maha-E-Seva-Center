<?php
$service_name=(isset($_GET['service_name']))?$_GET['service_name']:"";
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
  $document_name=array();
  /*array_push($certificate_name, "Income");*/
  $select="select * from services where service_name='$service_name'";
  $result=mysqli_query($conn,$select);
  if(mysqli_num_rows($result))
  {
    while($row=$result->fetch_assoc())
    {
      array_push($document_name, $row['document_name']);
    }
  }

  $sql1 = "SELECT * FROM service_image where service_name='$service_name'";
    $result1=mysqli_query($conn,$sql1);
  
    if(mysqli_num_rows($result1) > 0)
    {
        while($row1 = $result1->fetch_assoc())
        {
          
            $imageURL = 'uploads/'.$row1["service_img"];
            break;
        }
    }
  include 'conn_close.php';
?>

<!DOCTYPE html>
<html>
<head>
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="navigation_bar_stylesheet.css">
		<link rel="stylesheet" href="content.css">
	
	<title>Certficates Information</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
</head>
<body  style="background-color:#F5F5F5;">
	
	<?php
		
		include 'logo_page.html';
		echo "<br>";
		include 'navigation_bar4.php'; 
	
	?>
	
	
	<br><br><br><br><br><center>
	
	<table border="2" style="box-shadow: 10px 10px 5px grey; font-family:times new roman;">
		<tr><td colspan="2"><h2><center><?php echo $service_name;?></center></h2> </td></tr>
		<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h4><b>DOCUMENTS FOR <?php echo $service_name;?>&nbsp;&nbsp;&nbsp;&nbsp;</b></h4><br><br><br>
			<h4 style="font-size:140%;">
			<?php 
				for ($i=0; $i < count($document_name) ; $i++) { 
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".($i+1)."&nbsp;&nbsp;".$document_name[$i]."<br><br>";
		
				}
			?></h4>
			</td>
			<td><a href="<?php echo $imageURL;?>" target="_blank"><img src="<?php echo $imageURL;?>" height="400"></a></td>
		</tr>
	</table>

	</center>
	<br><br><br><br>
	<?php include 'footer.html' ?>

</body>
</html>
