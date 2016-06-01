<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once 'bksvr.class.php';
require_once 'utils.class.php';
require_once 'setting.class.php';
require_once 'imgtool.class.php';
class reprint_env
{
    private static $_aksk = false;

    
    public static function get_siteurl()
    {
        global $_G;
        $siteurl = $_G['siteurl'];
        $_G['siteurl'] = preg_replace("/source\/plugin\/reprint/i","", $siteurl);
        return rtrim($_G['siteurl'], '/');
    }

    
    public static function get_sitename()
    {
        global $_G;
        $sitename = $_G["setting"]["sitename"];
        $charset = strtolower($_G['charset']);
        if ($charset=='gbk') {
            $sitename = reprint_utils::piconv($charset, "UTF-8", $sitename);
        }   
        return $sitename;
    }

    
    public static function get_admin_email()
    {
        global $_G;
        return $_G["setting"]["adminemail"];
    }

    
    public static function get_plugin_path()
    {
        return self::get_siteurl().'/source/plugin/reprint';
    }

    
    public static function get_ajaxapi()
    {
        return self::get_siteurl().'/source/plugin/reprint/index.php?version=1&module=';
    }

    
    public static function result(array $result)
    {
        header("Content-type: application/json");
        if (!isset($result['retcode'])) {
            $result['retcode'] = 0;
        }   
        if (!isset($result['retmsg'])) {
            $result['retmsg'] = 'succ';
        }   
        header("Content-type: application/json");
        echo json_encode($result);
        exit;
    }

    
    public static function get_param($key, $dv=null, $field='request')
    {
        if ($field=='GET') {
            return isset($_GET[$key]) ? $_GET[$key] : $dv;
        }   
        else if ($field=='POST') {
            return isset($_POST[$key]) ? $_POST[$key] : $dv;
        }
        else {
            return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $dv;
        }
    }

    
    public static function getaksk()
    {
         if (!self::$_aksk) {
            
            $res = reprint_utils::getLocalAkSk();
            
            if ($res===false) {
                runlog('reprint', 'get_local_aksk fail');
                $request = array (
                    "sitename"    => self::get_sitename(),
                    "siteurl"     => self::get_siteurl(),
                    "admin_email" => self::get_admin_email(),
                );
                $rt = reprint_bksvr::getAkSk($request);
                if ($rt["retcode"]==0) {
                    $res = array (
                        "ak" => $rt["data"]["ak"],
                        "sk" => $rt["data"]["sk"],
                    );
                    reprint_utils::setLocalAkSk($res);
                    runlog('reprint', 'get_remote_aksk succ');
                } else {
                    $res === false;
                    runlog('reprint', 'get_remote_aksk fail');
                }
            } else {
				runlog('reprint', 'get_local_aksk succ');
            }
            if ($res!==false && isset($res["ak"]) && isset($res["sk"])) {
                self::$_aksk = array (
                    "ak" => $res["ak"],
                    "sk" => $res["sk"],
                );
            }
        }
        return self::$_aksk;
    }

    
    public static function get_quota()
    {
        $request = self::getaksk();
        $request["siteurl"] = self::get_siteurl();
        $rt = reprint_bksvr::getQuota($request);
        if ($rt["retcode"]==0) {
            return $rt['data']['quota'];
        } else {
            runlog('reprint', 'get_quota fail');
            return 50;
        }
    }

    
    public static function check_authrights()
    {
        global $_G;
        $groupid = $_G['groupid'];
        $setting = reprint_setting::get();
        $groupids = $setting['groupids'];
        
        if (empty($groupids) || $groupids[0]=='') {
            return true;
        }
        
        return in_array($groupid, $groupids); 
    }

    
    public static function allowpost($fid)
    {
        global $_G;
        if (!$_G['group']['allowpost']) {
            return false;
        }
        $uid = $_G['uid'];
        $groupid = $_G['groupid'];
        $info = C::t('forum_access')->fetch_all_by_fid_uid($fid, $uid);      
        if (!empty($info)) {
            $allowpost = intval($info[0]['allowpost']);
            if ($allowpost<0) {
                return false;
            }
        }
        return true;
    }
}

?>
