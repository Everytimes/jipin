<?php
/**
 *
 * Author: 24203741@qq.com
 *
 * Date: 2013/12/20 Mr.Will $
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!isset($_G['cache']['plugin'])){
	loadcache('plugin');
}

class plugin_man_dh{
	public function __construct() {}

	public function global_header() {
		global $_G;
		$nav = $_G['cache']['plugin']['man_dh'];
		if (!empty($nav)) {
			@extract($nav);
		} 


		include template('man_dh:subnav');
		return $return;		
	}
}

?>