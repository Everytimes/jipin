<?php

if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}

$openid     = isset($_GET['wxid'])? daddslashes($_GET['wxid']):'';
$article_id   = isset($_GET['article_id'])? intval($_GET['article_id']):0;

$article = C::t('portal_article_title')->fetch($article_id);
$contentInfo = C::t('portal_article_content')->fetch_by_aid_page($article_id, 1);

$dateline = date("Y-m-d", $article['dateline']);

require_once libfile('function/blog');
$content = blog_bbcode($contentInfo['content']);

include DISCUZ_ROOT.'./source/plugin/tom_weixin/core/module.class.php';
$moduleClass = new tom_module();
$articleInfo = $moduleClass->getOneByModuleId("article");
$articleSetting = array();
if($articleInfo && !empty($articleInfo['module_setting'])){
    $articleSetting = $moduleClass->decodeSetting($articleInfo['module_setting']);
}

$adscontent = "";
if(isset($articleSetting['adscontent'])){
    $adscontent = $articleSetting['adscontent'];
}

$formhash = FORMHASH;
$isGbk = false;
if (CHARSET == 'gbk') $isGbk = true;
define('TPL_DEFAULT', true);
include template("tom_weixin:article");
?>
