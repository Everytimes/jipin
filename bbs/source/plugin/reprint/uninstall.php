<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
C::t('common_setting')->delete(array("skey"=>"reprint_aksk"));
$sql = "DROP TABLE IF EXISTS `".DB::table('reprint_thread')."`";
runquery($sql);
$finish = TRUE;
?>
