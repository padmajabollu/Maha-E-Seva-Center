<?php

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

  for ($i=0; $i < count($certificate_name) ; $i++) { 
    if(isset($_POST[$i]))
    {
      //echo $certificate_name[$i];
      header('Location:dis_info.php?service_name='.$certificate_name[$i]);
      break;
    }
  }
  $conn->close();
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
  font-size: 10px;
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
&nbsp;

<div class="dropdown">
  <a href="payment_details.php"><button class="dropbtn">Payment Details</button></a>
  
</div>
<div class="dropdown">
  <a href="certificate_details.php"><button class="dropbtn">Service Detail</button></a>
	
</div>
<div class="dropdown">
  <a href="notifications.php"><button class="dropbtn">Notifications</button></a>
	
</div>
<div class="dropdown">
  <a href=".php"><button class="dropbtn">Payment Getway</button></a>
	
</div>
<div class="dropdown">
              <button class="dropbtn">Services</button>
                <div class="dropdown-content" style="font-size:140%; font-family:Hellvetica;">
                  <?php 
                    for ($i=0; $i < count($certificate_name) ; $i++) { 
                      echo "<a href='upload.php?service_name=".$certificate_name[$i]."'>".$certificate_name[$i]."</a>";
                    }
                  ?>
                </div>
            </div>

<div class="dropdown">
    <a href="logout.php"><button class="dropbtn">Logout</button></a>

</div>
<br><br>

</body>
</html>