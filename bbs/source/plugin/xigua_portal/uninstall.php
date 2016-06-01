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

$pluginid = 'xigua_portal';

require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
WeChatHook::delAPIHook($pluginid);
WeChatHook::updateRedirect(
    array('plugin' => 'wechat', 'include' => 'response.class.php', 'class' => 'WSQResponse', 'method' => 'redirect')
);

C::t('common_setting')->delete('xigua_portal_pid');
updatecache('setting');

$query = <<<SQL
DROP TABLE pre_xigua_portal_page;
DROP TABLE pre_xigua_portal_setting;
SQL;

runquery($query);

function xigua_portal_delete_all($directory, $empty = false) {
    if(substr($directory,-1) == "/") {
        $directory = substr($directory,0,-1);
    }

    if(!file_exists($directory) || !is_dir($directory)) {
        return false;
    } elseif(!is_readable($directory)) {
        return false;
    } else {
        @$directoryHandle = opendir($directory);

        while ($contents = @readdir($directoryHandle)) {
            if($contents != '.' && $contents != '..') {
                $path = $directory . "/" . $contents;

                if(is_dir($path)) {
                    @xigua_portal_delete_all($path);
                } else {
                    @unlink($path);
                }
            }
        }

        @closedir($directoryHandle);

        if($empty == false) {
            if(!@rmdir($directory)) {
                return false;
            }
        }

        return true;
    }
}

xigua_portal_delete_all(DISCUZ_ROOT.'./data/sysdata/xigua_portal');
xigua_portal_delete_all(DISCUZ_ROOT.'./source/plugin/xigua_portal');

@unlink(DISCUZ_ROOT . './source/plugin/xigua_portal/discuz_plugin_xigua_portal.xml');
@unlink(DISCUZ_ROOT . './source/plugin/xigua_portal/discuz_plugin_xigua_portal_SC_GBK.xml');
@unlink(DISCUZ_ROOT . './source/plugin/xigua_portal/discuz_plugin_xigua_portal_SC_UTF8.xml');
@unlink(DISCUZ_ROOT . './source/plugin/xigua_portal/discuz_plugin_xigua_portal_TC_BIG5.xml');
@unlink(DISCUZ_ROOT . './source/plugin/xigua_portal/discuz_plugin_xigua_portal_TC_UTF8.xml');

$finish = TRUE;