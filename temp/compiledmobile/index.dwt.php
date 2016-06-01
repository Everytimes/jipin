<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<head>
<meta name="Generator" content="HHSHOP v2.7.3" />
<META content="IE=7.0000" http-equiv="X-UA-Compatible">
<TITLE><?php echo $this->_var['page_title']; ?> 触屏版</TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<META name=viewport 
content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<META name=apple-themes-web-app-capable content=yes>
<META name=apple-themes-web-app-status-bar-style content=black>
<META name=format-detection content=telephone=no>
<LINK rel=apple-touch-icon-precomposed href="themes/default/images/touch-icon.png">
<LINK rel="shortcut icon" type=image/x-icon href="themes/default/images/favicon2.ico">
<LINK rel=stylesheet type=text/css href="themes/default/index.css">
</HEAD>
<BODY>
<DIV id=content class=tmall-h5-v2> 
  
  <DIV class=region>
    <DIV id=J_m-slider class=slider>
      <DIV class=slider-outer>
        <UL class=slider-wrap>
          <LI><A href="#"><img src="themes/default/images/a1-640-300.jpg"></A> </LI>
          <LI><A href="#"><IMG src=""></A> </LI>
          <LI><A href="#"><IMG src=""></A></LI>
          <LI><A href="#"><IMG src=""></A></LI>
          <LI><A href="#"><IMG src="themes/default/images/a5-640-300.jpg"></A></LI>
        </UL>
      </DIV>
      <DIV class=slider-status></DIV>
    </DIV>
  </DIV>
  
  <HEADER class=region>
    <DIV class=content> 
      
      <DIV class=top>
        <H1> <IMG title="本站logo" src="themes/default/images/logo.png" width=144 height=21> </H1>
      </DIV>
       
      
      <DIV id=fake-search>
        <DIV class=fakeInput>
          <BUTTON style="COLOR: silver" class=text>搜本站商品</BUTTON>
        </DIV>
      </DIV>
    </DIV>
  </HEADER>
  
  <DIV id=main-search class=main-search>
    <DIV class=hd> <SPAN class=close>关闭</SPAN> </DIV>
    <DIV class=bd>
      <DIV class=kwd>
        <form id="searchForm" name="searchForm" method="get" action="search.php" onSubmit="return checkSearchForm()" >
          <DIV class=content>
            <INPUT class=text type=search  name="keywords"   id="keyword" >
            <SPAN class=clear>清除</SPAN>
            <INPUT class=sub value=搜索 type=submit>
          </DIV>
        </FORM>
      </DIV>
      <!--<DIV class="result hidden"></DIV>-->
      <P class="clear-history hidden"><A href="#">清除历史记录</A></P>
    </DIV>
  </DIV>
  
  <DIV class="region entry-list"> 
  	<A href="allcate.php"><IMG src="themes/default/images/s1.png" width=37 height=37><BR><SPAN>所有类目</SPAN></A> <SPAN class=entry-decollator></SPAN> 
    <A href="user.php"><IMG  src="themes/default/images/s2.png" width=37 height=37><BR><SPAN>我的账户</SPAN></A> <SPAN class=entry-decollator></SPAN> 
    <A href="flow.php"><IMG src="themes/default/images/s3.png" width=37 height=37><BR><SPAN>购物车</SPAN></A> <SPAN class=entry-decollator></SPAN> 
    <A href="article_cat.php?id=1"><IMG  src="themes/default/images/s4.png" width=37 height=37><BR><SPAN>帮助中心</SPAN></A> <BR>
    <BR>
    <A href="tel:<?php echo $this->_var['service_phone']; ?>"><IMG  src="themes/default/images/s5.png" width=37 height=37><BR><SPAN>联系我们</SPAN></A> <SPAN class=entry-decollator></SPAN>
    <A href="map.php"><IMG src="themes/default/images/s6.png" width=37 height=37><BR><SPAN>地图</SPAN></A> <SPAN class=entry-decollator></SPAN>
    <A href="share.php"><IMG  alt=查物流 src="themes/default/images/s7.png" width=37 height=37><BR><SPAN>分享</SPAN></A> <SPAN class=entry-decollator></SPAN> 
    <A class=region-fav href="message.php"><IMG  src="themes/default/images/s8.png" width=37 height=37><BR><SPAN>留言板</SPAN></A> </DIV>
   
   
  <?php echo $this->fetch('library/recommend_promotion.lbi'); ?> 
   
  
  
  <DIV class="region focus-big"> 
    <A href="#"><IMG src="themes/default/images/ad1.jpg" width=299 height=100> </A>
  </DIV>
   
  <?php if ($this->_var['hot_goods']): ?> 
  <?php if ($this->_var['cat_rec_sign'] != 1): ?>
  <DIV class="region focus"> 
    <?php $_from = $this->_var['hot_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['hot_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['hot_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['hot_goods']['iteration']++;
?> 
    <?php if (($this->_foreach['hot_goods']['iteration'] - 1) <= 8): ?>
    <A class=tag11p href="<?php echo $this->_var['goods']['url']; ?>"> <IMG src="<?php echo $this->_var['goods']['thumb']; ?>"  width="52" height="52"> <SPAN class="focus-name"><?php echo $this->_var['goods']['short_style_name']; ?></SPAN><BR>
    <DEL class=miao-item-oldprice><?php echo $this->_var['goods']['market_price']; ?></DEL> <BR>
    <?php if ($this->_var['goods']['promote_price'] != ""): ?> 
    <SPAN class=miao-item-newprice><?php echo $this->_var['goods']['promote_price']; ?></SPAN> 
    <?php else: ?> 
    <SPAN class=miao-item-newprice><?php echo $this->_var['goods']['shop_price']; ?></SPAN> 
    <?php endif; ?> 
    </A> 
    <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
  </DIV>
  <?php endif; ?> 
  <?php endif; ?>  
   
 
  <DIV class="grid-c module mr-t20"> <A href="#"> <IMG src="themes/default/images/ad2.jpg" width=300 height=75></A> </DIV>
   <FOOTER class=region style="padding-bottom:8px;">
    <SECTION class="user-panel" > 
      <P class=guest  > <A class=login href="user.php">登陆</A> <A class=register href="user.php?act=register">注册</A> </P>
      <A class=fb-top href="javascript:scroll(0,0)"></A></SECTION>
      <SCRIPT>
        var str = document.getElementById("btn_go_pc").href;
        document.getElementById("btn_go_pc").href='http://www.tmall.com/go/act/is-desktop.php?r='+str.replace('mobile\/' , '');
        </SCRIPT> 
    </P>
    <P class=copyright><?php echo $this->_var['copyright']; ?><?php echo $this->_var['icp_number']; ?></P>
  </FOOTER>
</DIV>
<SCRIPT src="themes/default/js/sea.js"></SCRIPT> 
<SCRIPT>
    seajs.use("http://a.tbcdn.cn/apps/tmm/s/hi/tmall/h5v2/js/index.js");
</SCRIPT>

</BODY>

</HTML>