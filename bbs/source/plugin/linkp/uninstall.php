<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF

DROP TABLE IF EXISTS pre_common_linkp;

EOF;

runquery($sql);

$finish = TRUE;

?>