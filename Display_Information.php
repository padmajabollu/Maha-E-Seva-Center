<?php
	session_start();
	include 'conn.php';
	if(!(isset($_SESSION['admin'])))
	{
		header('Location:admin_login.php');
	}
?>

<html>

<head>
	<title>Display Information</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>


<?php 

include 'logo_page.html';
include 'admin_nav.php';
?>

<?php
include 'conn.php';
$info=(isset($_GET['info']))?$_GET['info']:"";

?>
<?php
if($info=='Show_Customer_Details1')
{
	
$sql="SELECT * FROM customer_details";
$result = mysqli_query($conn,$sql);
#UNION DISTINCT SELECT * FROM cust_payment
echo '<br>';
echo "
	<div class='container-fluid' style='width:60%;'>
	<br><center><font style='font-size:160%; font-weight:bold;'>Costumer Details</font></center>
		<br><br>
	<table border='2px' class='table' style='text-align:center;'>
<thead>
<tr>

<th scope='col' style='text-align:center; font-size:120%;'>Customer Name</th>

<th scope='col' style='text-align:center; font-size:120%;'>Email Id</th>

<th scope='col' style='text-align:center; font-size:120%;'>Contact Number</th>

<th scope='col' style='text-align:center; font-size:120%;'>Total</th>
</thead>
</tr>
<tbody>
";

while($row = mysqli_fetch_assoc($result))

  {
	   $name=$row['Cust_Name'];
	  
 $contact=$row['Contact_no'];
 $total=$row['total'];
 $email=$row['email'];
 
  echo "<tr>";

  echo "<td>" . $name . "</td>";

  echo "<td>" . $email . "</td>";
  
  echo "<td>" . $contact . "</td>";
  
	echo "<td>" . $total . "</td>";
  

  
  echo "</tr>";
  

  }

echo "</tbody></table></div>";


	#echo 'Show_Customer_Details';
}

else if($info=='Total_Income_Per_Day1')
{
	$date=date('Y-m-d');
$sql="SELECT sum(payment) AS sum_payment FROM cust_payment WHERE payment_date='$date' ";
$result = mysqli_query($conn,$sql);
#UNION DISTINCT SELECT * FROM cust_payment
echo '<br>';
echo "<div class='container-fluid' style='width:30%;'>
<br><center><font style='font-size:160%; font-weight:bold;'>Total Income</font></center>
	<br><br>
<table border='2px' class='table' style='text-align:center;'>
<thead>
<tr>

<th scope='col' style='text-align:center; font-size:120%;'>Total Income Per Day</th>

</tr></tbody>";


while($row = mysqli_fetch_assoc($result))

  {
	   $total=$row['sum_payment'];
	  
 
  echo "<tr>";

  echo "<td>" . $total . "</td>";

  

  
  echo "</tr>";
  

  }

echo "</tbody></table></div>";

 

	#echo 'Total_Income_Per_Day1';
	
}
else if($info=='Total_Amount_Per_Customer1')
{
	
$sql="SELECT Cust_Name,total FROM customer_details ";
$result = mysqli_query($conn,$sql);
#UNION DISTINCT SELECT * FROM cust_payment
echo '<br>';
echo "<div class='container-fluid' style='width:60%;'>
<br><center><font style='font-size:160%; font-weight:bold;'>Total Amount Per Costumer</font></center>
	<br><br>
<table border='2px' class='table' style='text-align:center;'>
<thead>
<tr>

<th scope='col' style='text-align:center; font-size:120%;'>Customer Name</th>
<th scope='col' style='text-align:center; font-size:120%;'>Total Amount </th>


</tr></tbody>";


while($row = mysqli_fetch_assoc($result))

  {
	   $total=$row['total'];
	   $name=$row['Cust_Name'];
	  
 
  echo "<tr>";

  echo "<td>" . $name . "</td>";
  
  
  echo "<td>" . $total . "</td>";


  echo "</tr>";
  

  }

echo "</tbody></table></div>";

 

	#echo 'Total_Amount_Per_Customer1';	
}
else if($info=='Remaining_Amount_per_Customer1')
{
#UNION DISTINCT SELECT * FROM cust_payment
echo '<br>';
echo "<div class='container-fluid' style='width:60%;'>
<br><center><font style='font-size:160%; font-weight:bold;'>Remaining Amount Per Costumer</font></center>
	<br><br>
<table border='2px' class='table' style='text-align:center;'>
<thead>
<tr>

<th scope='col' style='text-align:center; font-size:120%;'>Customer Name</th>
<th scope='col' style='text-align:center; font-size:120%;'>Remaining Amount </th>

</thead>
</tr><tbody>";
$sql="SELECT * FROM customer_details";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
	while($row=mysqli_fetch_assoc($result))
	{
		$userid=$row['UserID'];
		$sql1="SELECT sum(payment) as payment1 FROM cust_payment where UserID='$userid'";
		$result1 = mysqli_query($conn,$sql1);
		if(mysqli_num_rows($result1)>0)
		{
			while($row1=mysqli_fetch_assoc($result1))
			{
				$total=$row['total'];
			   $pay=$row1['payment1'];
			   $rem=$total-$pay;
			   $name=$row['Cust_Name'];

				  echo "<tr>";

				  echo "<td>" . $name . "</td>";
				  
				  
				  echo "<td>" . $rem . "</td>";


				  echo "</tr>";
				 
			}
			
		}
	}
	
}

