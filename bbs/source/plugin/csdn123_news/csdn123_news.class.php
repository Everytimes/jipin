<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_csdn123_news {

	protected static $csdn123_conf = array();
	public function plugin_csdn123_news() {
		
		global $_G;
		if(!isset($_G['cache']['plugin'])){
			loadcache('plugin');
		}
		self::$csdn123_conf=$_G['cache']['plugin']['csdn123_news'];
		self::$csdn123_conf["server"]="http://csdn123.0762so.net";
		$csdn123_keywords = self::$csdn123_conf['csdn123_keywords'];
		$csdn123_keywordsArr=explode(',',$csdn123_keywords);
		$csdn123_keywords="";
		foreach($csdn123_keywordsArr as $csdn123_keywordsValue)
		{
			$csdn123_keywords=$csdn123_keywords . '<a href="javascript:csdn123_keyword(\'' . $csdn123_keywordsValue . '\')">' . $csdn123_keywordsValue . '</a>&nbsp;|&nbsp;';
		}
		self::$csdn123_conf['csdn123_keywords']=$csdn123_keywords;

	}

}

class plugin_csdn123_news_forum extends plugin_csdn123_news {

	public function post_top_output() {
		
		global $_G;		
		$csdn123_usegroups = self::$csdn123_conf['csdn123_usegroups'];
		$csdn123_usegroups = (array)unserialize($csdn123_usegroups);
		if($_G['adminid']==1 || in_array($_G['groupid'],$csdn123_usegroups))
		{
			$csdn123_usegroups=true;
		} else {
			$csdn123_usegroups=false;
		}
		$csdn123_fid = self::$csdn123_conf['csdn123_fid'];
		$csdn123_fid = (array)unserialize($csdn123_fid);
		if(empty($csdn123_fid[0]) || in_array($_GET['fid'],$csdn123_fid))
		{
			$csdn123_fid=true;
		}else {
			$csdn123_fid=false;
		}
		$csdn123_server = self::$csdn123_conf["server"];
		$csdn123_keywords = self::$csdn123_conf['csdn123_keywords'];
		if($csdn123_usegroups && $csdn123_fid)
		{
			include template('csdn123_news:post_forum');
			return $return;
		}

		
	}
	
}

class plugin_csdn123_news_portal extends plugin_csdn123_news  {
	
	public function portalcp_top_output(){
		
		global $_G;
		$csdn123_server = self::$csdn123_conf["server"];
		$csdn123_keywords = self::$csdn123_conf['csdn123_keywords'];
		include template('csdn123_news:post_portal');
		return $return;
		
	}	
}

class plugin_csdn123_news_group extends plugin_csdn123_news  {
	
	public function post_top_output() {
		
		global $_G;		
		$csdn123_usegroups = self::$csdn123_conf['csdn123_usegroups'];
		$csdn123_usegroups = (array)unserialize($csdn123_usegroups);
		if($_G['adminid']==1 || in_array($_G['groupid'],$csdn123_usegroups))
		{
			$csdn123_usegroups=true;
		} else {
			$csdn123_usegroups=false;
		}
		$csdn123_server = self::$csdn123_conf["server"];
		$csdn123_keywords = self::$csdn123_conf['csdn123_keywords'];
		if($csdn123_usegroups)
		{
			include template('csdn123_news:post_group');
			return $return;
		}

		
	}

}


?>