<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!empty($_GET["csdn123_mycontent"]))
{
	
	$csdn123_mycontent=$_GET["csdn123_mycontent"];
	$csdn123_is_utf8=currentlang();
	$csdn123_data = array ('csdn123_mycontent' => $csdn123_mycontent,'csdn123_is_utf8' => $csdn123_is_utf8);
	$csdn123_url = "http://csdn123.0762so.net/zd_version/zd6/replaceTongyici.php?siteurl=" . $_G["siteurl"] . "&ip=" . $_SERVER['REMOTE_ADDR'];
	$csdn123_return=dfsockopen($csdn123_url,0,$csdn123_data);
	echo $csdn123_return;

}

if($_GET["csdn123_localmycontent"]=="yes")
{
	
	if(!isset($_G['cache']['plugin'])){
			loadcache('plugin');
	}
	$csdn123_localtongyici=$_G['cache']['plugin']['csdn123_news']['csdn123_localtongyici'];
	$csdn123_localtongyici=preg_replace('/\s+/','',$csdn123_localtongyici);
	if(currentlang()=='SC_GBK')
	{
		$csdn123_localtongyici=mb_convert_encoding($csdn123_localtongyici,"UTF-8","GBK");
	}
	$csdn123_localtongyiciArr=explode(",",$csdn123_localtongyici);
	echo json_encode($csdn123_localtongyiciArr);
	
}

if($_GET["csdn123_localimg"]=="yes")
{
	
	$csdn123_localimgUrl=$_GET["csdn123_localimgUrl"];
	$csdn123_localimgUrl=urlencode($csdn123_localimgUrl);
	$csdn123_url=
	$csdn123_return=dfsockopen("http://csdn123.0762so.net/zw_oss/zd_v6_get_img.php?siteurl=" . $_G["siteurl"] . "&ip=" . $_SERVER['REMOTE_ADDR'] . "&imgurl=" . $csdn123_localimgUrl);
	echo $csdn123_return;
	
	
}

if($_GET["csdn123_fromurl"]=="yes")
{
	
	$csdn123_remoteUrl=$_GET["csdn123_remoteUrl"];
	$csdn123_return=dfsockopen("http://csdn123.0762so.net/zd_version/zd6/fromurl.php?siteurl=" . $_G["siteurl"] . "&ip=" . $_SERVER['REMOTE_ADDR'] . "&url=" . $csdn123_remoteUrl);
	echo $csdn123_return;

}

?>