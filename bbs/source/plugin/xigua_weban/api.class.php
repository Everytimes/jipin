<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/5
 * Time: 19:39
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class xigua_weban
{
    public $config;

    public function __construct()
    {
        global $_G;
        if (empty($_G['cache']['plugin'])) {
            loadcache('plugin');
        }
        $this->config = $_G['cache']['plugin']['xigua_weban'];
        $this->pluginid = 'xigua_weban';
    }

    public function forumdisplay_headerBar()
    {
        global $_G;
        $_G['fid'] = $_G['fid'] ? $_G['fid'] : intval($_GET['fid']);
        if($this->config['wsq'] && in_array($_G['fid'], unserialize($this->config['fids']))){

            require_once DISCUZ_ROOT.'source/plugin/wechat/wechat.lib.class.php';
            $p = WeChatHook::getRedirect();
            $pluginid = 'xigua_weban';
            if($p['plugin']!=$pluginid){
                WeChatHook::updateRedirect(
                    array('plugin' => $pluginid, 'include' => 'api.class.php', 'class' => $pluginid, 'method' => 'redirect')
                );
            }

            return "<script>window.location.href=\"$_G[siteurl]forum.php?mod=forumdisplay&drewb=1&fid=$_G[fid]\"</script >";
        }
        return '';
    }

    public function viewthread_topBar()
    {
        global $_G;
        $_G['fid'] = $_G['fid'] ? $_G['fid'] : intval($_GET['fid']);
        if($this->config['wsqtid'] && in_array($_G['fid'], unserialize($this->config['fids']))){

            require_once DISCUZ_ROOT.'source/plugin/wechat/wechat.lib.class.php';
            $p = WeChatHook::getRedirect();
            $pluginid = 'xigua_weban';
            if($p['plugin']!=$pluginid){
                WeChatHook::updateRedirect(
                    array('plugin' => $pluginid, 'include' => 'api.class.php', 'class' => $pluginid, 'method' => 'redirect')
                );
            }

            $_G['tid'] = $_G['tid'] ? $_G['tid'] : intval($_GET['tid']);
            return "<script>window.location.href=\"$_G[siteurl]forum.php?mod=viewthread&drewb=1&tid=$_G[tid]\"</script >";
        }
        return '';
    }

    public static function redirect($type) {

        global $_G;

        $config = $_G['cache']['plugin']['xigua_weban'];
        $_G['fid'] = $_G['fid'] ? $_G['fid'] : intval($_GET['fid']);
        $_G['tid'] = $_G['tid'] ? $_G['tid'] : intval($_GET['tid']);
        if(
            in_array($_G['fid'], unserialize($config['fids'])) &&
            ($config['wsq'] || $config['wsqtid'])
        ){
            return ;
        }

        if($_G['cache']['plugin']['xigua_portal'] && is_file(DISCUZ_ROOT.'source/plugin/xigua_portal/api.class.php')){
            require_once DISCUZ_ROOT.'source/plugin/xigua_portal/api.class.php';
            return xigua_portal::redirect($type);
        }else{
            require_once DISCUZ_ROOT .'source/plugin/wechat/response.class.php';
            return WSQResponse::redirect($type);
        }

    }

    public static function xwb_currenturl($related = 0) {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
        return $related ? $relate_url : $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
    }
}