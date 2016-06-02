<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Cache-control" content="{if $_G['setting']['mobile'][mobilecachetime] > 0}{$_G['setting']['mobile'][mobilecachetime]}{else}no-cache{/if}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no" />
<meta name="keywords" content="{if !empty($metakeywords)}{echo dhtmlspecialchars($metakeywords)}{/if}" />
<meta name="description" content="{if !empty($metadescription)}{echo dhtmlspecialchars($metadescription)} {/if},$_G['setting']['bbname']" />
<title><!--{if !empty($navtitle)}-->$navtitle - <!--{/if}--><!--{if empty($nobbname)}--> $_G['setting']['bbname'] - <!--{/if}--> {lang waptitle} - Powered by Discuz!</title>
<script type="text/javascript">var STYLEID = '{STYLEID}', STATICURL = '{STATICURL}', IMGDIR = '{IMGDIR}', VERHASH = '{VERHASH}', charset = '{CHARSET}', discuz_uid = '$_G[uid]', cookiepre = '{$_G[config][cookie][cookiepre]}', cookiedomain = '{$_G[config][cookie][cookiedomain]}', cookiepath = '{$_G[config][cookie][cookiepath]}', showusercard = '{$_G[setting][showusercard]}', attackevasive = '{$_G[config][security][attackevasive]}', disallowfloat = '{$_G[setting][disallowfloat]}', creditnotice = '<!--{if $_G['setting']['creditnotice']}-->$_G['setting']['creditnames']<!--{/if}-->', defaultstyle = '$_G[style][defaultextstyle]', REPORTURL = '$_G[currenturl_encode]', SITEURL = '$_G[siteurl]', JSPATH = '$_G[setting][jspath]';</script>
<link rel="stylesheet" href="$_G[siteurl]template/mobanbus_wxgz/wxgz_st/css/mobanbus_wxgz_st.css" media="screen" />
<link rel="stylesheet" href="$_G[siteurl]template/mobanbus_wxgz/wxgz_st/css/mobanbus.min.css" />
<script type="text/javascript" src="{$_G[setting][jspath]}common.js?{VERHASH}"></script>
</head>
<body class="bg mobanbus" onLoad="LoadFinish()">
<!-- Mobanbus_cn header start -->
<header class="mobanbus_header bus_index">
  <div class="bus_nav">
		<!--{if $_GET[mod] == 'viewthread'}-->
	<div class="icon-angle-left">
		<a class="ico" href="javascript:history.go(-1);"></a>
	</div>
	<div class="logo_index">
		<ul class="coc_1">
			<li>$navtitle</li>
		</ul>
	</div>
	<div class="icon-edit"><a class="ico" href="forum.php?mod=misc&action=nav&mobile=2"></a></div>
  </div>	
<div class="bus_headbox"></div>
</header>
<!-- Mobanbus_cn header end -->

<section class="bus_warp">

