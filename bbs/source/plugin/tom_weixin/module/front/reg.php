<?php

if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}

$openid     = isset($_GET['wxid'])? daddslashes($_GET['wxid']):'';
$formhash = isset($_GET['formhash'])? trim($_GET['formhash']):'';

include DISCUZ_ROOT.'./source/plugin/tom_weixin/core/module.class.php';
$moduleClass = new tom_module();
$configName = $moduleClass->getConfigName("bindreg");
if($configName){
    include $configName;
}
include DISCUZ_ROOT.'./source/plugin/tom_weixin/core/user.class.php';
$userClass   = new tom_user();
loaducenter();

if($_GET['act'] == 'reg' && $formhash == FORMHASH){
    $outArr = array(
        'status'=> 0,
    );
    $username = isset($_GET['username'])? daddslashes(diconv(urldecode($_GET['username']),'utf-8')):'';
    $password = isset($_GET['password'])? daddslashes($_GET['password']):'';
    $email = isset($_GET['email'])? daddslashes($_GET['email']):'';
    
    $usernamelen = dstrlen($username);
    if($usernamelen < 3) {
        $outArr['status'] = 201;
        echo json_encode($outArr); exit;
    }
    if($usernamelen > 15) {
        $outArr['status'] = 202;
        echo json_encode($outArr); exit;
    }
    $censorexp = '/^('.str_replace(array('\\*', "\r\n", ' '), array('.*', '|', ''), preg_quote(($_G['setting']['censoruser'] = trim($_G['setting']['censoruser'])), '/')).')$/i';
    if($_G['setting']['censoruser'] && @preg_match($censorexp, $username)) {
        $outArr['status'] = 203;
        echo json_encode($outArr); exit;
    }
    
    $uid = uc_user_register($username, $password, $email, '', '', $_G['clientip']);
    if($uid <= 0) {
        if($uid == -1) {
            $outArr['status'] = 301;
            echo json_encode($outArr); exit;
        } elseif($uid == -2) {
            $outArr['status'] = 302;
            echo json_encode($outArr); exit;
        } elseif($uid == -3) {
            $outArr['status'] = 303;
            echo json_encode($outArr); exit;
        } elseif($uid == -4) {
            $outArr['status'] = 304;
            echo json_encode($outArr); exit;
        } elseif($uid == -5) {
            $outArr['status'] = 305;
            echo json_encode($outArr); exit;
        } elseif($uid == -6) {
            $outArr['status'] = 306;
            echo json_encode($outArr); exit;
        } else {
            $outArr['status'] = 307;
            echo json_encode($outArr); exit;
        }
    }
    $init_arr = array('credits' => explode(',', $_G['setting']['initcredits']));
	C::t('common_member')->insert($uid, $username, $password, $email, $_G['clientip'], $_G['setting']['newusergroupid'], $init_arr);
    
    if($_G['setting']['regctrl'] || $_G['setting']['regfloodctrl']) {
        C::t('common_regip')->delete_by_dateline($_G['timestamp']-($_G['setting']['regctrl'] > 72 ? $_G['setting']['regctrl'] : 72)*3600);
        if($_G['setting']['regctrl']) {
            C::t('common_regip')->insert(array('ip' => $_G['clientip'], 'count' => -1, 'dateline' => $_G['timestamp']));
        }
    }

    if($_G['setting']['regverify'] == 2) {
        C::t('common_member_validate')->insert(array(
            'uid' => $uid,
            'submitdate' => $_G['timestamp'],
            'moddate' => 0,
            'admin' => '',
            'submittimes' => 1,
            'status' => 0,
            'message' => '',
            'remark' => '',
        ), false, true);
        manage_addnotify('verifyuser');
    }
    
    include_once libfile('function/stat');
    updatestat('register');
    
    $insertData = array();
    $insertData['openid'] = $openid;
    $insertData['uid'] = $uid;
    $insertData['username'] = $username;
    $insertData['bind_time'] = TIMESTAMP;
    $userClass->insert($insertData);
    
    $outArr['status'] = 200;
    echo json_encode($outArr); exit;
}
$regUrl     = "plugin.php?id=tom_weixin:front&moduleAction=reg";
$backUrl    = "plugin.php?id=tom_weixin:front&moduleAction=bind&wxid={$openid}";

$formhash = FORMHASH;
$isGbk = false;
if (CHARSET == 'gbk') $isGbk = true;
define('TPL_DEFAULT', true);
include template("tom_weixin:reg");
?>
