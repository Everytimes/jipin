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



class lshl_jjdh_api {



	//forumdisplay


	function forumdisplay_headerBar() {

		require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';

        global $_G;
		
		$topurl=$_G['cache']['plugin']['lshl_jjdh']['jj_top_url'];
		//$adname=$_G['cache']['plugin']['lshl_jjdh']['ad_name'];
		$picurl=$_G['cache']['plugin']['lshl_jjdh']['jj_pic_url'];
		$lianjieurl=$_G['cache']['plugin']['lshl_jjdh']['jj_lianjie_url'];
		
		//kg
		$pickg=$_G['cache']['plugin']['lshl_jjdh']['jj_pic_kg'];
		$dh2kg=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_kg'];
		//$dh101=$_G['cache']['plugin']['lshl_jjdh']['dh1_01'];
		
				
		$dh101=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_01'];
		$dh101pic=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_01pic'];
		$dh101url=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_01url'];
		$dh1_01col=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_01col'];
		
		$dh102=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_02'];
		$dh102pic=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_02pic'];
		$dh102url=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_02url'];
		$dh1_02col=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_02col'];
		
		$dh103=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_03'];
		$dh103pic=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_03pic'];
		$dh103url=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_03url'];
		$dh1_03col=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_03col'];
		
		$dh104=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_04'];
		$dh104pic=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_04pic'];
		$dh104url=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_04url'];
		$dh1_04col=$_G['cache']['plugin']['lshl_jjdh']['jj_dh1_04col'];
		//------------------------------02-------------------------------------
		$dh201=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_01'];
		$dh201pic=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_01pic'];
		$dh201url=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_01url'];
		$dh2_01col=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_01col'];
		
		$dh202=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_02'];
		$dh202pic=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_02pic'];
		$dh202url=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_02url'];
		$dh2_02col=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_02col'];
		
		$dh203=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_03'];
		$dh203pic=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_03pic'];
		$dh203url=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_03url'];
		$dh2_03col=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_03col'];
		
		$dh204=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_04'];
		$dh204pic=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_04pic'];
		$dh204url=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_04url'];
		$dh2_04col=$_G['cache']['plugin']['lshl_jjdh']['jj_dh2_04col'];
		
		$dh_html = '<a href='.$lianjieurl.'><img src="'.$topurl.$picurl.'" width="100%" height="72" border="0" /></a>';
		
		$dh_html1 = '<table width="100%" border="0">
  <tr>
    <td width="25%" height="" border="0" ><p align="center"><a href="'.$dh101url.'"><img src="'.$topurl.$dh101pic.'" width="60%"/></a></p><p align="center"><font color="'.$dh1_01col.'" size="2">'.$dh101.'</font></p></td>
    <td width="25%" height="" border="0" ><p align="center"><a href="'.$dh102url.'"><img src="'.$topurl.$dh102pic.'" width="60%"/></a></p><p align="center"><font color="'.$dh1_02col.'" size="2">'.$dh102.'</font></p></td>
    <td width="25%" height="" border="0" ><p align="center"><a href="'.$dh103url.'"><img src="'.$topurl.$dh103pic.'" width="60%"/></a></p><p align="center"><font color="'.$dh1_03col.'" size="2">'.$dh103.'</font></p></td>
    <td width="25%" height="" border="0" ><p align="center"><a href="'.$dh104url.'"><img src="'.$topurl.$dh104pic.'" width="60%"/></a></p><p align="center"><font color="'.$dh1_04col.'" size="2">'.$dh104.'</font></p></td>
  </tr>
</table>';

		$dh_html2 = '<table width="100%" border="0">
  <tr>
    <td width="25%" height="" border="0" ><p align="center"><a href="'.$dh201url.'"><img src="'.$topurl.$dh201pic.'" width="60%"/></a></p><p align="center"><font color="'.$dh2_01col.'" size="2">'.$dh201.'</font></p></td>
    <td width="25%" height="" border="0" ><p align="center"><a href="'.$dh202url.'"><img src="'.$topurl.$dh202pic.'" width="60%"/></a></p><p align="center"><font color="'.$dh2_02col.'" size="2">'.$dh202.'</font></p></td>
    <td width="25%" height="" border="0" ><p align="center"><a href="'.$dh203url.'"><img src="'.$topurl.$dh203pic.'" width="60%"/></a></p><p align="center"><font color="'.$dh2_03col.'" size="2">'.$dh203.'</font></p></td>
    <td width="25%" height="" border="0" ><p align="center"><a href="'.$dh204url.'"><img src="'.$topurl.$dh204pic.'" width="60%"/></a></p><p align="center"><font color="'.$dh2_04col.'" size="2">'.$dh204.'</font></p></td>
  </tr>
</table>';
		
		if($pickg==1&&$dh2kg==1){
      return $dh_html.$dh_html1.$dh_html2;
		}
		if($pickg==1&&$dh2kg==0){
      return $dh_html.$dh_html1;
		}
		if($pickg==0&&$dh2kg==1){
		  return $dh_html1.$dh_html2;
		}
		if($pickg==0&&$dh2kg==0){
		  return $dh_html1;
		}

	}





}



?>

