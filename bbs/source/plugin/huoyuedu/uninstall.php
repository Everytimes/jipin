<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$sql = <<<SQL
DROP TABLE IF EXISTS pre_yt_huoyuedu1;
DROP TABLE IF EXISTS pre_yt_huoyuedu2;
SQL;
runquery($sql);
$finish = TRUE;
?>