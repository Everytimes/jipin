<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/5
 * Time: 14:10
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * Class xigua_cards
 */
class xigua_cards
{
    public static $configs;

    /**
     * @param bool $only_open
     * @return mixed
     */
    public static function config($only_open = true)
    {
        if(isset(self::$configs[$only_open])){
            return self::$configs[$only_open];
        }

        global $_G;
        $cache_key = 'config_cache';

        if(($_G['adminid'] > 0 && $_GET['diy'] == 'yes') || defined('IN_ADMINCP')){
            self::clearfromcache($cache_key);
            $config = self::init_config();
        }else{
            $config = self::readfromcache($cache_key, '', 86400000);
            if(!$config){
                $config = self::init_config();
                self::writetocache($config, $cache_key);
            }
        }

        if($only_open){
            foreach ($config as $k => $v) {
                if(!$v['open']){
                    unset($config[$k]);
                }
            }
        }
        self::$configs[$only_open] = $config;
        return self::$configs[$only_open];
    }

    public static function init_config(){
        $data = array();
        $cards_root = DISCUZ_ROOT . 'source/plugin/xigua_portal/template/cards';
        $dh  = opendir($cards_root);
        while (false !== ($filename = readdir($dh))) {
            if($filename != '.' && $filename != '..'){
                $config_file = $cards_root ."/$filename/config.php";
                $data[$filename] = include $config_file;
            }
        }
        return $data;
    }

    /**
     * @param string $lang
     * @param int $echo
     * @return bool
     */
    public static function l($lang = '', $echo = 1)
    {
        static $langs;
        $langs[$lang] = isset($langs[$lang]) ? $langs[$lang] : lang('plugin/xigua_portal', $lang);
        if($echo){
            echo $langs[$lang];
            return TRUE;
        }else{
            return $langs[$lang];
        }
    }

    public static function upload($file_data, $imgtype = array('.gif', '.jpg', '.jpeg', '.png',), $dir = 'source/plugin/xigua_portal/upload/')
    {
        global $_G;
        $errors = array(
            UPLOAD_ERR_OK         => self::l('UPLOAD_ERR_OK',        0),
            UPLOAD_ERR_INI_SIZE   => self::l('UPLOAD_ERR_INI_SIZE',  0),
            UPLOAD_ERR_FORM_SIZE  => self::l('UPLOAD_ERR_FORM_SIZE', 0),
            UPLOAD_ERR_PARTIAL    => self::l('UPLOAD_ERR_PARTIAL',   0),
            UPLOAD_ERR_NO_FILE    => self::l('UPLOAD_ERR_NO_FILE',   0),
            UPLOAD_ERR_NO_TMP_DIR => self::l('UPLOAD_ERR_NO_TMP_DIR',0),
            UPLOAD_ERR_CANT_WRITE => self::l('UPLOAD_ERR_CANT_WRITE',0),
            99                    => self::l('ONLY_IMAGE_ALLOW',     0),
        );
        $error = $file_data['error'];
        if($error != UPLOAD_ERR_OK){
            return array(
                'errno' => $error,
                'error' => $errors[$error]
            );
        }

        $type = '.'.addslashes(strtolower(substr(strrchr($file_data['name'], '.'), 1, 10)));
        $t = array_search($type, $imgtype);
        $filetype = $imgtype[$t];
        if($t === false || ! $filetype) {
            return array(
                'errno' => 99,
                'error' => $errors[99]
            );
        }

        dmkdir($dir);
        $file_attach = $dir. uniqid('xgp'.time()) . $filetype;
        $saved_file = DISCUZ_ROOT . $file_attach;

        if(is_uploaded_file($file_data['tmp_name']))
        {
            if(
                @copy($file_data['tmp_name'], $saved_file) ||
                @move_uploaded_file($file_data['tmp_name'], $saved_file)
            ){
                @unlink($file_data['tmp_name']);
                return array(
                    'errno' => 0,
                    'error' => $_G['siteurl'] . $file_attach
                );
            }else{
                return array(
                    'errno' => UPLOAD_ERR_CANT_WRITE,
                    'error' => $errors[UPLOAD_ERR_CANT_WRITE]
                );
            }
        }
        return array(
            'errno' => UPLOAD_ERR_NO_FILE,
            'error' => $errors[UPLOAD_ERR_NO_FILE]
        );
    }

    /**
     * @param $card
     * @param bool $parse
     * @return mixed
     */
    public static function run($card, $parse = false)
    {
        $config = self::config(true);

        $type  = $card['type'];
        $tpl   = $config[$type]['tpl'];

        $card['var'] = $card['value'] = unserialize($card['value']);
        $card['hide'] = 0;

        if(!is_file(DISCUZ_ROOT . 'source/plugin/xigua_portal/template/cards/'.$type.'/process.php')){
            return array();
        }
        include_once DISCUZ_ROOT . 'source/plugin/xigua_portal/template/cards/'.$type.'/process.php';
        $function = 'process_'.$type;
        $card = $function($card);

        if($parse && !$card['hide'] && $card['value']) {
            $card['html'] = xigua_parser::parse_string($tpl, $card['var']);
        }

        return $card;
    }

