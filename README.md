# reCaptcha_PHPMailer
A very simple approach to add google reCaptcha in contact form which has been built with PHPMailer. Free for personal/commercial use. Updated with latest PHPMailer.

- To send mail with reCaptcha use file /custom-mail/mail_with_captcha.php & index.html
- To send mail without reCaptcha use file /custom-mail/mail_no_captcha.php & index_nr.html
<h2>Configure reCaptcha</h2>
- add site key in index.html, Line 111.<br>
- add secret key in /custom-mail/mail_with_captcha.php, Line 77<br>

<h2>SMTP setting</h2>
- Remove comment at Line 4 & Line 10 from mail_with_captcha.php & mail_no_captcha.php.<br>
- use mail->isSMTP(); at Line 48 {must comment out/remove $mail->isSendmail(); if you are using SMTP for sending email}.<br>
- Configure your SMTP server {Line 50}.<br>

<h2>Others Config</h2>
- Change on Line 41 for email subject.<br>
- Change on Line 61, 62 for From email address and Recipient email address.<br>
- change other things according to your needs.<br>

<h3> Thanks a lot Synchro for his work https://github.com/PHPMailer/PHPMailer</h3>
