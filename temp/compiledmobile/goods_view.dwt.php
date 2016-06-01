<!DOCTYPE html>
<html manifest="/manifest/tmallCateAppCache.manifest">
<head>
<meta name="Generator" content="HHSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<title><?php echo $this->_var['goods']['goods_name']; ?></title>
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<LINK rel=apple-touch-icon-precomposed href="themes/default/images/touch-icon.png">
<LINK rel="shortcut icon" type=image/x-icon href="themes/default/images/favicon2.ico">
<LINK rel=stylesheet type=text/css href="themes/default/goods.css">
<LINK rel=stylesheet type=text/css href="themes/default/cart.css">

</head>
<body id="app-detail" style=" position: relative;">
<header class="s-header">
  <nav>
    <h1><?php echo $this->_var['goods']['goods_name']; ?></h1>
    <a href="javascript:history.go(-1)" class="back">返回</a>
    <label for="header-search-input" class="more" onclick="showSearch()">更多</label>
  </nav>
  <script>
function showSearch( ){
	document.getElementById("search_box").style.display="block";
	}
function closeSearch(){
	document.getElementById("search_box").style.display="none";
	}
</script>
  <div class="finder"  id="search_box" style="display:none" >
    <form  action="search.php" id="searchForm" method="get" name="searchForm" class="search" >
      <div style="float:left; width:85%; position:relative">
        <input   type="search"  name="keywords"   id="keyword" placeholder="搜索商品" autocomplete="off">
        <input  type="submit" value="" class="go" style="cursor:pointer;" />
      </div>
      <button type="submit"></button>
      <button type="reset"></button>
      <div class="close" onClick="closeSearch()" style=" height:28px;line-height:28px; font-size:12px; text-align:center; "> 取消 </div>
    </form>
    <div class="ui-suggest"></div>
  </div>
</header>



<section class="s-detail">

  <div class="wrap"> 
    <!--<div class="scroller" style="transition: -webkit-transform 0ms cubic-bezier(0, 0, 0.25, 1); -webkit-transition: -webkit-transform 0ms cubic-bezier(0, 0, 0.25, 1); -webkit-transform: translate3d(0px, 0, 0);"> -->
    <div class="scroller"> 
      
      <div class="m-desc current" id="detail-desc">
        <div class="content"> <?php echo $this->_var['goods']['goods_desc']; ?> </div>
        <a href="#"></a>
      </div>
       
      
      <div class="m-recommend" id="detail-recommend">
        <div class="content">
          <div class="non-standard">
            <ul class="col">
              <?php $_from = $this->_var['related_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'releated_goods_data');$this->_foreach['promotion_foreach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['promotion_foreach']['total'] > 0):
    foreach ($_from AS $this->_var['releated_goods_data']):
        $this->_foreach['promotion_foreach']['iteration']++;
