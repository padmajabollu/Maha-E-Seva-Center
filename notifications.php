<?php
	session_start();
	//echo $_SESSION['user_id'];
	if(!(isset($_SESSION['user_id'])))
	{
		header('Location:user_login.php');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Noifications</title>
</head>
<body>
		<?php 
		include 'logo_page.html';
		include 'user_nav.php';
		?>

		<div class='container-fluid' style='width:60%;'>
	<br><center><font style='font-size:160%; font-weight:bold;'> Feedback of Uploaded Documents</font></center>
		<br><br>
	<table border='2px' class='table' style='text-align:center;'>

		<tr>
		<thead>
			<th scope='col' style='text-align:center; font-size:120%;'>Feedback<br><br></th>
			<th scope='col' style='text-align:center; font-size:120%;'>Date<br><br></th>
		</thead>
		</tr><tbody>
		<?php
			include 'conn.php';
			$email=$_SESSION['email'];
			$select="select * from feedback where email='$email' order by date1 desc";
			$result=mysqli_query($conn,$select);
			if(mysqli_num_rows($result))
			{
				while($row=$result->fetch_assoc())
				{
					echo "<tr>";
					echo "<td>";
					echo $row['feedback'];
					echo "<br><br></td>";

					echo "<td>";
					echo $row['date1'];
					echo "<br><br></td>";

					echo "</tr>";
				}
			}
	
			include 'conn_close.php';

		?>
		</tbody>
	</table>
	</center>
</div>
<br><br><br><br><br><br>
	<?php include 'footer.html'; ?>
</body>
</html>