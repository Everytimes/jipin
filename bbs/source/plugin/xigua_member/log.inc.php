<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
include DISCUZ_ROOT.'./source/plugin/xigua_member/function.php';

if(submitcheck('permsubmit'))
{
    if(!empty($_GET['delete'])){
        C::t('#xigua_member#plugin_xigua_member')->multi_delete($_GET['delete']);
    }

    cpmsg(xul('save_succeed', FALSE), "action=plugins&operation=config&do=$pluginid&identifier=xigua_member&pmod=log&page=".$_GET['page'], 'succeed');
}

$page = max(1, intval(getgpc('page')));
$lpp  = 50;
$start_limit = ($page - 1) * $lpp;

$list = C::t('#xigua_member#plugin_xigua_member')->fetch_by_page($start_limit, $lpp);
$count = C::t('#xigua_member#plugin_xigua_member')->total();

$multipage = multi($count, $lpp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=xigua_member&pmod=log&lpp=$lpp", 0, 10, 0, 1);


showformheader("plugins&operation=config&do=$pluginid&identifier=xigua_member&pmod=log");
showtableheader(xul('log', FALSE));
showtablerow('class="header"', array(
), array(
    '&nbsp;',
    xul('usetype', FALSE),
    xul('uid', FALSE),
    xul('newname', FALSE),
    xul('oldname', FALSE),
    xul('crts', FALSE)
));

foreach ($list as $row) {
    showtablerow('', array(), array(
        '<label><input type="checkbox" name="delete[]" value="'.$row['logid'].'" /> '.$row['logid'].'</label>',
        $row['usetype'],
        $row['uid'],
        $row['newname'],
        '<del>'.$row['oldname'].'</del>',
        date('Y-m-d H:i:s', $row['crts']),
    ));
}


showtablerow('', 'colspan="99"', $multipage);
showsubmit('permsubmit', 'submit', 'del');
showtablefooter();
echo '<input type="hidden" name="page" value="'.$page.'">';
showformfooter();
