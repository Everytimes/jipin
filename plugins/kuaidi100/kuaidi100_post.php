<?php
$getcom = trim($_GET["com"]);
$getNu = trim($_GET["nu"]);

//echo $typeCom.'<br/>' ;
//echo $getNu ;
include_once("kuaidi100_config.php");

if(isset($postcom)&&isset($getNu)){
	$url='http://api.kuaidi100.com/api?id='.$kuaidi100key.'&com='.$postcom.'&nu='.$getnu.'&valicode=0&show=0muti=1&order=desc';
//	$url = 'http://www.kuaidi100.com/applyurl?key='.$kuaidi100key.'&com='.$postcom.'&nu='.$getNu;
	// echo $url;
	//请勿删除变量$powered 的信息，否者本站将不再为你提供快递接口服务。
	$powered = '查询服务由：<a href="http://www.kuaidi100.com" target="_blank" style="color:blue">快递100</a> 网站提供';
	
	
	//优先使用curl模式发送数据
	if (function_exists('curl_init') == 1){
	  $curl = curl_init();
	  curl_setopt ($curl, CURLOPT_URL, $url);
	  curl_setopt ($curl, CURLOPT_HEADER,0);
	  curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt ($curl, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
	  curl_setopt ($curl, CURLOPT_TIMEOUT,5);
	  $get_content = curl_exec($curl);
	  curl_close ($curl);
	}else{
	  include("snoopy.php");
	  $snoopy = new snoopy();
	  $snoopy->fetch($url);
	  $get_content = $snoopy->results;
	}
	//$get_content=iconv('UTF-8', 'GB2312//IGNORE', $get_content);
	//if(strpos($get_content,'地点和跟踪进度')== false){
	//  echo '查询失败，请重试';
	//} frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes"
//	$result='<iframe src="'.$get_content.'" width="334" height="340"><br/>';
	$result='$get_content';
//	echo json_encode($result);die;
	$str='{"nu":"70267806030689","message":"ok","comcontact":"4009 565656","ischeck":"0","com":"huitongkuaidi","condition":"00","status":"1","state":"0","data":[{"time":"2016-05-29 04:02:43","location":"","context":"太原市|到件|到太原市【太原转运中心】"},{"time":"2016-05-28 09:16:22","location":"","context":"武汉市|发件|武汉市【武汉转运中心】，正发往【太原转运中心】"},{"time":"2016-05-28 09:10:55","location":"","context":"武汉市|到件|到武汉市【武汉转运中心】"},{"time":"2016-05-26 21:52:59","location":"","context":"南宁市|发件|南宁市【南宁转运中心】，正发往【武汉转运中心】"},{"time":"2016-05-26 21:45:41","location":"","context":"南宁市|到件|到南宁市【南宁转运中心】"},{"time":"2016-05-26 18:29:25","location":"","context":"南宁市|收件|南宁市【西乡塘二部】，【谢荣振/0771-6763174】已揽收"}],"comurl":"http://www.800bestex.com/"';
	echo $str;die;

}else{
	echo '查询失败，请重试';
}
exit();
?>
