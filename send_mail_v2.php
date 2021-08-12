<?php


if(isset($_POST['name'])){
  $name = $_POST['name'];
  $email  = $_POST['email'];
  $project = $_POST['project'];
  $message = $_POST['message'];
  
  
  if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
    //your site secret key
    $secret = 'Your Site Secrete Key'; // Enter your Site Secret Key in Google ReCaptcha Settings
    //get verify response data
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    // echo $responseData;
    if($responseData->success){
        //contact form submission code goes here

        sendMail($name, $email, $project, $message);
    }else{
        echo "Robot verification failed, please try again.";
    }
  }else{
    echo "Please click on the reCAPTCHA box.";
  }
}


function sendMail($name, $email, $project, $message){
require "PHPMailer/PHPMailerAutoload.php"; // This is your PHPMailer path in your server

function smtpmailer($to, $from, $from_name, $subject, $body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
 
        $mail->SMTPSecure = 'ssl'; //Protocol
        $mail->Host = 'mail.example.com'; // Your email host
        $mail->Port = 465;  // Your email port
        $mail->Username = 'admin@example.com'; //Username of your email
        $mail->Password = 'Enter your email password here';    // Password of your email account
   
  //   $path = 'reseller.pdf';
  //   $mail->AddAttachment($path);
   
        $mail->IsHTML(true);
        $mail->From="admin@example.com"; // Your email usually
        $mail->FromName=$from_name;
        $mail->Sender=$from;
        $mail->AddReplyTo($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if(!$mail->Send())
        {
            $error ="Failed to send your message...";
            return $error; 
        }
        else 
        {
            $error = "Thank you for contacting me.";  
            return $error;
        }
    }
    
    $to   = 'xyz@gmail.com'; // give an email where you want to get your emails
    $from = $email;
    $name = $name;
    $subj = $project;
    $msg =  $message;
    
    $error=smtpmailer($to,$from, $name ,$subj, $msg);
    echo $error;
}
    
?>