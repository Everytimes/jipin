<?php
/**
 *	[【西瓜】微社区清理缓存] (C)2015-2099 Powered by 西瓜先生.
 *	Version: 1.20150301
 *	Date: 2015-3-6 16:25
 *	Warning: Don't delete this comment
 *
 *	cronname:clear
 *	week:-1
 *	day:-1
 *	hour:2
 *	minute:19
 *	desc:清理微社区美化缓存
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/xigua_beauty_wsq/function.php';
xgb_delete_all(DISCUZ_ROOT . 'data/sysdata/xigua_beauty_cache', true);
