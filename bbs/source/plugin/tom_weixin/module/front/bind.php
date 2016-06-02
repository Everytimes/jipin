<?php

if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}

$openid     = isset($_GET['wxid'])? daddslashes($_GET['wxid']):'';
$formhash   = isset($_GET['formhash'])? trim($_GET['formhash']):'';

include DISCUZ_ROOT.'./source/plugin/tom_weixin/core/module.class.php';
$moduleClass = new tom_module();
$configName = $moduleClass->getConfigName("bindreg");
if($configName){
    include $configName;
}
include DISCUZ_ROOT.'./source/plugin/tom_weixin/core/user.class.php';
$userClass   = new tom_user();
loaducenter();

if($_GET['act'] == 'bind' && $formhash == FORMHASH){
    $outArr = array(
        'status'=> 0,
    );
    $username = isset($_GET['username'])? daddslashes(diconv(urldecode($_GET['username']),'utf-8')):'';
    $password = isset($_GET['password'])? daddslashes($_GET['password']):'';
    $user = uc_user_login($username,$password,0);
    if($user['0'] > 0){
        $outArr['status'] = 200;
        $insertData = array();
        $insertData['openid'] = $openid;
        $insertData['uid'] = $user['0'];
        $insertData['username'] = $user['1'];
        $insertData['bind_time'] = TIMESTAMP;
        $userClass->insert($insertData);
    }else{
       $outArr['status'] = 100;
    }
    echo json_encode($outArr); exit;
}else if($_GET['act'] == 'unbind' && $formhash == FORMHASH){
    $userClass->deleteByOpenid($openid);
    exit("1");
}

$moduleInfo = $moduleClass->getOneByModuleId("bindreg");
$moduleSetting = array();
if(!empty($moduleInfo['module_setting'])){
    $moduleSetting = $moduleClass->decodeSetting($moduleInfo['module_setting']);
}
$yjStatus = 0;
if(isset($moduleSetting['is_yj']) && $moduleSetting['is_yj']==1){
    $yjStatus = 1;
}
$regStatus = 0;
if(isset($moduleSetting['is_reg']) && $moduleSetting['is_reg']==1){
    $regStatus = 1;
}

$userInfo = C::t('#tom_weixin#tom_weixin_user')->fetch_one_by_openid($openid);
$bindStatus = 0;
$username = '';
$avatarUrl = '';
if($userInfo){
    $bindStatus = 1;
    $username = $userInfo['username'];
    $avatarUrl = avatar($userInfo['uid'],'middle',TRUE);
}

$loginUrl   = "plugin.php?id=tom_weixin:front&moduleAction=bind";
$regUrl     = "plugin.php?id=tom_weixin:front&moduleAction=reg&wxid={$openid}";
$unbindUrl  = "plugin.php?id=tom_weixin:front&moduleAction=bind&act=unbind&wxid={$openid}&formhash=".FORMHASH;

$randUsername = 'wx'.TIMESTAMP.mt_rand(1, 99);
$randPassword = mt_rand(111111, 999999);
$randEmail = 'wx'.TIMESTAMP.mt_rand(1, 99).'@null.null';
$yjReg = "plugin.php?id=tom_weixin:front&moduleAction=reg&wxid={$openid}&act=reg&username={$randUsername}&password={$randPassword}&email={$randEmail}&formhash=".FORMHASH;

$formhash = FORMHASH;
$isGbk = false;
if (CHARSET == 'gbk') $isGbk = true;
define('TPL_DEFAULT', true);
include template("tom_weixin:bind");
?>
