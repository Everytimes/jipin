<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * Class xigua_portal
 */
class xigua_portal
{
    public $redirect = 0;

    public function __construct()
    {
//        global $_G;
//        if (!$_G['cache']['plugin']) {
//            loadcache('plugin');
//        }
//        $this->config = $_G['cache']['plugin']['xigua_portal'];
//        $wechat = unserialize($_G['setting']['mobilewechat']);
//
//        if($_GET['fid']){
//            $_G['fid'] = intval($_GET['fid']);
//        }
//
//        if($_G['fid'] == $wechat['wsq_fid'] && $this->config['getindex']){
//            $this->redirect = 1;
//        }
    }

//    public function forumdisplay_threadStyleTemplate(){
//        $return = array();
//        if(!$this->redirect){
//            return $return;
//        }
//        $return['style_portal'] = '<wsqscript>goto_xigua_portal();</wsqscript>';
//
//        return $return;
//    }
//
//    function forumdisplay_variables(&$variables)
//    {
//        if(!$this->redirect){
//            return TRUE;
//        }
//        if (!$variables['function']) {
//            $variables['function'] = array();
//        }
//
//        global $_G;
//        $function =array(
//            'goto_xigua_portal' => array(
//                'WSQ.location',
//                array(
//                    $_G['siteurl'] . 'plugin.php?id=xigua_portal%3Aindex&pid='.$this->config['getindex']
//                )
//            )
//        );
//        $variables['function'] = array_merge($function, $variables['function']);
//    }
//
//    function forumdisplay_threadStyle()
//    {
//        global $_G;
//        $return = array();
//
//        if(!$this->redirect){
//            return $return;
//        }
//
//        foreach (array_reverse($GLOBALS['threadlist']) as $thread) {
//            if($thread['displayorder'] || in_array($thread['tid'], $_G['wechat']['setting']['showactivity']['tids'])) {
//                continue;
//            }
//            $return[$thread['tid']] = array(
//                'id' => 'style_portal',
//                'var' => array()
//            );
//            break;
//        }
//
//        return $return;
//    }

    public static function redirect($type) {
        global $_G;
        if (!$_G['cache']['plugin']) {
            loadcache('plugin');
        }
        if(!$_G['wechat']['setting']) {
            $_G['wechat']['setting'] = unserialize($_G['setting']['mobilewechat']);
        }

        $modid = $_G['basescript'].'::'.CURMODULE;

        if(
            $_G['wechat']['setting']['wsq_siteid'] &&
            !defined('IN_MOBILE_API') &&
            $_G['setting']['xigua_portal_pid'] &&
            $type &&
            $modid == 'forum::index' &&
            !$_GET['forumlist'] && !$_GET['find']
        ){
            dheader('Location: '. $_G['siteurl'] . 'plugin.php?id=xigua_portal:index&mobile=no&pid='.$_G['setting']['xigua_portal_pid']);
        }else{
            require_once DISCUZ_ROOT .'source/plugin/wechat/response.class.php';
            return WSQResponse::redirect($type);
        }

    }

}