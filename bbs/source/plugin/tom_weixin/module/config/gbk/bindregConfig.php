<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$moduleConfig = array(
    'module_cmd'       => "bindreg",
    'module_desc'      => "΢��ע���",
	'power_id'         => '0',
	'module_ver'       => '1.0',
);

$moduleLang = array(
    'bind_title'  => '����̳�˺�',
    'bind_no_reg' => 'ע������̳�˺�',
    'bind_reg'    => '�ֹ�ע��',
    'bind_reg_msg'=> '���ע��󣬻��Զ��󶨵����΢���˺�',
    'bind_yj'    => 'һ��ע��',
    'bind_yj_msg'=> 'ϵͳ�Զ������û������������ע���',
    'bind_yj_ok' => 'һ��ע����ϵͳ�Զ������û��������룬��¼���԰���̳ʱ�����㣬ȷ���Ƿ����ʹ��һ��ע�᣿',
    'bind_yj_error' => 'ע��ʧ�ܣ�������',
    'bind_yj_success'=> 'ע��󶨳ɹ�',
    'bind_zc_title'=> 'ʹ�������˺Ű�',
    'bind_zc_username' => '�û���',
    'bind_zc_password' => '����',
    'bind_zc_btn'     => '���˺�',
    'bind_user_succ'  => '���Ѿ��ɹ�����̳�˺�',
    'bind_user_unbind'  => 'ȡ����',
    'bind_must_username' => '����д�û���',
    'bind_must_password' => '����д����',
    'bind_error'        => '�������������°�',
    'bind_success'      => '��̳�˺Ű󶨳ɹ�',
    'bind_up_error'     => '�û��������������벻��ȷ��',
    'unbind_ok'         => '��ȷ��Ҫȡ������',
    'unbind_error'      => '�������������ԣ�',
    'unbind_success'    => 'ȡ���󶨳ɹ�',
    'reg_title'         => 'ע�����˺�',
    'reg_new_username'  => 'ע�����˺�',
    'reg_msg'           => '���ע��󣬻��Զ��󶨵����΢���˺�',
    'reg_username'      => '�û���',
    'reg_password'      => '����',
    'reg_email'         => '����',
    'reg_btn'           => 'ע���˺�',
    'reg_must_username' => '����д�û���',
    'reg_must_password' => '����д����',
    'reg_must_email'    => '����д����',
    'reg_error'         => 'ע��ʧ�ܣ�������',
    'reg_success'       => 'ע��󶨳ɹ�',
    'reg_error201'      => '����û���С��3���ַ���������ϳ����û���',
    'reg_error202'      => '����û�������15���ַ���������϶̵��û���',
    'reg_error203'      => '�û���������ϵͳ���ε��ַ�',
    'reg_error301'      => '�û������Ϸ�',
    'reg_error302'      => '����������ע��Ĵ���',
    'reg_error303'      => '�û����Ѿ�����',
    'reg_error304'      => 'Email ��ʽ����',
    'reg_error305'      => 'Email ������ע��',
    'reg_error306'      => '�� Email �Ѿ���ע��',
    
);

$moduleSettingExt = array(
    array(
        'type'   => 'input',
        'title'  => 'ͼ�ı���',
        'name'   => 'title',
        'value'  => '΢��ע���',
        'desc'   => '',
    ),
    array(
        'type'   => 'input',
        'title'  => 'ͼ������',
        'name'   => 'desc',
        'value'  => '΢��ע�������',
        'desc'   => '',
    ),
    array(
        'type'   => 'input',
        'title'  => 'ͼƬ��',
        'name'   => 'img',
        'value'  => 'bindreg.png',
        'desc'   => 'ͼƬĿ¼��source/plugin/tom_weixin/images/',
    ),
    array(
        'type'   => 'radio',
        'title'  => '�Ƿ����ֹ�ע��',
        'name'   => 'is_reg',
        'value'  => '1',
        'desc'   => '�����ֹ�ע�ᣬ�������û�����ͨ��΢��ƽ̨����ע��',
        'item'   => array(
            '1' => "����",
            '0' => "�ر�",
        ),
    ),
    array(
        'type'   => 'radio',
        'title'  => '�Ƿ���һ��ע��',
        'name'   => 'is_yj',
        'value'  => '1',
        'desc'   => 'һ��ע�ᣬ��ϵͳ�Զ������û��������룬һ��ע����û��������ڵ��԰���̳��¼',
        'item'   => array(
            '1' => "����",
            '0' => "�ر�",
        ),
    ),
);

?>