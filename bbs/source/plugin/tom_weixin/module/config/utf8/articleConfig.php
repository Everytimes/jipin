<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$moduleConfig = array(
    'module_cmd'       => "article",
    'module_desc'      => "文章显示页",
	'power_id'         => '0',
	'module_ver'       => '1.0',
    'is_menu'          => '2',
);

$moduleLang = array();

$moduleSettingExt = array(
    array(
        'type'   => 'textarea',
        'title'  => '广告代码',
        'name'   => 'adscontent',
        'value'  => "请填写广告代码",
        'desc'   => '可以自行添加广告代码',
        'rows'   => 20,
        'cols'   => 80,
    ),
);

?>