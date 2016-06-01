<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/4/8
 * Time: 16:48
 */


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
include_once libfile('function/forumlist');
$wechat = unserialize($_G['setting']['mobilewechat']);

function xgl($lang){
    return lang('plugin/xigua_navigation_wsq', $lang);
}

loadcache(array('forum', 'setting'));
$tmp = C::t('forum_forum')->fetch_all_by_status(1);
foreach ($tmp as $k => $f) {
    $forums[$f['fid']] = $f;
}

foreach ($forums as $forum) {
    if($forum['type'] != 'group'){
        $fups[$forum['fid']] = $forum['name'];
    }
}

$tips2 = '';
foreach ($fups as $fid => $name) {
    $tips2 .= "<li><b>$name</b>: http://wsq.discuz.qq.com/?c=index&a=index&siteid=$wechat[wsq_siteid]&fid=<a style=\"color:#069\">$fid</a></li>";
}

echo <<<HTML
<style>
#tips1lis li,#tips2lis li{display:block!important;}
#tips1lis li#tips1_more, #tips2lis li#tips2_more{display:none!important;}
</style>
HTML;


showtips(str_replace('$wechat[wsq_siteid]', $wechat['wsq_siteid'], xgl('tips')), 'tips1', TRUE, xgl('tips_title'));

showtips(xgl('tips3'), 'tips3', TRUE, xgl('tips3_title'));
showtips($tips2, 'tips2', TRUE, xgl('tips2'));
