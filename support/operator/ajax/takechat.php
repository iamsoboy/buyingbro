<?php

/*===============================================*\
|| ############################################# ||
|| # JAKWEB.CH / Version 3.2.2                 # ||
|| # ----------------------------------------- # ||
|| # Copyright 2018 JAKWEB All Rights Reserved # ||
|| ############################################# ||
\*===============================================*/

if (!file_exists('../../config.php')) die('ajax/[available.php] config.php not exist');
require_once '../../config.php';

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !isset($_SESSION['jak_lcp_idhash'])) die("Nothing to see here");

if (is_numeric($_POST['id']) && is_numeric($_POST['userid'])) {

// Import the user or standard language file
if (isset($_SESSION['jak_lcp_lang']) && file_exists(APP_PATH.JAK_OPERATOR_LOC.'/lang/'.$_SESSION['jak_lcp_lang'].'.php')) {
    include_once(APP_PATH.JAK_OPERATOR_LOC.'/lang/'.$_SESSION['jak_lcp_lang'].'.php');
    $lang = $_SESSION['jak_lcp_lang'];
} else {
    include_once(APP_PATH.JAK_OPERATOR_LOC.'/lang/'.JAK_LANG.'.php');
    $lang = JAK_LANG;
}

// Get the operator
$operator = $jakdb->get("user", ["username", "name"], ["id" => $_POST["userid"]]);

// Set the operator and other stuff
$sessup = $jakdb->update("sessions", ["operatorid" => $_POST['userid'], "operatorname" => $operator['name']], ["AND" => ["operatorid" => [0, $_POST['userid']], "id" => $_POST["id"]]]);
if ($sessup) {

	// Update the checkstatus table
	$jakdb->update("checkstatus", ["newc" => 1, "operatorid" => $_POST['userid'], "operator" => $operator['name'], "pusho" => $_POST['pusho'], "statuso" => time()], ["convid" => $_POST["id"]]);

	// Check if it is a client and if we have a credit based system active
	if (JAK_BILLING_MODE == 1) {
		$client = $jakdb->get("sessions", ["clientid", "credits"], ["AND" => ["id" => $_POST["id"], "clientid[!]" => 0, "credits[!]" => 0]]);

		if ($client) {
			$jakdb->update("clients", ["credits[-]" => $client["credits"]], ["id" => $client["clientid"]]);
			$jakdb->insert("taken_credits", ["clientid" => $client["clientid"], "operatorid" => $_POST['userid'], "credits" => $client["credits"], "created" => $jakdb->raw("NOW()")]);
		}
	}

	if (!empty($HD_ANSWERS) && is_array($HD_ANSWERS)) foreach ($HD_ANSWERS as $v) {
		
		if ($v["msgtype"] == 2 && $v["lang"] == $lang) {
		
			$clientname = $jakdb->get("sessions", "name", ["id" => $_POST["id"]]);
		
			$phold = array("%operator%","%client%","%email%");
			$replace   = array($operator['name'], $clientname, JAK_EMAIL);
			$message = str_replace($phold, $replace, $v["message"]);

			$jakdb->insert("transcript", [ 
				"name" => $operator['name'],
				"message" => $message,
				"user" => $_POST['userid'].'::'.$operator['username'],
				"operatorid" => $_POST['userid'],
				"convid" => $_POST['id'],
				"class" => "admin",
				"time" => $jakdb->raw("NOW()")]);
			
		}
			
	}
	
	die(json_encode(array('cid' => $_POST['id'])));
} else {
	die(json_encode(array('cid' => 0)));
}

} else {
	die(json_encode(array('cid' => 0)));
}
?>