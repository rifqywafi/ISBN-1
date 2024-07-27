<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host  = 'smtp.gmail.com';
$mail->SMTPAuth  = true;
$mail->Username  = "rifqywafianerdza@gmail.com";
$mail->Password  = "mbbhpdocyqpvfazn";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            
$mail->Port       = 587;

$mail->isHTML(true);
$mail->setFrom("rifqywafianerdza@gmail.com");

require_once 'vendor/autoload.php';

$clientId = "1033374005328-r7cdg09kutgrk4mq08leda4qvi73bolp.apps.googleusercontent.com";
$clientSecret = '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';
$redirectUri = 'http://localhost/isbn-1/index.php';

$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('profile');
$client->addScope('email');
$authUrl = $client->createAuthUrl();