    public static function block($card, $module = 'forum')
    {
        $scripts = array('threadhot', 'threadnew', 'threaddigest', 'threadstick', 'threadspecified',);
        if (!in_array($card['var']['script'], $scripts)) {
            $card['var']['script'] = 'threadhot';
        }
        if($card['var']['script'] == 'threaddigest'){
            $card['var']['param']['digest'] = array(1,2,3);
        }
        if($card['var']['script'] == 'threadstick'){
            $card['var']['param']['stick'] = array(1,2,3);
        }

        $class_name = 'block_' . $card['var']['script'];
        require_once libfile($class_name, 'class/block/'.$module);
        $card['block_class'] = new $class_name();
        return $card;
    }

    public static function sort_by_tids($data, $param)
    {
        $threads = array();
        if($param['tids']){
            $tmp = array();
            foreach ($data['data'] as $thread) {
                $tmp[$thread['id']] = $thread;
            }
            $tids = array_filter(explode(',', $param['tids']));
            foreach ($tids as $tid) {
                if($tmp[$tid]){
                    $threads[] = $tmp[$tid];
                }
            }
        }else{
            $threads = $data['data'];
        }

        return $threads;
    }

    /**
     * @param $tid
     * @return string
     */
    public static function thread_link($tid){
        return "forum.php?mod=viewthread&tid=$tid";
//        global $wechat;
//        $param = array_merge(array(
//            'c' => 'index',
//            'a' => 'viewthread',
//            'f' => 'wx',
//            'siteid' => $wechat['wsq_siteid']
//        ), array('tid' => $tid));
//        $url = 'http://wsq.discuz.qq.com/?' . http_build_query($param);
//        return $url;
    }

    public static function get_picurl($pic, $thumb = 0){
        global $_G;

        if(in_array(strtolower(substr($pic, 0, 6)), array('http:/', 'https:', 'ftp://')))
        {
            return $pic;
        }

        if($_G['cache']['plugin']['xigua_portal']['remote'])
        {
            return rtrim($_G['cache']['plugin']['xigua_portal']['remote'], '/') . '/' . $pic;
        }

        $picurl =  $_G['setting']['attachurl'].$pic;
        if($thumb){
            $picurl = getimgthumbname($picurl);
        }
        if (!in_array(strtolower(substr($picurl, 0, 6)), array('http:/', 'https:', 'ftp://')))
        {
            $pic = $_G['siteurl'].$picurl;
        }
        else
        {
            $pic = $picurl;
        }
        return $pic;
    }

    public static function styles()
    {
        $styles = array();
        $cards_root = DISCUZ_ROOT . 'source/plugin/xigua_portal/static/css/style';
        $dh  = opendir($cards_root);
        while (false !== ($filename = readdir($dh))) {
            if($filename != '.' && $filename != '..'){
                $styles[] = str_replace('.css', '', $filename);
            }
        }
        return $styles;
    }

    public static function get_style($style){
        global $_G;
        return $_G['siteurl'] .'source/plugin/xigua_portal/static/css/style/'.$style.'.css?20150329';
    }

    public static function writetocache($array = array(), $script = 'xigua_portal_cache', $prefix = '')
    {
        global $_G;
        $datas = array(
            'ts' => $_G['timestamp'],
            'data'     => $array
        );
        $cachedata = " return ".arrayeval($datas).";";

        $dir = DISCUZ_ROOT.'./data/sysdata/xigua_portal/';
        if(!is_dir($dir)) {
            dmkdir($dir, 0777);
        }
        if($fp = @fopen("$dir$prefix$script.php", 'wb')) {
            fwrite($fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n//Identify: ".md5($prefix.$script.'.php'.$cachedata.$_G['config']['security']['authkey'])."\n\n$cachedata?>");
            fclose($fp);
        } else {
            exit('Can not write to cache files, please check directory ./data/ and ./data/sysdata/ and ./data/sysdata/xigua_beauty_cache/ .');
        }
    }

    public static function readfromcache($script = 'xigua_portal_cache', $prefix = '', $expire = 0)
    {
        global $_G;
        $expire = $expire ? $expire : $_G['cache']['plugin']['xigua_portal']['expire'];
        $dir = DISCUZ_ROOT.'./data/sysdata/xigua_portal/';
        if(!is_dir($dir)) {
            dmkdir($dir, 0777);
        }

        $ret = array();
        if(is_file("$dir$prefix$script.php")){
            $rets =  include "$dir$prefix$script.php";
            $ret = $rets['data'];
            if($_G['timestamp']> $rets['ts']+ $expire)
            {
                $ret = array();
            }
        }
        return $ret;
    }

    public static function clearfromcache($script = 'xigua_portal_cache', $prefix = '')
    {
        $dir = DISCUZ_ROOT.'./data/sysdata/xigua_portal/';
        @unlink("$dir$prefix$script.php");

        return TRUE;
    }
}