echo "</tbody></table></div>";

 

}
else if($info=='Paid_Customer1')
{
$sql="SELECT * FROM customer_details";

$result = mysqli_query($conn,$sql);
#UNION DISTINCT SELECT * FROM cust_payment
echo '<br>';
echo "<div class='container-fluid' style='width:60%;'>
<br><center><font style='font-size:160%; font-weight:bold;'>Paid Costumers</font></center>
	<br><br>
<table border='2px' class='table' style='text-align:center;'>
<thead>
<tr>

<th scope='col' style='text-align:center; font-size:120%;'>Customer Name</th>
<th scope='col' style='text-align:center; font-size:120%;'>Paid Amount </th>

</thead>
</tr><tbody>";


while($row = mysqli_fetch_assoc($result))

{
	   
	  
 if($row['payment_status']=='yes')
 {
  echo "<tr>";

  echo "<td>" . $row['Cust_Name'] . "</td>";
  
  
  echo "<td>" . $row['total'] . "</td>";


  echo "</tr>";
  

  }

echo "</tbody></table></div>";

  }

}
else if($info=='Unpaid_Customer1')
{

$sql="SELECT * FROM customer_details";

$result = mysqli_query($conn,$sql);
#UNION DISTINCT SELECT * FROM cust_payment
echo '<br>';
echo "<div class='container-fluid' style='width:60%;'>
<br><center><font style='font-size:160%; font-weight:bold;'>Unpaid Costumer</font></center>
	<br><br>
<table border='2px' class='table' style='text-align:center;'>
<thead>
<tr>

<th scope='col' style='text-align:center; font-size:120%;'>Customer Name</th>
<th scope='col' style='text-align:center; font-size:120%;'>Payment Status </th>

</thead>
</tr><tbody>";


while($row = mysqli_fetch_assoc($result))

  {
	   
	  
 if($row['payment_status']!='yes')
 {
  echo "<tr>";

  echo "<td>" . $row['Cust_Name'] . "</td>";
  
  
  echo "<td>" . $row['payment_status'] . "</td>";


  echo "</tr>";
  

  }

echo "</tbody></table></div>";

  }

}
else if($info=='Deliver_Certificates1')
{
		
$sql="SELECT * FROM customer_details";;
$result = mysqli_query($conn,$sql);
#UNION DISTINCT SELECT * FROM cust_payment
echo '<br>';
echo "<div class='container-fluid' style='width:60%;'>
<br><center><font style='font-size:160%; font-weight:bold;'>Delivered Certificates</font></center>
	<br><br>
<table border='2px' class='table' style='text-align:center;'>
<thead>
<tr>

<th scope='col' style='text-align:center; font-size:120%;'>Customer Name</th>
<th scope='col' style='text-align:center; font-size:120%;'>Contact Number</th>
<th scope='col' style='text-align:center; font-size:120%;'>Deliver Status</th>
<th scope='col' style='text-align:center; font-size:120%;'>Payment Status</th>


</thead>
</tr><tbody>";


while($row = mysqli_fetch_assoc($result))

  {
	  
	   $s=$row['status'];
	   $s_pay=$row['payment_status'];
	   $cont=$row['Contact_no'];
	   $name=$row['Cust_Name'];
	   if($s=='yes')
	   {
	  
  echo "<tr>";

  echo "<td>" . $name . "</td>";
  
  
  echo "<td>" . $cont . "</td>";

  echo "<td>" . $s . "</td>";

    echo "<td>" . $s_pay . "</td>";

  echo "</tr>";
  
	   }
  }
echo "</tbody></table></div>";
	
}

