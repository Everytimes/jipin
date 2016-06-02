<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$moduleConfig = array(
    'module_cmd'       => "twmenu",
    'module_desc'      => "多功能图文菜单",
	'power_id'         => '0',
	'module_ver'       => '1.2',
    'admin'            => '1',
    'admin_name'       => '设置图文菜单',
    'is_menu'          => '1',
);

$moduleLang = array(
    'twmenu_help_title' => '图文菜单设置帮助',
    'twmenu_help_1'     => "1、<b>多功能图文菜单特点：支持多指令、多图文、指令模糊匹配、论坛链接自动登录</b>",
    'twmenu_help_2'     => "2、图文菜单，第一条图片地址需要为大图；每一条图文菜单指令对应图文列表最多显示10条内容",
    'twmenu_help_3'     => '3、大转盘、刮刮卡、微信投票等TOM微信应用，添加到图文列表时，链接地址填写需要根据TOM微信官方给定的规则填写：<a href="http://www.tomwx.net/index.php?m=help&t=plugin&pluginid=tom_weixin&faqid=56#helpcontent" target="_blank"><font color="#FF0000">点击查看</font></a>',
    'twmeun_search_title'=> '指令列表搜索',
    'twmeun_search_cmd' => '搜索指令：',
    'twmenu_list_title' => '图文菜单列表',
    'twmenu_list'       => '图文菜单列表管理',
    'twmenu_list_back'  => '<<< 返回列表管理',
    'twmenu_add'        => '添加图文菜单链接',
    'twmenu_edit'       => '编辑',
    'cmd'               => '菜单指令',
    'cmd_msg'           => '关联的菜单指令，可以填写多个，如:菜单指令1|菜单指令2|菜单指令3 （多个用“|”隔开，最多5个）',
    'title'             => '标题',
    'title_msg'         => '标题必须填写',
    'description'       => '描述',
    'description_msg'   => '菜单描述，当指令只有一条图文链接时必须填写',
    'picurl'            => '图片地址',
    'picurl_msg'        => '图文菜单第一条，图片需要为大图',
    'url'               => '链接',
    'url_msg'           => '大转盘、刮刮卡、婚恋交友等TOM微信应用，链接地址填写需要根据TOM微信官方给定的规则填写：<a href="http://www.tomwx.net/index.php?m=help&t=plugin&pluginid=tom_weixin&faqid=56#helpcontent" target="_blank"><font color="#FF0000">点击查看</font></a>',
    'login'             => '自动登录',
    'login_ok'          => '是',
    'login_no'          => '否',
    'login_msg'         => '当链接是论坛首页，版块页，帖子页，可以选择自动登录，实现绑定用户自动登录（目前只能实现手机版自动登录）',
    'paixu'             => '排序',
    
);

$moduleSettingExt = array(
);

?>