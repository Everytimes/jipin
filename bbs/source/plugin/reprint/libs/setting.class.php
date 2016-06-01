<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
class reprint_setting
{
    public static function get()
    {
        global $_G;
        $setting = array(
            'zlabel'   => 1,         
            'fid'      => 0,         
            'groupids' => array(),   
            'dwords'   => array(),   
        );
        if (!isset($_G['cache']['plugin']["reprint"])) {
            loadcache('plugin');
        }
        if (isset($_G['cache']['plugin']["reprint"])) {
            $set = $_G['cache']['plugin']["reprint"];
            $set['groupids'] = unserialize($set['groupids']);
            $words = explode("\n", $set['dwords']);
            $wordarr = array();
            if (!empty($words)) {
                foreach ($words as $word) {
                    $w = trim($word);
                    if ($w!='') {
                        $wordarr[] = reprint_utils::piconv(CHARSET, 'UTF-8', $w);
                    }
                }
            }
            $set['dwords'] = $wordarr;
            self::copy_param($setting, $set, array_keys($setting));
            $setting['fid'] = intval($setting['fid']);
        }

        return $setting;
    }

    private static function copy_param(array &$to_arr, array &$from_arr, array $keys)
    {
        foreach ($keys as $key) {
			if(isset($from_arr[$key])) $to_arr[$key] = $from_arr[$key];
        }
    }
}
?>
