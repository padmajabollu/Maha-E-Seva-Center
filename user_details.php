<?php
	session_start();
	include 'conn.php';
	if(!(isset($_SESSION['admin'])))
	{
		header('Location:admin_login.php');
	}
?>


<html>
<body>
<body>

<?php
	include 'logo_page.html';
	echo "<br>";
	include 'admin_nav.php';
?>


<br>

<div class='container-fluid' style='width:60%;'>
	<br><center><font style='font-size:180%; font-weight:bold;'>Uploaded Customer Details</font></center></center>
		<br><br>
	<table border='2px' class='table' style='text-align:center;'>
<thead>

  <tr>
    <th><center><font color="black" size="5" style="font-family:times new roman;">Username</font></center></th>
    <th><center><font color="black" size="5" style="font-family:times new roman;">Documents</font></center></th> 
  </tr><tbody>
<?php

$sql="SELECT * FROM user_reg where user_id in(select distinct(user_id) from upload_docs)";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
    while($row = $result->fetch_assoc()){
    ?>
		<tr>
			<td scope='col' style='text-align:center; font-size:120%;'> 
				
				<center><?php echo $row['email']; ?></center>
				</font>
			</td>
			<td scope='col' style='text-align:center; font-size:120%;'>
				<a href="showuploadfiles.php?email=<?php echo $row['email']; ?>">SHOW Documents</a>
			</td>
		</tr>
 <?php       
	}
}
?>

<?php

include 'conn_close.php';

?>

</table>
</div>
<br><br><br><br><br><br><br><br><br>
	<?php
		include 'footer.html';
	?>
</body>
</html>
