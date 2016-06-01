<?php
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
global $_G;
if (!isset($_G['cache']['plugin'])) {
    loadcache('plugin');
}
$csetting = $_G['cache']['plugin']['huoyuedu'];
$guanlis = $csetting[guanlis];

$guanli = explode(",",$guanlis);
if(!in_array($_G['username'], $guanli)){
	echo 'sorry,no access!<a href=forum.php>Back</a>';
	exit;
}

$bankuais = $csetting[bankuais];
$bankuais = unserialize($bankuais);
$bankuaisql = implode(',',$bankuais);

$bsql = "select fid,name FROM ".DB::table('forum_forum')." where fid in (".$bankuaisql.")  order by displayorder desc";
$bquery = DB::query($bsql);
while($bk = DB::fetch($bquery)) {
	$bks[] = $bk;
}

$fid = intval($_GET['fid']);
if($fid){
	$fsql = " and fid = '$fid' "; 
  $fname = DB::result_first("SELECT name FROM ".DB::table('forum_forum')."  where fid  =".$fid );	
	}

$pn = 30;
$showMaxPage = 300;
$totalrows = DB::result_first("SELECT count(*) FROM ".DB::table('yt_huoyuedu2')."  where 1=1 ".$fsql );
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$page = $page >= $showMaxPage ? $showMaxPage : $page;
$offset = $pn*($page-1);
$page_url = "plugin.php?id=huoyuedu&fid=".$fid;
$totalrows = $totalrows >= $showMaxPage * $pn ? $showMaxPage * $pn : $totalrows;
$multipage = multi($totalrows, $pn, $page, $page_url);

$ssql = "select * FROM ".DB::table('yt_huoyuedu2')." where 1=1 ".$fsql." order by addtime asc  limit $offset, $pn";
$query = DB::query($ssql);
while($rt = DB::fetch($query)) {
	$rt['addtime'] = date("m-d",$rt['addtime']) ;	
  $sql1 = "select name from  ".DB::table('forum_forum')." where fid = '".$rt['fid']."'";
  $thread = DB::fetch_first($sql1);	
	$rt['fname'] = $thread[name];	
	if($fid){
		$ii = substr_count($newusers,",");
		$newusers = $newusers.",".$rt['newuser'];
		$liveusers = $liveusers.",".$rt['liveuser'];
		$livings = $livings.",".$rt['living'];
    $labels = $labels.",".$ii.":"."'".$rt['addtime']."'";		
  }
	$tu[] = $rt;
}
$newusers =substr($newusers,1);
$liveusers =substr($liveusers,1);
$livings =substr($livings,1);
$labels =substr($labels,1);
unset($tu);

$ssql = "select * FROM ".DB::table('yt_huoyuedu2')." where 1=1 ".$fsql." order by addtime desc  limit $offset, $pn";
$query = DB::query($ssql);
while($rt = DB::fetch($query)) {
	$rt['addtime'] = date("m-d",$rt['addtime']) ;	
  $sql1 = "select name from  ".DB::table('forum_forum')." where fid = '".$rt['fid']."'";
  $thread = DB::fetch_first($sql1);	
	$rt['fname'] = $thread[name];	
	$posts[] = $rt;
}
include template("huoyuedu:view");