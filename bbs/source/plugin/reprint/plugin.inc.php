<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

require_once dirname(__FILE__).'/libs/env.class.php';
$plugin = "reprint";
$plugin_enabled = 0;
if(isset($_G['setting']['plugins']['available']) && in_array($plugin, $_G['setting']['plugins']['available'])){
    $plugin_enabled = 1;
}

$list = C::t("#reprint#reprint_thread")->query();
foreach ($list['root'] as &$item) {
    $item['turl'] = reprint_env::get_siteUrl().'/forum.php?mod=viewthread&tid='.$item['tid'];
}
$result = array (
    "charset" => $_G['charset'],
    "discuz_version" => $_G['setting']['version'],
    "php_version" => phpversion(),
    "siteurl"  => reprint_env::get_siteUrl(),
    "sitename" => reprint_env::get_sitename(),
    "admin_email" => reprint_env::get_admin_email(),
    "reprint" => array(
        "plugin_version" => $_G['setting']['plugins']['version'][$plugin],
        "plugin_enabled" => $plugin_enabled,
        "aksk" => reprint_env::getaksk(),
        "quota" => reprint_env::get_quota(),
        "config" => reprint_setting::get(),
    ),
    "list" => array(
        'totalProperty' => $list['totalProperty'],
        'root' => $list['root'],
    ),
);
reprint_env::result($result);