?> 
              <?php if (($this->_foreach['promotion_foreach']['iteration'] - 1) % 2 == 0): ?>
              <li> <a href="<?php echo $this->_var['goods']['url']; ?>">
                <div class="summary"> <img src="../<?php echo $this->_var['releated_goods_data']['goods_thumb']; ?>" alt=""/>
                  <div class="price"> 
                    
                    <?php if ($this->_var['releated_goods_data']['promote_price'] != 0): ?> 
                    <?php echo $this->_var['releated_goods_data']['formated_promote_price']; ?> 
                    <?php else: ?> 
                    <?php echo $this->_var['releated_goods_data']['shop_price']; ?> 
                    <?php endif; ?> 
                    
                  </div>
                </div>
                <?php if ($this->_var['goods']['goods_comment']): ?>
                <div class="reviews"> 
                  <?php $_from = $this->_var['goods']['goods_comment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'comment');$this->_foreach['comment'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['comment']['total'] > 0):
    foreach ($_from AS $this->_var['comment']):
        $this->_foreach['comment']['iteration']++;
?> 
                  <?php if ($this->_foreach['comment']['iteration'] < 4): ?>
                  <blockquote> <span class="user"><?php if ($this->_var['comment']['username']): ?><?php echo htmlspecialchars($this->_var['comment']['username']); ?><?php else: ?><?php echo $this->_var['lang']['anonymous']; ?><?php endif; ?></span> <?php echo $this->_var['comment']['content']; ?> </blockquote>
                  <?php endif; ?> 
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                </div>
                <?php endif; ?> 
                </a> </li>
              <?php endif; ?> 
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              
            </ul>
            <ul class="col">
              
              <?php $_from = $this->_var['related_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'releated_goods_data');$this->_foreach['promotion_foreach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['promotion_foreach']['total'] > 0):
    foreach ($_from AS $this->_var['releated_goods_data']):
        $this->_foreach['promotion_foreach']['iteration']++;
?> 
              <?php if (($this->_foreach['promotion_foreach']['iteration'] - 1) % 2 == 1): ?>
              <li> <a href="<?php echo $this->_var['goods']['url']; ?>">
                <div class="summary"> <img src="../<?php echo $this->_var['releated_goods_data']['goods_thumb']; ?>" alt=""/>
                  <div class="price"> 
                    
                    <?php if ($this->_var['releated_goods_data']['promote_price'] != 0): ?> 
                    <?php echo $this->_var['releated_goods_data']['formated_promote_price']; ?> 
                    <?php else: ?> 
                    <?php echo $this->_var['releated_goods_data']['shop_price']; ?> 
                    <?php endif; ?> 
                    
                  </div>
                </div>
                <?php if ($this->_var['goods']['goods_comment']): ?>
                <div class="reviews"> 
                  <?php $_from = $this->_var['goods']['goods_comment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'comment');$this->_foreach['comment'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['comment']['total'] > 0):
    foreach ($_from AS $this->_var['comment']):
        $this->_foreach['comment']['iteration']++;
?> 
                  <?php if ($this->_foreach['comment']['iteration'] < 4): ?>
                  <blockquote> <span class="user"><?php if ($this->_var['comment']['username']): ?><?php echo htmlspecialchars($this->_var['comment']['username']); ?><?php else: ?><?php echo $this->_var['lang']['anonymous']; ?><?php endif; ?></span> <?php echo $this->_var['comment']['content']; ?> </blockquote>
                  <?php endif; ?> 
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                </div>
                <?php endif; ?> 
                </a> </li>
              <?php endif; ?> 
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
          </div>
        </div>
      </div>
       
    </div>
  </div>
</section>
<input type="hidden" id="redirectClientFlag" value="1">
<script type="text/tpl" id="tpl-error">
 <div class="ui-error"><?php echo $this->_var['msg']; ?></div>
</script> 
<?php echo $this->fetch('library/page_goods.lbi'); ?>
 


<script type="text/javascript">
var goods_id = <?php echo $this->_var['goods_id']; ?>;
var goodsattr_style = <?php echo empty($this->_var['cfg']['goodsattr_style']) ? '1' : $this->_var['cfg']['goodsattr_style']; ?>;
var gmt_end_time = <?php echo empty($this->_var['promote_end_time']) ? '0' : $this->_var['promote_end_time']; ?>;
<?php $_from = $this->_var['lang']['goods_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var goodsId = <?php echo $this->_var['goods_id']; ?>;
var now_time = <?php echo $this->_var['now_time']; ?>;

</script>
<style type="text/css">
#ft{position:fixed; bottom:0;height:57px; width:100%; text-align:center;background:#343434;}
#ft a{width:20%; display:block; float:left;text-align:center; font-size:0.8em;color:#b0b0b0}
#ft a:hover,.ft a.a{background:#1e1e1e;}
#ft a span{display:block; width:50px; height:57px; margin:0 auto;}
#ft a em{display:block; width:34px; height:34px; margin:0 auto;background:url(themes/default/images/nav.png) no-repeat 0 0;}
#ft a .n2{background-position:0 -44px;}
#ft a .n3{background-position:0 -88px;}
#ft a .n4{background-position:0 -132px; position:relative;}
#ft a .n5{background-position:0 -176px;}
#ft a .n4 b{ position:absolute; top:5px; right:-18px; display:block;height:18px; width:18px; text-align:center;line-height: 18px; border-radius: 10px; background: #C70600; color:#fff;
</style>
<div id="ft">
<a class="a" href="index.php" ><span><em class="n1"></em>首页</span></a>
<a href="search.php"><span><em class="n2"></em>搜索</span></a>
<a href="allcate.php"><span><em class="n3"></em>分类</span></a>
<a href="flow.php"><span><em class="n4"><b id="cartnum"><?php echo $this->_var['wxch_cart']; ?></b></em>购物车</span></a>
<a href="user.php" ><span><em class="n5"></em>我的</span></a>
</div>
</body>

</html>