else if($info=='Undeliver_Certificates1')
{
	$sql="SELECT * FROM customer_details";;
$result = mysqli_query($conn,$sql);
#UNION DISTINCT SELECT * FROM cust_payment
echo '<br>';
echo "<div class='container-fluid' style='width:60%;'>
<br><center><font style='font-size:160%; font-weight:bold;'>Undeliverd Certificates</font></center>
	<br><br>
<table border='2px' class='table' style='text-align:center;'>
<thead>
<tr>

<th scope='col' style='text-align:center; font-size:120%;'>Customer Name</th>
<th scope='col' style='text-align:center; font-size:120%;'>Contact Number</th>
<th scope='col' style='text-align:center; font-size:120%;'>Deliver Status</th>
<th scope='col' style='text-align:center; font-size:120%;'>Payment Status</th>


</thead>
</tr><tbody>";


while($row = mysqli_fetch_assoc($result))

  {
	  
	   $s=$row['status'];
	   $s_pay=$row['payment_status'];
	   $cont=$row['Contact_no'];
	   $name=$row['Cust_Name'];
	   if($s=='no')
	   {
	  
  echo "<tr>";

  echo "<td>" . $name . "</td>";
  
  
  echo "<td>" . $cont . "</td>";

  echo "<td>" . $s . "</td>";

    echo "<td>" . $s_pay . "</td>";

  echo "</tr>";
  
	   }
  }
echo "</tbody></table></div>";

}

else if($info=='Certificates_of_Per_Customer1')
{
	$sql="SELECT DISTINCT customer_details.Cust_Name,cust_certificate.certificate_name FROM customer_details, cust_certificate 
	WHERE customer_details.UserID=cust_certificate.UserID ORDER BY customer_details.UserID";
$result = mysqli_query($conn,$sql);
#UNION DISTINCT SELECT * FROM cust_payment
echo '<br>';
echo "<div class='container-fluid' style='width:60%;'>
<br><center><font style='font-size:160%; font-weight:bold;'>Certificates of Per Customer</font></center>
	<br><br>
<table border='2px' class='table' style='text-align:center;'>
<thead>
<tr>

<th scope='col' style='text-align:center; font-size:120%;'>Customer Name</th>
<th scope='col' style='text-align:center; font-size:120%;'>Certificate Name</th>

</thead>
</tr><tbody>";


while($row = mysqli_fetch_assoc($result))

  {
	  
	   $cust_name=$row['Cust_Name'];
	   $cert=$row['certificate_name'];
	   
  echo "<tr>";

  echo "<td>" . $cust_name . "</td>";
  
  
  echo "<td>" . $cert . "</td>";

 
  echo "</tr>";
  
	   }
  
echo "</tbody></table></div>";

  
}

$conn->close();


?>
<?php
echo "<br><br><br><br><br><br><br><br><br>";
include 'footer.html';
?>
</body>
</html>