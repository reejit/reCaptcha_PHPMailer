<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP; // For SMTP must enable
use PHPMailer\PHPMailer\Exception;

// Load Now
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php'; //For SMTP must enable

    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "<br /><br />".$error;
        die();
    }

if(!empty($_POST['txtEmail'])) { //set a required field here for condition

// NEED CHANGES FROM HERE

    // validation expected data exists
    if(empty($_POST['txtTitle']) ||
       empty($_POST['txtFirst']) ||
       empty($_POST['txtSur']) ||
       empty($_POST['txtEmail']) ||
       empty($_POST['txtInterest'])
   ) {
        died('Looks like you forgot to fill some required field.');        
    }



// Cooking to make it 
    $title = $_POST['txtTitle']; 
    $fname = $_POST['txtFirst']; 
    $sname = $_POST['txtSur']; 
    $email_f= $_POST['txtEmail']; 
    $interest= $_POST['txtInterest']; 
    $subject = 'Contact - Webocta.Com';

// CHANGE AREA STOPS HERE

    $mail = new PHPMailer;
    $mail->isSendmail();                                           // Send using phpSendmail  or
    // $mail->isSMTP();                                            // Send using SMTP


    //Server settings for SMTP
    
    // $mail->Host       = 'mail.your-mailserver.com';             // Set the SMTP server to send through
    // $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    // $mail->Username   = 'user@your-domain.com';                 // SMTP username
    // $mail->Password   = 'password';                               // SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    // $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above



    $mail->setFrom('noreplay@yourmail.com', 'optional name');     // From mail
    $mail->addAddress('mail@yourmail.com', 'optional name');     // Add a recipient mail
    // $mail->addAddress('ellen@example.com');                     // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Atttchments
    // $mail->addAttachment('/var/tmp/file.tar.gz');              // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');         // Optional name

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = '
                    <p>Title: '.$title.'</p>
                    <p>First Name: '.$fname.'</p>
                    <p>Surname: '.$sname.'</p>
                    <p>Email: '.$email_f.'</p>
                    <p>Interest: '.$interest.'</p>
                    <b>Message has been sent from Contact Page!</b>';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        //echo 'Message has been sent';
        header("Location: /index_nr.html?code=1");
    }
}   else {
        died('Looks like you forgot to fill <strong>Email</strong> field.');        
    }
