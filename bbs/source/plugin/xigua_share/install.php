<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$pluginid = 'xigua_share';

$Hooks = array(
    'forumdisplay_mobilesign',
    'viewthread_threadBottom',
    'viewthread_threadTop',
    'viewthread_variables'
);

$data = array();
foreach ($Hooks as $Hook) {
    $data[] = array(
        $Hook => array(
            'plugin' => $pluginid,
            'include' => 'api.class.php',
            'class' => $pluginid,
            'method' => $Hook)
    );
}

require_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';
WeChatHook::updateAPIHook($data);


$finish = TRUE;