<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$moduleConfig = array(
    'module_cmd'       => "kefu",
    'module_desc'      => "΢�Ŷ�ͷ�",
	'power_id'         => '0',
	'module_ver'       => '1.1',
);

$moduleLang = array(
);

$moduleSettingExt = array(
    array(
        'type'   => 'textarea',
        'title'  => '����ͷ���ʾ',
        'name'   => 'kf_msg',
        'value'  => "�Ѿ�����ͷ�ģʽ������Է������ݺͿͷ�������",
        'desc'   => '���ý���ͷ���ʾ',
        'rows'   => 5,
        'cols'   => 30,
    ),
);

?>