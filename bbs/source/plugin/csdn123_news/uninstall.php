<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF
DROP TABLE pre_zd_news;
EOF;

runquery($sql);

$sql2 = <<<EOF
DROP TABLE pre_zd_cron;
EOF;

runquery($sql2);

$finish = true;
