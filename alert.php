
<?php

$delete_ser=(isset($_GET['delete_ser']))?$_GET['delete_ser']:"";
if($delete_ser=="yes")
{
	echo '<script type="text/javascript">alert("Service Deleted Successfully")</script>';
	header('Refresh:0; url=user_details.php');
	

}

$add=(isset($_GET['add']))?$_GET['add']:"";
if($add=="yes")
{
	echo '<script type="text/javascript">alert("New Service Added Successfully")</script>';
	header('Refresh:0; url=user_details.php');
	
}
$login_status=(isset($_GET['admin_login']))?$_GET['admin_login']:"";
if($login_status=="yes")
{
	echo '<script type="text/javascript">alert("Login Successful")</script>';
	header('Refresh:0; url=user_details.php');
	
}
$sent=(isset($_GET['sent']))?$_GET['sent']:"";
if($sent=='yes')
{
	echo '<script type="text/javascript">alert("Feedback Send Successfully")</script>';
	header('Refresh:0; url=user_details.php');
	

}
$delete=(isset($_GET['delete']))?$_GET['delete']:"";
if($delete=="yes")
{
	echo '<script type="text/javascript">alert("Customer Details Deleted Successfully")</script>';
	header('Refresh:0; url=user_details.php');
	

}
else if($delete=="no")
{
	echo '<script type="text/javascript">alert("Customer Record Not Found")</script>';
	header('Refresh:0; url=user_details.php');
	

}

$deliver=(isset($_GET['deliver']))?$_GET['deliver']:"";
if($deliver=="yes")
{
	echo '<script type="text/javascript">alert("Customer Deliver Status Updated Successfully")</script>';
	header('Refresh:0; url=user_details.php');
	

}

$payment=(isset($_GET['payment']))?$_GET['payment']:"";
if($payment=="yes")
{
	echo '<script type="text/javascript">alert("Customer Payment & Payment Status Updated")</script>';
	header('Refresh:0; url=user_details.php');
	

}
$record=(isset($_GET['record']))?$_GET['record']:"";
if($record=="no")
{
	echo '<script type="text/javascript">alert("Customer Record Not Found")</script>';
	header('Refresh:0; url=Store_customer_details.php');
	

}
?>

<?php

$add=(isset($_GET['add']))?$_GET['add']:"";
if($add=="no")
{
	echo '<script type="text/javascript">alert("Service Already Exists")</script>';
	header('Refresh:0; url=user_details.php');
	

}

$login_status=(isset($_GET['admin_login']))?$_GET['admin_login']:"";
if($login_status=="no")
{
    echo '<script type="text/javascript">alert("Login Unsuccessful")</script>';
	header('Refresh:0; url=admin_login.php');
	

}

?>

<?php

$deliver=(isset($_GET['deliver']))?$_GET['deliver']:"";
if($deliver=="no")
{
	echo '<script type="text/javascript">alert("Customer Deliver Status Not Updated")</script>';
	header('Refresh:0; url=Certificate_Deliver_Status.php');
	

}

$record=(isset($_GET['record']))?$_GET['record']:"";
if($record=="no")
{
	echo '<script type="text/javascript">alert("Customer Record Not Found")</script>';
	header('Refresh:0; url=Certificate_Deliver_Status.php');
	

}

?>

<?php

$add=(isset($_GET['add']))?$_GET['add']:"";
if($add=="no")
{
	echo '<script type="text/javascript">alert("Service Already Exists")</script>';
	header('Refresh:0; url=user_details.php');
	

}


$delete_ser=(isset($_GET['delete_ser']))?$_GET['delete_ser']:"";
if($delete_ser=="no")
{
	echo '<script type="text/javascript">alert("Service Record Not Exists")</script>';
	header('Refresh:0;url=user_details.php');
	

}
?>
<?php
$user_login=(isset($_GET['user_login']))?$_GET['user_login']:"";
if($user_login=="yes")
{
	echo '<script type="text/javascript">alert("Login Successful")</script>
	';
	echo header('Refresh:0; url=dis_services_for_info.php');
	;

}

$upload=(isset($_GET['upload']))?$_GET['upload']:"";
if($upload=="yes")
{
	echo '<script type="text/javascript">alert("Upload Successfully")</script>';
	header('Refresh:0; url=dis_services_for_info.php');
	
}

?>
<?php

	$logout=(isset($_GET['logout']))?$_GET['logout']:"";
	if($logout=="yes")
	{
		echo '<script type="text/javascript">alert("Logout Successfully")</script>';
		header('Refresh:0; url=index.php');
	

	}
?>
<?php

$payment=(isset($_GET['payment']))?$_GET['payment']:"";
if($payment=="no")
{
	echo '<script type="text/javascript">alert("Customer Payment Is Remaining")</script>';
	header('Refresh:0; url=user_details.php');
	

}
?>
<?php

$sent=(isset($_GET['sent']))?$_GET['sent']:"";
if($sent=='no')
{
	$mailto=$_GET['email'];
	echo '<script type="text/javascript">alert("Feedback Not Send")</script>';
	header('Refresh:0; url=showuploadfiles.php?email='.$mailto);
	
	
}
?>

<?php
$payrecord=(isset($_GET['payrecord']))?$_GET['payrecord']:"";
if($payrecord=="no")
{
	echo '<script type="text/javascript">alert("Customer Record Not Found")</script>';
	header('Refresh:0; url=user_details.php');
	

}
else if($record=="yes")
{
	echo "
	<script>
		alert('Customer Details Stored Successfully and Send Bill');
	</script>";
	header('Refresh:0; url=user_details.php');
	
}
else if($record=='nosel')
{
	echo '<script type="text/javascript">alert("Select the Certificate")</script>';
	header('Refresh:0; url=add_service.php');
	

}
?>

<?php
$upload=(isset($_GET['upload']))?$_GET['upload']:"";
if($upload=="no")
{
	echo '<script type="text/javascript">alert("Upload Unsuccessfully")</script>';
	header('Refresh:0; url=upload.php');
	

}

?>

<?php
$user_login=(isset($_GET['user_login']))?$_GET['user_login']:"";
if($user_login=="no")
{
	
    echo '<script type="text/javascript">alert("Login Unsuccessful")</script>';
	header('Refresh:0; url=user_login.php');
	

}
else if($user_login=='noentry')
{
    echo '<script type="text/javascript">alert("Registration is not Done")</script>';
	header('Refresh:0; url=user_reg.php');
	

}

$reg=(isset($_GET['reg']))?$_GET['reg']:"";
if($reg=="yes")
{
        echo '<script type="text/javascript">alert("Registration Successful")</script>';
		header('Refresh:0; url=user_login.php');
	

}
else if($reg=="no")
{
	echo '<script type="text/javascript">alert("Registration Unsuccessful")</script>';
	header('Refresh:0; url=user_reg.php');
}
else if($reg=="duplicate")
{
	echo '<script type="text/javascript">alert("Registration Already Done")</script>';
	header('Refresh:0; url=user_reg.php');
}
?>
