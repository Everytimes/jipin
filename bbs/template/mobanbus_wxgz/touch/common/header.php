<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={CHARSET}">
<meta http-equiv="Cache-control" content="{if $_G['setting']['mobile'][mobilecachetime] > 0}{$_G['setting']['mobile'][mobilecachetime]}{else}no-cache{/if}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no" />
<meta name="keywords" content="{if !empty($metakeywords)}{echo dhtmlspecialchars($metakeywords)}{/if}" />
<meta name="description" content="{if !empty($metadescription)}{echo dhtmlspecialchars($metadescription)} {/if},$_G['setting']['bbname']" />
<title><!--{if !empty($navtitle)}-->$navtitle - <!--{/if}--><!--{if empty($nobbname)}--> $_G['setting']['bbname'] - <!--{/if}--> {lang waptitle} - Powered by Discuz!</title>
<script type="text/javascript">var STYLEID = '{STYLEID}', STATICURL = '{STATICURL}', IMGDIR = '{IMGDIR}', VERHASH = '{VERHASH}', charset = '{CHARSET}', discuz_uid = '$_G[uid]', cookiepre = '{$_G[config][cookie][cookiepre]}', cookiedomain = '{$_G[config][cookie][cookiedomain]}', cookiepath = '{$_G[config][cookie][cookiepath]}', showusercard = '{$_G[setting][showusercard]}', attackevasive = '{$_G[config][security][attackevasive]}', disallowfloat = '{$_G[setting][disallowfloat]}', creditnotice = '<!--{if $_G['setting']['creditnotice']}-->$_G['setting']['creditnames']<!--{/if}-->', defaultstyle = '$_G[style][defaultextstyle]', REPORTURL = '$_G[currenturl_encode]', SITEURL = '$_G[siteurl]', JSPATH = '$_G[setting][jspath]';</script>
<!--{if $_GET[mod] == 'misc'}-->
<script type="text/javascript" src="{$_G[setting][jspath]}common.js?{VERHASH}"></script>
<!--{else}-->
<script src="$_G[siteurl]{STATICURL}js/mobile/jquery-1.8.3.min.js?{VERHASH}"></script>
<script src="$_G[siteurl]{STATICURL}js/mobile/common.js?{VERHASH}" charset="{CHARSET}"></script>
<!--{/if}-->
<link rel="stylesheet" href="$_G[siteurl]template/mobanbus_wxgz/wxgz_st/css/mobanbus_wxgz_st.css" media="screen" />
<link rel="stylesheet" href="$_G[siteurl]template/mobanbus_wxgz/wxgz_st/css/mobanbus.min.css" />
</head>
<body onLoad="LoadFinish()" class="mobanbus slideleftin page-container"> 
<base href="$_G[siteurl]" />
<!--{hook/global_header_mobile}-->

<!-- Mobanbus_cn header start -->
<header class="mobanbus_header bus_index">
  <div class="bus_nav">
		<!--{if $_GET[mod] == 'viewthread'}-->
	<div class="icon-angle-left">
		<a class="ico" href="javascript:history.go(-1);"></a>
	</div>
		<!--{else}-->
	<div class="icon-reorder">
		<div class="bus_h_hide">
			<a class="ico" href="javascript:void(0)" onClick="mobanbusshow(this)"></a>
			<div class="mobanbus_nav">
			<ul>
				<!-- 这里放 顶部导航模块 内部调用地址 -->
				<!--{block/5}-->
				
				<li><a href="home.php?mod=space&uid={$_G[uid]}&do=profile&mycenter=1&mobile=2">个人主页</a></li>
				<div class="clear"></div>
				<li class="last">模版巴士原创设计<br>www.mobanbus.cn</li>
			</ul>
			</div>	
		</div>
	</div>
		<!--{/if}-->
	<div class="logo_index">
		<!--{if $_GET[mod] == 'index'}-->
		<ul class="coc_2">
			<li class="active"><a href="portal.php?mod=index&mobile=2">精华</a></li>
			<li><a href="forum.php?mod=guide&view=new&mobile=2">新帖</a></li>
		</ul>
		<!--{elseif $_GET[mod] == 'guide'}-->
		<ul class="coc_2">
			<li><a href="portal.php?mod=index&mobile=2">精华</a></li>
			<li class="active"><a href="forum.php?mod=guide&view=new&mobile=2">新帖</a></li>
		</ul>
		<!--{elseif $_GET[mod] == 'forumdisplay'}-->
		<ul class="coc_3">
			<li {if $_GET['orderby'] == 'dateline'}class="active"{/if}><a href="forum.php?mod=forumdisplay&fid=$_G[fid]&filter=author&orderby=dateline$forumdisplayadd[author]{if $_GET['archiveid']}&archiveid={$_GET['archiveid']}{/if}">发布时间</a></li>
			<li {if $_GET['orderby'] == 'replies'}class="active"{/if}><a href="forum.php?mod=forumdisplay&fid=$_G[fid]&filter=reply&orderby=replies$forumdisplayadd[reply]{if $_GET['archiveid']}&archiveid={$_GET['archiveid']}{/if}">回复</a></li>
			<li {if $_GET['orderby'] == 'views'}class="active"{/if}><a href="forum.php?mod=forumdisplay&fid=$_G[fid]&filter=reply&orderby=views$forumdisplayadd[view]{if $_GET['archiveid']}&archiveid={$_GET['archiveid']}{/if}">浏览</a></li>
		</ul>
		<!--{elseif $_GET[mod] == 'viewthread'}-->
		<ul class="coc_1">
			<li>帖子详情</li>
		</ul>
		<!--{else}-->
		<ul class="coc_1">
			<li>$navtitle</li>
		</ul>
		<!--{/if}-->
	</div>
	<div class="icon-edit"><a class="ico" href="forum.php?mod=misc&action=nav&mobile=2"></a></div>
  </div>	
<div class="bus_headbox"></div>
</header>
<!-- Mobanbus_cn header end -->

<section class="bus_warp">

