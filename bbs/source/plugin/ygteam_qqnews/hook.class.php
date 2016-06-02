<?php
/**
 *	[[YGTEAM]╥бQQпбнесроб╫г╣╞╢╟(ygteam_qqnews.{modulename})] (C)2015-2099 Powered by [YGTEAM]blog.loldan.com.
 *	Version: 1.0
 *	Date: 2015-11-1 09:30
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_ygteam_qqnews {
	function global_footer(){
		loadcache('plugin');
		global $_G;
		$st = $_G['cache']['plugin']['ygteam_qqnews'];
		$ygteam_html = '';
		if($st['ifopen']){
			include_once template('ygteam_qqnews:hook_footer');
		}
		return $ygteam_html;
	}
}
class plugin_ygteam_qqnews_forum extends plugin_ygteam_qqnews {

}
?>