<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install.php 34718 2014-07-14 08:56:39Z nemohou $
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class xigua_member {

    public $config;

    public function __construct()
    {
        global $_G;
        loadcache('plugin');
        $this->config = $_G['cache']['plugin']['xigua_member'];
    }

    function profile_extraInfo() {
        require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
        require_once DISCUZ_ROOT.'./source/plugin/xigua_member/function.php';
        global $_G;
        $ads = array_filter(explode("\n", $this->config['ads']));

        $return = array();

        if($this->is_self()){
            /*edit*/
//            $link = WeChatHook::getPluginUrl('xigua_member:profile');
            $link = $_G['siteurl'] .'plugin.php?id=xigua_member:profile&mobile=no';
            $return[] = array(
                'name' => '<a href="'.$link.'">'.xul('edit', 0).'</a>',
                'link' => $link,
            );
        }

        /*ads*/
        foreach ($ads as $ad) {
            $src = $link = '';
            list($src, $link) = explode(',', $ad);
            $return[] = array(
                'name' => "<a href='$link' style='display:block;margin:0 -10px 0 -15px;height:40px;min-width:100%;background:url($src) no-repeat center center;background-size:cover'></a>",
            );
        }

        /*logout*/
        if($this->config['logout']){
            if($this->is_self()) {
                $link = $_G['siteurl'] . 'member.php?mod=logging&action=logout&formhash=' . FORMHASH;
                $return[] = array(
                    'name' => '<a href="'.$link.'">'.$this->config['logout'].'</a>',
                    'link' => $link
                );
            }
        }
        return $return;
    }

    public function is_self()
    {
        global $_G;
        if($_G['uid']<1){
            return FALSE;
        }
        if(!empty($_GET['uid']) && $_G['uid'] != $_GET['uid']){
            return FALSE;
        }
        return TRUE;
    }
}