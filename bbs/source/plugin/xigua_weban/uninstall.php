<?php
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/6/27
 * Time: 13:51
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$pluginid = 'xigua_weban';

require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
WeChatHook::delAPIHook($pluginid);
$p = WeChatHook::getRedirect();
if($p['plugin']==$pluginid){
    WeChatHook::updateRedirect(
        array('plugin' => 'wechat', 'include' => 'response.class.php', 'class' => 'WSQResponse', 'method' => 'redirect')
    );
}

$finish = TRUE;

@unlink(DISCUZ_ROOT . './source/plugin/xigua_weban/discuz_plugin_xigua_weban.xml');
@unlink(DISCUZ_ROOT . './source/plugin/xigua_weban/discuz_plugin_xigua_weban_SC_GBK.xml');
@unlink(DISCUZ_ROOT . './source/plugin/xigua_weban/discuz_plugin_xigua_weban_SC_UTF8.xml');
@unlink(DISCUZ_ROOT . './source/plugin/xigua_weban/discuz_plugin_xigua_weban_TC_BIG5.xml');
@unlink(DISCUZ_ROOT . './source/plugin/xigua_weban/discuz_plugin_xigua_weban_TC_UTF8.xml');
@unlink(DISCUZ_ROOT . './source/plugin/xigua_weban/install.php');

xwb_delall(DISCUZ_ROOT . "./source/plugin/xigua_weban");
@rmdir(DISCUZ_ROOT . "./source/plugin/xigua_weban");


function xwb_delall($directory, $empty = false) {
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
                    @xwb_delall($path);
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