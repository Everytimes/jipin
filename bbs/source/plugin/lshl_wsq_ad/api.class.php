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

class lshl_wsq_ad_api {

	//forumdisplay


	function forumdisplay_topBar() {
		require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';

        global $_G;
		
		$topurl=$_G['cache']['plugin']['lshl_wsq_ad']['top_url'];
		$adname=$_G['cache']['plugin']['lshl_wsq_ad']['ad_name'];
		$picurl=$_G['cache']['plugin']['lshl_wsq_ad']['pic_url'];
		$lianjieurl=$_G['cache']['plugin']['lshl_wsq_ad']['lianjie_url'];

		$return = array();
		
		$dh_html = '<a href='.$lianjieurl.'><img src="'.$topurl.$picurl.'" width="100%" height="70%" border="0" /></a>';

		$return[] = array(

		    'name' => $adname,

		    'html' => $dh_html,

		);

		return $return;
	}

	//viewthread


}

?>
