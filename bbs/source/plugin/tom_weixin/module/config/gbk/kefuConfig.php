<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$moduleConfig = array(
    'module_cmd'       => "kefu",
    'module_desc'      => "微信多客服",
	'power_id'         => '0',
	'module_ver'       => '1.1',
);

$moduleLang = array(
);

$moduleSettingExt = array(
    array(
        'type'   => 'textarea',
        'title'  => '进入客服提示',
        'name'   => 'kf_msg',
        'value'  => "已经进入客服模式，你可以发送内容和客服聊天了",
        'desc'   => '设置进入客服提示',
        'rows'   => 5,
        'cols'   => 30,
    ),
);

?>