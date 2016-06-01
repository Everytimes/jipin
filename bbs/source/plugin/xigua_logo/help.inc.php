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
include dirname(__FILE__) . '/function.php';
$wechat = unserialize($_G['setting']['mobilewechat']);

$tip = xg_ll('tip', 1);
$tip2 = xg_ll('tip2', 1);
$tip98_ = xg_ll('tip98', 1);
$tip99_ = xg_ll('tip99', 1);

function getPluginUrl($pluginid, $param = array()) {
    global $wechat;
    $url = 'http://wsq.discuz.qq.com/?siteid='.$wechat['wsq_siteid'].'&mobile=2&c=index&a=plugin&pluginid=' . urlencode($pluginid) . '&param=' . urlencode(base64_encode(http_build_query($param)));
    return htmlspecialchars($url);
}

loadcache(array('forum', 'setting'));


$tmp = C::t('forum_forum')->fetch_all_by_status(1);
foreach ($tmp as $k => $f) {
    $forums[$f['fid']] = $f;
}

foreach ($forums as $forum) {
    if($forum['fup'] == 0 && $forum['type'] == 'group'){
        $gids[$forum['fid']] = $forum['name'];
    }

    if($forum['fup'] != 0 && $forum['type'] == 'sub'){
        $fups[$forum['fup']] = $forums[$forum['fup']]['name'];
    }
}
$tip .= '<p><img src="source/plugin/xigua_logo/images/1.jpg" /> </p>'.xg_ll('tip100', 1) . getPluginUrl('xigua_logo:forumlist', array('siteid' => $wechat['wsq_siteid']));
foreach ($gids as $gid => $name) {
    $tip99 .= $name . ': ' .getPluginUrl('xigua_logo:forumlist', array('siteid' => $wechat['wsq_siteid'], 'gid' => $gid)) .'<br>';
}

foreach ($fups as $fid => $name) {
    $tip98 .= $name . ': ' .getPluginUrl('xigua_logo:forumlist', array('siteid' => $wechat['wsq_siteid'], 'fid' => $fid)) . '<br>';
}

echo <<<HTML
<style>
.tb2 .partition {
  background: url(static/image/admincp/bg_repx_hc.gif) repeat-x 0 -70px;
}
.tb2 .partition p{
  color:#666;
  font-weight:normal;
}
</style>
<table class="tb tb2 ">
  <tr class="header"><th colspan="15" class="partition">$tip</th></tr>
  <tr class="header"><th colspan="15" class="partition">$tip2</th></tr>
  <tr class="header"><th colspan="15" class="partition">$tip98_<p>$tip99</p></th></tr>
  <tr class="header"><th colspan="15" class="partition">$tip99_<p>$tip98</p></th></tr>
</table>
HTML
;