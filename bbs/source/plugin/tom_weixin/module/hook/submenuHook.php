<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
} 

$submenuList = C::t('#tom_weixin#tom_weixin_submenu')->fetch_all_list("*","",10);
if(is_array($submenuList) && !empty($submenuList)){
    $outArr = array(
            'type'      => 'news',
            'content'   => '',
        );
    foreach ($submenuList as $key => $value) {
        if(strpos($value['url'], "{openid}") !== false){
            $value['url'] = str_replace("{openid}", $openid, $value['url']);
        }else{
            if(strpos($value['url'], "?") !== false){
                $value['url'] = $value['url']."&openid=".$openid;
            } 
        }
        $newsItem = array(
            'title' => $value['title'],
            'description' => $value['description'],
            'picUrl' => $value['picurl'],
            'url' => $value['url'],
        );
        $outArr['content'][] = $newsItem;
        $isDoHookContent = true;
        $exitHookScript = true;
    }
}
?>
