<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$moduleConfig = array(
    'module_cmd'       => "new",
    'module_desc'      => "最新帖子",
	'power_id'         => '0',
	'module_ver'       => '1.4',
);

$moduleLang = array(
    'no_new_book' => '没有最新帖子',
);

$moduleSettingExt = array(
    array(
        'type'   => 'input',
        'title'  => '帖子版块ID',
        'name'   => 'fid',
        'value'  => '0',
        'desc'   => '填写帖子所在论坛板块ID，多版块用“英文”逗号隔开：1,2,3 （留空则全部板块）',
    ),
    array(
        'type'   => 'input',
        'title'  => '显示帖子数量',
        'name'   => 'num',
        'value'  => '10',
        'desc'   => '设置帖子列表的帖子数量，不能大于10条',
    ),
    array(
        'type'   => 'radio',
        'title'  => '只显示图片贴',
        'name'   => 'is_image',
        'value'  => '0',
        'desc'   => '是否只显示有图片附件的帖子；无图时使用随机图片：[<a href="http://addon.discuz.com/?@tom_weixin.plugin.40833" target="_blank"><font color="#FF0000">安装帖子列表随机图片组件</font></a>]',
        'item'   => array(
            '1' => "是",
            '0' => "否",
        ),
    ),
);

?>