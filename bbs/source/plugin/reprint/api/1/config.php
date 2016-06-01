<?php
if (!defined('IN_MOBILE_API')) {
    exit('Access Denied');
}
require './source/class/class_core.php';
$discuz = C::app();
$discuz->init();
require_once dirname(__FILE__)."/../../libs/env.class.php";
admin_check();
$setting = reprint_setting::get();
$res = array(
    'quota' => reprint_env::get_quota(),
    'charset' => $_G['charset'],
    'fid' => $setting['fid'],
);
reprint_env::result($res);
