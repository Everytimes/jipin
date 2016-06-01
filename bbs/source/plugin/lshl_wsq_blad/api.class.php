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

class lshl_wsq_blad_api {

	//forumdisplay  ad_weizhi

	function forumdisplay_sideBar() {
		require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';

		global $_G;

		$topurl=$_G['cache']['plugin']['lshl_wsq_blad']['top_url'];
		$blad1pic=$_G['cache']['plugin']['lshl_wsq_blad']['bl_ad1pic'];
		$blad2pic=$_G['cache']['plugin']['lshl_wsq_blad']['bl_ad2pic'];
		$blad1url=$_G['cache']['plugin']['lshl_wsq_blad']['bl_ad1url'];
		$blad2url=$_G['cache']['plugin']['lshl_wsq_blad']['bl_ad2url'];
		

		//$bl_html = '<img src="'.$topurl.$blad1pic.'" width="100%" height="50" border="0" /></a>';
		$bl_html = '<a href='.$blad1url.' ><img src="'.$topurl.$blad1pic.'" width="100%" height="50" border="1" /><br><a href='.$blad2url.' ><img src="'.$topurl.$blad2pic.'" width="100%" height="50" border="1" /></a>';

		return $bl_html;
	}

}

?>
