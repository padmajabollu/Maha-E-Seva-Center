<?php
include 'conn.php';
if(isset($_POST['user_reg']))
{
	$fn=$_POST['fname'];
	$ln=$_POST['lname'];
	$email=$_POST['email'];
	$phno=$_POST['phone'];
	$pass=$_POST['password'];
	//$hashpass=password_hash($pass,PASSWORD_DEFAULT);
	
	$select="select * from user_reg where email='$email'";

	$result=mysqli_query($conn,$select);
	$num_rows=mysqli_num_rows($result);
	if($num_rows==1)
	{
		//echo "duplicate";
		header('Location:user_reg.php?reg=duplicate');	
	}
	else
	{
		$insert="insert into user_reg(fname,lname,email,phno,password) values('$fn','$ln','$email','$phno','$pass')";
		if(mysqli_query($conn,$insert))
		{
			header('Location:user_login.php?reg=yes');
			//echo "success";
		}
		else
		{
			//echo "unccess";
			header('Location:alert.php?reg=no');
		}
	}
}
include 'conn_close.php';
?>

<html>
	<head>
		<title>Registration</title>
		<script type="text/javascript">
			function user_reg_validation()
			{

				var fname=document.forms["user_reg"]["fname"].value;
				var lname=document.forms["user_reg"]["lname"].value;
				var email=document.forms["user_reg"]["email"].value;
				var phno=document.forms["user_reg"]["phone"].value;
				var password=document.forms["user_reg"]["password"].value;
				
				var i=0;
				var chars=0;
				var fname1=fname.toLowerCase();
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
				
				if(!(fname != "" && chars === fname.length && fname.length >= 4))
				{
					alert("\nEnter A Valid First Name");	
					return false;
                    
                }
				
				var i=0;
				var chars=0;
				var lname1=lname.toLowerCase();
				for(i=0;i<lname1.length;i++)
				{
					var ch=lname1.charAt(i);
					if(ch=='a' || ch=='b' || ch=='c' || ch=='d' || ch=='e' || ch=='f' || ch=='g' || ch=='h'
						 || ch=='i' || ch=='j' || ch=='k' || ch=='l' || ch=='m' || ch=='n' || ch=='o' || ch=='p'
						 || ch=='q' || ch=='r' || ch=='s' || ch=='t' || ch=='u' || ch=='v' || ch=='w' || ch=='x'
						   || ch=='y' || ch=='z' || ch==" ")
					{
						chars=chars+1;
					}
				}
				
				if(!(lname != "" && chars === lname.length && lname.length >= 4))
				{
					alert("\nEnter A Valid Last Name");	
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
<body>
<br><br>
<form action="index.php" method="post">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<input type="submit" value="Back" name="submit">
</form>
&nbsp;&nbsp;

<center>
<h2>Registration</h2>&nbsp;&nbsp;&nbsp;

<form name='user_reg' action="user_reg.php" method="POST" onsubmit="return user_reg_validation()">

<h3>
First Name:&nbsp;&nbsp;&nbsp	<input type="text" name="fname" placeholder="first_Name" id="first1"><br><br>
Last Name:&nbsp;&nbsp;&nbsp  <input type="text" name="lname" placeholder="last_Name" id="last1"><br><br>
Username:&nbsp;&nbsp;&nbsp; 
		<input type="text" name="email" placeholder="email" id="email1" ><br><br>

Phone Number:&nbsp;&nbsp;&nbsp <input type="text" name="phone" placeholder="phone number" id="phno"><br><br>

Password:&nbsp;&nbsp;&nbsp <input type="password" name="password" placeholder="password" id="password1"><br><br>
<input type="submit" name="user_reg" value="Sign Up"><br>
</h3>
</form>

</center>

<?php
$reg=(isset($_GET['reg']))?$_GET['reg']:"";
if($reg=="no")
{
	echo '<script type="text/javascript">alert("Registration Unsuccessful")</script>';

}
else if($reg=="duplicate")
{
	echo '<script type="text/javascript">alert("Duplicate Registration")</script>';

}
?>

</body>
</html>