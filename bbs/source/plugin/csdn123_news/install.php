<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF

CREATE TABLE IF NOT EXISTS `pre_zd_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(800) DEFAULT NULL,
  `getdatetime` int(11) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `fromurl` varchar(800) DEFAULT NULL,
  `fid` tinyint(4) DEFAULT NULL,
  `is_import` tinyint(4) DEFAULT NULL,
  `showfromurl` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM;

EOF;

runquery($sql);

$sql2 = <<<EOF

CREATE TABLE IF NOT EXISTS `pre_zd_cron` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `csdn123_keyword` varchar(160) DEFAULT NULL,
  `csdn123_fromtype` tinyint(4) DEFAULT NULL,
  `csdn123_importfid` tinyint(4) DEFAULT NULL,
  `csdn123_showfromurl` tinyint(4) DEFAULT NULL,
  `csdn123_catch_num` int(4) DEFAULT '0',
  `csdn123_catch_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

EOF;

runquery($sql2);

$finish = TRUE;
