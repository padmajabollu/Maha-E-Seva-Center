<?php
session_start();
if(isset($_POST["admin_login"]))
{

	$username = $_POST['email'];
	$password = $_POST['password'];
	$u1="vrushalibollu05@gmail.com";
	$p1="Mahaeseva@06";

	    if (empty($username) || empty($password))
	    {
	        //echo 'Fill data';
	        header("refresh:0; url=admin_loginform.php?login=unsuccess");
	    }
	    elseif($username==$u1 && $password==$p1)
			{
				$_SESSION['admin']=1111;
				header("Location:alert.php?admin_login=yes");
			}
		else
			{
				header("Location:alert.php?admin_login=no");
			
			}

}
?>

<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	
	<title>Admin Login</title>
	<script type="text/javascript">
		function login_validation()
		{
			var email=document.forms["admin_login"]["email"].value;
			var password=document.forms["admin_login"]["password"].value;
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
         
         	var special=0,number=0,capalpha=0,smallalpha=0;
            var i=0;
            for(i=0;i<password.length;i++)
            {
                if(password.charAt(i)=='@' || password.charAt(i)=='#' || password.charAt(i)=='$' || password.charAt(i)=='&' || password.charAt(i)=='.')
                {
                    special+=1;
                }
                else if(password.charAt(i)=='0' || password.charAt(i)=='1' || password.charAt(i)=='2' || password.charAt(i)=='3' || password.charAt(i)=='4' || password.charAt(i)=='5' || password.charAt(i)=='6' || password.charAt(i)=='7' || password.charAt(i)=='8' || password.charAt(i)=='9')
                {
                    number+=1;
                }
                else if(password.charAt(i)=="A" || password.charAt(i)=="B" || password.charAt(i)=="C" || password.charAt(i)=="D" || password.charAt(i)=="E" || password.charAt(i)=="F" || password.charAt(i)=="G" || password.charAt(i)=="H" || password.charAt(i)=="I" || password.charAt(i)=="J" || password.charAt(i)=="K" || password.charAt(i)=="L" || password.charAt(i)=="W" || password.charAt(i)=="X" || password.charAt(i)=="M" || password.charAt(i)=="N" || password.charAt(i)=="O" || password.charAt(i)=="Z" || password.charAt(i)=="Y" || password.charAt(i)=="P" || password.charAt(i)=="Q" || password.charAt(i)=="R" || password.charAt(i)=="S" || password.charAt(i)=="T" || password.charAt(i)=="U" || password.charAt(i)=="V")
                {
                    capalpha+=1;
                    
                }
                else if(password.charAt(i)=="a" || password.charAt(i)=="b" || password.charAt(i)=="c" || password.charAt(i)=="d" || password.charAt(i)=="e" || password.charAt(i)=="f" || password.charAt(i)=="g" || password.charAt(i)=="h" || password.charAt(i)=="i" || password.charAt(i)=="j" || password.charAt(i)=="k" || password.charAt(i)=="l" || password.charAt(i)=="w" || password.charAt(i)=="x" || password.charAt(i)=="m" || password.charAt(i)=="n" || password.charAt(i)=="o" || password.charAt(i)=="Z" || password.charAt(i)=="Y" || password.charAt(i)=="p" || password.charAt(i)=="q" || password.charAt(i)=="r" || password.charAt(i)=="s" || password.charAt(i)=="t" || password.charAt(i)=="u" || password.charAt(i)=="v")
                {
                    smallalpha+=1;
                    
                }
	            else
                {

                }

            } 
            if(!(password!="" && capalpha>=1 && smallalpha>=1 && number>=1 && special>=1 && (special+number+smallalpha+capalpha)==password.length && password.length>=8 && password.length<=16))
				{
					alert("\nEnter Valid Password");
					return false;
	                
	            }

            return true;
		}
	</script>
</head>

<body style="background-color:#F5F5F5;">

<?php 

	include 'logo_page.html';
	echo "<br>";
	include 'navigation_bar1.html';
	
?>

<br>
<h2 style="color:#696969; text-align:center;">ADMIN LOGIN</h2>
<center>
	<div class="container-fluid" style="width:36%; height:60%;">	
		<br><img src="static images/admin1.jpg" width=50% height=50%></img>
		<br><br>
		<form  class="form-group" name="admin_login" action="admin_login.php" method="post" onsubmit="return login_validation();">
		<input type="text" class="form-control" name="email" id="username1" placeholder="Email"><br>
		<input type="password" class="form-control" name="password" id="password1" placeholder="password"><br>
		<button type="submit" value="Login" class="btn btn-default" name="admin_login">Login</button>
		<br><br><br>
		</form>
	</div>

</center>

<br><br><br><br><br>
<?php include 'footer.html' ?>
</body>
</html>
