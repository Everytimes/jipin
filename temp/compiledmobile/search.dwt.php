<!DOCTYPE html>
<html manifest="/manifest/tmallCateAppCache.manifest">
<head>
<meta name="Generator" content="HHSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<title><?php echo $this->_var['page_title']; ?>触屏版</title>
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<LINK rel=apple-touch-icon-precomposed href="themes/default/images/touch-icon.png">
<LINK rel="shortcut icon" type=image/x-icon href="themes/default/images/favicon2.ico">
<LINK rel=stylesheet type=text/css href="themes/default/category.css">
</head>
<body>
<SCRIPT src="themes/default/js/jquery.js"></script> 
<SCRIPT src="themes/default/js/placeholder.js"></script> 
<SCRIPT src="themes/default/js/bootstrap.min.js"></script> 
<SCRIPT src="themes/default/js/category.js"></script>
<div id="page" class="page-shadow" style="margin-left: 0px; margin-right: 0px;">
  <div class="searchbox">
    <div class="sb-header"> <a id="J_BackBtn" class="sb-back" href="javascript:history.go(-1)">返回</a>
      <div class="sb-search">
        <form id="searchForm" name="searchForm" method="get" action="search.php" onSubmit="return checkSearchForm()" >
          <div class="s-combobox s-combobox-shown" style="" aria-disabled="false" aria-pressed="false">
            <div class="s-combobox-invalid-el">
              <div class="s-combobox-invalid-inner"> </div>
            </div>
            <div class="s-combobox-input-wrap">
              <input name="keywords" type="text" id="keyword" value="<?php if ($this->_var['search_keywords']): ?><?php echo htmlspecialchars($this->_var['search_keywords']); ?><?php else: ?><?php echo $this->_var['cat_name']; ?><?php endif; ?>" class="s-combobox-input"/>
            </div>
          </div>
          <input type="submit" id="J_SubmitBtn" >
          <input type="reset" id="J_ResetBtn">
        </form>
      </div>
      <a id="J_SwitchBtn" class="sb-switchBtn sb-switchBtn-album"  href="javascript:void(0);" onclick="changeCl(this)" style="opacity: 1;">切换</a>
      <div class="sb-cancelBtn-wrap"><a id="J_CancelBtn" class="sb-cancelBtn" href="javascript:void(0);">取消</a></div>
    </div>
    <div class="sb-category"></div>
  </div>
  <div class="minisite-wrapper" id="J_MinisiteWrap"></div>
  <div style="height: 45px; display: none;" class="searchbox-placeholder"></div>
  <div class="filter" id="J_Filter"> 
    <script>
   $(function(){
	   $('.filter-inner li').click(function(){
		  
		  i = $(this).index( '.filter-inner li'); 
		  switch(i){
			  case 0:
			    $("input[name='sort']").val('goods_id');
			  break;
			  case 1:
			    $("input[name='sort']").val('click_count');
			  break;
			   case 2:
			    $("input[name='sort']").val('last_update');
			  break;
			  case 3:
			    $("input[name='sort']").val('shop_price');
			  break;
			
			    
			  };
			  $("input[name='order']").val('DESC');
			   document.getElementById("form").submit();

		   });
	   
	   })
   
   </script>
    <form method="GET" class="sort" name="listform" id="form">
      <ul class="filter-inner">
        <li class="<?php if ($this->_var['pager']['sort'] == 'goods_id' && $this->_var['pager']['order'] == 'DESC'): ?>filter-cur<?php endif; ?>"> <a href="javascript:void(0);">综合 </a> </li>
        <li class="<?php if ($this->_var['pager']['sort'] == 'click_count' && $this->_var['pager']['order'] == 'DESC'): ?>filter-cur<?php endif; ?>"> <a href="javascript:void(0);">人气 <i class="f-ico-arrow-d"></i> </a> </li>
        <li class="<?php if ($this->_var['pager']['sort'] == 'last_update' && $this->_var['pager']['order'] == 'DESC'): ?>filter-cur<?php endif; ?>"> <a href="javascript:void(0);">销量</a></li>
        <li class="<?php if ($this->_var['pager']['sort'] == 'shop_price'): ?>filter-cur<?php endif; ?>"> 
        <a href="javascript:void(0);">价格 <span> <i class="f-ico-triangle-mt <?php if ($this->_var['pager']['sort'] == 'shop_price' && $this->_var['pager']['order'] == 'ASC'): ?> f-ico-triangle-slctd<?php endif; ?>"></i> <i class="f-ico-triangle-mb <?php if ($this->_var['pager']['sort'] == 'shop_price' && $this->_var['pager']['order'] == 'DESC'): ?>f-ico-triangle-slctd<?php endif; ?>"></i> </span> </a> 
        </li>
      </ul>
      <input type="hidden" name="category" value="<?php echo $this->_var['category']; ?>" />
      <input type="hidden" name="display" value="<?php echo $this->_var['pager']['display']; ?>" id="display" />
      <input type="hidden" name="brand" value="<?php echo $this->_var['brand_id']; ?>" />
      <input type="hidden" name="price_min" value="<?php echo $this->_var['price_min']; ?>" />
      <input type="hidden" name="price_max" value="<?php echo $this->_var['price_max']; ?>" />
      <input type="hidden" name="filter_attr" value="<?php echo $this->_var['filter_attr']; ?>" />
      <input type="hidden" name="page" value="<?php echo $this->_var['pager']['page']; ?>" />
      <input type="hidden" name="sort" value="<?php echo $this->_var['pager']['sort']; ?>" />
      <input type="hidden" name="order" value="<?php echo $this->_var['pager']['order']; ?>" />
    </form>
  </div>
  <div style="height: 39px; display: none;" class="filter-placeholder"></div>
  <?php if ($this->_var['category'] > 0): ?>
  <form name="compareForm" action="compare.php" method="post" onSubmit="return compareGoods(this);">
    <?php endif; ?>
    <div class="srp j_autoResponsive_container m-ks-autoResponsive-container m-animation album" id="J_ItemList" style="opacity: 1;"> 
      
      <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods_list']['iteration']++;
