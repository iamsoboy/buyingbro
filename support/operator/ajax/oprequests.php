<?php

/*===============================================*\
|| ############################################# ||
|| # JAKWEB.CH / Version 3.5.5                 # ||
|| # ----------------------------------------- # ||
|| # Copyright 2020 JAKWEB All Rights Reserved # ||
|| ############################################# ||
\*===============================================*/

if (!file_exists('../../config.php')) die('ajax/[oprequests.php] config.php not exist');
require_once '../../config.php';

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !isset($_SESSION['jak_lcp_idhash'])) die("Nothing to see here");

if (!is_numeric($_POST['uid'])) die("There is no such user!");

switch ($_POST['oprq']) {
	case 'status':
		# code...
		if ($_POST['available'] == 1) {

			// operator makes himself available
			$jakdb->update("user", ["available" => 1], ["id" => $_POST['uid']]);
			$row = $jakdb->get("user",["operatorlist", "operatorchat"], ["AND" => ["id" => $_POST['uid'], "access" => 1]]);
			
			die(json_encode(array('status' => 1, 'olist' => $row["operatorlist"], 'ochat' => $row["operatorchat"])));
			
		} elseif ($_POST['available'] == 2) {

			// Operator goes busy
			$jakdb->update("user", ["available" => 2], ["id" => $_POST['uid']]);
			$row = $jakdb->get("user",["operatorlist", "operatorchat"], ["AND" => ["id" => $_POST['uid'], "access" => 1]]);
			
			die(json_encode(array('status' => 2, 'olist' => $row["operatorlist"], 'ochat' => $row["operatorchat"])));
			
		} else {

			// operator goes offline
			$jakdb->update("user", ["available" => 0], ["id" => $_POST['uid']]);
			
			die(json_encode(array('status' => 0)));
			
		}
	break;
	case 'sound':
		# code...
		if (isset($_POST['sa']) && is_numeric($_POST['sa'])) {
			// operator makes himself available
			$jakdb->update("user", ["sound" => $_POST['sa']], ["id" => $_POST['uid']]);
		
		}

		die(json_encode(array('status' => 1)));
	break;
	case 'push':
		# code...
		if (isset($_POST['pa']) && is_numeric($_POST['pa'])) {
			// operator makes himself available
			$jakdb->update("user", ["push_notifications" => $_POST['pa']], ["id" => $_POST['uid']]);

			// operator likes to turn on/off push notifications for the active chat
			if (isset($_POST['convid']) && !empty($_POST['convid'])) {
				$jakdb->update("checkstatus", ["pusho" => $_POST['pa']], ["convid" => $_POST['convid']]);
			}
		
		}

		die(json_encode(array('status' => 1)));
	break;
	case 'deny':
		# code...
		if (is_numeric($_POST['id'])) {
			// Now cancel the chat
			$jakdb->update("sessions", ["deniedoid" => $_POST['uid'], "status" => 0, "ended" => time()], ["id" => $_POST['id']]);
			$jakdb->update("checkstatus", ["denied" => 1, "hide" => 1], ["convid" => $_POST['id']]);
			die(json_encode(array('cid' => $_POST['id'])));
		}
		// Nothing worked cancel
		die(json_encode(array('cid' => 0)));
	break;
	case 'hidemsg':
	 	# code...
		if (!is_numeric($_POST['id'])) die("There is no such post!");

		// Import the user or standard language file
		if (isset($_SESSION['jak_lcp_lang']) && file_exists(APP_PATH.JAK_OPERATOR_LOC.'/lang/'.$_SESSION['jak_lcp_lang'].'.php')) {
		    include_once(APP_PATH.JAK_OPERATOR_LOC.'/lang/'.$_SESSION['jak_lcp_lang'].'.php');
		} else {
		    include_once(APP_PATH.JAK_OPERATOR_LOC.'/lang/'.JAK_LANG.'.php');
		}

		if ($_POST['plevel'] == 1) {
			$plevel = 2;
		} else {
			$plevel = 1;
		}

		// Update the plevel in the transcript table
		$update = $jakdb->update("transcript", ["plevel" => $plevel], ["AND" => ["id" => $_POST['id'], "convid" => $_POST['cid']]]);

		if ($update) {
			
			// Update the status page
			$jakdb->update("checkstatus", ["typeo" => 0, "msgdel" => $_POST['id']], ["convid" => $_POST['cid']]);

			die(json_encode(array('status' => 1, 'txt' => $jkl["g14"], 'plevel' => $plevel)));
				
		} else {

			die(json_encode(array('status' => 0, 'txt' => $jkl["i"])));
		}
	break;
	case 'starred':
	 	# code...
		if (!is_numeric($_POST['id'])) die("There is no such post!");

		// Import the user or standard language file
		if (isset($_SESSION['jak_lcp_lang']) && file_exists(APP_PATH.JAK_OPERATOR_LOC.'/lang/'.$_SESSION['jak_lcp_lang'].'.php')) {
		    include_once(APP_PATH.JAK_OPERATOR_LOC.'/lang/'.$_SESSION['jak_lcp_lang'].'.php');
		} else {
		    include_once(APP_PATH.JAK_OPERATOR_LOC.'/lang/'.JAK_LANG.'.php');
		}

		if ($_POST['starred'] == 1) {
			$starred = 0;
		} else {
			$starred = 1;
		}

		// Update the starred in the transcript table
		$update = $jakdb->update("transcript", ["starred" => $starred], ["AND" => ["id" => $_POST['id'], "convid" => $_POST['cid']]]);

		if ($update) {

			die(json_encode(array('status' => 1, 'txt' => $jkl["g14"], 'starred' => $starred)));
				
		} else {

			die(json_encode(array('status' => 0, 'txt' => $jkl["i"])));
		}
	break;
	case 'sendfile':
		# code...
		if (!is_numeric($_POST['id'])) die("There is no such post!");
		
		$row = $jakdb->get("files", ["name", "path"], ["id" => $_POST['id']]);

		if ($row) {

			$jakdb->insert("transcript", [ 
				"name" => $_POST['oname'],
				"message" => $row['path'],
				"user" => $_POST['uid'].'::'.$_POST['uname'],
				"operatorid" => $_POST['uid'],
				"convid" => $_POST['conv'],
				"class" => "download",
				"time" => $jakdb->raw("NOW()")]);

			// Update the status table
			$jakdb->update("checkstatus", ["newc" => 1, "typeo" => 0, "newo" => 0, "statuso" => time()], ["convid" => $_POST['conv']]);
			
			die(json_encode(array('status' => 1)));

		}

		die(json_encode(array('status' => 10)));
	break;
	case 'transfer':
		# code...
		if (!is_numeric($_POST['convid'])) die("There is no such conversation!");

		// Import the user or standard language file
		if (isset($_SESSION['jak_lcp_lang']) && file_exists(APP_PATH.JAK_OPERATOR_LOC.'/lang/'.$_SESSION['jak_lcp_lang'].'.php')) {
		    include_once(APP_PATH.JAK_OPERATOR_LOC.'/lang/'.$_SESSION['jak_lcp_lang'].'.php');
		} else {
		    include_once(APP_PATH.JAK_OPERATOR_LOC.'/lang/'.JAK_LANG.'.php');
		}

		// Standard message
		$noconv = '<a href="#" class="alert-link main-sidebar-toggle d-md-none"><i class="fa fa-bars"></i></a> '.$jkl['g79'];

		$trow = $jakdb->get("checkstatus", ["convid", "transferid"], ["convid" => $_POST['convid']]);

		if ($trow) {
			
			if ($_POST['accept'] == 1) {

				// Get the operator details
				$operator = $jakdb->get("user", ["username", "name"], ["id" => $_POST["uid"]]);

				$jakdb->insert("transcript", [ 
					"name" => $operator['name'],
					"message" => $operator['name'].' '.$jkl["g121"],
					"user" => $_POST['uid'].'::'.$operator['username'],
					"operatorid" => $_POST['uid'],
					"convid" => $trow["convid"],
					"class" => "admin",
					"time" => $jakdb->raw("NOW()")]);

				$jakdb->update("sessions", ["operatorid" => $_POST['uid'], "operatorname" => $operator['name']], ["id" => $trow['convid']]);

				$jakdb->update("checkstatus", ["operatorid" => $_POST['uid'], "operator" => $operator['name'], "newc" => 1, "transferid" => 0, "transferoid" => 0], ["convid" => $trow['convid']]);
				$jakdb->update("transfer", ["used" => 1], ["id" => $trow["transferid"]]);
				
				die(json_encode(array('status' => 1, 'href' => str_replace("ajax/", "", JAK_rewrite::jakParseurl('live', $trow['convid'])))));
			
			} else {

				$jakdb->update("checkstatus", ["transferid" => 0, "transferoid" => 0], ["convid" => $trow['convid']]);
				$jakdb->update("transfer", ["used" => 2], ["id" => $trow["transferid"]]);
				die(json_encode(array('status' => 0, "noconv" => $noconv)));
			
			}

		}

		die(json_encode(array('status' => 0, "noconv" => $noconv)));

	break;
	case 'delstat':
		# code...
		if (is_numeric($_POST['sid'])) {

			// Now delete the record from the database
			$jakdb->delete("user_stats", ["id" => $_POST['sid']]);
			die(json_encode(array('status' => 1)));
		} else {
			die(json_encode(array('status' => 0)));
		}
	break;
	case 'supportresponse':
		# code...
		if (is_numeric($_POST['respid'])) {
			
			if (isset($HD_RESPONSEST) && is_array($HD_RESPONSEST)) {

			// get the responses from the file specific for this client
			  foreach($HD_RESPONSEST as $r) {

			    if ($r["id"] == $_POST["respid"]) {

			      $phold = array("%operator%","%client%","%email%");
			      $replace   = array($jakuser->getVar("name"), $_POST["cname"], JAK_EMAIL);
			      $message = str_replace($phold, $replace, $r["message"]);
			      die(json_encode(array('status' => 1, 'response' => $message)));

			    }
			  }
			}

			die(json_encode(array('status' => 0)));

		} else {
			die(json_encode(array('status' => 0)));
		}
	break;
	default:
		# code...
		break;
}
	
?>