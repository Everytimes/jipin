<?php
if (!defined('IN_MOBILE_API')) {
    exit('Access Denied');
}
require './source/class/class_core.php';
$discuz = C::app();
$discuz->init();
require_once dirname(__FILE__)."/../../libs/env.class.php";
admin_check();

$url = isset($_POST["url"]) ? $_POST["url"] : "";
$fid = isset($_POST["fid"]) ? $_POST["fid"] : 0;
if (!is_weixin_link($url)) {
	reprint_env::result(array("retcode"=>100002,"retmsg"=>"请输入微信文章链接"));
}
if (has_reprint($url)) {
	reprint_env::result(array("retcode"=>100003,"retmsg"=>"您已转过该篇文章"));
}
if ($fid==0) {
	reprint_env::result(array("retcode"=>100001,"retmsg"=>"invalid params"));
}

try {
    if (!reprint_env::allowpost($fid)) {
        throw new Exception("您没有权限在此版块发表帖子");
    }
    
    $html_body = get_paper_content($url);
    
    $paper = convert_paper($url,$html_body);
    
    $content = $paper["content"];
    $content = tobbcode($content);
    $content = preg_replace("/<.*?>/i","",$content);
    
    $words = array();
    split_imgobj($content, $words);
    
    special_process($words);
    
    $setting = reprint_setting::get();
    $zlabel = ($setting['zlabel']==0) ? '【转】' : '';
    $res = array (
        "subject" => $paper["title"].$zlabel,
        "words"   => $words,
        "formhash"=> $_G['formhash'],
    );
    reprint_env::result($res);
} catch (Exception $e) {
	reprint_env::result(array("retcode"=>100009,"retmsg"=>$e->getMessage()));
}

function is_weixin_link($url)
{
    $reg = "/^http[s]?:\/\/mp.weixin.qq.com/i";
    return preg_match($reg, $url);
}

function has_reprint($url) 
{
    $record = C::t("#reprint#reprint_thread")->getThreadByUrl($url);
    return !empty($record);
}

function get_paper_content($url)
{
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $body = curl_exec($ch);
    curl_close($ch);
    $reg = "/activity-name/i";
    if (!preg_match($reg, $body)) {
        throw new Exception("微信文章获取失败，或已删除");
    }
    return $body;
}

function convert_paper($target_url, &$html_body)
{
	$request = reprint_env::getaksk();
	$request["siteurl"] = reprint_env::get_siteurl();
    $request["target_url"] = $target_url;
    $request["html_body"] = $html_body;
    $rt = reprint_bksvr::parsePaper($request);
    if ($rt["retcode"]!=0) { 
        throw new Exception($rt['retmsg']);
    }
    return $rt['data']['thread'];
}


function tripScriptAndStyle(&$html)
{
	$html = preg_replace("/<script>.*?<\/script>/i", "", $html);
	$html = preg_replace("/<style>.*?<\/style>/i", "", $html);
	return $html;
}


function tobbcode($content)
{
	$content = urldecode($content);
	$content = tripScriptAndStyle($content);
	require_once libfile('function/editor');
	$content = html2bbcode($content);
	$content = htmlspecialchars_decode($content);
	return $content;
}


function split_imgobj(&$str, array &$list)
{
    $list=array();
	$n = strlen($str);
	$state=0;
	$word="";
    $urlprex = reprint_env::get_siteurl()."//";
	for($i=0; $i<$n; ++$i) {
		$c = $str{$i};
		switch($state) {
            case 0:
				$word.=$c;
				if($c=='[') {$state=1;}
				break;
			case 1:
                $word.=$c;
				if($c=='i' || $c=='I') {$state=2;}
                else {$state=0;}
				break;
            case 2:
                $word.=$c;
				if($c=='m' || $c=='M') {$state=3;}
                else {$state=0;}
				break;
            case 3:
                $word.=$c;
				if($c=='g' || $c=='G') {$state=4;}
                else {$state=0;}
				break;
            case 4:
                $word.=$c;
                if($c==']') {
                    $list[] = $word;
                    $word = "";
                    $state=5;
                }
                break;
            case 5:
                if ($c=='[') {
                    $list[] = array(
                        "tag" => "img",
                        "src" => str_replace($urlprex,'',$word),
                    );
                    $word="";
                    $state=1;
                }
                $word.=$c;
                break;
		}
	}
	if ($word!="") {
		$list[] = $word;
	}
}


function special_process(array &$words)
{
    $sizereg = "/\[\/?size.*?\]/i";
    $j13reg  = "/&#13;/i";
    $setting = reprint_setting::get();
    $delwords = $setting['dwords'];
    $len = count($delwords);
    $i = 0;
    foreach ($words as &$word) {
        if (is_array($word)) {
            ++$i;
            continue;
        }
        $word = rmimgauto($word);
		$word = preg_replace($sizereg, "", $word);
		$word = preg_replace($j13reg, "", $word);
        
        
        if ($len>0) {
            foreach ($delwords as $delword) {
                $dwreg = "/$delword/i";
                $word = preg_replace($dwreg, "", $word);
            }
        }
        
		$word = trim($word);
        ++$i;
    }
}


function rmimgauto($str)
{
    $res = $str;
    $reg = "/\[img.*?\]/i";
    if (preg_match($reg, $str, $matches)) {
        $img = $matches[0];
        $imgstr = preg_replace("/auto/i","0",$img);
        $imgstr = preg_replace("/px/i","",$img);
        $res = preg_replace($reg, $imgstr, $str);
    }
    return $res;
}


?>
