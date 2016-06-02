<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$outArr = array(
            'type'      => 'text',
            'content'   => '',
        );

$moduleActivity = $activityClass->getActivityData($tomActivity);
if(!$tomActivityStatus || empty($moduleActivity)){
    $moduleActivity['step'] = 'inkefu';
    $activityClass->add($moduleActivity);
    $outArr['content'] = $moduleSetting['kf_msg'];
}else{
    if($moduleActivity['step'] == 'inkefu'){
        
        $postStr = file_get_contents("php://input");
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            if(is_object($postObj)){
                $toUserName      = $postObj->ToUserName;
                $fromUserName    = $postObj->FromUserName;
            }
        }
        
        $kfTpl = "<xml>
                      <ToUserName><![CDATA[%s]]></ToUserName>
                      <FromUserName><![CDATA[%s]]></FromUserName>
                      <CreateTime>%s</CreateTime>
                      <MsgType><![CDATA[transfer_customer_service]]></MsgType>
                  </xml>";
        $kefuResult = sprintf($kfTpl,$fromUserName,$toUserName,TIMESTAMP);
        
        $activityClass->delete();
        echo $kefuResult;exit;
        $moduleActivity = array();
    }
}


?>