<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
require_once dirname(__FILE__).'/libs/menu.inc.php';
$params = array(
);
$tplVars = array(
    'plugin_path' => reprint_env::get_plugin_path(),
    'toolurl' => reprint_env::get_siteurl()."/plugin.php?id=reprint",
    'ak' => $aksk['ak'],
    'sk' => $aksk['sk'],
    'quota' => 10,
);
reprint_utils::loadtpl(dirname(__FILE__).'/view/z_index.tpl', $params, $tplVars);
