<?php
if (!defined('IN_MOBILE_API')) {
    exit('Access Denied');
}
require './source/class/class_core.php';
$discuz = C::app();
$discuz->init();
require_once dirname(__FILE__)."/../../libs/env.class.php";
admin_check();

try {
	$imgurl = isset($_POST["imgurl"]) ? $_POST["imgurl"] : "";
	if (!is_url($imgurl)) {
        throw new Exception("请输入图片链接");
	}
	$res = crawl_img($imgurl);
    reprint_env::result($res);
} catch (Exception $e) {
	reprint_env::result(array("retcode"=>100009,"retmsg"=>$e->getMessage()));
}


function is_url($url)
{
    $reg = "/^http[s]?:\/\//i";
    return preg_match($reg, $url);
}

function crawl_img($url)
{
    global $_G;
    $md5 = md5($url);
    $path = $md5{0}."/".$md5{1};
    $fullpath = dirname(__FILE__)."/../../data/imgs/$path";
    if (!is_dir($fullpath)) {
        mkdir($fullpath, 0777, true);
    }
    $fullfile = $fullpath."/".$md5.".jpg";
    $resurl   = rtrim($_G['siteurl'], '/')."/data/imgs/".$path."/".$md5.".jpg";

    if (!is_file($fullfile)) {
		$ch = curl_init ();  
		curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );  
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );  
		curl_setopt ( $ch, CURLOPT_URL, $url );  
		ob_start ();  
		curl_exec ( $ch );  
		$return_content = ob_get_contents ();  
		ob_end_clean ();  
		$return_code = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );  
		file_put_contents($fullfile, $return_content);
    }
    clearstatcache();
    if (!is_file($fullfile)) {
        $cmd = "wget ".$url." -O '".$fullfile."'";
        system($cmd);
    }
    clearstatcache();
    if (!is_file($fullfile)) {
        throw new Exception("下载图片文件失败");
    }
    
    
    $oldfullfile = $fullfile;
    $url = save_file($fullfile);
    if ($url=='') {
        $url = $resurl;
        $fullfile = $oldfullfile;
    }
    

    $imginfo = getimagesize($fullfile);
    $width   = intval($imginfo[0]);
    $height  = intval($imginfo[1]);
    if ($width<200 || $height<150) {
        $fullfile = "";
    }

    return array (
        "imgurl" => $url, 
        "imginfo" => array (
            "width"  => $width,
            "height" => $height,
        ),
        "imgfile" => $fullfile,
    );
}

function save_file(&$filepath)
{
    $url = reprint_imgtool::save($filepath, 'common', rand(0, 100000), 'reprint');
    if ($url===false) return '';
    return $url;

}

?>
