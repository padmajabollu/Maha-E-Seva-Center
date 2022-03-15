<?php
	session_start();
	if(!(isset($_SESSION['admin'])))
	{
		header('Location:admin_login.php');
	}
?>


<?php
$tot=0;
$userid=0;
$flag=0;
$date= date('Y-m-d');

include 'conn.php';
if(isset($_POST['store']))
{
	
	$email1=$_POST['email'];
	
	$amount1=$_POST['amount'];

$select2="SELECT * FROM customer_details where email='$email1' ";
$result = mysqli_query($conn,$select2);
$resultCheck = mysqli_num_rows($result);
if($resultCheck==1)
{
	
	while($row = mysqli_fetch_assoc($result))
	{

		$userid=$row['UserID'];
		$tot=$row['total'];
		$flag+=1;
	}

			$select2="SELECT sum(payment) as total1 FROM cust_payment where UserID='$userid' ";
			$result = mysqli_query($conn,$select2);
			$resultCheck1 = mysqli_num_rows($result);
			if($resultCheck1==1)
			{
				while($row = mysqli_fetch_assoc($result))
				{
					$pay_tot=$row['total1'];
					$amt_sum=$amount1+$pay_tot;
					if($tot==$amt_sum)
					{
						$update="UPDATE customer_details SET payment_status='yes' WHERE UserID='$userid'  ";
						mysqli_query($conn,$update)	;
						$flag+=1;
						
					}
					
					else if($tot>$amt_sum)
					{
						$update="UPDATE customer_details SET payment_status='partial' WHERE UserID='$userid'";
						//header("refresh:0; url=admin_page.php?login=updatesuccess");
						mysqli_query($conn,$update)	;
						$flag+=1;
						
				
					}

				}
				
			}/*
			else if($tot==$amount1)
			{
					$update="UPDATE customer_details SET payment_status='yes' WHERE UserID='$userid'  ";
					mysqli_query($conn,$update)	;
					$flag+=1;
				}

		
		else if($tot>$amount1)
		{
			$update="UPDATE customer_details SET payment_status='partial' WHERE UserID='$userid'";
			//header("refresh:0; url=admin_page.php?login=updatesuccess");
			mysqli_query($conn,$update)	;
			$flag+=1;
			
	
		}*/
		$sql = "INSERT INTO cust_payment(UserID,payment,payment_date) 
			VALUES('$userid',' $amount1','$date');";
			
			mysqli_query($conn,$sql);
			
		
}
		if($userid==0)
		{
			header('Location:alert.php?record=no');

		}
		else if($flag==2)
		{
			header('Location:alert.php?payment=yes');
			
		}

}

$conn->close();
?>			

<html>
<head>
	<title>Payment Entry</title>
	<script type="text/javascript">
		function email_validation()
		{
			var email=document.forms["form1"]["email"].value;
			var phno=document.forms["form1"]["amount"].value;
			
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
	            var no=0;
				var i=0;
				var phno1=phno.toString();
				for(i=0;i<phno1.length;i++)
				{
					var ch=phno1.charAt(i);
					
					if(ch=='0' || ch=='1' || ch=='2' || ch=='3' || ch=='4' || ch=='5' || ch=='6' || ch=='7'
					|| ch=='8' || ch=='9')
					{
						no=no+1;
					}
					
				}
				
				if(!(Number.isInteger(parseInt(phno))==true && phno!=""))
				{
					alert("\nEnter Valid Amount")
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
	echo "<br>";
	include 'admin_nav.php';
?>
<br>
&nbsp;&nbsp;
<center>
<div class="container-fluid" style="width:40%; height:60%;">

<form name="form1" action="payment.php" method="POST" onsubmit="return email_validation()"><br>
<h2 style="color:black; text-align:center;">Payment</h2>&nbsp;&nbsp;&nbsp;
<h3 style="text-align:left; font-family:Helvetica; color:black;">
<h3 style="text-align:left; font-family:Helvetica; color:black;">Email:</h3>
<input type="text" class="form-control"  name="email" id="email1" placeholder="Email" ><br>
<h3 style="text-align:left; font-family:Helvetica; color:black;">Amount:</h3>
<input type="text" class="form-control"  name="amount" id="amount1" placeholder="Amount"><br><br>

  <center>
<input type="submit" class="dropbtn" name="store" value="Make Payment"></center><br>
</form>
</h3>
</form>
	</div>
</center>
<br>
<?php
	include 'footer.html';
?>
</body>
</html>