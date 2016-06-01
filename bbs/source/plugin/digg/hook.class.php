<?php
/*
 * 应用中心主页：http://addon.discuz.com/?@ailab
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ594941227
 * From www.ailab.cn
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_digg {
	function __construct(){
	}
}
class plugin_digg_forum extends plugin_digg {
	function viewthread_modaction(){
		loadcache('plugin');
		global $_G;	
		$langvar=lang('forum/template');
		$recommend_add=$_G['thread']['recommend_add'];
		$recommend_sub=$_G['thread']['recommend_sub'];
		$recommends=$recommend_add+$recommend_sub;
		$rate_add=round(100*$recommend_add/$recommends,2);
		$rate_sub=round(100-$rate_add,2);
		include template('digg:digg');	
		return $return;	
	}
	
	function viewthread_bottom(){
		return "<script type=\"text/javascript\">
$('recommend_add').style.display='none';
$('recommend_subtract').style.display='none';
</script>";
	}
}
?>