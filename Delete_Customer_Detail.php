<?php
session_start();
include 'conn.php';

$flag=0;
$userid=0;
if(isset($_POST['delete']))
{
	
	$email1=$_POST['email'];
	#echo $email1;
	#echo '<br>';

$select="SELECT UserID FROM customer_details where email='$email1' ";
$result = mysqli_query($conn,$select);
while($row = mysqli_fetch_assoc($result))
{
	$userid=$row['UserID'];
		$flag=1;

	}
	
$delete = "DELETE FROM customer_details WHERE UserID='$userid'";
mysqli_query($conn,$delete);

$delete = "DELETE FROM cust_certificate WHERE UserID='$userid'";
mysqli_query($conn,$delete);

$delete = "DELETE FROM cust_payment WHERE UserID='$userid'";
mysqli_query($conn,$delete);

if($flag==1)
{
	header('Location:alert.php?delete=yes');

}
else
{
	header('Location:alert.php?delete=no');
	
}
		
}
include 'conn_close.php';

?>

<html>
<head>
	<title>Delete Customer Detail</title>
	<style>
		.dropbtn {
  			padding: 14px;
  			font-size:14px;
  			background-color:#26267d;
  			border: none;
 			color:white;
		}
	</style>
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
<body>

<?php
	include 'logo_page.html';
	echo "<br>";
	include 'admin_nav.php';
?>

<br><br><br>

<center>
<div class="container-fluid" style="width:36%; height:60%;">
		
<form name="form1" action="Delete_Customer_Detail.php" method="POST" onsubmit="return email_validation()">

<h2 style="color:black; text-align:center; font-size:180%; font-weight:bold;">Delete Customer Detail</h2>&nbsp;&nbsp;&nbsp;
<br>
<h3 style="text-align:left;">Email:<br><br></h3>
<input type="text" class="form-control" name="email" id="email1" placeholder="Email" ><br>

 <br>
<input type="submit" name="delete" class="dropbtn" value="Delete"><br>
</form>
</div>
</center>
<?php include 'footer.html'; ?>
</body>
</html>