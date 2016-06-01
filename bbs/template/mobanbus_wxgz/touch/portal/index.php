<?php echo '模板巴士原创模板，版权所有，盗版必究，官网 www.mobanbus.cn';exit;?>
<!--{template common/header}-->
<script src="template/mobanbus_wxgz/wxgz_st/js/jquery.infinitescroll.js" type="text/javascript"></script>
<div class="bus_indexbg_box">
	<p class="slogan"><img src="template/mobanbus_wxgz/wxgz_st/img/index-logo.png"></p>
	<div class="bus_icolist">
		<!-- 这里放 首页分类入口模块 内部调用地址 -->
		<!--{block/5}-->
	</div>
	<div class="bus_indexbg_col s01 mobanbus_vbg"><img src="http://static.qyer.com/m/project/main2/images/bg-main.jpg" /></div>
</div>

<!-- 这里放 二图模块、门户图文模块 内部调用地址 -->
<!--{block/4}-->

<div id="more"><a href="forum.php?mod=forumdisplay&fid=38&page=2"></a></div>
<!--{if !$_G[uid] && !$_G['connectguest']}-->
<section class="busbox mobanbus_loginitem">
<p>您还没有登录哦，赶快去登录吧！</p>
<span><a href="member.php?mod=logging&action=login" class="buslogin">登录</a><a href="member.php?mod=register" class="busregister">注册</a></span>
</section>
<!--{else}--><!--{/if}-->
<!--{template common/footer}-->











