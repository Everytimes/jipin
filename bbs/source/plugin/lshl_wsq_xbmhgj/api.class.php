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

class lshl_wsq_xbmhgj_api {

	function forumdisplay_authorInfo() {

		$return = array();
		global $_G;
		$xbmh_sitekg=$_G['cache']['plugin']['lshl_wsq_xbmhgj']['xbmh_sitekg'];
		$xbnan = $_G['cache']['plugin']['lshl_wsq_xbmhgj']['xbmh_xbnan'];
		$xbnv = $_G['cache']['plugin']['lshl_wsq_xbmhgj']['xbmh_xbnv'];
		
		if($xbmh_sitekg == 0 ){
		    //默认自动获取网站url
		    $nanpic = $_G['siteurl'].$xbnan;
		    $nvpic = $_G['siteurl'].$xbnv;	    
		}
		else{
		    $nanpic =$xbnan;
		    $nvpic = $xbnv;	    
		}

		foreach($GLOBALS['threadlist'] as $thread) {
		
      $xingbie3=DB::fetch_all('SELECT * FROM %t where uid='.$thread['authorid'].'',array('common_member_profile'));
      if(!empty($xingbie3)){
            $xingbie2=serialize($xingbie3);
            $xingbie1=strstr($xingbie2,"gender");
            $xingbie =substr($xingbie1,13,1);
      }
     else{
            //获取失败 则默认为保密
            $xingbie = "0";
      }
			//$return[$thread['authorid']] = '[authorInfo-forumdisplay/'.$thread['authorid'].']';
      if($xingbie=="1"){
          $return[$thread['authorid']] = '<img src="'.$nanpic.'"  with="100%" /> ';
			}
			elseif($xingbie=="2"){
          $return[$thread['authorid']] = '<img src="'.$nvpic.'"  with="100%" />';
			}
			else{
          $return[$thread['authorid']] ='';
			}
    }
		return $return;



	}
	
	function viewthread_authorInfo() {
		global $_G;
		$xbmh_sitekg=$_G['cache']['plugin']['lshl_wsq_xbmhgj']['xbmh_sitekg'];
		$xbnan = $_G['cache']['plugin']['lshl_wsq_xbmhgj']['xbmh_xbnan'];
		$xbnv = $_G['cache']['plugin']['lshl_wsq_xbmhgj']['xbmh_xbnv'];
		
		if($xbmh_sitekg == 0 ){
		    //默认自动获取网站url
		    $nanpic = $_G['siteurl'].$xbnan;
		    $nvpic = $_G['siteurl'].$xbnv;	    
		}
		else{
		    $nanpic =$xbnan;
		    $nvpic = $xbnv;	    
		}
	
		$return = array();
		foreach($GLOBALS['postlist'] as $post) {
			//$return[$post['authorid']] = '[性别/'.$post['gender'].']';
			if($post['gender']==1){
          $return[$post['authorid']] = '<img src="'.$nanpic.'"  with="100%" /> ';
			}
			elseif($post['gender']==2){
          $return[$post['authorid']] = '<img src="'.$nvpic.'"  with="100%" />';
			}
			else{
          $return[$post['authorid']] ='';
			}
			//$data='<img src="http://www.lansehulian.cn/dz/source/plugin/lshl_wsq_xbmh/pic/1.gif"  with="100%" /> ';
			//$return[$post['authorid']] = $_G['siteurl'].$data;
		}
		return $return;
	}


}

?>
