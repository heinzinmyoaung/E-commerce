<?php  

session_start();  
include('connect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/PHPMailer/src/SMTP.php';

    $otp = rand(100000,999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['error_msg'] = "Code Sent";
    $mail = new PHPMailer;

    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;     
    // $mail->SMTPDebug = 2;                               //Enable SMTP authentication
    $mail->Username   = 'tygord259@gmail.com';                     //SMTP username
    $mail->Password   = 'uhewajwkscqhxxgf';                               //SMTP password
    $mail->SMTPSecure='tls';
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('tygord259@gmail.com', 'Aline Electronic Online Shop');
    // $mail->addAddress('zinzin223332@gmail.com', 'Joe User');     //Add a recipient
    $mail->addAddress($_SESSION['Email'] );//Add a recipient
    


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject="Your verify code";
    $name =$_SESSION['StaffName']; 
    $mail->Body="<p>Dear $name ,</p> <h3>Your verify OTP code is $otp <br></h3>";


    if(!$mail->send()){
        ?>
            <script>
                
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            </script>
        <?php
    }else{
        ?>
        <?php
        header("Location: Verify.php");

    }
        
?>
   