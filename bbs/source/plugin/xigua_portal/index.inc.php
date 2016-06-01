<?php
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/2/14
 * Time: 12:14
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'init.php';
$wechat = unserialize($_G['setting']['mobilewechat']);

if($_G['uid']){
    if($_G['wechat']['setting']['wsq_allow']) {
        $loginurl = 'http://wsq.discuz.qq.com/?c=index&a=profile&f=wx&siteid=' . $wechat['wsq_siteid'];
    }else{
        $loginurl =  $_G['siteurl'].'home.php?mod=space&uid='.$_G['uid'].'&do=profile&mycenter=1&mobile=2';
    }
}else{
    if($_G['cache']['plugin']['xigua_login']){
        $loginurl = $_G['siteurl'].'member.php?mod=logging&action=login&mobile=2';
    }else if($_G['wechat']['setting']['wsq_allow']){
        $loginurl = 'http://wsq.discuz.qq.com/?c=index&a=profile&f=wx&siteid='.$wechat['wsq_siteid'].'&login=yes';
    }else{
        $loginurl = $_G['siteurl'].'member.php?mod=logging&action=login&mobile=2';
    }
}

define('WSQ_UCENTER', $loginurl);
define('WSQ_POSTURL', 'http://wsq.discuz.qq.com/?c=index&a=newthread&siteuid='.$_G['uid'].'&&fid='.$_GET['fid'].'&siteid='.$wechat['wsq_siteid'] . ($_G['uid'] ? '' : '&login=yes'));

if($_GET['redirect']){
    dheader('Location:'.WSQ_UCENTER);
    exit;
}
if($_GET['newthread']){
    dheader('Location:'.WSQ_POSTURL);
    exit;
}

$config = xigua_cards::config(TRUE);

$pid = intval($_GET['pid']);
$pageinfo = C::t('#xigua_portal#xigua_portal_page')->fetch($pid);

if(empty($pageinfo)){
    echo 'PID Error';
//    dheader('Location:http://wsq.discuz.qq.com/?siteid='.$wechat['wsq_siteid']);
    exit;
}
$title       = $pageinfo['title'] ? $pageinfo['title'] : $wechat['wsq_sitename'];
$keywords    = $pageinfo['keywords'];
$description = $pageinfo['description'];
$code        = html_entity_decode($pageinfo['code']);
$style       = xigua_cards::get_style($pageinfo['style']);

$actionurl = $_G['siteurl'] . 'plugin.php?id=xigua_portal:index&diy=yes&pid=' . $pid;
$actionsaveurl = $_G['siteurl'] . 'plugin.php?id=xigua_portal:index&diy=yes&ac=save&pid=' . $pid;

$diy = FALSE;
if ($_G['adminid'] > 0 && $_GET['diy'] == 'yes') {  //in diy
    $ac = $_GET['ac'];
    xigua_cards::clearfromcache($pid);
    switch ($ac) {
        case 'new':
            if (submitcheck('type') && in_array($_GET['type'], array_keys($config))) {
                $type = daddslashes($_GET['type']);
                $ret = C::t('#xigua_portal#xigua_portal_setting')->insert(array(
                    'pid'          => $pid,
                    'type'         => $type,
                    'modulename'   => $config[ $type ]['modulename'],
                    'displayorder' => 999,
                    'upts'         => $_G['timestamp'],
                    'value'        => 'a:0:{}'
                ));
                if ($ret) {
                    xigua_cards::l('add_success');
                } else {
                    xigua_cards::l('add_failed');
                }
            }
            exit;
            break;
        case 'del':
            if (submitcheck('cid')) {
                $ret = C::t('#xigua_portal#xigua_portal_setting')->delete(intval($_GET['cid']));
                if ($ret) {
                    xigua_cards::l('del_success');
                } else {
                    xigua_cards::l('del_failed');
                }
            }
            exit;
            break;
        case 'order':
            if (submitcheck('cid')) {

                $ids = dintval(explode('_', trim($_GET['cid'])), TRUE);
                $idx = dintval(explode('_', trim($_GET['idx'])), TRUE);

                if (count($ids) != count($idx)) {
                    exit('0');
                }
                foreach ($ids as $k => $id) {
                    $ret = C::t('#xigua_portal#xigua_portal_setting')->update($id, array(
                        'displayorder' => $idx[ $k ]
                    ));
                }
                exit('1');
            }
            exit;
            break;
        case 'card':
            $cid = intval($_GET['cid']);
            $profile = C::t('#xigua_portal#xigua_portal_setting')->fetch($cid);
            if (empty($profile)) {
                exit('Access Denied!');
            }

            $p = xigua_cards::run($profile);
            include xp_display('cards/' . $p['type'] . '/tpl');
            exit;
            break;
        case 'upload':
            if (submitcheck('formhash')) {
                $ret = xigua_cards::upload($_FILES['xiguafile']);
                $ret['error'] = iconv(CHARSET, 'utf-8', $ret['error']);
                echo json_encode($ret);
            }
            exit;
            break;
        case 'save':
            if (submitcheck('row')) {
                $cid = intval($_GET['cid']);
                $row = dhtmlspecialchars($_GET['row']);

                $profile = C::t('#xigua_portal#xigua_portal_setting')->fetch($cid);
                if (empty($profile) || empty($row)) {
                    xigua_cards::l('add_failed');
                    exit;
                }

                $ret = C::t('#xigua_portal#xigua_portal_setting')->update($cid, array(
                    'upts'  => $_G['timestamp'],
                    'value' => serialize($row)
                ), TRUE);

                if ($ret) {
                    xigua_cards::l('save_success');
                } else {
                    xigua_cards::l('save_failed');
                }
            }
            exit;
            break;
        default:
            $ac && exit('Access Denied!');
            break;
    }


    $module = '';
    foreach ($config as $k => $v) {
        $module .= "<li><a href='javascript:;' data-type='$k' title='$v[introduce]'><img src='$v[icon]'>$v[modulename]</a></li>";
    }

    $diy = TRUE;
    define('IN_DIY', $diy);
    $title = 'DIY - ' . $title;
}else if($_GET['preview']!='previews'){
    if(!checkmobile()){
        dheader('Location:'.$_G['siteurl']);
        exit;
    }
}

$cards = xigua_cards::readfromcache($pid);
if(!$cards){
    $cards = C::t('#xigua_portal#xigua_portal_setting')->list_all($pid);
    foreach ($cards as $id => $card) {
        $cards[ $id ] = xigua_cards::run($card, TRUE);
    }
    xigua_cards::writetocache($cards, $pid);
}

$src = $css = $js = '';
foreach ($config as $v) {
    $js  .= (strpos($js,  $v['js'])  === false) ? $v['js']  : '';
    $css .= (strpos($css, $v['css']) === false) ? $v['css'] : '';
    $src .= (strpos($src, $v['src']) === false) ? $v['src'] : '';
}

include xp_display('index');