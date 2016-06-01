<?php
if (!defined('IN_MOBILE_API')) {
    exit('Access Denied');
}
$_GET['mobile'] = 'no';

require './source/class/class_core.php';
$discuz = C::app();
$discuz->init();
require_once dirname(__FILE__)."/../../libs/env.class.php";
admin_check();


$subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
$message = isset($_POST["message"]) ? $_POST["message"] : "";
$fid     = isset($_POST["fid"]) ? $_POST["fid"] : 0;
$stick   = isset($_POST["stick"]) ? $_POST["stick"] : 0;
$fromurl = isset($_POST["fromurl"]) ? $_POST["fromurl"] : "";
if ($subject=="" || $message=="" || $fid==0) {
	reprint_env::result(array("retcode"=>100001,"retmsg"=>"invalid params"));
}
$subject = iconv("UTF-8", CHARSET."//ignore", $subject);
$message = iconv("UTF-8", CHARSET."//ignore", $message);


$modthread = C::m('forum_thread');
include_once libfile('function/forum');
loadforum($fid);
$modthread->forum = $modthread->app->var['forum'];


$params = array(
	'subject' => $subject,
	'message' => $message,
    "typeid" => 0,
    "sortid" => 0,
    "special" => 0,
    "publishdate"=>time(),
    "save" => "",
    "sticktopic" => null,
    "digest" => null,
    "readperm" => 0,
    "isanonymous" => null,
    "typeexpiration" => null,
    "ordertype" => null,
    "hiddenreplies" => null,
    "allownoticeauthor" => 1,
    "tags" => "",
    "bbcodeoff" => null,
    "smileyoff" => null,
    "parseurloff" => null,
    "usesig" => 1,
    "htmlon" => null,
    "geoloc" => null,
);

$return = $modthread->newthread($params);
$tid = $modthread->tid;
if ($tid==0) {
    reprint_env::result(array("retcode"=>100002,"retmsg"=>"帖子发表失败"));
}




C::t('#reprint#reprint_thread')->addThread($tid, $fromurl, $_G['username']);


$ret = array (
    "retcode" => 0,
    "retmsg"  => $return,
    "tid" => $tid,
);
reprint_env::result($ret);



?>
