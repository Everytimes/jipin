<?php

//cronname:csdn123_news
//week:
//day:
//hour:12
//minute:

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function csdn123_import_news($csdn123_id)
{

	$csdn123_news=DB::fetch_first("select * from " . DB::table("zd_news") . " where is_import is null and id=" . dintval($csdn123_id));
	if(empty($csdn123_news))
	{
		return "hezhiwu_no";
		
	} else {

		$zd_news_arr=array('is_import'=>1);
		DB::update("zd_news",$zd_news_arr,'id=' . dintval($csdn123_id));
		$csdn123_fid=$csdn123_news["fid"];
		$csdn123_title=$csdn123_news["title"];
		$csdn123_time=time();
		$csdn123_showfromurl=$csdn123_news["showfromurl"];
		$csdn123_fromurl=$csdn123_news["fromurl"];
		$csdn123_content=dfsockopen("http://csdn123.0762so.net/zd_version/zd6/getContent_list.php?cms=dz&ip=" . $_SERVER['REMOTE_ADDR'] . "&siteurl=" . $_SERVER['HTTP_HOST'] . "&url=" . $csdn123_news["url"]);
		$csdn123_content=json_decode($csdn123_content);
		$csdn123_lang=currentlang();
		$csdn123_lang=strtoupper($csdn123_lang);
		if(strpos($csdn123_lang,"GBK")!==false)
		{
			$csdn123_lang="GBK";
		}
		if(strpos($csdn123_lang,"BIG")!==false)
		{
			$csdn123_lang="BIG5";
		}		
		if(strpos($csdn123_lang,'UTF')===false)
		{
			$csdn123_content=mb_convert_encoding($csdn123_content,$csdn123_lang,"UTF-8");
		}
		if($csdn123_showfromurl==1)
		{
			$csdn123_content=$csdn123_content . "<br><br><br>" . lang('plugin/csdn123_news', 'csdn123_fromlink') . " " . $csdn123_fromurl;
		}
		require_once libfile('function/editor');
		$csdn123_content=str_replace('<hr>','[hr]',$csdn123_content);
		$csdn123_content=html2bbcode($csdn123_content);
		$csdn123_content=html_entity_decode($csdn123_content);
		$csdn123_forum_thread_arr=array();
		$csdn123_forum_thread_arr['fid']=dintval($csdn123_fid);
		$csdn123_forum_thread_arr['author']='admin';
		$csdn123_forum_thread_arr['authorid']=1;
		$csdn123_forum_thread_arr['subject'] = $csdn123_title;
		$csdn123_forum_thread_arr['dateline'] = dintval($csdn123_time);
		$csdn123_forum_thread_arr['lastpost']= dintval($csdn123_time);
		$csdn123_forum_thread_arr['lastposter'] = 'admin';
		$csdn123_forum_thread_arr['status'] = 32;
		$csdn123_tid=DB::insert('forum_thread', $csdn123_forum_thread_arr, TRUE);		
		DB::query("INSERT into " . DB::table('forum_post_tableid') . "() VALUES()");
		$csdn123_pid=DB::insert_id();
		if($csdn123_pid<=0)
		{
			$csdn123_pid=DB::fetch_first("select max(pid)+1 as pid from " . DB::table('forum_post'));
			$csdn123_pid=$csdn123_pid["pid"];
			$csdn123_pid=dintval($csdn123_pid);			
			$csdn123_forum_post_tableid_data=array('pid'=>$csdn123_pid);
			DB::insert("forum_post_tableid",$csdn123_forum_post_tableid_data,false,true);
		}
		$csdn123_forum_post_array=array();
		$csdn123_forum_post_array['pid'] = dintval($csdn123_pid);
		$csdn123_forum_post_array['fid'] = dintval($csdn123_fid);
		$csdn123_forum_post_array['tid'] = dintval($csdn123_tid);
		$csdn123_forum_post_array['first'] = 1;
		$csdn123_forum_post_array['author'] = 'admin';
		$csdn123_forum_post_array['authorid'] = 1;
		$csdn123_forum_post_array['subject'] = $csdn123_title;
		$csdn123_forum_post_array['dateline'] = dintval($csdn123_time);
		$csdn123_forum_post_array['message'] = $csdn123_content;
		$csdn123_forum_post_array['useip'] = '127.0.0.1';
		$csdn123_forum_post_array['usesig']=1;
		$csdn123_forum_post_array['bbcodeoff']=0;
		$csdn123_forum_post_array['smileyoff']=-1;
		$csdn123_forum_post_array['position']=1;
		DB::insert('forum_post', $csdn123_forum_post_array);		
		$csdn123_num=DB::fetch_first('SELECT threads,posts,todayposts FROM '.DB::table('forum_forum')." WHERE fid=" . $csdn123_fid);
		$csdn123_forum_forum_data=array('threads'=>$csdn123_num['threads']+1,'posts'=>$csdn123_num['posts']+1,'lastpost'=>"$csdn123_pid        $csdn123_title        " . time() . "        $admin",'todayposts'=>$csdn123_num['todayposts']+1);
		DB::update('forum_forum', $csdn123_forum_forum_data,"fid=" . $csdn123_fid);		
		$csdn123_common_member_count_data=array('posts'=>'posts+1','threads'=>'threads+1');
		DB::update('common_member_count',$csdn123_common_member_count_data,'uid=1');
		return "hezhiwu_yes";
		
	}
	
	
}

