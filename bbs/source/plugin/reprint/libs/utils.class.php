<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
class reprint_utils
{
    
    public static function piconv($from_charset, $to_charset, $str)
    {
		if(function_exists('iconv')){
			$str = @iconv($from_charset, $to_charset.'//ignore', $str);
		}else{
			$str = @mb_convert_encoding($str, $to_charset, $from_charset);
		}
		return $str;
    }

    
    public static function loadtpl($tpl, $vars ,$tplVars=null)
    {
        $json = json_encode($vars);
        $js_script = '<script type="text/javascript"> v = eval(\'(' . $json . ")');</script>\n";
        $content = @file_get_contents($tpl);
        if (false === $content) {
            return false;
        }
        $charset = strtolower(CHARSET);
        if (is_string($content) && $charset!='utf-8' && $charset!='utf8') {
            $content = self::piconv('UTF-8', CHARSET, $content);
        }
		$tplVars['js_script'] = $js_script;
		$tplVars['app_charset'] = CHARSET;
		if (is_array($tplVars)) {
		    foreach($tplVars as $key => $value){
                $content = str_replace("<%".$key."%>",$value,$content);
                $content = str_replace("<% ".$key." %>",$value,$content);
            }
        }
		echo $content;
    }

    private static $_aksk_setting_key = "reprint_aksk";

    
    public static function getLocalAkSk()
    {
		global $_G;
		require_once libfile('function/core');
		require_once libfile('function/cache');
		$key = self::$_aksk_setting_key;  
		if(isset($_G['setting'][$key]) && !is_array($_G['setting'][$key])){
			$_G['setting'][$key] = unserialize($_G['setting'][$key]);
		}
        $aksk = $_G['setting'][$key];
		if(isset($aksk['ak']) && $aksk['ak']!="" &&
           isset($aksk['sk']) && $aksk['sk']!=""
        ){
			return $aksk;
		}
		return false;
    }

    
    public static function setLocalAkSk(array $data)
    {
		global $_G;
		require_once libfile('function/core');
		require_once libfile('function/cache');
        $key = self::$_aksk_setting_key;
        C::t('common_setting')->update_batch(array($key=>$data));
        updatecache('setting');
    }
}
?>
