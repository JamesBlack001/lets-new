<?php

	date_default_timezone_set('Etc/UTC');

	require("PHPMailerAutoload.php"); 
	echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n";
	
		//Create a new PHPMailer instance
	$mail = new PHPMailer;
	//var_dump($mail->options);
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();

	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 3;
	//Ask for HTML-friendly debug output
	
	$mail->Debugoutput = 'html';

	$mail->Mailer = 'smtp';

	//Set the hostname of the mail server
	$mail->Host = 'tls://smtp.gmail.com:587';
	//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = "letsatrhul@gmail.com";
	//Password to use for SMTP authentication
	$mail->Password = "RHULlets00";
	//Set the encryption system to use - ssl (deprecated) or tls
	$mail->SMTPSecure = 'tls';
	//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = 587;
	
	$mail->From = "letsatrhul@gmail.com";
	$mail->FromName = "James";
	//Set an alternative reply-to address
	$mail->addReplyTo('replyto@example.com', 'Reply To');
	//Set who the message is to be sent to
	$mail->addAddress('letsatrhul@gmail.com', 'John Doe');
	
	//Set the subject line
	$mail->Subject = 'PHPMailer GMail SMTP test';
	//set the body
	$mail->Body     = "Hi! This is my first e-mail sent through PHPMailer.";
	//Replace the plain text body with one created manually
	$mail->AltBody = 'This is a plain-text message body';
	

	//var_dump($mail->send());
	
	//$mail->Debugoutput = 'html';
	//Set who the message is to be sent from
	//$mail->setFrom('letsatrhul@gmail.com', 'First Last');
	//send the message, check for errors
	if (!$mail->send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	echo "Message sent!";
	}
?>