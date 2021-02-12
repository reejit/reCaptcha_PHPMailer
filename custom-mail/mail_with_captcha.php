<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP; // For SMTP must enable
use PHPMailer\PHPMailer\Exception;

// Load Now
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php'; // For SMTP must enable



    function died($error) {
    // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "<br /><br />".$error;
        die();
    }

if(!empty($_POST['txtEmail'])) { //set a required field here for condition


// extending validation and checking if expected data exists or not
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

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $mail->isSendmail();                                            // for phpsendMail
    $mail->isSMTP();                                            // Send using SMTP


    //Server settings for SMTP

    $mail->Host       = 'smtp.gmail.com';             // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'reejitx@gmail.com';                 // SMTP username
    // $mail->Password   = 'reejitxx1234+';                               // SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    // $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above


    $mail->setFrom('reejitx@gmail.com', 'optional name');     // From mail
    $mail->addAddress('guardiansofspartax@gmail.com', 'optional name');     // Add a recipient mail
    // $mail->addAddress('ellen@example.com');                     // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Atttchments
    // $mail->addAttachment('/var/tmp/file.tar.gz');              // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');         // Optional name
    
                              

    // Validate reCAPTCHA box 
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
            // Google reCAPTCHA API secret key 
            $secretKey = 'YOUR_RECAPTCHA_SECRET_KEY_GOES_HERE'; 

            if(isset($_POST['g-recaptcha-response'])){
              $captcha=$_POST['g-recaptcha-response'];
            }
            if(!$captcha){
              echo '<h2>Please check the the captcha form.</h2>';
              exit;
            }

        // Function url_get_contents if native options are disabled by Hosting
            function url_get_contents ($url) {
                if (function_exists('curl_exec')){ 
                    $conn = curl_init($url);
                    curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, true);
                    curl_setopt($conn, CURLOPT_FRESH_CONNECT,  true);
                    curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
                    $url_get_contents_data = (curl_exec($conn));
                    curl_close($conn);
                } elseif(function_exists('file_get_contents')){
                    $url_get_contents_data = file_get_contents($url);
                } elseif(function_exists('fopen') && function_exists('stream_get_contents')){
                    $handle = fopen ($url, "r");
                    $url_get_contents_data = stream_get_contents($handle);
                } else{
                    $url_get_contents_data = false;
                }
            return $url_get_contents_data;
            } 
             
        // Verify the reCAPTCHA response 
            $verifyResponse = url_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha));
        
             
        // Decode json data 
            $resp = json_decode($verifyResponse, true); 


    
             
        // If reCAPTCHA response is valid 
            if ($resp["success"]) {

                // Set email format to HTML
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
                    echo 'Message could not be sent. Error:'. $mail->ErrorInfo.'<br>';
                    died('We are facing some difficulties. We will fix it soon. Thank you.');
                } else {

                header("Location: /index.html?code=1"); //mail sent successfully
                }

            } else{ 

                died('Unfortunately mail delivery failed. <strong>Try again after a few minutes later</strong>.');  //json data verification failed
            }
        } else{ 
                
            died('Looks like you forgot to <strong>Verify reCaptcha</strong>.');   //error - recaptcha not filled by user
    }

}  else {
        died('Looks like you forgot to fill <strong>Email</strong> field.');        
    }
