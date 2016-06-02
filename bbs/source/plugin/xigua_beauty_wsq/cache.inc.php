<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/xigua_beauty_wsq/function.php';

if(submitcheck('permsubmit'))
{
    if(xgb_delete_all(DISCUZ_ROOT . 'data/sysdata/xigua_beauty_cache', true, true)){
        cpmsg(lang('plugin/xigua_beauty_wsq', 'succeed'), "action=plugins&operation=config&do=$pluginid&identifier=xigua_beauty_wsq&pmod=cache", 'succeed');
    }else{
        cpmsg(sprintf(lang('plugin/xigua_beauty_wsq', 'failed'), DISCUZ_ROOT.'data/sysdata/xigua_beauty_cache'), '', 'error');
    }
}

$cache_count = 0;
$directory = DISCUZ_ROOT . 'data/sysdata/xigua_beauty_cache';
@$directoryHandle = opendir($directory);

while ($contents = @readdir($directoryHandle)) {
    if($contents != '.' && $contents != '..') {
        $cache_count ++;
    }
}
@closedir($directoryHandle);

showformheader("plugins&operation=config&do=$pluginid&identifier=xigua_beauty_wsq&pmod=cache");
showtableheader(lang('plugin/xigua_beauty_wsq', 'cache_desc'));

echo '<tr><td>'.lang('plugin/xigua_beauty_wsq', 'cache_items').$cache_count.'</td></tr>';
showsubmit('permsubmit', 'submit');
showtablefooter();
showformfooter();