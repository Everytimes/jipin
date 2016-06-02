<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install.php 34718 2014-07-14 08:56:39Z nemohou $
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$pluginid = 'xigua_member';

$Hooks = array(
    'profile_extraInfo'
);

$data = array();
foreach($Hooks as $Hook) {
    $data[] = array($Hook => array('plugin' => $pluginid, 'include' => 'api.class.php', 'class' => $pluginid, 'method' => $Hook));
}

require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
WeChatHook::updateAPIHook($data);

$sql = <<<SQL
CREATE TABLE IF NOT EXISTS `pre_plugin_xigua_member` (
 `logid` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `uid` int(11) unsigned NOT NULL,
 `crts` int(11) unsigned NOT NULL,
 `oldname` varchar(200) NOT NULL,
 `newname` varchar(200) NOT NULL,
 `usetype` varchar(100) NOT NULL DEFAULT '',
 PRIMARY KEY (`logid`),
 KEY `uid` (`uid`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `pre_plugin_xigua_member_count` (
 `uid` int(11) unsigned NOT NULL,
 `counter` int(11) unsigned NOT NULL DEFAULT '0',
 PRIMARY KEY (`uid`)
) ENGINE=InnoDB
SQL;
runquery($sql);

@unlink(DISCUZ_ROOT . './source/plugin/xigua_member/discuz_plugin_xigua_member.xml');
@unlink(DISCUZ_ROOT . './source/plugin/xigua_beauty_wsq/discuz_plugin_xigua_member_SC_GBK.xml');
@unlink(DISCUZ_ROOT . './source/plugin/xigua_beauty_wsq/discuz_plugin_xigua_member_SC_UTF8.xml');
@unlink(DISCUZ_ROOT . './source/plugin/xigua_beauty_wsq/discuz_plugin_xigua_member_TC_BIG5.xml');
@unlink(DISCUZ_ROOT . './source/plugin/xigua_beauty_wsq/discuz_plugin_xigua_member_TC_UTF8.xml');

$finish = TRUE;