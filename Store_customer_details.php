<?php
	session_start();
	if(!(isset($_SESSION['admin'])))
	{
		header('Location:admin_login.php');
	}
?>

<?php
	$userid=0;

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
$flag=0;
if(isset($_POST['store']))
{

	$cust_name1=$_POST['name'];
	#echo $cust_name1;
	#echo '<br>';
	
	$email1=$_POST['email'];
	#echo $email1;
	#echo '<br>';
	
	$contact1=$_POST['phno'];
	#echo $contact1;
	#echo '<br>';
	
	//$certificate1=$_POST['certificate'];
	#echo $certificate1;
	#echo '<br>';
	$service_names=$_POST['certificate'];
	/*
	$select="SELECT user_id FROM user_reg where email='$email1' ";
	$result = mysqli_query($conn,$select);
	while($row = mysqli_fetch_assoc($result))
	{
		$userid=$row['user_id'];
		#echo $userid;
		#echo '<br>';
	}*/
	$select2="SELECT UserID,Contact_no FROM customer_details where email='$email1' ";
	$result = mysqli_query($conn,$select2);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck<1)
	{
	$sql = "INSERT INTO customer_details(Cust_Name,email,Contact_no) 
			VALUES(' $cust_name1','$email1','$contact1');";
			
	mysqli_query($conn,$sql);
	
	$update="UPDATE customer_details SET payment_status='no' WHERE UserID='$userid'  ";
			mysqli_query($conn,$update)	;
			$update="UPDATE customer_details SET status='no' WHERE UserID='$userid'  ";
			mysqli_query($conn,$update)	;


	}
	$select="SELECT UserID FROM customer_details where email='$email1' ";
	$result = mysqli_query($conn,$select);
	while($row = mysqli_fetch_assoc($result))
	{
		$userid=$row['UserID'];
		/*echo $userid;
		*/#echo '<br>';
	}
	
	if(count($service_names)>0)
	{
		foreach($service_names as $val)
		{

			$select1="SELECT * FROM service_image where service_name='$val'";
			$result1 = mysqli_query($conn,$select1);
			if($row1 = mysqli_fetch_assoc($result1))
			{
				$amount1=$row1['service_cost'] ;
				
				#echo $amount1;
			}

			$date=date('Y-m-d');

			$insert1="INSERT INTO cust_certificate(UserID,certificate_name,cert_amount,date1) 
					VALUES('$userid',' $val','$amount1','$date')";

					mysqli_query($conn,$insert1);

				
			$select="SELECT SUM(cert_amount) AS total FROM cust_certificate GROUP BY UserID HAVING UserID='$userid' ";		
			$result = mysqli_query($conn,$select);
			while($row = mysqli_fetch_assoc($result))
			{
			$total1=$row['total'];
			#echo '<br>';
			#echo $total1;
			}
			$update="UPDATE customer_details SET total='$total1' WHERE UserID='$userid'";
				
			mysqli_query($conn,$update);
			
		}
		$flag=1;
	
	}
	
	else
	{
		$flag=2;
	}

   require('FPDF/fpdf.php');
	$db=new PDO('mysql:host=localhost;dbname=mahaesevacenter','root','');
	
	class myPDF extends FPDF
	{
		function header()
		{
			$this->Image('Images/logo.jpg',0,0,-300);
			$this->SetFont('Arial','B',18);
			$this->Cell(276,8,'Maha E Seva Center',40,40,'C');
			$this->Ln();
			$this->SetFont('Times','',14);

			$this->Cell(270,10,'Shripad Darshan Appartment, Store N0. 7, Near Tana-Bana, Datta Nager, New Pachha Peth,Solapur.',0,0,'C');
			
			$this->Ln(20);
		}
		function footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
		}
		function headerTable($cust_name1)
		{
			$this->SetFont('Times','B',14);
			
			$cust_name=$cust_name1;
			$this->Cell(270,20,$cust_name,0,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',15);
			
			$this->Cell(100,10,'CERTIFICATE NAME',1,0,'C');
			$this->Cell(100,10,'AMOUNT',1,0,'C');
			$this->Ln();
		
		}
		function viewTabledata($db,$userid)
		{
			$this->SetFont('Times','',12);
			$date2=date('Y-m-d');
			$id=$userid;
			$stmt=$db->query("select * from cust_certificate where date1='$date2' and UserID='$id'");
			
			while($data=$stmt->fetch(PDO::FETCH_OBJ))
			{
				
				$this->Cell(100,10,$data->certificate_name,1,0,'C');
				$this->Cell(100,10,$data->cert_amount,1,0,'C');
				$this->Ln();	
			}
		}
		function footertable($db,$userid)
		{	
			$date2=date('Y-m-d');
			$id=$userid;
			$stmt=$db->query("select sum(cert_amount) as total_amount from cust_certificate where date1='$date2' and UserID='$id'");
			
			while($data=$stmt->fetch(PDO::FETCH_OBJ))
			{
				$this->Cell(100,10,'Total',1,0,'C');
				$this->Cell(100,10,$data->total_amount,1,0,'C');
				$this->Ln();
			}
		}
	}	


