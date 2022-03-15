<?php

 $to = 'vrushalibollu05@gmail.com';
                $subject = 'Fedback of uploaded documnets';
                $message = "<h1>Payment Details</h1>";
                $message .= "<hr>";
                $message .= '<p><b>Name:padmaja</b> </p>';
                
                $message .= "<hr>";

              
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                // send email
                mail($to, $subject, $message, $headers);

?>