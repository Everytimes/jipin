<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class reprint_bksvr
{
    
    public static function getAkSk(array $request)
    {
        $api = 'http://139.196.29.35:8888/api/site/regist';
        $postData = array (
            "plugin"   => 'reprint',
            "sitename" => self::getParam($request, "sitename"),
            "siteurl"  => self::getParam($request, "siteurl"),
            "admin_email" => self::getParam($request, "admin_email"),
        );
        try {
            $res = self::http_request($api, $postData);
            if ($res["retcode"]!=0) {
                throw new Exception($res["retmsg"]);
            }   
            return self::result(0, $res);
        } catch (Exception $e) {
            return self::result(100010, $e->getMessage());
        }   
    }

    
    public static function getQuota(array $request)
    {
        $api = 'http://139.196.29.35:8888/api/reprint/getquota';
        $postData = array (
            "ak"   => self::getParam($request, "ak"),
            "sign" => self::makeSign($request),
        );
        try {
            $res = self::http_request($api, $postData);
            if ($res["retcode"]!=0) {
                throw new Exception($res["retmsg"]);
            }   
            return self::result(0, $res);
        } catch (Exception $e) {
            return self::result(100010, $e->getMessage());
        }
    }

    
    public static function parsePaper(array $request)
    {
        $api = 'http://139.196.29.35:8888/api/reprint/wxparse';
        $postData = array (
            "ak"   => self::getParam($request, "ak"),
            "sign" => self::makeSign($request),
            "url"  => self::getParam($request, "target_url"),
            "html_body" => self::getParam($request, "html_body"),
        );
        try {
            $res = self::http_request($api, $postData);
			if (empty($res)) {
				throw new Exception("文章解析失败");
			}
            if ($res["retcode"]!=0) {
                throw new Exception($res["retmsg"]);
            }
            return self::result(0, $res);
        } catch (Exception $e) {
            return self::result(100010, $e->getMessage());
        }
    }

    private static function makeSign(array $request) 
    {
        $ak = self::getParam($request, "ak");
        $sk = self::getParam($request, "sk");
        $siteurl = self::getParam($request, "siteurl");
        return md5($ak.$sk.$siteurl);
    }

    private static function result($code, &$data)
    {
        if ($code==0) {
            return array (
                "retcode" => 0,
                "retmsg"  => "succ",
                "data" => $data
            );  
        } else {
            return array (
                "retcode" => $code,
                "retmsg"  => $data,
            );  
        }   
    }

    private static function getParam(array &$arr, $key, $defaultValue="")
    {
        return isset($arr[$key]) ? trim($arr[$key]) : $defaultValue;
    }

    
    private static function http_request($url, $postData=null)
    {
        $data = "";
        $urlarr = array($url);
        foreach ($urlarr as $k => $ithurl) {
			$ch = curl_init();
            if ($k!=0 && $domain!="") {
				$header = array ("Host: $domain");
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			} 
			if(!is_null($postData)){
				$curlPost = http_build_query($postData);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
			}
			curl_setopt($ch, CURLOPT_URL, $ithurl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
			curl_setopt($ch, CURLOPT_TIMEOUT, 20);
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
			$data      = curl_exec($ch);
			$errorInfo = curl_error($ch);
            $httpCode  = curl_getinfo($ch,CURLINFO_HTTP_CODE);
			if($httpCode!=200 || !empty($errorInfo)){
				curl_close($ch);
                continue;
			}
			if(empty($data) && empty($postData)){
				curl_close($ch);
                break;
			}
			curl_close($ch);
		}
        if ($data == "") {
			$tmp = file_get_contents($url);
		    if(!empty($tmp)){
			    $data = $tmp;
		    }
        }
        $res = json_decode($data,true);
        if (empty($res)) {
            throw new Exception("http_request_fail [res:$data]");
        }
        runlog('reprint', "url:$url|req:".json_encode($postData)."|res:".$data);
        return $res;
    }
}

?>