$csdn123_cron=DB::fetch_first("select * from " . DB::table("zd_cron") . " order by csdn123_catch_num asc limit 1");
if(empty($csdn123_cron)==false)
{
	
	$csdn123_zd_cron_arr=array();
	$csdn123_zd_cron_arr['csdn123_catch_num']='csdn123_catch_num+1';
	$csdn123_zd_cron_arr['csdn123_catch_time']=time();
	DB::update("zd_cron",$csdn123_zd_cron_arr,"id=" . dintval($csdn123_cron["id"]));
	$csdn123_keyword=$csdn123_cron["csdn123_keyword"];
	$csdn123_fromtype=$csdn123_cron["csdn123_fromtype"];
	$csdn123_showfromurl=$csdn123_cron["csdn123_showfromurl"];
	$csdn123_importfid=$csdn123_cron["csdn123_importfid"];
	$csdn123_lang=currentlang();
	$csdn123_lang=strtoupper($csdn123_lang);
	if(strpos($csdn123_lang,"GBK")!==false)
	{
		$csdn123_lang="GBK";
	}
	if(strpos($csdn123_lang,"BIG")!==false)
	{
		$csdn123_lang="BIG5";
	}
	if(strpos($csdn123_lang,'UTF')===false)
	{
		$csdn123_keyword=mb_convert_encoding($csdn123_keyword,"UTF-8",$csdn123_lang);
	}
	$csdn123_url="http://csdn123.0762so.net/zd_version/zd6/main_news_list.php?siteurl=" . $_SERVER['HTTP_HOST'] . "&query=" . urlencode($csdn123_keyword) . "&fromtype=" . $csdn123_fromtype . "&showfromurl=" . $csdn123_showfromurl;
	$csdn123_getdata=dfsockopen($csdn123_url);
	$csdn123_getdata=json_decode($csdn123_getdata,true);
	foreach($csdn123_getdata["items"] as $csdn123_key=>$csdn123_value)
	{
		if(strpos($csdn123_lang,'UTF')===false){
		
			$csdn123_getdata["items"][$csdn123_key]['title']=mb_convert_encoding($csdn123_getdata["items"][$csdn123_key]['title'],$csdn123_lang,"UTF-8");
		}
		$csdn123_select_sql=DB::query("select * from " . DB::table("zd_news") . " where url='" . daddslashes($csdn123_getdata["items"][$csdn123_key]['url']) . "'");
		if(DB::num_rows($csdn123_select_sql)==0)
		{
			
			$csdn123_zd_news_arr=array();
			$csdn123_zd_news_arr["title"]=$csdn123_getdata["items"][$csdn123_key]['title'];
			$csdn123_zd_news_arr["getdatetime"]=dintval($csdn123_getdata["items"][$csdn123_key]['getdatetime']);
			$csdn123_zd_news_arr["url"]=$csdn123_getdata["items"][$csdn123_key]['url'];
			$csdn123_zd_news_arr["fromurl"]=$csdn123_getdata["items"][$csdn123_key]['fromurl'];
			$csdn123_zd_news_arr["fid"]=dintval($csdn123_importfid);
			$csdn123_zd_news_arr["showfromurl"]=$csdn123_showfromurl;
			$csdn123_lastid=DB::insert("zd_news",$csdn123_zd_news_arr,true);
			csdn123_import_news($csdn123_lastid);
			
		}
	}

}


?>