<?php

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 6 May 1980 03:10:00 GMT");

/*===============================================*\
|| ############################################# ||
|| # JAKWEB.CH / Version 3.5.5                 # ||
|| # ----------------------------------------- # ||
|| # Copyright 2020 JAKWEB All Rights Reserved # ||
|| ############################################# ||
\*===============================================*/

if (!file_exists('../config.php')) die('install/[db_user.php] config.php not exist');
require_once '../config.php';

// Finally verify the license
require_once '../class/class.jaklic.php';
$jaklic = new JAKLicenseAPI();

if (is_numeric($_POST['step']) && $_POST['step'] == 4) {

$result = $jakdb->get("departments", "title", ["id" => 1]);
  	
if ($result) {

$errors = "";

// Decode the password so we can actually use it
$pass = base64_decode($_POST['password']);

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors = 'Please insert a valid email address.<br>';
}

if (jak_field_not_exist(strtolower($_POST['email']), "user", "email")) {
  $errors .= 'This email address is already on deck, please try a different one.<br>';
}

if (!preg_match('/^([a-zA-Z0-9\-_])+$/', $_POST['uname'])) {
  $errors .= 'Please insert a valid username (A-Z,a-z,0-9,-_).<br>';
}
        
if (jak_field_not_exist(strtolower($_POST['uname']), "user", "username")) {
  $errors .= 'This username is already on board.<br>';
}

if ($pass == '') {
    $errors .= 'Please insert a password, it should have at least 8 characters.<br>';
  }

if ($jakhs['hostactive']) {
  if ($_POST['timestamp'] == '' || !is_numeric($_POST['timestamp'])) {
    $errors .= 'Please insert a valid timestamp the one you have received in the email.<br>';
  }
}

if (!empty($_POST['onumber']) && !empty($_POST['envname'])) {
  $license_code = strip_tags(trim($_POST["onumber"]));
  $env_name = strip_tags(trim($_POST["envname"]));

  // Now let's check the license
  $activate_response = $jaklic->activate_license($license_code, $env_name);
  if (empty($activate_response)) {
    $errors .= LB_TEXT_CONNECTION_FAILED.'<br>';
  }

  if ($activate_response['status'] != true) { 
    $errors .= $activate_response['message'].'<br>';
  }

} else {
  $errors .= 'Please insert your order/license number.<br>';
}

if (!$errors) {

// The new password encrypt with hash_hmac
if ($jakhs['hostactive']) {
  $passcrypt = $pass;
  $subject = "Hosted Install - HelpDesk 3 / 3.5.5";
} else {
  $passcrypt = hash_hmac('sha256', $pass, DB_PASS_HASH);
  $subject = "Install - HelpDesk 3 / 3.5.5";
}

  // Sanitize Email
$semail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
 
$jakdb->insert("user", [
  "username" => filter_var($_POST['uname'], FILTER_SANITIZE_STRING),
  "password" => $passcrypt,
  "email" => $semail,
  "name" => filter_var($_POST['name'], FILTER_SANITIZE_STRING),
  "operatorchat" => 1,
  "time" => $jakdb->raw("NOW()"),
  "access" => 1]);
  
$jakdb->update("settings", ["used_value" => $semail], ["varname" => "email"]);
$jakdb->update("settings", ["used_value" => filter_var($_POST['onumber'], FILTER_SANITIZE_STRING)], ["varname" => "o_number"]);
if ($jakhs['hostactive'] && isset($_POST['timestamp'])) {
  $jakdb->update("settings", ["used_value" => filter_var($_POST['timestamp'], FILTER_SANITIZE_NUMBER_INT)], ["varname" => "validtill"]);
}

@$jakdb->query('ALTER DATABASE '.DB_NAME.' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci');

// confirm
include_once '../class/PHPMailerAutoload.php';

$email_body = 'URL: '.FULL_SITE_DOMAIN.'<br>Email: '.$semail.'<br>License: '.filter_var($_POST['onumber'], FILTER_SANITIZE_STRING);

// Send the email to the customer
$mail = new PHPMailer(); // defaults to using php "mail()"
$body = str_ireplace("[\]", "", $email_body);
$mail->SetFrom($semail);
$mail->AddReplyTo($semail);
$mail->AddAddress('lic@jakweb.ch');
$mail->Subject = $subject;
$mail->AltBody = 'HTML Format';
$mail->MsgHTML($body);
$mail->Send();
	
	die(json_encode(array("status" => 1)));

} else {
  die(json_encode(array("status" => 0, "errors" => $errors)));
}

} else {
	die(json_encode(array("status" => 0)));
}

} else {
	die(json_encode(array("status" => 0)));
}
?>