<?php
	session_start();
	include 'conn.php';

	if(isset($_SESSION['user_id']))
	{
		$id=$_SESSION['user_id'];
		echo $id;
		$delete="delete from temp_service where user_id=$id";
		mysqli_query($conn,$delete);
		include 'conn_close.php';
	}
	session_destroy(); 
	header('Location: alert.php?logout=yes');

	

?>

