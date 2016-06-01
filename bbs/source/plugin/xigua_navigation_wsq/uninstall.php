<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install.php 34718 2014-07-14 08:56:39Z nemohou $
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$pluginid = 'xigua_navigation_wsq';

require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
WeChatHook::delAPIHook($pluginid);

$sql = <<<SQL
  DROP TABLE pre_plugin_xigua_navigation_wsq
SQL;


include DISCUZ_ROOT . './source/plugin/xigua_navigation_wsq/function.php';
xgn_delete_all(DISCUZ_ROOT . "./data/sysdata/xigua_navigation_wsq");
@rmdir(DISCUZ_ROOT . "./data/sysdata/xigua_navigation_wsq");

runquery($sql);

$finish = TRUE;
