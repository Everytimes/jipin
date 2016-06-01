<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
include DISCUZ_ROOT . 'source/plugin/xigua_portal/core/cards.class.php';
include DISCUZ_ROOT . 'source/plugin/xigua_portal/core/parser.class.php';
require_once libfile('function/cache');

if(!$_G['cache']['plugin']){
    loadcache('plugin');
}

dsetcookie('mobile', '', -1);

define('XG_PORTAL_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('XG_PORTAL_TPL_PATH', XG_PORTAL_PATH . 'template' . DIRECTORY_SEPARATOR);

function xp_display($template_name){
    return XG_PORTAL_TPL_PATH.$template_name.'.php';
}