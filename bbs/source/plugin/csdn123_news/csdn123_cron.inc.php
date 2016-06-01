<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function csdn123_fidtoname($fid)
{
	return DB::result_first("select `name` from " . DB::table("forum_forum") . " where fid=" . $fid);
}

if(empty($_GET["csdn123_cron"])==false && $_GET["csdn123_cron"]=="yes")
{

	if(strlen($_GET["csdn123_keyword"])>2)
	{
		$csdn123_zd_cron_data=array();
		$csdn123_zd_cron_data['csdn123_keyword']=$_GET["csdn123_keyword"];
		$csdn123_zd_cron_data['csdn123_fromtype']=dintval($_GET["csdn123_fromtype"]);
		$csdn123_zd_cron_data['csdn123_showfromurl']=$_GET["csdn123_showfromurl"];
		$csdn123_zd_cron_data['csdn123_importfid']=dintval($_GET["csdn123_importfid"]);
		DB::insert("zd_cron",$csdn123_zd_cron_data);
	}
	$csdn123_fromtype_arr=array();
	$csdn123_fromtype_arr[0]=lang('plugin/csdn123_news', 'csdn123_allfrom');
	$csdn123_fromtype_arr[1]=lang('plugin/csdn123_news', 'csdn123_fromweixin');
	$csdn123_fromtype_arr[2]=lang('plugin/csdn123_news', 'csdn123_fromgoodnews');
	$csdn123_fromtype_arr[3]=lang('plugin/csdn123_news', 'csdn123_fromhaha');
	$csdn123_fromtype_arr[4]=lang('plugin/csdn123_news', 'csdn123_fromvideo');
	$csdn123_fromtype_arr[5]=lang('plugin/csdn123_news', 'csdn123_fromimg');
	$csdn123_showfromurl_arr=array();
	$csdn123_showfromurl_arr[0]=lang('plugin/csdn123_news', 'csdn123_no');
	$csdn123_showfromurl_arr[1]=lang('plugin/csdn123_news', 'csdn123_yes');
	$csdn123_cron_list=DB::fetch_all("select * from " . DB::table("zd_cron") . " order by id desc");
	include template('csdn123_news:catch_cron_list');
	

} elseif(empty($_GET["csdn123_delid"])==false && is_numeric($_GET["csdn123_delid"])==true) {
	
	$csdn123_delid=dintval($_GET["csdn123_delid"]);
	if(DB::delete("zd_cron","id=" . $csdn123_delid))
	{
		echo 'delete_id_' . $csdn123_delid;
	}
	
} else {
	
	$csdn123_fid=DB::fetch_all("select fid,name from " . DB::table('forum_forum') . " where type='forum' and status=1 order by displayorder,fid");
	include template('csdn123_news:catch_form_cron');
	
}


?>