<?php
		//session_start();
		include 'conn.php';
		if(!(isset($_SESSION['admin'])))
	{
		header('Location:admin_login.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
.dropbtn {
  padding: 14px;
  font-size: 14px;
  background-color:#26267d;
  border: none;
  color:white;
}

.dropdown {
  position: relative;
  font-family:Times new roman;
  font-weight: bold;
  background-color:none;
  display: inline-block;
}

.dropdown-content {
  display: none;
  font-family:Times new roman;
  position: absolute;
  font-weight: bold;
  background-color:#26267d;
  min-width: 300px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color:white;
  padding: 12px 16px;
  text-decoration: none;
  font-weight: bold;
  display: block;
  font-family:Times new roman;
}

li>a
{
	color:navy;
	font-weight: bold;
	font-family:Times new roman;
}


.dropdown:hover .dropdown-content {display: block;}

</style>

</head>
<body>
<br>
<nav class="navbar navbar-dark" >	
<ul class="nav navbar-nav">
<div class="dropdown">
	<li><button class="dropbtn">Display Information</button></li>
    <div class="dropdown-content">
      <a href="Display_Information.php?info=Certificates_of_Per_Customer1">Certificates of Per Customer</a>
      <a href="Display_Information.php?info=Show_Customer_Details1">Show Customer Details</a>
      <a href="Display_Information.php?info=Total_Income_Per_Day1">Total Income Per Day</a>
      <a href="Display_Information.php?info=Total_Amount_Per_Customer1">Total Amount of Per Customer</a>
      <a href="Display_Information.php?info=Remaining_Amount_per_Customer1">Remaining Amount of Per Customer</a>
      <a href="Display_Information.php?info=Paid_Customer1">Paid Customers</a>
      <a href="Display_Information.php?info=Unpaid_Customer1">Unpaid Customers</a>
      <a href="Display_Information.php?info=Deliver_Certificates1">Deliver Certificates</a>
      <a href="Display_Information.php?info=Undeliver_Certificates1">Undeliver Certificates</a>
    
      
  </div>
</div>

<div class="dropdown">
  <li><a href="user_details.php"><button class="dropbtn">Uploaded Customer Details</button></a></li>
</div>
<div class="dropdown">
<li><a href="Delete_Customer_Detail.php"><button class="dropbtn">Delete Customer Detail</button></a></li>
	
</div>
<div class="dropdown">
<li><a href="Certificate_Deliver_Status.php"><button class="dropbtn">Update Certificate Deliver Status</button></a></li>
	
</div>
<div class="dropdown">
<li><a href="Store_customer_details.php"><button class="dropbtn">Store Customer Details</button></a></li>
	
</div>
<div class="dropdown">
<li> <a href="add_service.php"><button class="dropbtn">Add Service</button></a></li>
	
</div>
<div class="dropdown">
<li><a href="delete_service.php"><button class="dropbtn">Delete Service</button></a></li>
	
</div>
<div class="dropdown">
<li><a href="payment.php"><button class="dropbtn">Payment</button></a></li>
	
</div>
<div class="dropdown">
<li><a href="logout.php"><button class="dropbtn">Logout</button></a></li>

</div>
<br><br>
</nav>
</div>
</body>
</html>