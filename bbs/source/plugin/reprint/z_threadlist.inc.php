<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
require_once dirname(__FILE__).'/libs/menu.inc.php';
$params = array(
    'ajaxapi' => reprint_env::get_ajaxapi(),
);
$tplVars = array(
    'plugin_path' => reprint_env::get_plugin_path(),
);
reprint_utils::loadtpl(dirname(__FILE__).'/view/z_threadlist.tpl', $params, $tplVars);
