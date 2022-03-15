<?php
include 'conn.php';
if(isset($_POST['send'])){
	$mailto=$_POST['email'];
	echo '<br>';
	
	$email_data=$_POST['feedback'];
	$mailSub = "Feedback of Uploaded Documents";
	
    $number=$_POST['sms'];
    $flag=0;
    $date= date('Y-m-d');

	$insert="INSERT INTO feedback(email, feedback,date1) VALUES ('$mailto','$email_data','$date')";
	mysqli_query($conn,$insert);

if($number)
{
	$url="www.way2sms.com/api/v1/sendCampaign";
	$message = urlencode($email_data);// urlencode your message
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
	curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=CJ9FK9VCAREZRLH8G11SC3US3OW17PMI&secret=HQS7CMFVQIPRT3RH&usetype=stage&phone=$number&senderid=vrushalibollu05@gmail.com&message=$message");// post data
	// query parameter values must be given without squarebrackets.
	 // Optional Authentication:
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($curl);
	curl_close($curl);

	$url="www.way2sms.com/api/v1/sendCampaign";
	$message = urlencode($mailSub);// urlencode your message
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
	curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=FVHWEXDSNGE0IAT9CXSGV45VJ8SH1LMM&secret=FBNP9M6PEERDUUYD&usetype=stage&phone=$number&senderid=vrushalibollu05@gmail.com&message=$message");// post data
	// query parameter values must be given without squarebrackets.
	 // Optional Authentication:
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($curl);
	curl_close($curl);
	$flag+=1;
	echo $result;
}
	//require 'VerifyEmail.class.php	';

   require 'PHPMailer-master/PHPMailerAutoload.php';
   
	$mail = new PHPMailer;

   $mail ->IsSmtp();
   $mail ->SMTPDebug = 0;
   $mail ->SMTPAuth = true;
   $mail ->SMTPSecure = 'ssl';
   $mail ->Host = "smtp.gmail.com";
   $mail ->Port = 465 ; // or 587
   $mail ->IsHTML(true);
   $mail ->Username = "vrushalibollu05@gmail.com";
   $mail ->Password = "Gmailpaddu@03";
   $mail ->SetFrom("vrushalibollu05@gmail.com","MAHA E Seva Center");
   $mail ->Subject = $mailSub;
   $mail ->Body = $email_data;
   $mail ->AddAddress($mailto);

   if(!$mail->Send())
   {
   		echo 'Mailer Error: ' . $mail->ErrorInfo;
   		
   		
   }
   else

   {
   	
   	$flag+=1;
   }
   /*

	$sql = "SELECT * FROM user_reg where email='$mailto' ";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result) > 0)
	{
	    while($row = $result->fetch_assoc()){
			$id= $row['user_id'];
			
		}
		$delete="delete from upload_docs where user_id=$id";
		mysqli_query($conn,$delete);
	}
	*/
   if($flag==2)
   {
   	
   		header('Location:alert.php?sent=yes');
   	
   }
   else
   {
   		header('Location:alert.php?email='.$mailto.'&sent=no');
	
   }
	

	}
include 'conn_close.php';
?>
