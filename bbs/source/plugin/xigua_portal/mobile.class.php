<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/15
 * Time: 21:26
 */
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
class plugin_xigua_portal
{
    public function common()
    {
        global $_G;
        if(
            defined('IN_MOBILE') &&
            !defined('IN_MOBILE_API') &&
            in_array(CURMODULE, array('index', 'guide')) &&
            $_G['setting']['xigua_portal_pid'] &&
            !$_GET['forumlist'] &&
            !$_GET['find']
        ){
            switch (CURMODULE){
                case 'index':
                case 'guide':
                    dheader('Location: '. $_G['siteurl'] . 'plugin.php?id=xigua_portal:index&mobile=no&pid='.$_G['setting']['xigua_portal_pid']);
                    break;
            }
        }
    }
}

class  mobileplugin_xigua_portal extends plugin_xigua_portal{ }