$pdf=new myPDF();
	$file_name='bill.pdf';
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A4',0);
	$pdf->SetLeftMargin(45);
	$pdf->headerTable();
	$pdf->viewTabledata($db);
	$pdf->footertable($db);
	$file=$pdf->Output('F', $file_name);
	require 'PHPMailer-master/PHPMailerAutoload.php';
   
	$mail = new PHPMailer;

   	$mail ->IsSmtp();
   	$mail ->SMTPDebug = 0;
   	$mail ->SMTPAuth = true;
   	$mail ->SMTPSecure = 'tls';
   	$mail ->Host = "smtp.gmail.com";
   	$mail ->Port = 587 ; // or 587
   	$mail ->IsHTML(true);
	$mail->WordWrap=50;
   	$mail ->Username = "vrushalibollu05@gmail.com";
   	$mail ->Password = "Gmailpaddu@03";
   	$mail ->SetFrom("vrushalibollu05@gmail.com","MAHA E Seva Center");
	$mail->AddAttachment($file_name);

	$mail->Subject='Invoice';
   	$mail->Body='Please find invoice in attach PDF file.';
   	$mail ->AddAddress($email1);

	if(!$mail->Send())
   	{
   		echo 'Mailer Error: ' . $mail->ErrorInfo;
   		
   		
   	}
  	else
	{

		echo "Email has been sent successfully";
	}
	
	if($flag==0)
	{
		//header('Location:alert.php?record=no');

	}
	else if($flag==2)
	{
		//header('Location:alert.php?record=nosel');
		
	}
	else
	{
		//header('Location:alert.php?record=yes');

	}
	//unlink($file_name);  //remove pdf file 
}
	

include 'conn_close.php';
?>


<html>
<head>
	<title>Store Customer Details</title>
	<script type="text/javascript">

		/*alert("Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.")
		*/
		function customer_validation()
		{

				var name=document.forms["store1"]["name"].value;
				var email=document.forms["store1"]["email"].value;
				var phno=document.forms["store1"]["phno"].value;
				/*var service=document.forms["store1"]["certificate"].value;
				/*alert(service);
				*/
				var i=0;
				var chars=0;
				var fname1=name.toLowerCase();
				for(i=0;i<fname1.length;i++)
				{
					var ch=fname1.charAt(i);
					if(ch=='a' || ch=='b' || ch=='c' || ch=='d' || ch=='e' || ch=='f' || ch=='g' || ch=='h'
						 || ch=='i' || ch=='j' || ch=='k' || ch=='l' || ch=='m' || ch=='n' || ch=='o' || ch=='p'
						 || ch=='q' || ch=='r' || ch=='s' || ch=='t' || ch=='u' || ch=='v' || ch=='w' || ch=='x'
						   || ch=='y' || ch=='z' || ch==" ")
					{
						chars=chars+1;
					}
				}
				
				if(!(name != "" && chars === name.length && name.length >= 4))
				{
					alert("\nEnter A Valid Name");	
					return false;
                    
                }
				
				
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
				
				if(!(Number.isInteger(parseInt(phno))==true && no==10 && phno!=""))
				{
					alert("\nEnter Valid 10 Digit Contact Number")
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

<center>
<div class="container-fluid" style="width:50%; height:85%;">

<form name='store1' action="Store_customer_details.php" method="post" onsubmit="return customer_validation();">
<h2  style="color:black; text-align:center; font-size:180%; font-weight:bold;">Store Customer Details</h2>&nbsp;&nbsp;&nbsp;
<h3 style="text-align:left; font-family:Helvetica; color:black;">
Customer Name:<br><br><input type="text" class="form-control" name="name" id="cust_name1" placeholder="Name" ><br>
Email ID:<br><br><input type="text" name="email" id="email1" class="form-control" placeholder="Email" ><br>
Contact Number:<br><br><input type="text" name="phno" class="form-control" id="contact1" placeholder="Contact Number"><br>
Choose Cretificate: <br><br>
	<select name="certificate[]" multiple="multiple" class="form-control">
    <?php

	    for ($i=0; $i < count($certificate_name) ; $i++) { 
	    	echo "<option>".$certificate_name[$i]."</option>";
	    }

	

    ?>

    </select>
  <br><br><center>
<input type="submit" name="store" class="dropbtn" value="Store Data"></center><br>
</h3>
</form>
</div>
</center>
<br><br><br><br><br><br>
<?php include 'footer.html'; ?>
</body>
</html>