<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/21
 * Time: 19:03
 */

if (empty($_G['cache']['plugin'])) {
    loadcache('plugin');
}
$vars = $_G['cache']['plugin']['xigua_navigation_wsq'];

$variable = '';
if($_GET['xt'] == 'f'){
    $forum = $vars['forumlistfont'] ? $vars['forumlistfont'] : lang('plugin/xigua_navigation_wsq', 'bottom1');
    if($vars['forumlistlink']){
        $variable .= '<a cid="on" style="width:auto;color:#769cdc" class="blockSec db" href="'.$vars['forumlistlink'].'"><i class="incoSec"></i>'.$forum.'</a>';
    }else{
        $variable .= '<i class="incoSec"></i>'.$forum;
    }
}else if($_GET['xt'] == 't'){
    $postthreadfont = $vars['postthreadfont'] ? cutstr($vars['postthreadfont'], 5, '') : lang('plugin/xigua_navigation_wsq', 'bottom2');
    if($vars['postthreadlink1']){
        $variable .= '<a cid="on" style="width:auto;color:#769cdc" class="blockSec db" href="'.$vars['postthreadlink1'].'"><i class="iconPost f18 mr5 commF"></i>'.$postthreadfont.'</a>';
    }else{
        $variable .= '<i class="iconPost f18 mr5 commF"></i>'.$postthreadfont;
    }
}
json_output();