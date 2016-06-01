<?php
if (!defined('IN_MOBILE_API')) {
    exit('Access Denied');
}
require './source/class/class_core.php';
$discuz = C::app();
$discuz->init();
require_once dirname(__FILE__)."/../../libs/env.class.php";


try {
    $upfile  = get_upload_file('upfile');
    $res = array(
        'fileurl' => save_file($upfile),
    );
    reprint_env::result($res);
} catch (Exception $e) {
	reprint_env::result(array("retcode"=>100009,"retmsg"=>$e->getMessage()));
}

function get_upload_file($fileid)
{
    $upfile = $_FILES[$fileid];
    if ($upfile["error"]!==0) {
        $err = $upfile["error"];
        $errMap = array(
            '1' => '文件大小超出服务器空间大小',
            '2' => '文件超出浏览器限制大小',
            '3' => '文件仅部分被上传',
            '4' => '未找到要上传的文件',
            '5' => '服务器临时文件丢失',
            '6' => '文件写入到临时文件出错',
        );  
        $errMsg = isset($errMap[$err]) ? $errMap[$err] : "文件未上传或上传失败";
        throw new Exception($errMsg);
    }   
    return $upfile;
}

function save_file($upfile)
{
    global $_G;
    $upload = new discuz_upload();
    if(!$upload->init($upfile, 'common', rand(0, 100000), 'reprint_' . md5_file($upfile['tmp_name']))) {
        throw new Exception("文件保存失败");
    }
    if(!$upload->save(1)){
        throw new Exception("文件存储失败");
    }
    $url = $upload->attach['attachment'];
    if(strpos($_G['setting']['attachurl'],'http') === false ){
        $url = $_G['siteurl'] . $_G['setting']['attachurl'] . 'common/' . $url;
    }else{
        $url = $_G['setting']['attachurl'] . 'common/' . $url;
    }
    
    return preg_replace('/\/source\/plugin\/reprint/i','',$url);
}



?>
