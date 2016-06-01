<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$moduleConfig = array(
    'module_cmd'       => "submenu",
    'module_desc'      => "关注图文回复",
	'power_id'         => '0',
	'module_ver'       => '1.2',
    'admin'            => '1',
    'admin_name'       => '设置关注回复',
    'is_menu'          => '1',
);

$moduleLang = array(
    'submenu_help_title' => '关注回复设置帮助',
    'submenu_help_1'     => "1、关注回复图文列表，第一条图片地址需要为大图",
    'submenu_help_2'     => "2、关注回复图文列表最多显示10条内容",
    'submenu_help_3'     => '3、大转盘、刮刮卡、婚恋交友等TOM微信应用，添加到关注回复图文列表时，链接地址填写需要根据TOM微信官方给定的规则填写：<a href="http://www.tomwx.net/index.php?m=help&t=plugin&pluginid=tom_weixin&faqid=56#helpcontent" target="_blank"><font color="#FF0000">点击查看</font></a>',
    
    'submenu_list_title' => '关注回复列表',
    'submenu_list'       => '关注回复列表管理',
    'submenu_list_back'  => '<<< 返回列表管理',
    'submenu_add'       => '添加关注图文链接',
    'submenu_edit'       => '编辑',
    'title'             => '标题',
    'title_msg'         => '标题必须填写',
    'description'       => '描述',
    'description_msg'   => '菜单描述，当只有一条图文链接时必须填写',
    'picurl'            => '图片地址',
    'picurl_msg'        => '图文菜单第一条，图片需要为大图',
    'url'               => '链接',
    'url_msg'           => '大转盘、刮刮卡、婚恋交友等TOM微信应用，链接地址填写需要根据TOM微信官方给定的规则填写：<a href="http://www.tomwx.net/index.php?m=help&t=plugin&pluginid=tom_weixin&faqid=56#helpcontent" target="_blank"><font color="#FF0000">点击查看</font></a>',
    'paixu'             => '排序',
);

$moduleSettingExt = array(
);

?>