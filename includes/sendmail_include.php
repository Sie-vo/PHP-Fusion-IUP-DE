<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: sendmail_include.php
| Author: Nick Jones (Digitanium)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) { die("Access Denied"); }
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendemailold($toname, $toemail, $fromname, $fromemail, $subject, $message, $type = "plain", $cc = "", $bcc = "") {

	global $settings, $locale;
	
	require_once INCLUDES."class.phpmailer.php";
	
	$mail = new PHPMailer();
	if (file_exists(INCLUDES."language/phpmailer.lang-".$locale['phpmailer'].".php")) {
		$mail->SetLanguage($locale['phpmailer'], INCLUDES."language/");
	} else {
		$mail->SetLanguage("en", INCLUDES."language/");
	}

	if (!$settings['smtp_host']) {
		$mail->IsMAIL();
	} else {
		$mail->IsSMTP();
		$mail->Host = $settings['smtp_host'];
		$mail->Port = $settings['smtp_port'];
		$mail->SMTPAuth = $settings['smtp_auth'] ? true : false;
		$mail->Username = $settings['smtp_username'];
		$mail->Password = $settings['smtp_password'];
		$mail->SMTPSecure = $settings['smtp_security'];
	}
	
	$mail->CharSet = $locale['charset'];
	$mail->From = $fromemail;
	$mail->FromName = $fromname;
	$mail->AddAddress($toemail, $toname);
	$mail->AddReplyTo($fromemail, $fromname);
	if ($cc) { 
		$cc = explode(", ", $cc);
		foreach ($cc as $ccaddress) {
			$mail->AddCC($ccaddress);
		}
	}
	if ($bcc) {
		$bcc = explode(", ", $bcc);
		foreach ($bcc as $bccaddress) {
			$mail->AddBCC($bccaddress);
		}
	}
	if ($type == "plain") {
		$mail->IsHTML(false);
	} else {
		$mail->IsHTML(true);
	}
	
	$mail->Subject = $subject;
	$mail->Body = $message;
	
	if(!$mail->Send()) {
		$mail->ErrorInfo;
		$mail->ClearAllRecipients();
		$mail->ClearReplyTos();
		return false;
	} else {
		$mail->ClearAllRecipients(); 
		$mail->ClearReplyTos();
		return true;
	}

}

function sendemail(string $toname,string $toemail,string $fromname,string $fromemail,string $subject,string $message, $type = "plain", $cc = "", $bcc = "") {
	// load Class
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
	//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
	if(!$settings['smtp_host']){
		$mail->IsMAIL();
	} else {
		$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable Debug output
		$mail->IsSMTP();
		$mail->Host = $settings['smtp_host'];
		$mail->Port = $settings['smtp_port'];
		$mail->SMTPAuth = $settings['smtp_auth'] ? true : false;
		$mail->Username = $settings['smtp_username'];
		$mail->Password = $settings['smtp_password'];
		$mail->SMTPAutoTLS = true; // wir probieren es mal so aus. Bei localhost auf false setzen
		//$mail->SMTPSecure = $settings['smtp_security']; funktioniert so nicht mehr, dann die beiden folgenden
		//$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		//$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`;
	}
	// set charset
	$mail->CharSet = $locale['charset'];

    //Recipients
	$mail->setFrom($fromemail, $fromname);
	$mail->AddAddress($toemail, $toname);
	$mail->AddReplyTo($fromemail, $fromname);
	if ($cc) { 
		$cc = explode(", ", $cc);
		foreach ($cc as $ccaddress) {
			$mail->AddCC($ccaddress);
		}
	}
	if ($bcc) {
		$bcc = explode(", ", $bcc);
		foreach ($bcc as $bccaddress) {
			$mail->AddBCC($bccaddress);
		}
	}
	if ($type == "plain") {
		$mail->IsHTML(false);
	} else {
		$mail->IsHTML(true);
	}
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->Subject = $subject;
	$mail->Body = $message;

    $mail->send();
    return true;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	return false;
}
}