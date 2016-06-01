<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
require_once 'env.class.php';
$memuLang = array(
    'tips_title'  => '插件使用提示',
    'browser_tip' => '请在chrome或firefox浏览器中使用本插件的后台管理页面',
    'help_tip' => '在使用过程中遇到任何问题，请随时与我们联系，<b>QQ: 492108207</b>',
    'quota_tip' => '您的转帖配额剩余 <b>%d</b> 条',
    'mobile_allow_tip' => '<br><b style="color:red;">未开启手机版访问设置</b>，'.
           '<a href="'.reprint_env::get_siteurl().'/admin.php?frames=yes&action=setting&operation=mobile" target="_blank">点此前往设置</a>',
    'regist_fail_tip' => '<br><b style="color:red;">站点注册失败，请确保您的站点服务器有访问外网权限，并刷新本页面。</b>',
);
$charset = strtolower($_G['charset']);
if($charset!='utf-8' && $charset!='utf8'){
    foreach($memuLang as $k => &$v){
        $v = reprint_utils::piconv("UTF-8", $charset, $v);
    }   
}
if (isset($lang)) {
    $lang = array_merge($lang,$memuLang);
} else {
    $lang = $memuLang;
}
$str = '';
$str.= '<li>' . $lang['browser_tip'] . '</li>';
$str.= '<li>' . $lang['help_tip'] . '</li>';

$aksk = reprint_env::getaksk();
if (!isset($aksk['ak'])) {
	showtips($str,'',true, $lang['tips_title']);
	echo $lang['regist_fail_tip'];
	die(0);
}

$mobile_setting = $_G['setting']['mobile'];
if (!$mobile_setting['allowmobile']) {
	showtips($str,'',true, $lang['tips_title']);
	echo $lang['mobile_allow_tip'];
	die(0);
}

$quota = reprint_env::get_quota();
if ($quota<=10) {
    $tip = sprintf($lang['quota_tip'], $quota);
    $str.= '<li style="color:red;">'.$tip.'</li>';
}

showtips($str,'',true, $lang['tips_title']);
?>
