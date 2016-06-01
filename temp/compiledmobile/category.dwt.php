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
<LINK rel=stylesheet type=text/css href="themes/default/css/searchbox.css">
</head>
<body>
<SCRIPT src="themes/default/js/jquery.js"></script>
<SCRIPT src="themes/default/js/placeholder.js"></script>
<SCRIPT src="themes/default/js/bootstrap.min.js"></script>

<SCRIPT src="themes/default/js/category.js"></script> 
<div id="page" class="page-shadow" style="margin-left: 0px; margin-right: 0px;">
  <div class="searchbox">
    <div class="sb-header"> <a id="J_BackBtn" class="sb-back" href="javascript:history.go(-1);" >返回</a>
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
          <input type="reset" id="J_ResetBtn" >
        </form>
      </div>
      <a id="J_SwitchBtn" class="sb-switchBtn sb-switchBtn-album" data-atp="3,d,,,disp,20,disp," href="javascript:void(0);"  onclick="changeCl(this)" style="opacity: 1;">切换</a>
      <div class="sb-cancelBtn-wrap"><a id="J_CancelBtn" class="sb-cancelBtn" >取消</a></div>
    </div>
    <div class="sb-category"></div>
  </div>
  <div class="minisite-wrapper" id="J_MinisiteWrap"></div>
  <div style="height: 45px; display: none;" class="searchbox-placeholder"></div>
  <?php echo $this->fetch('library/goods_list.lbi'); ?>
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
               <a  class="no">首页</a> 
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

<div id="J_Nav" class="nav" style="right: -275px;">
  <form class="hold-height" action="category.php">
    <div class="attrExtra">
      <input type="hidden" name="category" value="<?php echo $this->_var['category']; ?>"/>
      <button class="j_SubmitBtn attrExtra-submit" type="submit">确定</button>
      <button id="J_Cancel" class="j_CancelBtn attrExtra-cancel" type="button"  onclick="mtShowMenu()">取消</button>
    </div>
    <div class="attrs attr-fix" id="J_Attrs" style="height: 594px; overflow: auto;">
    
      <!--<div class="j_Auction attr auctionAttr">
        <div class="attrKey"></div>
        <div class="attrValues">
          <ul class="av-collapse">
            <li><a href="#" data-name="new" data-value="1" >新到商品</a></li>
            <li><a href="#" data-name="post_fee" data-value="-1">特别推荐</a></li>
            <li><a href="#" data-name="miaosha" data-value="1">热销狂欢</a></li>
            <li><a href="#" data-name="pic_detail" data-value="1">特价甩卖</a></li>
          </ul>
          <div class="av-options hidden"> 
          <a class="j_Multiple avo-multiple" href="javascript:;">多选<i></i></a> 
          <a class="j_More avo-more avo-more-down"  href="javascript:;" data-atp="1,auction_more,,,auction,20,auction,">查看更多<i></i></a> </div>
        </div>
      </div>-->
      
      
      <div class="j_Brand attr brandAttr">
        <div class="attrKey">推荐品牌</div>
        <div class="attrValues">
          <ul class="av-collapse" style="" id="av_brands">
            <?php if ($this->_var['brands']): ?>
          	<?php $_from = $this->_var['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?>
            <li class=""><a href="javascript:;" ><?php echo $this->_var['brand']['brand_name']; ?></a></li>
            <input type="hidden" class="hid_b" value="<?php echo $this->_var['brand']['brand_id']; ?>"/>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php endif; ?>
          </ul>
          <div class="av-options"> 
          <a class="j_Multiple avo-multiple" href="javascript:;">多选<i></i></a> 
          <a class="j_More avo-more avo-more-down"   onclick="more_brands(this)"  href="javascript:;">查看更多<i></i></a> </div>
        </div>
      </div>
       
       
       
      <div class="j_Cate attr cateAttr">
        <div class="attrKey">类目</div>
        <div class="attrValues">
          <ul class="av-collapse" style="" id="av_category">
          	 <?php $_from = $this->_var['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
              <li class=""><a href="javascript:;" data-id="51536001"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a></li>
              <input type="hidden" class="hid_b" value="<?php echo $this->_var['cat']['id']; ?>"/>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
          </ul>
          <div class="av-options"> 
          <a class="j_Multiple avo-multiple" href="javascript:;">多选<i></i></a> 
          <a class="j_More avo-more avo-more-down" href="javascript:;" onclick="more_category(this)" >查看更多<i></i></a> </div>
        </div>
      </div>
      
      <div class="j_Price attr priceAttr" id="J_Price">
        <div class="attrKey">价格区间（单位：元）</div>
        <div class="attrValues">
          <div class="priceRange" id="J_PriceRange">
            <p>
              <input type="text" name="min_price" class="start_price" data-atp=",price,,,,20,filter," maxlength="6" value="">
              <span class="av-sep">——</span>
              <input type="text" name="max_price" class="end_price" data-atp=",price,,,,20,filter," maxlength="6" value="">
            </p>
          </div>
        </div>
      </div>
    </div>
  </form>
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