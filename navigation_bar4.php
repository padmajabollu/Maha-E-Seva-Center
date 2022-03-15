<html>
<head>
    <style>
	.dropbtn {
		padding: 16px;
		border: none;
		color:white;
		background:none;
		font-weight: bolder;
		font-family:Verdana, Geneva, Tahoma, sans-serif;
		
	}	

	.dropdown {
		position: relative;
		display: inline-block;	
	}

	.dropdown-content {
		display: none;
		position: absolute;
		background-color:white;
		min-width: 300px;
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		z-index: 1;
	}

	.dropdown-content a {
		color:Navy;
		padding: 12px 16px;
		text-decoration: none;
		display: block;
	}

    li>a
	{
		color:whitesmoke;
		font-weight: bolder;
		font-family:Verdana, Geneva, Tahoma, sans-serif;
	}

	.dropdown:hover .dropdown-content {display: block;}

	</style>
</head>
<body>

<div class="container-fluid">
    <nav class="navbar navbar-dark" style="background-image:url('static images/abstract4.jpg'); background-size: 100%;">	
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="about.php">About Us</a></li>
				<li><a href="first_page.php">Contact</a></li>
				<li><a href="user_login.php">Upload Documents</a></li>
				<li>
						<div class="dropdown">
							<button class="dropbtn">Services</button>
								<div class="dropdown-content" style="font-size:140%; font-family:Hellvetica;">
									<?php 
										for ($i=0; $i < count($certificate_name) ; $i++) { 
											echo "<a href='dis_info.php?service_name=".$certificate_name[$i]."'>".$certificate_name[$i]."</a>";
										}
									?>
								</div>
						</div>
					<br>
                </li>
                <li><a href="admin_login.php">Admin Login</a></li>
			</ul>
	</nav>
	
	</div>

</body>
</html>