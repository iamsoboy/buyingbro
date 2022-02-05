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

if (!file_exists('../config.php')) die('install/[db_update.php] config.php not exist');
require_once '../config.php';

// Finally verify the license
require_once '../class/class.jaklic.php';
$jaklic = new JAKLicenseAPI();

if (is_numeric($_POST['step']) && $_POST['step'] == 4) {

  $verify_response = $jaklic->verify_license(false);

  if ($verify_response['status'] != true) {
    die(json_encode(array("status" => 3)));
  }

$result = $jakdb->get("departments", "title", ["id" => 1]);
  	
if ($result) {

// Check the current version
$version = $jakdb->get("settings", "used_value", ["varname" => "version"]);

// Ok, we are already up to date
if ($version == "3.5.5") die(json_encode(array("status" => 2)));

// Proceed with the update
if ($version <= "3.1") {

  // Version 3.1
  $jakdb->query("DELETE FROM ".JAKDB_PREFIX."settings WHERE `varname` = 'langdirection'");
  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."chatwidget ADD `btn_animation` VARCHAR(20) NULL AFTER `floatcsschat`");
  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."chatwidget ADD `chat_animation` VARCHAR(20) NULL AFTER `btn_animation`");

  $jakdb->query("INSERT INTO ".JAKDB_PREFIX."settings (`id`, `varname`, `used_value`, `default_value`) VALUES (NULL, 'calendar_tickets', '0', '0'),
  (NULL, 'calendar_chats', '0', '0'),
  (NULL, 'calendar_offline', '0', '0'),
  (NULL, 'calendar_purchases', '0', '0')");

  $jakdb->query("CREATE TABLE ".JAKDB_PREFIX."events (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `userid` int(10) unsigned NOT NULL DEFAULT '0',
    `clientid` int(10) unsigned NOT NULL DEFAULT '0',
    `color` varchar(7) DEFAULT NULL,
    `start` datetime NOT NULL,
    `end` datetime DEFAULT NULL,
    `title` varchar(255) DEFAULT NULL,
    `content` mediumtext,
    `url` varchar(255) DEFAULT NULL,
    `status` tinyint(3) NOT NULL DEFAULT '0',
    `lastedit` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
    `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
    PRIMARY KEY (`id`),
    KEY `userid` (`userid`,`clientid`,`start`,`end`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8");

  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."bot_question ADD `widgetids` varchar(100) NOT NULL DEFAULT '0' AFTER `id`");
  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."bot_question ADD INDEX `depid_lang_widgetids` (`depid`, `lang`, `widgetids`), DROP INDEX `depid`");

  $jakdb->query("INSERT INTO ".JAKDB_PREFIX."answers (`department`, `lang`, `title`, `message`, `fireup`, `msgtype`, `created`)
  VALUES ('0', 'en', 'Support Rating', '<h3>How would you rate the support you received?</h3><p>Hello {cname},<br>We\'d love to hear what you think of our customer service. Please take a moment to rate the support you have received by clicking the link below.<br>How would you rate the support you received?</p><p>Please rate our support here: {ticketurl}</p>', '15', '25', NOW())");

  $jakdb->query("CREATE TABLE ".JAKDB_PREFIX."ticket_rating (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `ticketid` int(10) unsigned NOT NULL DEFAULT '0',
    `clientid` int(10) unsigned NOT NULL DEFAULT '0',
    `vote` int(10) unsigned NOT NULL DEFAULT '0',
    `name` varchar(100) DEFAULT NULL,
    `email` varchar(255) DEFAULT NULL,
    `comment` text,
    `support_time` int(10) unsigned NOT NULL DEFAULT '0',
    `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
    PRIMARY KEY (`id`),
    KEY `ticketid` (`ticketid`,`clientid`,`vote`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

}

if ($version < "3.2") {

  $jakdb->query("INSERT INTO ".JAKDB_PREFIX."settings (`varname`, `used_value`, `default_value`)
  VALUES ('dsgvo', 'I accept the <a href=\"https://www.jakweb.ch/privacy\" target=\"_blank\">privacy agreement</a>.', 'I accept the privacy agreement.')");

}

// Update to 3.2.2
if ($version < "3.2.2") {
  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."transcript ADD `sentstatus` tinyint(3) unsigned NOT NULL DEFAULT '0' AFTER `time`");
  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."user ADD `alwaysnot` tinyint(1) NOT NULL DEFAULT '0' AFTER `ringing`");
}

// Update for 3.3
if ($version < "3.3") {
  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."chatwidget
  ADD `dsgvo` text COLLATE 'utf8_general_ci' NULL AFTER `chat_animation`,
  ADD `redirect_url` varchar(200) COLLATE 'utf8_general_ci' NULL AFTER `dsgvo`,
  ADD `redirect_active` tinyint(3) unsigned NULL DEFAULT '0' AFTER `redirect_url`,
  ADD `redirect_after` tinyint(3) unsigned NULL DEFAULT '8' AFTER `redirect_active`,
  ADD `feedback` tinyint(3) unsigned NULL DEFAULT '1' AFTER `redirect_after`");

  $jakdb->query("DELETE FROM ".JAKDB_PREFIX."settings
  WHERE ((`varname` = 'contact_redirect') OR (`varname` = 'wait_message3') OR (`varname` = 'dsgvo') OR (`varname` = 'url_redirect') OR (`varname` = 'feedback'))");

  $jakdb->query("INSERT INTO ".JAKDB_PREFIX."settings (`varname`, `used_value`, `default_value`)
  VALUES ('proactive_time', '3', '3')");

  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."chatwidget
  CHANGE `depid` `depid` varchar(50) COLLATE 'utf8_general_ci' NOT NULL DEFAULT '0' AFTER `title`");

  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."user
  ADD `whatsappnumber` varchar(255) COLLATE 'utf8_general_ci' NULL AFTER `phonenumber`");

  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."chatwidget
  ADD `whatsapp_message` text COLLATE 'utf8_general_ci' NULL AFTER `title`,
  ADD `whatsapp_online` tinyint(3) unsigned NOT NULL DEFAULT '0' AFTER `chat_direct`,
  ADD `whatsapp_offline` tinyint(3) unsigned NOT NULL DEFAULT '0' AFTER `whatsapp_online`");

  $jakdb->query("INSERT INTO ".JAKDB_PREFIX."answers (`id`, `department`, `lang`, `title`, `message`, `fireup`, `msgtype`, `created`) VALUES
  (NULL, 0, 'en', 'WhatsApp Online', 'Please click on a operator below to connect via WhatsApp and get help immediately.', 15, 26, NOW()),
  (NULL, 0, 'en', 'WhatsApp Offline', 'We are currently offline however please check below for available operators in WhatsApp, we try to help you as soon as possible.', 15, 27, NOW())");
}

// Update 3.4
if ($version < "3.4") {
  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."ticket_answers
    ADD `private` tinyint(3) unsigned NOT NULL DEFAULT '0' AFTER `content`");

  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."chatwidget ADD `engagecss` VARCHAR(100) NULL AFTER `floatcsschat`");
  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."chatwidget ADD `engage_animation` VARCHAR(20) NULL AFTER `chat_animation`");

  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."cms_pages
  ADD `custom` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `prepage`,
  ADD `custom2` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `custom`,
  ADD `custom3` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `custom2`,
  ADD `custom4` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `custom3`,
  ADD `custom5` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `custom4`");

  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."user
  ADD `aboutme` text COLLATE 'utf8_general_ci' NULL AFTER `picture`");

  $jakdb->exec("INSERT INTO ".JAKDB_PREFIX."translations (`id`, `lang`, `chat_dep`, `support_dep`, `faq_cat`, `priorityid`, `customfieldid`, `toptionid`, `cmsid`, `title`, `description`, `faq_url`, `time`) VALUES
  (NULL, '".JAK_LANG."', 0, 0, 0, 0, 0, 0, 17, '<h4>Mobile Apps</h4>', '<ul class=\"social-buttons\"><li><a href=\"https://play.google.com/store/apps/details?id=ch.jakweb.livechat\" class=\"btn btn-just-icon btn-link btn-android\"><i class=\"material-icons\">phone_android</i></a></li><li><a href=\"https://itunes.apple.com/us/app/live-chat-3-lcps/id1229573974\" class=\"btn btn-just-icon btn-link btn-apple\"><i class=\"material-icons\">phone_iphone</i></a></li></ul><h5>Numbers Don&apos;t Lie</h5><h4>14.521<small> Freelancers</small></h4><h4>1.423.183<small> Transactions</small></h4>', NULL, NOW()),
  (NULL, '".JAK_LANG."', 0, 0, 0, 0, 0, 0, 18, '', '', NULL, NOW()),
  (NULL, '".JAK_LANG."', 0, 0, 0, 0, 0, 0, 19, '', '', NULL, NOW()),
  (NULL, '".JAK_LANG."', 0, 0, 0, 0, 0, 0, 20, '', '', NULL, NOW()),
  (NULL, '".JAK_LANG."', 0, 0, 0, 0, 0, 0, 21, '', '', NULL, NOW())");

  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."blog
  ADD `opid` int(10) unsigned NULL DEFAULT '1' AFTER `lang`");

  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."sessions
  ADD `lang` char(2) COLLATE 'utf8_general_ci' NULL DEFAULT 'en' AFTER `longitude`");
}

// Update 3.4
if ($version < "3.4.2") {

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."settings (`varname`, `used_value`, `default_value`)
  VALUES ('chat_upload_standard', '0', '0'), ('twoco', '', ''), ('twoco_secret', '', '')");

}

// Update to 3.5
if ($version < "3.5") {
$custfield_update = $jakdb->select("customfields", ["id", "fieldlocation", "val_slug"]);

foreach ($custfield_update as $cfu) {

  // Since MySQL 5.7 we have to rename the slug
  $newslug = str_replace("-", "_", $cfu['val_slug']);

  // Now we create the field in the appropriate table
  if ($cfu['fieldlocation'] == 1) {
    $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."clients CHANGE `".$cfu['val_slug']."` `".$newslug."` TEXT NULL;");
  } elseif ($cfu['fieldlocation'] == 2) {
    $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."support_tickets CHANGE `".$cfu['val_slug']."` `".$newslug."` TEXT NULL;");
  } 

  // Update the val_slud
  $jakdb->update("customfields", ["val_slug" => $newslug], ["id" => $cfu["id"]]);

}

$jakdb->query("ALTER TABLE ".JAKDB_PREFIX."user
  ADD `navsidebar` tinyint(1) unsigned NOT NULL AFTER `emailnot`, ADD `themecolour` varchar(10) COLLATE 'utf8_general_ci' NOT NULL DEFAULT 'blue' AFTER `navsidebar`");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."settings (`varname`, `used_value`, `default_value`)
  VALUES ('blog_page', '5', '5'), ('blog_pagination', '10', '10'), ('faq_page', '10', '10'), ('faq_pagination', '10', '10'), ('chatwidget_id', '0', '0'), ('ticket_rating', '1', '1'), ('ticket_duedate_format', 'F d, Y:#:LL', 'F d, Y:#:LL'), ('ticket_duedate_preset', '1', '1'), ('ticket_duedate', '0', '0'), ('engage_icon', 'fa-bells', 'fa-bells')");

$jakdb->query("ALTER TABLE ".JAKDB_PREFIX."support_tickets
    ADD `mergeid` int(10) unsigned NOT NULL AFTER `status`,
    ADD `mergeopid` int(10) unsigned NOT NULL AFTER `mergeid`,
    ADD `mergetime` int(10) unsigned NOT NULL AFTER `mergeopid`,
    ADD `duedate` date NOT NULL DEFAULT '1980-05-06' AFTER `updated`");

$jakdb->query("DELETE FROM ".JAKDB_PREFIX."settings
  WHERE ((`varname` = 'ticket_format'))");

$jakdb->query("ALTER TABLE ".JAKDB_PREFIX."ticket_answers ADD INDEX `ticketid` (`ticketid`)");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."support_tickets_cc (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticketid` int(10) NOT NULL DEFAULT '0',
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ticketid` (`ticketid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."support_tickets_response (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticketid` int(10) NOT NULL DEFAULT '0',
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0',
  `responsetime` int(10) unsigned NOT NULL DEFAULT '0',
  `newticket` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ticketid` (`ticketid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

// We remove the old loginlog table
$jakdb->query("DROP TABLE ".JAKDB_PREFIX."loginlog");

// We add the new whatslog table
$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."whatslog (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `guestid` varchar(200) NULL DEFAULT NULL,
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0',
  `clientid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `whatsid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `itemid` int(10) unsigned NOT NULL DEFAULT '0',
  `fromwhere` varchar(255) DEFAULT NULL,
  `ip` char(45) NOT NULL DEFAULT '0',
  `country` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `countrycode` varchar(2) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `usragent` varchar(255) DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

}

// Version 3.5.2
if ($version < "3.5.2") {
  $jakdb->query("INSERT INTO ".JAKDB_PREFIX."settings (`varname`, `used_value`, `default_value`)
  VALUES ('dsgvo_contact', '', '')");
}

// Version 3.5.4
if ($version < "3.5.4") {
  $jakdb->query("ALTER TABLE ".JAKDB_PREFIX."chatwidget
  ADD `floatcss_safari` varchar(100) COLLATE 'utf8_general_ci' NULL AFTER `floatcss`");
}

// Version 3.5.5
$jakdb->query("ALTER TABLE ".JAKDB_PREFIX."support_departments
ADD `pre_content` mediumtext COLLATE 'utf8_general_ci' NULL AFTER `description`");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."settings (`varname`, `used_value`, `default_value`)
VALUES ('ticket_similar', '1', '1')");

// confirm
$email_body = 'URL: '.BASE_URL.'<br />Email: '.JAK_EMAIL.'<br />License: '.JAK_O_NUMBER;

// Send the email to the customer
$mail = new PHPMailer(); // defaults to using php "mail()"
$body = str_ireplace("[\]", "", $email_body);
$mail->SetFrom(JAK_EMAIL);
$mail->AddReplyTo(JAK_EMAIL);
$mail->AddAddress('lic@jakweb.ch');
$mail->Subject = 'Update - HelpDesk 3 / 3.5.5';
$mail->AltBody = 'HTML Format';
$mail->MsgHTML($body);
$mail->Send();

// update time so css and javascript will be loaded fresh
$jakdb->update("settings", ["used_value" => time()], ["varname" => "updated"]);
// update version
$jakdb->update("settings", ["used_value" => "3.5.5"], ["varname" => "version"]);

// Now let us delete all cache files
$cacheallfiles = '../'.JAK_CACHE_DIRECTORY.'/';
$msfi = glob($cacheallfiles."*.php");
if ($msfi) foreach ($msfi as $filen) {
    if (file_exists($filen)) unlink($filen);
}
	
die(json_encode(array("status" => 1)));

}

} else {
	die(json_encode(array("status" => 0)));
}
?>