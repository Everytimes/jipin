<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$outArr = array(
            'type'      => 'news',
            'content'   => '',
        );

$newsItem = array(
    'title' => $moduleSetting['title'],
    'description' => $moduleSetting['desc'],
    'picUrl' => TOM_SITEURL.'source/plugin/tom_weixin/images/'.$moduleSetting['img'],
    'url' => TOM_SITEURL.'plugin.php?id=tom_weixin:front&moduleAction=bind&wxid='.$openid,
);
$outArr['content'][] = $newsItem;
?>