?> 
      <?php if ($this->_var['goods']['goods_id']): ?>
      <div class="product">
        <div class="pro-inner">
          <div class="proImg-wrap"> <a href="<?php echo $this->_var['goods']['url']; ?>" > <img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" alt="<?php echo $this->_var['goods']['goods_name']; ?>"> </a> </div>
          <div class="proInfo-wrap">
            <div class="proTitle"> <a href="<?php echo $this->_var['goods']['url']; ?>" ><?php echo $this->_var['goods']['goods_name']; ?></a> </div>
            <div class="proSKU"></div>
            <div class="proPrice"> 
              <?php if ($this->_var['goods']['promote_price'] != ""): ?> 
              <em><?php echo $this->_var['goods']['promote_price']; ?></em> 
              <?php else: ?> 
              <em><?php echo $this->_var['goods']['shop_price']; ?></em> 
              <?php endif; ?> 
              <?php if ($this->_var['show_marketprice']): ?> 
              <del><?php echo $this->_var['goods']['market_price']; ?></del> 
              <?php endif; ?> 
            </div>
            <div class="proService"><span>运费10.00</span></div>
            <div class="proSales">月销:<em><?php echo $this->_var['goods']['sales_count']; ?></em></div>
            <div class="proIcons"> 
			
			 <?php if ($this->_var['goods']['watermark_img']): ?> 
			<img src="themes/default/images/<?php echo $this->_var['goods']['watermark_img']; ?>.png" alt="<?php echo $this->_var['goods']['goods_name']; ?>" />
			<?php endif; ?> 
			</div>
          </div>
        </div>
      </div>
      <?php endif; ?> 
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
      
    </div>
    <?php if ($this->_var['category'] > 0): ?>
  </form>
  <?php endif; ?>
  
  <div id="J_loading" class="mobilelist-loading" style="display: none;">
    <div class="floatingCircles">
      <div class="circle frotate_01"></div>
      <div class="circle frotate_02"></div>
      <div class="circle frotate_03"></div>
      <div class="circle frotate_04"></div>
      <div class="circle frotate_05"></div>
      <div class="circle frotate_06"></div>
      <div class="circle frotate_07"></div>
      <div class="circle frotate_08"></div>
    </div>
  </div>
  <section class="list-pagination">
    <div class="pagenav-wrapper" id="J_PageNavWrap" style="">
      <div class="pagenav-content">
        <div class="pagenav" id="J_PageNav">
          <div class="<?php if ($this->_var['pager']['page_first']): ?>p-first<?php else: ?>p-prev p-gray<?php endif; ?>"> 
            <?php if ($this->_var['pager']['page_first']): ?> 
            <a href="<?php echo $this->_var['pager']['page_first']; ?>">首页</a> 
            <?php else: ?> 
            <a class="no">首页</a> 
            <?php endif; ?> 
          </div>
          <div class="<?php if ($this->_var['pager']['page_prev']): ?>p-prev<?php else: ?>p-prev p-gray<?php endif; ?>"> 
            <?php if ($this->_var['pager']['page_prev']): ?> 
            <a href="<?php echo $this->_var['pager']['page_prev']; ?>" >上一页</a> 
            <?php else: ?> 
             <a class="no">上一页</a> 
            <?php endif; ?> 
          </div>
          <div class="pagenav-cur " >
            <div class="pagenav-text"> <span><?php echo $this->_var['pager']['page']; ?>/<?php echo $this->_var['pager']['page_count']; ?></span> <i></i> </div>
            <select name="page" class="pagenav-select">
              <?php if ($this->_var['pager']['page_number']): ?>
            <?php $_from = $this->_var['pager']['page_number']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>    
              
              <option value="<?php echo $this->_var['item']; ?>"><?php echo $this->_var['key']; ?></option>
              
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php endif; ?>
            </select>
          </div>
          <div class="<?php if ($this->_var['pager']['page_next']): ?>p-next<?php else: ?>p-next p-gray<?php endif; ?>" > 
            <?php if ($this->_var['pager']['page_next']): ?> 
            <a  href="<?php echo $this->_var['pager']['page_next']; ?>" >下一页</a> 
            <?php else: ?> 
            <a class="no">下一页</a> 
            <?php endif; ?> 
          </div>
          <div class="<?php if ($this->_var['pager']['page_last']): ?>p-end<?php else: ?>p-end p-gray<?php endif; ?>"> 
            <?php if ($this->_var['pager']['page_last']): ?> 
            <a href="<?php echo $this->_var['pager']['page_last']; ?>"><?php echo $this->_var['lang']['page_last']; ?></a> 
            <?php else: ?> 
             <a class="no">末页</a> 
            <?php endif; ?> 
          </div>
        </div>
      </div>
    </div>
  </section>
  <div id="J_Footer" ></div>
  <footer class="footer"   >
    <div class="user">
      <ul>
        <li> <a data-atp="1,signin,,,sign,20,sign," href="user.php" id="J_Login" class="login">登陆</a> </li>
        <li> <a data-atp="2,signup,,,sign,20,sign," href="user.php?act=register" id="J_Register" class="register">注册</a> </li>
      </ul>
    </div>
    <div class="h-line"></div>
    <div class="footer-v"> <a href="javascript:window.scroll(0,0);" class="backTop" data-atp="1,top,,,tools,20,tools,"> <img alt="返回顶部" src="themes/default/images/top.png"> </a>
      <div class="copyright"> <?php echo $this->_var['copyright']; ?><?php echo $this->_var['icp_number']; ?> </div>
    </div>
  </footer>
</div>
<script type="Text/Javascript" language="JavaScript">
<!--

function selectPage(sel)
{
  sel.form.submit();
}

//-->
</script> 
<script type="text/javascript">
window.onload = function()
{
  //Compare.init();
  fixpng();
}
<?php $_from = $this->_var['lang']['compare_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
<?php if ($this->_var['key'] != 'button_compare'): ?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php else: ?>
var button_compare = '';
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var compare_no_goods = "<?php echo $this->_var['lang']['compare_no_goods']; ?>";
var btn_buy = "<?php echo $this->_var['lang']['btn_buy']; ?>";
var is_cancel = "<?php echo $this->_var['lang']['is_cancel']; ?>";
var select_spe = "<?php echo $this->_var['lang']['select_spe']; ?>";
</script>
</body>
</html>