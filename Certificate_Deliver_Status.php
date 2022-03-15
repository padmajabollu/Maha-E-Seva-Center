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
$userid=0;
$payment_status="";
if(isset($_POST['store']))
{
	
	$email1=$_POST['email'];
		
	$select="SELECT UserID,payment_status FROM customer_details where email='$email1' ";
	$result = mysqli_query($conn,$select);
	while($row = mysqli_fetch_assoc($result))
	{
		$userid=$row['UserID'];
		$payment_status=$row['payment_status'];
		echo '<br>';
		$flag=1;
		
		}
			
		if($payment_status=="yes")
		{
			$update="UPDATE customer_details SET status='yes' WHERE UserID='$userid'  ";

			mysqli_query($conn,$update)	;
			
		}
		else
		{
			$flag=0;
		}
	if($userid==0 && $flag==0)
	{
		header('Location:alert.php?record=no');
	}
	else if($flag==1)
	{
		
		header('Location:alert.php?deliver=yes');
		
	}	
	else
	{
		header('Location:alert.php?payment=no');

	}
}

include 'conn_close.php';
?>	

<?php

$deliver=(isset($_GET['deliver']))?$_GET['deliver']:"";
if($deliver=="no")
{
	echo '<script type="text/javascript">alert("Customer Deliver Status Not Updated")</script>';

}

$record=(isset($_GET['record']))?$_GET['record']:"";
if($record=="no")
{
	echo '<script type="text/javascript">alert("Customer Record Not Found")</script>';

}

?>

<html>
<head>
	<title>Update Certificate Deliver Status</title>
	<script type="text/javascript">
		function email_validation()
		{
			var email=document.forms["form1"]["email"].value;

				var amp=0,dot=0,space=0;
	            var i=0;
	            for(i=0;i<email.length;i++)
	            {
	                if(email.charAt(i)=='@')
	                {
	                    amp+=1
	                }
	                else if(email.charAt(i)=='.')
	                {
	                    dot+=1
	                }
	                else if(email.charAt(i)==" ")
	                {
	                    space+=1
	                    
	                }
	                else
	                {

	                }
	            }
	            if(!(email!="" && space==0 && amp==1 && dot>=1))
				{
					alert("\nEnter Valid Email");
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
<?php
	include 'logo_page.html';
	echo '<br>';
	include 'admin_nav.php';
?>
<br>

&nbsp;&nbsp;
<center>

<div class="container-fluid" style="width:36%; height:60%;">
<br>
<form name="form1" action="Certificate_Deliver_Status.php" method="POST" onsubmit="return email_validation()">
<h2 style="color:black; text-align:center; font-size:180%; font-weight:bold;">Update Certificate Deliver Status</h2>&nbsp;
<h3 style="text-align:left;">Email:<br><br></h3>
<input type="text" class="form-control" name="email" id="email1" placeholder="Email" >

<br><br>

<input type="submit" name="store"  class="dropbtn" value="Update Status"><br>
</form>
</h3>
</form>
</div>
</center>
<br><br><br><br><br>
	<?php
		include 'footer.html';
	?>
</body>
</html>