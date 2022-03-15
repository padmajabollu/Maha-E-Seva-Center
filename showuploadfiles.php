<?php
	session_start();
	include 'conn.php';
	if(!(isset($_SESSION['admin'])))
	{
		header('Location:admin_login.php');
	}
?>

<html>
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
<?php
	include 'logo_page.html';
	echo "<br>";
	include 'admin_nav.php';
?>
<br>

<div class='container-fluid' style='width:60%;'>
<br><center><font style='font-size:160%; font-weight:bold;'>Uploaded Documents Details</font></center>
	<br><br>
<table border='2px' class='table' style='text-align:center;'>
<thead>
	<tr>
		<th scope='col' style='text-align:center; font-size:120%;'>SR. NO.</th>
		<th scope='col' style='text-align:center; font-size:120%;'>SERVICE NAME</th>
		<th scope='col' style='text-align:center; font-size:120%;'>DOCUMENT NAME</th>
		<th scope='col' style='text-align:center; font-size:120%;'>DOCUMENT IMAGE</th>
</thead></tr></tbody>

<?php
$email=(isset($_GET['email']))?$_GET['email']:"";

$sql = "SELECT * FROM user_reg where email='$email' ";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0)
{
    while($row = $result->fetch_assoc()){
		$id= $row['user_id'];
		$phno1 = $row['phno'];
		$sql1 = "SELECT * FROM upload_docs where user_id='$id' ";
		$result1=mysqli_query($conn,$sql1);
		$i=0;
		if(mysqli_num_rows($result1) > 0)
		{
		    while($row1 = $result1->fetch_assoc())
		    {
		    	$i+=1;
		        $imageURL = 'uploads/'.$row1["img"];
		?>
   	<tr>
   		<td><center><?php echo $i;?></center></td>
   		<td><center><?php echo $row1['service_name'];?></center></td>
   		<td><center><?php echo $row1['document_name'];?></center></td>
   		<td><center><a href="<?php echo $imageURL;?>" target="_blank"><img src="<?php echo $imageURL;?>" width="150" height="150"></a></center></td>
   		
   		
   	</tr>
	
<?php 
			}
		}
		else{ ?>
		    <p>No image(s) found...</p>
	
<?php 
			} 
        
	}
}
?>
</tbody>
</table>
</div>
<form method="POST" action="sms_email.php" align="center">
<center><p><h2 style='font-size:190%; font-weight:bold;'>Feedback to User </h2></p></center>
	 <textarea name="feedback" cols="50" ></textarea>
	<br><br>
	<input type="hidden" name='email' value="<?php echo $email; ?>">
	<input type="hidden" name='sms' value="<?php echo $phno1; ?>">
	
	<input type='submit' class="dropbtn" name="send" value='Send'>
	</form>
</body>
</html>
	<?php
$conn->close();
include 'footer.html';


?>