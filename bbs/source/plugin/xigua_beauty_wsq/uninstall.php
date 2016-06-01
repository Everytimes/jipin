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

$pluginid = 'xigua_beauty_wsq';

require_once DISCUZ_ROOT.'./source/plugin/xigua_beauty_wsq/function.php';
require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
WeChatHook::delAPIHook($pluginid);

xgb_delete_all(DISCUZ_ROOT . 'data/sysdata/xigua_beauty_cache', true);
@rmdir(DISCUZ_ROOT . 'data/sysdata/xigua_beauty_cache');

$finish = TRUE;
