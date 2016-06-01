<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once dirname(__FILE__)."/libs/env.class.php";

if(!$_G['uid']){
    showmessage("to_login", '', array(), array('login' => true));
}

if (!reprint_env::check_authrights()) {
    $_G["setting"]["navs"]["3"]["navname"] = $_G["lang"]["core"]["title_share_link"];
    showmessage("forum_group_noallowed", "");
}


$plugin_path = reprint_env::get_plugin_path();
$siteurl = reprint_env::get_siteurl();

$lang_title = reprint_utils::piconv('UTF-8',CHARSET,"微信转帖工具");
$lang_kong  = reprint_utils::piconv('UTF-8',CHARSET,"空");
$lang_home  = reprint_utils::piconv('UTF-8',CHARSET,"首页");
$lang_list  = reprint_utils::piconv('UTF-8',CHARSET,"转帖列表");

require_once libfile('function/forumlist');
$forums_sel = '<select id="fm-forumid" class="form-control"><option value="0">'.$lang_kong.'</option>'.forumselect(FALSE, 0, 0, TRUE).'</select>';

include template("reprint:index");
