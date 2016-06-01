<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
require_once dirname(__FILE__).'/libs/env.class.php';

if (isset($_POST["zlabel"])) { 
    $params = array(
        'zlabel' => $_POST["zlabel"],
    );
    C::t('common_setting')->update_batch(array("reprint_setting"=>$params));
    updatecache('setting');
    $landurl = 'action=plugins&operation=config&do='.$pluginid.'&identifier=reprint&pmod=z_setting';
	cpmsg('plugins_edit_succeed', $landurl, 'succeed');
}

require_once dirname(__FILE__).'/libs/menu.inc.php';
$params = reprint_setting::get();
$tplVars = array(
    'plugin_path' => reprint_env::get_plugin_path(),
);
reprint_utils::loadtpl(dirname(__FILE__).'/view/z_setting.tpl', $params, $tplVars);
