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

if (!file_exists('../config.php')) die('install/[db_install.php] config.php not exist');
require_once '../config.php';

if (is_numeric($_POST['step']) && $_POST['step'] == 3) {

$result = $jakdb->get("departments", "title", ["id" => 1]);
  	
if (!$result) {

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."answers (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `department` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(2) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text,
  `fireup` smallint(5) unsigned NOT NULL DEFAULT '60',
  `msgtype` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=standard,2=welcome,3=closed,4=expired,5=firstmsg',
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `depid` (`department`,`lang`,`fireup`,`msgtype`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."answers (`id`, `department`, `lang`, `title`, `message`, `fireup`, `msgtype`, `created`) VALUES
(1, 0, 'en', 'Enters Chat', '%operator% enters the chat.', 15, 2, NOW()),
(2, 0, 'en', 'Expired', 'This session has expired!', 15, 4, NOW()),
(3, 0, 'en', 'Ended', '%client% has ended the conversation', 15, 3, NOW()),
(4, 0, 'en', 'Welcome', 'Welcome %client%, a representative will be with you shortly.', 15, 5, NOW()),
(5, 0, 'en', 'Leave', 'has left the conversation.', 15, 6, NOW()),
(6, 0, 'en', 'Start Page', 'Please insert your name to begin, a representative will be with you shortly.', 15, 7, NOW()),
(7, 0, 'en', 'Contact Page', 'None of our representatives are available right now, although you are welcome to leave a message!', 15, 8, NOW()),
(8, 0, 'en', 'Feedback Page', 'We would appreciate your feedback to improve our service.', 15, 9, NOW()),
(9, 0, 'en', 'Quickstart Page', 'Please type a message and hit enter to start the conversation.', 15, 10, NOW()),
(10, 0, 'en', 'Group Chat Welcome Message', 'Welcome to our weekly support session, sharing experience and feedback.', 0, 11, NOW()),
(11, 0, 'en', 'Group Chat Offline Message', 'The public chat is offline at this moment, please try again later.', 15, 12, NOW()),
(12, 0, 'en', 'Group Chat Full Message', 'The public chat is full, please try again later.', 15, 13, NOW()),
(NULL, 0, 'en', 'WhatsApp Online', 'Please click on a operator below to connect via WhatsApp and get help immediately.', 15, 26, NOW()),
(NULL, 0, 'en', 'WhatsApp Offline', 'We are currently offline however please check below for available operators in WhatsApp, we try to help you as soon as possible.', 15, 27, NOW())");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."autoproactive (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `path` varchar(200) NULL DEFAULT NULL,
  `title` varchar(255) NULL DEFAULT NULL,
  `imgpath` varchar(255) NULL DEFAULT NULL,
  `message` varchar(255) NULL DEFAULT NULL,
  `btn_confirm` VARCHAR(50) NULL DEFAULT NULL,
  `btn_cancel` VARCHAR(50) NULL DEFAULT NULL,
  `showalert` smallint(1) unsigned NOT NULL DEFAULT '1',
  `soundalert` VARCHAR(100) NULL DEFAULT NULL,
  `timeonsite` smallint(3) unsigned NOT NULL DEFAULT '2',
  `visitedsites` smallint(2) unsigned NOT NULL DEFAULT '1',
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `path` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."urlblacklist (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `path` varchar(200) NULL DEFAULT NULL,
  `title` varchar(255) NULL DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `path` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."buttonstats (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `depid` int(10) unsigned NOT NULL DEFAULT '0',
  `opid` int(10) unsigned NOT NULL DEFAULT '0',
  `clientid` int(10) unsigned NOT NULL DEFAULT '0',
  `referrer` varchar(255) DEFAULT NULL,
  `firstreferrer` varchar(255) DEFAULT NULL,
  `agent` varchar(255) DEFAULT NULL,
  `hits` int(10) NOT NULL DEFAULT '0',
  `ip` char(45) NOT NULL DEFAULT '0',
  `country` varchar(64) DEFAULT NULL,
  `countrycode` CHAR(2) NOT NULL DEFAULT 'xx',
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `proactive` int(10) NOT NULL DEFAULT '0',
  `message` varchar(255) DEFAULT NULL,
  `readtime` smallint(1) NOT NULL DEFAULT '0',
  `session` varchar(64) DEFAULT NULL,
  `lasttime` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `depid` (`depid`),
  KEY `session` (`session`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."bot_question (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `widgetids` varchar(100) DEFAULT '0',
  `depid` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(2) DEFAULT NULL,
  `question` text,
  `answer` text,
  `updated` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `widgetids` (`widgetids`, `depid`, `lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."chatwidget (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `whatsapp_message` text,
  `depid` varchar(50) NOT NULL DEFAULT '0',
  `opid` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` char(2) DEFAULT NULL,
  `widget` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `hideoff` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `buttonimg` varchar(100) NOT NULL,
  `mobilebuttonimg` varchar(100) NOT NULL,
  `slideimg` varchar(100) NOT NULL,
  `floatpopup` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `chat_direct` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `whatsapp_online` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `whatsapp_offline` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `client_email` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `client_semail` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `client_phone` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `client_sphone` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `client_question` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `client_squestion` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `show_avatar` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `floatcss` varchar(100) DEFAULT NULL,
  `floatcss_safari` varchar(100) DEFAULT NULL,
  `floatcsschat` varchar(100) DEFAULT NULL,
  `engagecss` varchar(100) DEFAULT NULL,
  `btn_animation` varchar(20) DEFAULT NULL,
  `chat_animation` varchar(20) DEFAULT NULL,
  `engage_animation` varchar(20) DEFAULT NULL,
  `dsgvo` text,
  `redirect_url` varchar(200) DEFAULT NULL,
  `redirect_active` tinyint(3) unsigned DEFAULT '0',
  `redirect_after` tinyint(3) unsigned DEFAULT '8',
  `feedback` tinyint(3) unsigned NULL DEFAULT '1',
  `sucolor` char(7) NOT NULL DEFAULT '#6f6f6f',
  `sutcolor` char(7) NOT NULL DEFAULT '#ffffff',
  `template` varchar(20) DEFAULT NULL,
  `theme_colour` varchar(10) DEFAULT 'primary',
  `body_colour` char(7) DEFAULT '#ffffff',
  `h_colour` char(7) DEFAULT '#494949',
  `c_colour` char(7) DEFAULT '#494949',
  `time_colour` char(7) DEFAULT '#999999',
  `link_colour` char(7) DEFAULT '#2f942b',
  `sidebar_colour` char(7) DEFAULT '#857d7d',
  `t_font` varchar(100) NOT NULL,
  `h_font` varchar(100) NOT NULL DEFAULT 'NonGoogle',
  `c_font` varchar(100) NOT NULL DEFAULT 'Arial, Helvetica, sans-serif',
  `widget_whitelist` text,
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `depid` (`depid`, `opid`, `lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."chatwidget (`id`, `title`, `depid`, `opid`, `lang`, `widget`, `hideoff`, `buttonimg`, `slideimg`, `floatpopup`, `chat_direct`, `client_email`, `client_semail`, `client_phone`, `client_sphone`, `client_question`, `client_squestion`, `show_avatar`, `floatcss`, `floatcsschat`, `engagecss`, `sucolor`, `sutcolor`, `template`, `theme_colour`, `body_colour`, `h_colour`, `c_colour`, `time_colour`, `link_colour`, `sidebar_colour`, `t_font`, `h_font`, `c_font`, `widget_whitelist`, `created`) VALUES
(1, 'Live Support Chat',  0,  0,  'en', 1,  0,  'jaklc_on.png', 'chatnow_on.png', 1, 1, 1, 1, 0, 1, 1, 1, 1, 'bottom:0;right:40px;', 'bottom:0;right:40px;', 'left:50%;top:50%;transform: translate(-50%, -50%);', '', '', 'modern', 'standard', '#ffffff', '#494949', '#494949', '#999999', '#007ff5', '#857d7d', '', 'Open+Sans', 'Open+Sans', '', NOW())");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."clientcontact (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sessionid` int(10) unsigned NOT NULL DEFAULT '0',
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0',
  `operatorname` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `sent` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."contacts (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `depid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text,
  `ip` char(45) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `countrycode` varchar(2) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `reply` smallint(1) unsigned NOT NULL DEFAULT '0',
  `answered` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `sent` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `depid` (`depid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."contactsreply (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `contactid` int(10) unsigned NOT NULL DEFAULT '0',
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0',
  `operatorname` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `sent` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `contactid` (`contactid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."departments (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` mediumtext,
  `email` varchar(255) DEFAULT NULL,
  `faq_url` text,
  `credits` int(10) unsigned NOT NULL DEFAULT '0',
  `guesta` smallint(1) unsigned NOT NULL DEFAULT '1',
  `active` smallint(1) unsigned NOT NULL DEFAULT '1',
  `dorder` smallint(2) unsigned NOT NULL DEFAULT '1',
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `guesta` (`guesta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."departments (`id`, `title`, `description`, `guesta`, `active`, `dorder`, `time`) VALUES
(1, 'Chat', 'Edit this department to your needs...', 1, 1, 1, NOW())");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."files (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `path` text,
  `name` varchar(200) NULL DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."groupchat (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `password` varchar(20) NULL DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text NULL DEFAULT NULL,
  `opids` varchar(10) DEFAULT '0',
  `maxclients` tinyint(3) unsigned NOT NULL DEFAULT '20',
  `lang` char(2) DEFAULT NULL,
  `buttonimg` varchar(100) NOT NULL,
  `floatpopup` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `floatcss` varchar(100) DEFAULT NULL,
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `opids` (`opids`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."groupchat (`id`, `title`, `opids`, `maxclients`, `lang`, `buttonimg`, `floatpopup`, `floatcss`, `active`, `created`) VALUES
(1, 'Weekly Support', '0', 10, 'en', 'colour_on.png', 0, 'bottom:20px;left:20px', 0, NOW())");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."groupchatmsg (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `groupchatid` int(10) NOT NULL DEFAULT '0',
  `chathistory` mediumtext,
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `groupchatid` (`groupchatid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."groupchatuser (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `groupchatid` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) NULL DEFAULT NULL,
  `usr_avatar` varchar(255) NULL DEFAULT NULL,
  `statusc` int(10) unsigned NOT NULL DEFAULT '0',
  `lastmsg` int(10) unsigned NOT NULL DEFAULT '0',
  `banned` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ip` char(45) NOT NULL DEFAULT '0',
  `isop` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `session` varchar(64) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `groupchatid` (`groupchatid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

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

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."operatorchat (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fromid` int(10) NOT NULL DEFAULT '0',
  `toid` int(10) NOT NULL DEFAULT '0',
  `message` text NULL DEFAULT NULL,
  `sent` int(10) NOT NULL DEFAULT '0',
  `received` smallint(1) unsigned NOT NULL DEFAULT '0',
  `msgpublic` smallint(1) unsigned NOT NULL DEFAULT '0',
  `system_message` varchar(3) DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."responses (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `department` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(200) NULL DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."responses (`id`, `title`, `message`) VALUES
(1, 'Assist Today', 'How can I assist you today?')");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."sessions (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` varchar(200) NULL DEFAULT NULL,
  `department` int(10) unsigned NOT NULL DEFAULT '0',
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0',
  `clientid` int(10) unsigned NOT NULL DEFAULT '0',
  `operatorname` varchar(255) NULL DEFAULT NULL,
  `template` varchar(20) NULL DEFAULT NULL,
  `usr_avatar` varchar(255) NULL DEFAULT NULL,
  `name` varchar(100) NULL DEFAULT NULL,
  `email` varchar(100) NULL DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `countrycode` varchar(2) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `lang` char(2) DEFAULT 'en',
  `notes` text,
  `credits` smallint unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `fcontact` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `initiated` int(10) unsigned NOT NULL DEFAULT '0',
  `ended` int(10) unsigned NOT NULL DEFAULT '0',
  `deniedoid` int(10) unsigned NOT NULL DEFAULT '0',
  `session` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `operatorid` (`operatorid`),
  KEY `session` (`session`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."settings (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(100) DEFAULT NULL,
  `used_value` text,
  `default_value` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."settings (`id`, `varname`, `used_value`, `default_value`) VALUES
(NULL, 'allowedo_files', '.zip,.rar,.jpg,.jpeg,.png,.gif', '.zip,.rar,.jpg,.jpeg,.png,.gif'),
(NULL, 'allowed_files', '.zip,.rar,.jpg,.jpeg,.png,.gif', '.zip,.rar,.jpg,.jpeg,.png,.gif'),
(NULL, 'validtill', 0, 0),
(NULL, 'captcha', '0', '1'),
(NULL, 'client_expired', '600', '600'),
(NULL, 'client_left', '300', '300'),
(NULL, 'crating', '1', '0'),
(NULL, 'dateformat', 'd.m.Y', 'd.m.Y'),
(NULL, 'email', '', '@hd3jak'),
(NULL, 'emailcc', '', '@jakcc'),
(NULL, 'email_block', '', NULL),
(NULL, 'facebook', '', ''),
(NULL, 'facebook_big', '', ''),
(NULL, 'ip_block', '', NULL),
(NULL, 'lang', 'en', 'en'),
(NULL, 'msg_tone', 'new_message', 'new_message'),
(NULL, 'openop', '1', '1'),
(NULL, 'register', '1', '1'),
(NULL, 'o_number', 'O-test', '0'),
(NULL, 'pro_alert', '1', '1'),
(NULL, 'ring_tone', 'ring', 'ring'),
(NULL, 'send_tscript', '1', '1'),
(NULL, 'show_ips', '1', '1'),
(NULL, 'smtphost', '', ''),
(NULL, 'smtppassword', '', ''),
(NULL, 'smtpport', '25', '25'),
(NULL, 'smtpusername', '', ''),
(NULL, 'smtp_alive', '0', '0'),
(NULL, 'smtp_auth', '0', '0'),
(NULL, 'smtp_mail', '0', '0'),
(NULL, 'smtp_prefix', '', ''),
(NULL, 'timeformat', ' g:i a', 'g:i a'),
(NULL, 'timezoneserver', 'Europe/Zurich', 'Europe/Zurich'),
(NULL, 'title', 'HelpDesk 3', 'HelpDesk 3'),
(NULL, 'twilio_nexmo', '0', '1'),
(NULL, 'twitter', '', ''),
(NULL, 'twitter_big', '', ''),
(NULL, 'tw_msg', 'A customer is requesting attention.', 'A customer is requesting attention.'),
(NULL, 'tw_phone', '', ''),
(NULL, 'tw_sid', '', ''),
(NULL, 'tw_token', '', ''),
(NULL, 'updated', '".time()."', '1475494685'),
(NULL, 'useravatheight', '250', '250'),
(NULL, 'useravatwidth', '250', '250'),
(NULL, 'version', '3.5.5', '3.5.5'),
(NULL, 'holiday_mode', '0', '0'),
(NULL, 'push_reminder', '120', '120'),
(NULL, 'native_app_token', '', 'jakweb_app'),
(NULL, 'native_app_key', '', 'jakweb_app'),
(NULL, 'client_push_not', '1', '1'),
(NULL, 'engage_icon', 'fa-bells', 'fa-bells'),
(NULL, 'engage_sound', 'sound/new_message3', 'sound/new_message3'),
(NULL, 'client_sound', 'sound/hello', 'sound/hello'),
(NULL, 'live_online_status', '0', '0'),
(NULL, 'chat_upload_standard', '0', '0'),
(NULL, 'chatwidget_id', '0', '0'),
(NULL, 'recap_client', '', ''),
(NULL, 'recap_server', '', ''),
(NULL, 'billing_mode', '0', '0'),
(NULL, 'ticket_close_r', '0', '0'),
(NULL, 'ticket_inform_r', '0', '0'),
(NULL, 'ticket_guest', '0', '0'),
(NULL, 'ticket_account', '0', '0'),
(NULL, 'ticket_limit', '0', '0'),
(NULL, 'ticket_reminder', '0', '0'),
(NULL, 'ticket_close_c', '0', '0'),
(NULL, 'ticket_reopen', '0', '0'),
(NULL, 'ticket_attach', '0', '0'),
(NULL, 'ticket_rating', '1', '1'),
(NULL, 'ticket_similar', '1', '1'),
(NULL, 'ticket_duedate_format', 'F d, Y:#:LL', 'F d, Y:#:LL'),
(NULL, 'ticket_duedate_preset', '1', '1'),
(NULL, 'ticket_duedate', '0', '0'),
(NULL, 'faq_a', '1', '1'),
(NULL, 'faq_home', '4', '4'),
(NULL, 'faq_footer', '3', '3'),
(NULL, 'faq_page', '10', '10'),
(NULL, 'faq_pagination', '10', '10'),
(NULL, 'blog_a', '1', '1'),
(NULL, 'blog_home', '3', '3'),
(NULL, 'blog_footer', '2', '2'),
(NULL, 'blog_page', '5', '5'),
(NULL, 'blog_pagination', '10', '10'),
(NULL, 'standard_chat_dep', '0', '0'),
(NULL, 'standard_support_dep', '0', '0'),
(NULL, 'standard_faq_cat', '0', '0'),
(NULL, 'front_template', 'modern', 'modern'),
(NULL, 'offline_cms_page', '10', '10'),
(NULL, 'facebook_app_id', '', ''),
(NULL, 'stripe_publish_key', '', ''),
(NULL, 'stripe_secret_key', '', ''),
(NULL, 'paypal_email', '', ''),
(NULL, 'twoco', '', ''),
(NULL, 'twoco_secret', '', ''),
(NULL, 'blogpostapprove', '', ''),
(NULL, 'standard_ticket_priority', '0', '0'),
(NULL, 'standard_ticket_option', '0', '0'),
(NULL, 'ticket_private', '0', '0'),
(NULL, 'ticket_guest_web', '0', '0'),
(NULL, 'calendar_tickets', '0', '0'),
(NULL, 'calendar_chats', '0', '0'),
(NULL, 'calendar_offline', '0', '0'),
(NULL, 'calendar_purchases', '0', '0'),
(NULL, 'proactive_time', '3', '3'),
(NULL, 'dsgvo_contact', '', '')");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."transcript (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NULL DEFAULT NULL,
  `message` varchar(2000) NULL DEFAULT NULL,
  `user` varchar(100) NULL DEFAULT NULL,
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0',
  `convid` int(10) unsigned NOT NULL DEFAULT '0',
  `quoted` int(10) unsigned NOT NULL DEFAULT '0',
  `replied` int(10) unsigned NOT NULL DEFAULT '0',
  `starred` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `editoid` int(10) unsigned NOT NULL DEFAULT '0',
  `edited` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `sentstatus` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `class` varchar(20) NULL DEFAULT NULL,
  `plevel` smallint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `convid` (`convid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."user (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `chat_dep` varchar(100) DEFAULT '0',
  `support_dep` varchar(100) DEFAULT '0',
  `available` smallint(1) unsigned NOT NULL DEFAULT '0',
  `busy` smallint(1) unsigned NOT NULL DEFAULT '0',
  `hours_array` TEXT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `whatsappnumber` varchar(255) DEFAULT NULL,
  `pusho_tok` VARCHAR(50) DEFAULT NULL,
  `pusho_key` VARCHAR(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` char(64) NULL DEFAULT NULL,
  `idhash` varchar(32) DEFAULT NULL,
  `session` varchar(64) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `picture` varchar(100) NOT NULL DEFAULT '/standard.jpg',
  `aboutme` TEXT NULL,
  `language` varchar(10) DEFAULT NULL,
  `invitationmsg` varchar(255) DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `lastactivity` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `responses` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `files` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `useronlinelist` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `operatorchat` tinyint(1) NOT NULL DEFAULT '0',
  `operatorchatpublic` tinyint(1) NOT NULL DEFAULT '1',
  `operatorlist` tinyint(1) NOT NULL DEFAULT '0',
  `transferc` tinyint(1) NOT NULL DEFAULT '1',
  `chat_latency` smallint(4) UNSIGNED NOT NULL DEFAULT '3000',
  `push_notifications` tinyint(1) NOT NULL DEFAULT '1',
  `sound` tinyint(1) NOT NULL DEFAULT '1',
  `ringing` tinyint(2) NOT NULL DEFAULT '3',
  `alwaysnot` tinyint(1) NOT NULL DEFAULT '0',
  `emailnot` tinyint(1) NOT NULL DEFAULT '0',
  `navsidebar` tinyint(1) NOT NULL DEFAULT '1',
  `themecolour` varchar(10) NOT NULL DEFAULT 'green',
  `access` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `permissions` varchar(512) DEFAULT NULL,
  `forgot` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."user_stats (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `vote` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comment` text,
  `support_time` int(10) unsigned NOT NULL DEFAULT '0',
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."checkstatus (
  `convid` int(10) unsigned NOT NULL,
  `depid` int(10) unsigned NOT NULL DEFAULT '0',
  `department` varchar(100) DEFAULT NULL,
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0',
  `operator` varchar(100) DEFAULT NULL,
  `pusho` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `newc` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `newo` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `files` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `knockknock` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `msgdel` int(10) unsigned NOT NULL DEFAULT '0',
  `msgedit` int(10) unsigned NOT NULL DEFAULT '0',
  `typec` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `typeo` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `transferoid` int(10) unsigned NOT NULL DEFAULT '0',
  `transferid` int(10) unsigned NOT NULL DEFAULT '0',
  `denied` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `hide` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `datac` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `statusc` int(10) unsigned NOT NULL DEFAULT '0',
  `statuso` int(10) unsigned NOT NULL DEFAULT '0',
  `initiated` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `convid` (`convid`),
  KEY `denied` (`denied`,`hide`,`statusc`,`statuso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."transfer (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `convid` int(10) unsigned NOT NULL DEFAULT '0',
  `fromoid` int(10) unsigned NOT NULL DEFAULT '0',
  `fromname` varchar(100) DEFAULT NULL,
  `tooid` int(10) unsigned NOT NULL DEFAULT '0',
  `toname` varchar(100) DEFAULT NULL,
  `message` text,
  `used` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `convid` (`convid`,`tooid`,`used`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."push_notification_devices (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `ostype` enum('ios','android') NOT NULL DEFAULT 'ios',
  `token` varchar(255) DEFAULT NULL,
  `lastedit` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`,`ostype`,`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

### HelpDesk 3 ###
$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."support_departments (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` mediumtext,
  `pre_content` mediumtext,
  `faq_url` text,
  `email` varchar(255) DEFAULT NULL,
  `credits` int(10) unsigned NOT NULL DEFAULT '0',
  `guesta` smallint(1) unsigned NOT NULL DEFAULT '1',
  `active` smallint(1) unsigned NOT NULL DEFAULT '1',
  `dorder` smallint(2) unsigned NOT NULL DEFAULT '1',
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `guesta` (`guesta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."support_departments (`id`, `title`, `description`, `email`, `guesta`, `active`, `dorder`, `time`) VALUES
(1, 'Support', 'Edit this text to your needs...', '', 1, 1, 1, NOW())");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."support_tickets (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `depid` int(10) unsigned NOT NULL DEFAULT '0',
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0',
  `clientid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `priorityid` int(10) unsigned NOT NULL DEFAULT '0',
  `toptionid` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `ip` char(15) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `notes` text,
  `private` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `attachments` smallint(2) unsigned NOT NULL DEFAULT '0',
  `mergeid` int(10) unsigned NOT NULL DEFAULT '0',
  `mergeopid` int(10) unsigned NOT NULL DEFAULT '0',
  `mergetime` int(10) unsigned NOT NULL DEFAULT '0',
  `initiated` int(10) unsigned NOT NULL DEFAULT '0',
  `ended` int(10) unsigned NOT NULL DEFAULT '0',
  `updated` int(10) unsigned NOT NULL DEFAULT '0',
  `duedate` date NOT NULL DEFAULT '1980-05-06',
  `reminder` smallint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `depid` (`depid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

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

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."faq_categories (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `class` varchar(20) NOT NULL DEFAULT 'success',
  `title` varchar(255) DEFAULT NULL,
  `description` mediumtext,
  `email` varchar(255) DEFAULT NULL,
  `guesta` smallint(1) unsigned NOT NULL DEFAULT '1',
  `active` smallint(1) unsigned NOT NULL DEFAULT '1',
  `dorder` smallint(2) unsigned NOT NULL DEFAULT '1',
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `guesta` (`guesta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."faq_categories (`id`, `title`, `description`, `email`, `guesta`, `active`, `dorder`, `time`) VALUES
(1, 'FAQ', 'Edit this text to your needs...', '', 1, 1, 1, NOW())");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."faq_article (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `catid` int(10) NOT NULL DEFAULT '0',
  `lang` char(2) DEFAULT 'en',
  `title` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `socialbutton` smallint(1) unsigned NOT NULL DEFAULT 0,
  `votes` int(10) NOT NULL DEFAULT 0,
  `active` smallint(1) unsigned NOT NULL DEFAULT '1',
  `dorder` int(10) unsigned NOT NULL DEFAULT '1',
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."faq_article (`id`, `catid`, `lang`, `title`, `content`, `active`, `dorder`, `time`) VALUES
(1, 1, 'en', 'First FAQ Entry', 'Edit this text to your needs...', 1, 1, NOW())");

$jakdb->query('ALTER TABLE '.JAKDB_PREFIX.'faq_article ADD FULLTEXT(`title`, `content`)');

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."ticket_answers (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticketid` int(10) NOT NULL DEFAULT '0',
  `clientid` int(10) unsigned NOT NULL DEFAULT '0',
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `private` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `lastedit` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `sent` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ticketid` (`ticketid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."ticketpriority (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `depid` int(10) NOT NULL DEFAULT '0',
  `title` varchar(100) DEFAULT NULL,
  `class` varchar(10) DEFAULT 'default',
  `oponly` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `credits` int(10) unsigned NOT NULL DEFAULT '0',
  `dorder` int(10) unsigned NOT NULL DEFAULT '1',
  `edited` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `depid` (`depid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."ticketpriority (`id`, `depid`, `title`, `class`, `oponly`, `dorder`, `edited`, `created`) VALUES
(1, 0, 'Low', 'secondary', 0, 1, NOW(), NOW()),
(2, 0, 'Medium','warning', 0, 2, NOW(), NOW()),
(3, 0, 'High', 'danger', 0, 3, NOW(), NOW());");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."ticketoptions (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `depid` int(10) NOT NULL DEFAULT '0',
  `title` varchar(100) DEFAULT NULL,
  `icon` varchar(20) DEFAULT 'fa-bug',
  `oponly` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `credits` int(10) unsigned NOT NULL DEFAULT '0',
  `dorder` int(10) unsigned NOT NULL DEFAULT '1',
  `edited` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `depid` (`depid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");


$jakdb->query("INSERT INTO ".JAKDB_PREFIX."ticketoptions (`id`, `depid`, `title`, `icon`, `oponly`, `dorder`, `edited`, `created`) VALUES
(1, 0, 'Feedback', 'fa-comment-alt-dots', 0, 1, NOW(), NOW()),
(2, 0, 'Support', 'fa-ambulance', 0, 2, NOW(), NOW()),
(3, 0, 'Bug Report', 'fa-bug', 0, 3, NOW(), NOW())");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."php_imap (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `depid` int(10) unsigned NOT NULL DEFAULT '0',
  `mailbox` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `encryption` varchar(3) DEFAULT NULL,
  `scanfolder` varchar(30) DEFAULT NULL,
  `emailanswer` varchar(255) DEFAULT NULL,
  `msgdel` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `depid` (`depid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."clients (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `chat_dep` varchar(100) DEFAULT '0',
  `support_dep` varchar(100) DEFAULT '0',
  `faq_cat` varchar(100) DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `picture` varchar(255) NOT NULL DEFAULT '/standard.jpg',
  `password` char(64) NOT NULL,
  `idhash` varchar(32) DEFAULT NULL,
  `session` varchar(64) DEFAULT NULL,
  `language` varchar(10) DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `lastactivity` int(10) unsigned NOT NULL DEFAULT '0',
  `chatrequests` int(10) unsigned NOT NULL DEFAULT '0',
  `supportrequests` int(10) unsigned NOT NULL DEFAULT '0',
  `canupload` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `access` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `custom_price` smallint(3) NOT NULL DEFAULT '0',
  `credits` int(10) NOT NULL DEFAULT '0',
  `paid_until` date NOT NULL DEFAULT '1980-05-06',
  `forgot` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."support_responses (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `depid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `message` mediumtext,
  PRIMARY KEY (`id`),
  KEY `depid` (`depid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."support_responses (`id`, `depid`, `title`, `message`) VALUES
(1, 0, 'Reply', 'Thank you for opening a support ticket with us.')");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."blog (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lang` char(2) DEFAULT 'en',
  `opid` int(10) unsigned NOT NULL DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `previmg` varchar(255) DEFAULT NULL,
  `active` smallint(1) unsigned NOT NULL DEFAULT 1,
  `showdate` smallint(1) unsigned NOT NULL DEFAULT 0,
  `comments` smallint(1) unsigned NOT NULL DEFAULT 0,
  `socialbutton` smallint(1) unsigned NOT NULL DEFAULT 0,
  `hits` int(10) unsigned NOT NULL DEFAULT 0,
  `membersonly` smallint(1) unsigned NOT NULL DEFAULT 0,
  `dorder` int(10) unsigned NOT NULL DEFAULT 1,
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("INSERT INTO ".JAKDB_PREFIX."blog (`id`, `lang`, `title`, `content`, `previmg`, `active`, `showdate`, `comments`, `socialbutton`, `hits`, `membersonly`, `dorder`, `time`) VALUES
(1, 'en', 'Lorem Ipsum', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>', '/".JAK_FILES_DIRECTORY."/editor/bg-22.jpg', 1, 1, 1, 1, 0, 0, 1, NOW()),
(2, 'en', 'Lorem Ipsum 2', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>', '/".JAK_FILES_DIRECTORY."/editor/bg-003.jpg', 1, 1, 1, 1, 0, 0, 2, NOW()),
(3, 'en', 'Lorem Ipsum 3', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>', '/".JAK_FILES_DIRECTORY."/editor/bg-015.jpg', 1, 1, 1, 1, 0, 0, 3, NOW())");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."blogcomments (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `blogid` int(10) unsigned NOT NULL DEFAULT 0,
  `commentid` int(10) unsigned NOT NULL DEFAULT 0,
  `clientid` int(10) unsigned NOT NULL DEFAULT 0,
  `operatorid` int(10) unsigned NOT NULL DEFAULT 0,
  `message` text,
  `approve` smallint(1) unsigned NOT NULL DEFAULT 0,
  `votes` int(10) NOT NULL DEFAULT 0,
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `session` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blogid` (`blogid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."billing_packages (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `previmg` varchar(255) DEFAULT NULL,
  `credits` int(10) unsigned NOT NULL DEFAULT 0,
  `paidtill` varchar(100) DEFAULT NULL,
  `chat_dep` varchar(100) DEFAULT '0',
  `support_dep` varchar(100) DEFAULT '0',
  `faq_cat` varchar(100) DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  `currency` varchar(3) DEFAULT NULL,
  `dorder` int(10) unsigned NOT NULL DEFAULT 1,
  `active` smallint(1) unsigned NOT NULL DEFAULT 1,
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."subscriptions (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientid` int(10) unsigned NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  `currency` varchar(3) DEFAULT NULL,
  `package` int(10) unsigned NOT NULL DEFAULT 1,
  `paidhow` varchar(30) DEFAULT NULL,
  `paidwhen` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `success` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `clientid` (`clientid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."payment_ipn (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientid` int(10) unsigned NOT NULL DEFAULT '0',
  `status` varchar(200) DEFAULT NULL,
  `amount` varchar(200) DEFAULT NULL,
  `currency` varchar(200) DEFAULT NULL,
  `txn_id` varchar(200) DEFAULT NULL,
  `receiver_email` varchar(200) DEFAULT NULL,
  `payer_email` varchar(200) DEFAULT NULL,
  `paid_with` varchar(200) DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."cms_pages (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url_slug` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `ogimg` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(200) DEFAULT NULL,
  `meta_description` varchar(200) DEFAULT NULL,
  `dorder` int(10) NOT NULL DEFAULT '1',
  `showheader` tinyint(3) NOT NULL DEFAULT '1',
  `ishome` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `showfooter` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `prepage` varchar(50) NOT NULL DEFAULT '0',
  `custom` varchar(100) NOT NULL,
  `custom2` varchar(100) NOT NULL,
  `custom3` varchar(100) NOT NULL,
  `custom4` varchar(100) NOT NULL,
  `custom5` varchar(100) NOT NULL,
  `access` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `hits` int(10) unsigned NOT NULL DEFAULT '1',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `edited` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8");

$jakdb->exec("INSERT INTO ".JAKDB_PREFIX."cms_pages (`id`, `lang`, `title`, `url_slug`, `content`, `ogimg`, `meta_keywords`, `meta_description`, `dorder`, `showheader`, `ishome`, `showfooter`, `prepage`, `access`, `hits`, `active`, `edited`, `created`) VALUES
(1, 'en', 'Home', 'home', '<p>{searchblock}</p>\r\n<p>{blognew}</p>', '', 'helpdesk3,support,live-chat,faq,blog,cms', 'Get the next generation support desk software.', 1, 1, 1, 0, 0, 2, 3, 1, NOW(), NOW()),
(2, 'en', 'Support', 'support', '', '', '', '', 2, 1, 0, 1, 'support', 2, 5, 1, NOW(), NOW()),
(3, 'en', 'FAQ', 'faq', '', '', '', '', 3, 1, 0, 1, 'faq', 2, 3, 1, NOW(), NOW()),
(4, 'en', 'Blog', 'blog', '', '', '', '', 4, 1, 0, 1, 'blog', 2, 3, 1, NOW(), NOW()),
(5, 'en', 'Login', 'login', '<p>{login}</p>', '', '', '', 5, 1, 0, 1, 0, 1, 2, 1, NOW(), NOW()),
(6, 'en', 'Register', 'register', '<p>{register}</p>', NULL, NULL, NULL, 6, 1, 0, 1, '0', 1, 3, 1, NOW(), NOW()),
(7, 'en', 'Contact', 'get-in-touch', '<div class=\"container my-5\">\r\n<div class=\"row\">\r\n<div class=\"col-md-6\">\r\n<p>Feel free to contact us by the contact form at any time, we usually respond in less then 24 hours.</p>\r\n<address><strong>JAKWEB / Switzerland</strong><br> Hch.Bosshardstrasse 26 / 8352 Elsau<br> <abbr title=\"Phone\">Phone:</abbr> +41 (0)77 482 57 15<br> <abbr title=\"Email\">Email:</abbr> info[at]jakweb.ch</address><hr />\r\n<div class=\"alert alert-info\"><strong>Heads up!</strong> For support please use our <a class=\"alert-link\" href=\"/support\">support</a> area.</div>\r\n</div>\r\n<div class=\"col-md-6\">\r\n<p>{contact}</p>\r\n</div>\r\n</div>\r\n</div>', '', '', '', 7, 1, 0, 1, 0, 2, 3, 1, NOW(), NOW()),
(8, 'en', 'Client', 'client', '', '', '', '', 8, 1, 0, 1, 'client', 3, 3, 1, NOW(), NOW()),
(9, 'en', 'Search', 'search', '', '', '', '', 9, 1, 0, 1, 'search', 2, 3, 1, NOW(), NOW())");

$jakdb->exec("INSERT INTO ".JAKDB_PREFIX."answers (`id`, `department`, `lang`, `title`, `message`, `fireup`, `msgtype`, `created`) VALUES (NULL, 0, 'en', 'Register Email', '<p>Thank you very much for opening an account with us.<br><br>You have used following email address: {cemail}<br>Please use following password to login into your account: {cpassword}<br><br>You can now login on our site <a href=\"{url}\">{title}</a> and change your information, avatar and or password.</p>', 15, 14, NOW()),
(NULL, 0, 'en', 'Welcome Register Web', '<div class=\"container\">
<div class=\"row\">
<div class=\"col-lg-12\">
<h2>Thank You</h2>
<p>Your account has been registered and an email has been sent to the provided email address with your password and further informations.</p>
<p>Please also check your spam/junk folder, if you should not receive an email from us within the next 2 hours, please contact us thru following email address: {email}.</p>
<p>Kind regards<br>{title}</p>
</div>
</div>
</div>', 15, 15, NOW()),
(NULL, 0, 'en', 'Forgot Password Email', '<p>Someone (hopefully you!) has submitted a forgotten password request for your account. If you do not wish to change your password, just ignore this email and nothing will happen. However, if you did forget your password and wish to set a new one, visit the following link: {reset}</p>', 15, 16, NOW()),
(NULL, 0, 'en', 'password', '<div class=\"container\">
<div class=\"row\">
<div class=\"col-lg-12\">
<h2>Password Reset Web</h2>
<p>An email has been sent with a link to reset your password.</p>
<p>Please also check your spam/junk folder, if you should not receive an email from us within the next 2 hours, please try again or contact us thru following email address: {email}.</p>
<p>Kind regards<br>{title}</p>
</div>
</div>
</div>', 15, 17, NOW()),
(NULL, 0, 'en', 'Logout', '<div class=\"container\">
<div class=\"row\">
<div class=\"col-lg-12\">
<h2>Logout successfully</h2>
<p>You have been logged out successful.</p>
<p><a href=\"{url}\">Click here to go back to the home page</a></p>
</div>
</div>
</div>', 15, 18, NOW()),
(NULL, 0, 'en', 'Error', '<p>Hi!</p><p>An error occured, you might want to try again. It could be that your ip has been blocked, please contact us if you not aware off that.</p><p><a href=\"{url}\">Click here to go back to the home page</a></p>', 15, 19, NOW()),
(NULL, 0, 'en', 'New Ticket', '<p>Hi!</p>
<p>This message has been automatically generated in response to the creation of a support ticket regarding: \"{subject}\", a summary of which appears below. There is no need to reply to this message right now. Your ticket has been assigned an ID of {ticket}.</p>
<p>To do so, you may reply to this message, here: {ticketurl}</p>
<p>Thank you,<br>{title}</p>', 15, 20, NOW()),
(NULL, 0, 'en', 'Ticket Answer', '<p>Hi!</p>
<p>This message has been automatically generated in response to an answer of a support ticket regarding: \"{subject}\", a summary of which appears below.</p>
<p>Your ticket has following ID: {ticket}</p>
<p>You may reply to this message, here: {ticketurl}</p>
<p>Thank you,<br>{title}</p>', 15, 21, NOW()),
(NULL, 0, 'en', 'Ticket Reminder', '<p>Hi {cname},</p>
<p>This is a reminder of your ticket \"{subject}\".</p>
<p>The history of your ticket can be found in your dashboard or you can go straight to your ticket with following url: {ticketurl}</p>
<p>Kind regards<br>{title}</p>', 15, 22, NOW()),
(NULL, 0, 'en', 'Ticket closed', '<p>Hi {cname},</p>
<p>Your ticket \"{subject}\" has been closed.</p>
<p>The history of your ticket can be found in your dashboard or you can go straight to your ticket with following url: {ticketurl}</p>
<p>You can reopen the ticket, simply reply to it.</p>
<p>Kind regards<br>{title}</p>', 15, 23, NOW()),
(NULL, 0, 'en', 'Start Chat Client', 'Hi %client%, please start the chat below.', 15, 24, NOW()),
(NULL, 0, 'en', 'Support Rating', '<h3>How would you rate the support you received?</h3><p>Hello {cname},<br>We would love to hear what you think of our customer service. Please take a moment to rate the support you have received by clicking the link below.<br>How would you rate the support you received?</p><p>Please rate our support here: {ticketurl}</p>', 15, 25, NOW())");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."translations (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) DEFAULT NULL,
  `chat_dep` int(10) unsigned NOT NULL DEFAULT '0',
  `support_dep` int(10) unsigned NOT NULL DEFAULT '0',
  `faq_cat` int(10) unsigned NOT NULL DEFAULT '0',
  `priorityid` int(10) unsigned NOT NULL DEFAULT '0',
  `customfieldid` int(10) unsigned NOT NULL DEFAULT '0',
  `toptionid` int(10) unsigned NOT NULL DEFAULT '0',
  `cmsid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` mediumtext,
  `faq_url` text,
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->exec("INSERT INTO ".JAKDB_PREFIX."translations (`id`, `lang`, `chat_dep`, `support_dep`, `faq_cat`, `priorityid`, `customfieldid`, `toptionid`, `cmsid`, `title`, `description`, `faq_url`, `time`) VALUES
(1, 'en', 0, 0, 0, 0, 0, 0, 1, '<h3>Smart FAQ Search</h3>', '<p class=\"txt-small\">Search through our FAQ with the build in smart search.</p>', NULL, NOW()),
(2, 'en', 0, 0, 0, 0, 0, 0, 2, '<h3><strong>Help</strong> <small>Desk 3</small></h3>', '<p class=\"txt-small\">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>\r\n<p class=\"mb-0\">Phone: <strong>+41 (0) 77 482 57 15</strong></p>\r\n<p>Email: <strong>youremail@domain.com</strong></p>', NULL, NOW()),
(3, 'en', 0, 0, 0, 0, 0, 0, 3, '<h4 class=\"title-green\">Features</h4>', NULL, NULL, NOW()),
(4, 'en', 0, 0, 0, 0, 0, 0, 4, '<h4 class=\"title-green\">About Us</h4>', NULL, NULL, NOW()),
(5, 'en', 0, 0, 0, 0, 0, 0, 5, '<h3 class=\"title-green\">Latest News</h3>', '<p>Our blog will inform you about the latest news about our company.</p>', NULL, NOW()),
(6, 'en', 0, 0, 0, 0, 0, 0, 6, '<h4>Contact Form</h4>', '<p>Please fill at least the name, email and message field.</p>', NULL, NOW()),
(7, 'en', 0, 0, 0, 0, 0, 0, 7, '<h3 class=\"title-green\">Latest FAQ Articles</h3>', '<p>The latest FAQ article, browse through our frequently asked question database and get smart.</p>', NULL, NOW()),
(8, 'en', 0, 0, 0, 0, 0, 0, 8, '<h3 class=\"title-green\">Our FAQ Article</h3>', '<p>Check all our frequently asked questions and get smart.</p>', NULL, NOW()),
(9, 'en', 0, 0, 0, 0, 0, 0, 9, '<h3 class=\"title-green\">Latest Support Tickets</h3>', '<p>Our latest support tickets, grab some knowledge from our database.</p>', NULL, NOW()),
(10, 'en', 0, 0, 0, 0, 0, 0, 10, '<h3 class=\"title-green\">Support Tickets</h3>', '<p>Grab some knowledge from our public support tickets.</p>', NULL, NOW()),
(11, 'en', 0, 0, 0, 0, 0, 0, 11, '<h3>All Blog Articles</h3>', '<p>Check our latest articles now and in full length.</p>', NULL, NOW()),
(12, 'en', 0, 0, 0, 0, 0, 0, 12, '<h3>Client Dashboard</h3>', '<p>Welcome to your dashboard, you will find all your tickets, payments and profile information on this page.</p>', NULL, NOW()),
(13, 'en', 0, 0, 0, 0, 0, 0, 13, '<h3>Billing History</h3>', '<p>Your billing history on our site</p>', NULL, NOW()),
(14, 'en', 0, 0, 0, 0, 0, 0, 14, '<h3>Subscriptions</h3>', '<p>Select the package that suits you.</p>', NULL, NOW()),
(15, 'en', 0, 0, 0, 0, 0, 0, 15, '<h3>Edit Profile</h3>', '<p>Edit your profile add your personal avatar and get some nuts.</p>', NULL, NOW()),
(16, 'en', 0, 0, 0, 0, 0, 0, 16, '<h3>How would you rate the support you received?</h3>', '<p>Hello %client%,<br>We\'d love to hear what you think of our customer service. Please take a moment to rate the support you have received by clicking the link below.<br>How would you rate the support you received?</p>', NULL, NOW()),
(17, 'en', 0, 0, 0, 0, 0, 0, 17, '<h4>Mobile Apps</h4>', '<ul class=\"social-buttons\"><li><a href=\"https://play.google.com/store/apps/details?id=ch.jakweb.livechat\" class=\"btn btn-just-icon btn-link btn-android\"><i class=\"material-icons\">phone_android</i></a></li><li><a href=\"https://itunes.apple.com/us/app/live-chat-3-lcps/id1229573974\" class=\"btn btn-just-icon btn-link btn-apple\"><i class=\"material-icons\">phone_iphone</i></a></li></ul><h5>Numbers Don&apos;t Lie</h5><h4>14.521<small> Freelancers</small></h4><h4>1.423.183<small> Transactions</small></h4>', NULL, NOW()),
(18, 'en', 0, 0, 0, 0, 0, 0, 18, '', '', NULL, NOW()),
(19, 'en', 0, 0, 0, 0, 0, 0, 19, '', '', NULL, NOW()),
(20, 'en', 0, 0, 0, 0, 0, 0, 20, '', '', NULL, NOW()),
(21, 'en', 0, 0, 0, 0, 0, 0, 21, '', '', NULL, NOW())");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."customfields (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fieldlocation` tinyint(3) NOT NULL DEFAULT '1',
  `depid` int(10) unsigned NOT NULL DEFAULT 1,
  `title` varchar(255) DEFAULT NULL,
  `val_slug` varchar(255) DEFAULT NULL,
  `field_html` text,
  `fieldtype` tinyint(3) NOT NULL DEFAULT '1',
  `mandatory` tinyint(3) NOT NULL DEFAULT '0',
  `onregister` tinyint(3) NOT NULL DEFAULT '0',
  `dorder` int(10) unsigned NOT NULL DEFAULT 1,
  `active` tinyint(3) NOT NULL DEFAULT '1',
  `time` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fieldlocation` (`fieldlocation`, `depid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

$jakdb->query("CREATE TABLE ".JAKDB_PREFIX."taken_credits (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `clientid` int(10) unsigned NOT NULL DEFAULT '0',
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0',
  `credits` int(10) unsigned NOT NULL DEFAULT 0,
  `taken` tinyint(3) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '1980-05-06 00:00:00',
  PRIMARY KEY (`id`),
  KEY `clientid` (`clientid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

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

// Now let us delete all cache files
$cacheallfiles = '../'.JAK_CACHE_DIRECTORY.'/';
$msfi = glob($cacheallfiles."*.php");
if ($msfi) foreach ($msfi as $filen) {
    if (file_exists($filen)) unlink($filen);
}
	
	die(json_encode(array("status" => 1)));

} else {
	die(json_encode(array("status" => 2)));
}

} else {
	die(json_encode(array("status" => 0)));
}
?>