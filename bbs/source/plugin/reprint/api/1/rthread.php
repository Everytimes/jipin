<?php
if (!defined('IN_MOBILE_API')) {
    exit('Access Denied');
}
require './source/class/class_core.php';
$discuz = C::app();
$discuz->init();
require_once dirname(__FILE__)."/../../libs/env.class.php";
admin_check();
$action=isset($_GET["action"]) ? $_GET["action"] : "del";
try {
    $res = array();
	switch($action) {
		case "del": $res = delete_reprint_thread(); break;
		default: throw new Exception("unkown action"); break;
	}
    reprint_env::result($res);
} catch (Exception $e) {
	reprint_env::result(array("retcode"=>100009,"retmsg"=>$e->getMessage()));
}


function delete_reprint_thread()
{
    C::t("#reprint#reprint_thread")->del();
    return array();
}
