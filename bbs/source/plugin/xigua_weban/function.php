<?php
/**
 * Created by PhpStorm.
 * User: yzg
 * Date: 2016/1/12
 * Time: 12:59
 */

function replace_aimg($aid){
    $src = getforumimg($aid, 0, 2000, 550, 'fixnone');
    $GLOBALS['replace_aimg'][] = $src;
    return "<img id=\"aimg_$aid\" src=\"$src\" />";
}
function parsexiguamedia($attr,$url ){
    global $_G;
    $height = $_G['cache']['plugin']['xigua_media']['height'];
    $link = $_G['siteurl']. 'plugin.php?id='.urlencode('xigua_media:fetchid').'&param='. urlencode(base64_encode(http_build_query(array(
            'attr' => $attr,
            'url'  => $url,
            'formhash' => FORMHASH
        ))));
    return '<iframe style="width:100%;height:'.$height.'px" frameborder="0" scrolling="no" allowfullscreen="true" src="'.$link.'"></iframe>';
}

function xwb_currenturl($related = 0) {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
    return $related ? $relate_url : $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}


function __get_signature001($appid,$appsecret, $noncestr, $acurl, $timestamp)
{
    if(empty($appid) || empty($appsecret)){
        return '';
    }
    $key1 = md5($appid.$appsecret);
    $key2 = 't'.$key1;

    if(! $ret = readweban($key1)){
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
        $ret = dfsockopen($url);
        $ret = json_decode($ret, TRUE);
        writeweban($key1, $ret, $ret['expires_in']);
    }
    $access_token = $ret['access_token'];

    if(! $ret = readweban($key2)) {
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$access_token&type=jsapi";
        $ret = dfsockopen($url);

        $ret = json_decode($ret, TRUE);
        if($ret['errcode'] == 0){
            writeweban($key2, $ret, $ret['expires_in']);
        }
    }
    $string1 = "jsapi_ticket=$ret[ticket]&noncestr=$noncestr&timestamp=$timestamp&url=$acurl";

    $signature = sha1( $string1 );
    return $signature;
}


function writeweban($script, $array = array(), $expirein = 7200)
{
    $expirein = $expirein - 100;
    $datas = array(
        'expireat' => time()+$expirein,
        'data'     => $array
    );
    $cachedata = " return ".var_export($datas, true).";";

    global $_G;

    $dir = DISCUZ_ROOT.'./source/plugin/xigua_weban/cache/';
    if(!is_dir($dir)) {
        dmkdir($dir, 0777);
    }
    if($fp = @fopen("$dir$script.php", 'wb')) {
        fwrite($fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n//Identify: ".md5($script.'.php'.$cachedata.$_G['config']['security']['authkey'])."\n\n$cachedata?>");
        fclose($fp);
    } else {
        exit('Can not write to cache files, please check directory ./source/plugin/xigua_weban/cache/ .');
    }
}

function readweban($script)
{
    $dir = DISCUZ_ROOT.'./source/plugin/xigua_weban/cache/';
    if(!is_dir($dir)) {
        dmkdir($dir, 0777);
    }

    $ret = array();

    if(is_file("$dir$script.php")){
        $rets =  include "$dir$script.php";
        $ret = $rets['data'];
        if(time()>= $rets['expireat'] )
        {
            $ret = array();
        }
    }
    return $ret;
}
function filter_desc($desc){
    return str_replace(array(
        '\'',"\n","\r","\t"
    ), '', $desc);
}

function get_share($appid, $appsecret, $title, $metadescription, $imgurl, $debug){
    $ret = '';

    $metadescription = filter_desc($metadescription);
    $title = filter_desc($title);
    $imgurl = filter_desc($imgurl);

    $timestamp  = time();
    $noncestr   = uniqid('wx');
    $currenturl = xwb_currenturl();
    $signature  = __get_signature001($appid, $appsecret, $noncestr, $currenturl, $timestamp);
    $debug = $debug ? 'true':'false';

    if($signature){
        $ret = "<script src=\"http://res.wx.qq.com/open/js/jweixin-1.0.0.js\"></script><script>
var title='$title', desc='$metadescription', link='$currenturl',imgUrl='$imgurl';
wx.config({debug:$debug,appId: '$appid', timestamp:$timestamp, nonceStr:'$noncestr', signature:'$signature',jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo']
});
wx.ready(function () {
    wx.onMenuShareAppMessage({ title: title, desc: desc, link: link,imgUrl: imgUrl});
    wx.onMenuShareTimeline({ title: title, link: link, imgUrl: imgUrl});
    wx.onMenuShareQQ({title: title,desc: desc,link: link,imgUrl: imgUrl});
    wx.onMenuShareWeibo({title: title, desc: desc, link: link, imgUrl: imgUrl});
});
</script>";
    }
    return $ret;
}