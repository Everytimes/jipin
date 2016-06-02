<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$moduleConfig = array(
    'module_cmd'       => "bindreg",
    'module_desc'      => "微信注册绑定",
	'power_id'         => '0',
	'module_ver'       => '1.0',
);

$moduleLang = array(
    'bind_title'  => '绑定论坛账号',
    'bind_no_reg' => '注册新论坛账号',
    'bind_reg'    => '手工注册',
    'bind_reg_msg'=> '完成注册后，会自动绑定到你的微信账号',
    'bind_yj'    => '一键注册',
    'bind_yj_msg'=> '系统自动生成用户名、密码完成注册绑定',
    'bind_yj_ok' => '一键注册由系统自动生成用户名、密码，登录电脑版论坛时不方便，确认是否继续使用一键注册？',
    'bind_yj_error' => '注册失败，请重试',
    'bind_yj_success'=> '注册绑定成功',
    'bind_zc_title'=> '使用已有账号绑定',
    'bind_zc_username' => '用户名',
    'bind_zc_password' => '密码',
    'bind_zc_btn'     => '绑定账号',
    'bind_user_succ'  => '你已经成功绑定论坛账号',
    'bind_user_unbind'  => '取消绑定',
    'bind_must_username' => '请填写用户名',
    'bind_must_password' => '请填写密码',
    'bind_error'        => '遇到错误，请重新绑定',
    'bind_success'      => '论坛账号绑定成功',
    'bind_up_error'     => '用户名或者密码输入不正确！',
    'unbind_ok'         => '你确定要取消绑定吗？',
    'unbind_error'      => '遇到错误，请重试！',
    'unbind_success'    => '取消绑定成功',
    'reg_title'         => '注册新账号',
    'reg_new_username'  => '注册新账号',
    'reg_msg'           => '完成注册后，会自动绑定到你的微信账号',
    'reg_username'      => '用户名',
    'reg_password'      => '密码',
    'reg_email'         => '邮箱',
    'reg_btn'           => '注册账号',
    'reg_must_username' => '请填写用户名',
    'reg_must_password' => '请填写密码',
    'reg_must_email'    => '请填写邮箱',
    'reg_error'         => '注册失败，请重试',
    'reg_success'       => '注册绑定成功',
    'reg_error201'      => '你的用户名小于3个字符，请输入较长的用户名',
    'reg_error202'      => '你的用户名超过15个字符，请输入较短的用户名',
    'reg_error203'      => '用户名包含被系统屏蔽的字符',
    'reg_error301'      => '用户名不合法',
    'reg_error302'      => '包含不允许注册的词语',
    'reg_error303'      => '用户名已经存在',
    'reg_error304'      => 'Email 格式有误',
    'reg_error305'      => 'Email 不允许注册',
    'reg_error306'      => '该 Email 已经被注册',
    
);

$moduleSettingExt = array(
    array(
        'type'   => 'input',
        'title'  => '图文标题',
        'name'   => 'title',
        'value'  => '微信注册绑定',
        'desc'   => '',
    ),
    array(
        'type'   => 'input',
        'title'  => '图文描述',
        'name'   => 'desc',
        'value'  => '微信注册绑定描述',
        'desc'   => '',
    ),
    array(
        'type'   => 'input',
        'title'  => '图片名',
        'name'   => 'img',
        'value'  => 'bindreg.png',
        'desc'   => '图片目录：source/plugin/tom_weixin/images/',
    ),
    array(
        'type'   => 'radio',
        'title'  => '是否开启手工注册',
        'name'   => 'is_reg',
        'value'  => '1',
        'desc'   => '开启手工注册，即允许用户可以通过微信平台自由注册',
        'item'   => array(
            '1' => "开启",
            '0' => "关闭",
        ),
    ),
    array(
        'type'   => 'radio',
        'title'  => '是否开启一键注册',
        'name'   => 'is_yj',
        'value'  => '1',
        'desc'   => '一键注册，由系统自动生成用户名和密码，一键注册的用户不方便在电脑版论坛登录',
        'item'   => array(
            '1' => "开启",
            '0' => "关闭",
        ),
    ),
);

?>