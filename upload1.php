<?php
session_start();
$document_img=array();
$service=(isset($_GET['service_name']))?$_GET['service_name']:"";

include 'conn.php';
$id=$_SESSION['user_id'];

if(!(isset($_SESSION['user_id'])))
{
	header('Location:user_login.php');
}
	$select="select * from temp_service where user_id='$id'";
	$result=mysqli_query($conn,$select);
	if(mysqli_num_rows($result))
	{
		while($row=$result->fetch_assoc())
		{
			$service=$row['service_name'];
			
			
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
	

	$v='var';
	for ($i=0; $i < count($document_name); $i++) { 
		$variable=$v.$i;
		array_push($document_img, $_POST[$variable]);
	/*	echo $document_img[$i];*/
	}

	$flag=0;

	for ($i=0; $i < count($document_name); $i++) { 
		$v1=strval($i);
		$doc=$document_name[$i];
		$img=$document_img[$i];
		$name=$_FILES[$v1]['name'];

		$tmpname=$_FILES[$v1]['tmp_name'];

		$target_dir = "uploads/"; //folder name where your files will be stored. create this folder inside "file_upload_api" folder
		$target_file = $target_dir.$name ;
		if(move_uploaded_file($tmpname,$target_file))
		{
			
			$insert = "INSERT INTO upload_docs(user_id,service_name,document_name,img) VALUES('$id','$service','$doc','$img')";
			if(mysqli_query($conn,$insert))
			{
				$flag+=1;
			
			}

		}
			
	}
	if($flag==count($document_name))
		{
			$delete="delete from temp_service where user_id=$id";
			mysqli_query($conn,$delete);
			
			//echo $flag;
			header('Location:alert.php?upload=yes');
		}
		else
		{
			header('Location:alert.php?upload=no');
		}
	
include 'conn_close.php';

?>
