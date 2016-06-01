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

class lshl_tzydh_api {

	//forumdisplay

	function  viewthread_topBar() {

		require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';

        global $_G;
		
		$topurl=$_G['cache']['plugin']['lshl_tzydh']['tz_top_url'];
		//$adname=$_G['cache']['plugin']['lshl_tzydh']['ad_name'];

		$dh101=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_01'];
		$dh101pic=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_01pic'];
		$dh101url=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_01url'];
		$dh1_01col=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_01col'];
		
		$dh102=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_02'];
		$dh102pic=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_02pic'];
		$dh102url=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_02url'];
		$dh1_02col=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_02col'];
		
		$dh103=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_03'];
		$dh103pic=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_03pic'];
		$dh103url=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_03url'];
		$dh1_03col=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_03col'];
		
		$dh104=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_04'];
		$dh104pic=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_04pic'];
		$dh104url=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_04url'];
		$dh1_04col=$_G['cache']['plugin']['lshl_tzydh']['tz_dh1_04col'];
		
		$dh_html1 = '<table width="100%" border="0">
  <tr>
    <td width="25%" height="" border="0" ><p align="center"><a href="'.$dh101url.'"><img src="'.$topurl.$dh101pic.'" width="60%"/></a></p><p align="center"><font color="'.$dh1_01col.'" size="3">'.$dh101.'</font></p></td>
    <td width="25%" height="" border="0" ><p align="center"><a href="'.$dh102url.'"><img src="'.$topurl.$dh102pic.'" width="60%"/></a></p><p align="center"><font color="'.$dh1_02col.'" size="3">'.$dh102.'</font></p></td>
    <td width="25%" height="" border="0" ><p align="center"><a href="'.$dh103url.'"><img src="'.$topurl.$dh103pic.'" width="60%"/></a></p><p align="center"><font color="'.$dh1_03col.'" size="3">'.$dh103.'</font></p></td>
    <td width="25%" height="" border="0" ><p align="center"><a href="'.$dh104url.'"><img src="'.$topurl.$dh104pic.'" width="60%"/></a></p><p align="center"><font color="'.$dh1_04col.'" size="3">'.$dh104.'</font></p></td>
  </tr>
</table>';

		return $dh_html1;

	}


}



?>

