<?php
/*
	���ߣ���;
	��ַ��http://www.nciaer.com
	ʱ�䣺2016.01.06
	QQ: 1069971363
*/
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_nciaer_qqservice {
	
	public function global_cpnav_top() {
		
		global $_G;
		extract($_G["cache"]["plugin"]["nciaer_qqservice"]);
		include template("nciaer_qqservice:index");
		return $return;
	}
}