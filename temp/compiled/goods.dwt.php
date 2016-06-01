<!doctype html>
<html lang="zh-CN">
<head>
<meta name="Generator" content="haohaios v1.0" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<title><?php echo $this->_var['page_title']; ?></title>
<link rel="shortcut icon" href="favicon.ico" />
<link href="<?php echo $this->_var['hhs_css_path']; ?>/haohaios.css" rel="stylesheet" />
<link href="<?php echo $this->_var['hhs_css_path']; ?>/font-awesome.min.css" rel="stylesheet" />
<link href="<?php echo $this->_var['hhs_css_path']; ?>/flexslider.css" rel="stylesheet" />

<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.js,haohaios.js,jquery.flexslider-min.js')); ?>
</head>
<body>
<div class="container">
    <section class="main-view">
        <div class="flexslider" style="margin-bottom:10px;">
            <ul class="slides">
                <?php $_from = $this->_var['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'picture');$this->_foreach['ptab'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['ptab']['total'] > 0):
    foreach ($_from AS $this->_var['picture']):
        $this->_foreach['ptab']['iteration']++;
?>
                <li><img src="<?php echo $this->_var['picture']['img_url']; ?>"/></li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
        </div>
        <script type="text/javascript">
            $(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    slideDirection: "horizontal"
                });
            });
        </script> 
        <div class="tm">
            <form action="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" method="post" name="HHS_FORMBUY" id="HHS_FORMBUY" >
            <div class="td2">
                <div class="td2_original_price">
                    <span>¥<?php echo $this->_var['goods']['team_price']; ?></span>
                    <div class="mar_price"><del>¥</del><del id="market_price"><?php echo $this->_var['goods']['market_price']; ?></del></div>
                    <?php if ($this->_var['goods']['is_luck']): ?>
                    <div class="lotteryIcon">抽奖</div>
                    <?php endif; ?>
                    <?php if ($this->_var['goods']['is_miao']): ?>
                    <div class="lotteryIcon">秒杀</div>
                    <?php endif; ?>
                    <div class="td2_sold_quantity"><span>累计销量：<i id="sold_quantity"><?php echo $this->_var['buy_num']; ?></i><?php if ($this->_var['goods']['guige']): ?><?php echo $this->_var['goods']['guige']; ?><?php endif; ?></span></div>
                </div>
                <div class="td2_name"><?php echo $this->_var['goods']['goods_name']; ?></div>
                <div class="td2_cx"><?php echo $this->_var['goods']['goods_brief']; ?></div>
                <div class="td2_info">
                     <?php if ($this->_var['goods']['lab_qgby']): ?><div class="mall_detail_1"> 
                       <img src="themes/haohaios/images/td2_num_img-51155b64c3.png">
                       <span><?php echo $this->_var['goods']['lab_qgby']; ?></span>
                    </div><?php endif; ?>
                     <?php if ($this->_var['goods']['lab_zpbz']): ?><div class="mall_detail_2"> 
                       <img src="themes/haohaios/images/td2_num_img-51155b64c3.png">
                       <span><?php echo $this->_var['goods']['lab_zpbz']; ?></span>
                    </div><?php endif; ?>
                     <?php if ($this->_var['goods']['lab_qtth']): ?><div class="mall_detail_3"> 
                       <img src="themes/haohaios/images/td2_num_img-51155b64c3.png">
                       <span><?php echo $this->_var['goods']['lab_qtth']; ?></span>
                    </div><?php endif; ?>
                    <?php if ($this->_var['goods']['lab_jkbs']): ?><div class="mall_detail_4"> 
                       <img src="themes/haohaios/images/td2_num_img-51155b64c3.png">
                       <span><?php echo $this->_var['goods']['lab_jkbs']; ?></span>
                    </div><?php endif; ?>
                     <?php if ($this->_var['goods']['lab_hwzy']): ?><div class="mall_detail_5"> 
                       <img src="themes/haohaios/images/td2_num_img-51155b64c3.png">
                       <span><?php echo $this->_var['goods']['lab_hwzy']; ?></span>
                    </div><?php endif; ?>
                    
                </div>
                <div class="td2_num">支付开团并邀请<span><?php echo $this->_var['d_team_num']; ?></span>人参团，人数不足自动退款，详见下方拼团玩法</div>  
                
     <?php if ($this->_var['specification']): ?>       
 <div class="spec">
      <ul>
<?php $_from = $this->_var['specification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('spec_key', 'spec');if (count($_from)):
    foreach ($_from AS $this->_var['spec_key'] => $this->_var['spec']):
?>
      <li>
      <label><?php echo $this->_var['spec']['name']; ?>：</label>
<?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
<a <?php if ($this->_var['key'] == 0): ?>class="cattsel"<?php endif; ?> onclick="changeAtt(this)" href="javascript:;" name="<?php echo $this->_var['value']['id']; ?>" title="[<?php if ($this->_var['value']['price'] > 0): ?><?php echo $this->_var['lang']['plus']; ?><?php elseif ($this->_var['value']['price'] < 0): ?><?php echo $this->_var['lang']['minus']; ?><?php endif; ?> <?php echo $this->_var['value']['format_price']; ?>]"><?php echo $this->_var['value']['label']; ?><input style="display:none" id="spec_value_<?php echo $this->_var['value']['id']; ?>" type="radio" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" <?php if ($this->_var['key'] == 0): ?>checked<?php endif; ?> /></a>

<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <input type="hidden" name="spec_list" value="<?php echo $this->_var['key']; ?>" />
      </li>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </ul>
 </div>
     <?php endif; ?>   
                
                
                
    <?php if ($this->_var['goods']['limit_buy_bumber'] == 1): ?>
            
            <input name="number"  type="hidden" id="number" class="text" value="1"/>
            <?php elseif ($this->_var['goods']['limit_buy_bumber'] == 0): ?>
			<?php if ($this->_var['bonus_free_all'] > 0): ?>
                <?php else: ?>
             <div class="buynum">
             <label>数量：</label>
                <a href="javascript:void(0);" onclick="goods_cut();changePrice()"><i class="fa fa-minus"></i></a>
                <input name="number" type="text" id="number" class="text" value="1" size="4" onblur="changePrice();"/>
                <a href="javascript:void(0);"  onclick="goods_add();changePrice()"><i class="fa fa-plus"></i></a>
                </div>
				<?php endif; ?>   
                <?php else: ?>
                <?php if ($this->_var['bonus_free_all'] > 0): ?>
                <?php else: ?>
                 <div class="buynum">
             <label>数量：</label>
                <a href="javascript:void(0);" onclick="goods_cut();changePrice()"><i class="fa fa-minus"></i></a>
                <input name="number" type="text" id="number" class="text" value="1" size="4" onblur="changePrice();"/>
                <a href="javascript:void(0);"  onclick="goods_add();changePrice()"><i class="fa fa-plus"></i></a>
                <span>限购<?php echo $this->_var['goods']['limit_buy_bumber']; ?><?php if ($this->_var['goods']['guige']): ?><?php echo $this->_var['goods']['guige']; ?><?php else: ?><?php echo $this->_var['goods']['guige']; ?><?php endif; ?></span>   
                  </div>          
				<?php endif; ?><?php endif; ?>                    
                
                
                
                
            </div>
            
 
 
 <div class="ftbuy">
            <a href="index.php" class="ftbuy_index">
                <div class="ftbuy_index_img">
                    <img src="themes/haohaios/images/index-38d3d45c2c.png">
                </div>
                <div class="ftbuy_index_text">首页</div>
            </a>
            <a href="javascript:collect(<?php echo $this->_var['goods']['goods_id']; ?>)" class="ftbuy_like">
                <div class="ftbuy_index_img">
                    <div class="ftbuy_index_img_bg <?php echo $this->_var['liked']; ?>"></div>
                    <!-- <img ms-src="likeImg" class="kt_index_img_gif"> -->
                </div>
                <div class="ftbuy_index_text">收藏</div>
            </a>
            <a class="ftbuy_message" target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $this->_var['qq']; ?>&amp;site=qq&amp;menu=yes"> 
                <div class="ftbuy_message_img">
                </div>
                <div class="ftbuy_message_text">客服</div>
            </a>
            <?php if ($this->_var['goods']['promote_end_date'] > $this->_var['now_time'] || $this->_var['goods']['promote_end_date'] == 0): ?>

                <?php if ($this->_var['goods']['promote_start_date'] > $this->_var['now_time']): ?>
                <a href="javascript:;alert('即将开始')" id="tuan_more_btn" class="ftbuy_item">
                    <div class="ftbuy_price"><span id="tuan_more_price">¥&nbsp;<?php echo $this->_var['goods']['team_price']; ?></span><?php if ($this->_var['goods']['guige']): ?><?php echo $this->_var['goods']['guige']; ?><?php else: ?><?php echo $this->_var['goods']['guige']; ?><?php endif; ?></div>
                    <div class="ftbuy_btn"><b id="tuan_more_number"><?php echo $this->_var['goods']['team_num']; ?>人团</b></div>
                </a>

                <a href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>,0,0,5)" id="tuan_one_btn" class="ftbuy_item ftbuy_item_buy out">
                    <div class="ftbuy_price">
                        <div><b id="tuan_one_price">¥&nbsp;<?php echo $this->_var['goods']['shop_price']; ?></b><?php if ($this->_var['goods']['guige']): ?><?php echo $this->_var['goods']['guige']; ?><?php else: ?>件<?php endif; ?></div>
                    </div>
                    <div class="ftbuy_btn" id="tuan_one_number">单独购买</div>
                </a>
                <?php else: ?>
				<?php if ($this->_var['bonus_free_all'] > 0): ?>
                <?php if ($this->_var['goods']['bonus_free_all'] > 0): ?>
                <a href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>,0,0,5)" class="ftbuy_item out" style="width:62%; line-height:50px; font-size:16px;">
                    团长免单
                </a>
                <?php endif; ?>
                <?php else: ?>
                <a href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>,0,0,5)" id="tuan_more_btn" class="ftbuy_item out">
                    <div class="ftbuy_price"><span id="tuan_more_price">¥&nbsp;<?php echo $this->_var['goods']['team_price']; ?></span><?php if ($this->_var['goods']['guige']): ?><?php echo $this->_var['goods']['guige']; ?><?php else: ?><?php echo $this->_var['goods']['guige']; ?><?php endif; ?></div>
                    <div class="ftbuy_btn"><b id="tuan_more_number"><?php echo $this->_var['goods']['team_num']; ?>人团</b></div>
                </a>
				<?php endif; ?>
				
                <a href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>);" id="tuan_one_btn" class="ftbuy_item ftbuy_item_buy"<?php if ($this->_var['bonus_free_all'] > 0): ?><?php if ($this->_var['goods']['bonus_free_all'] > 0): ?> style="display:none;"<?php endif; ?><?php endif; ?>>
                    <div class="ftbuy_price">
                        <div><b id="tuan_one_price">¥&nbsp;<?php echo $this->_var['goods']['shop_price']; ?></b><?php if ($this->_var['goods']['guige']): ?><?php echo $this->_var['goods']['guige']; ?><?php else: ?>件<?php endif; ?></div>
                    </div>
                    <div class="ftbuy_btn" id="tuan_one_number">单独购买</div>
                </a>
                <?php endif; ?>
            <?php else: ?>
                <?php if ($this->_var['goods']['is_luck'] == 1): ?>
                <a href="lottery_list.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" id="lottery_lucky_button" class="ftbuy_lottery">已开奖&nbsp;&nbsp;查看中奖名单</a>
                <?php endif; ?>
                <?php if ($this->_var['goods']['is_miao'] == 1): ?>
                <a href="javascript:;" id="lottery_lucky_button" class="ftbuy_lottery">已售罄</a>
                <?php endif; ?>
            <?php endif; ?>
</div>  
        <?php if ($this->_var['goods']['is_nearby']): ?>
        <?php if ($this->_var['group_list']): ?>
        <div id="more_tuan">
             <div class="ht">
                 <div class="ht_tit">其他小伙伴正在发起团购，您可以直接参与</div>
				<div class="ht_list" id="near_team">
                    <?php $_from = $this->_var['group_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'group');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['group']):
        $this->_foreach['name']['iteration']++;
?>
                    <div class="ht_item" onclick="location.href='share.php?team_sign=<?php echo $this->_var['group']['team_sign']; ?>';">
                        <div class="ht_avatar">
							<img src="<?php echo $this->_var['group']['headimgurl']; ?>" alt="团长头像">
						</div>
						<div class="ht_info">
							<div class="ht_name"><?php echo $this->_var['group']['uname']; ?></div>
							<div class="ht_time"><?php echo $this->_var['group']['finish_str']; ?></div>
						</div>
						<a href="javascript:;" class="ht_btn">
							<span class="ht_price"><i>￥</i><?php echo $this->_var['goods']['team_price']; ?> / 件</span>
							<span class="ht_btn_go">还差<?php echo $this->_var['group']['progress']; ?>人成团，直接参团</span>
						</a>
					</div>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </div>
			</div>
		</div>
        <?php endif; ?>
        <?php endif; ?>
            </form>
        </div>
        
        
        <?php if ($this->_var['comments']): ?>
        <div class="detail-comments-container">
            <div class="detail-comments-title">
                <div class="detail-comments-all">用户评价</div>
                <img class="detail-comments-arrow" src="http://cdn.yangkeduo.com/assets/img/personal_arrow-dd13467d78.png">
                <div class="detail-comments-amount">
                    <a href="comments.php?id=<?php echo $this->_var['goods']['goods_id']; ?>">共<span><?php echo $this->_var['comments_nums']; ?></span>条评论</a>
                </div>
            </div>
            <div class="goods-comments-list">
                <?php $_from = $this->_var['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                <div class="goods-comments-detail">
                    <img class="goods-comments-avatar" src="<?php echo $this->_var['item']['headimgurl']; ?>">
                    <div class="goods-comments-name"><?php echo $this->_var['item']['username']; ?></div>
                    <div class="goods-comments-time"><?php echo $this->_var['item']['add_time']; ?></div>
                    <div class="goods-comments-stars">
                    <?php if ($this->_var['item']['rank'] == 1): ?>
                        <div class="goods-comments-stars-show"></div>
                     <?php elseif ($this->_var['item']['rank'] == 2): ?>   
                        <div class="goods-comments-stars-show"></div>
                        <div class="goods-comments-stars-show"></div>
                      <?php elseif ($this->_var['item']['rank'] == 3): ?>     
                        <div class="goods-comments-stars-show"></div>
                        <div class="goods-comments-stars-show"></div>
                        <div class="goods-comments-stars-show"></div>
                        <?php elseif ($this->_var['item']['rank'] == 4): ?>  
                         <div class="goods-comments-stars-show"></div>
                        <div class="goods-comments-stars-show"></div>
                        <div class="goods-comments-stars-show"></div>
                         <div class="goods-comments-stars-show"></div> 
                         <?php elseif ($this->_var['item']['rank'] == 5): ?>  
                         <div class="goods-comments-stars-show"></div>
                        <div class="goods-comments-stars-show"></div>
                        <div class="goods-comments-stars-show"></div>
                         <div class="goods-comments-stars-show"></div> 
                         <div class="goods-comments-stars-show"></div>
                         <?php endif; ?>
                         
                    </div>
                    <div class="goods-comments-content"><?php echo $this->_var['item']['content']; ?></div>
                </div>
                <?php endforeach; else: ?>
                暂无评论
                <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>
        </div>
		<?php endif; ?>



        <?php if ($this->_var['goods']['suppliers_id']): ?>
        <div class="mall_goods">
            <a href="store.php?id=<?php echo $this->_var['goods']['suppliers_id']; ?>">
                <img src="<?php echo $this->_var['stores_info']['supp_logo']; ?>">
                <div class="mall_sub">
                    <span><?php echo $this->_var['stores_info']['suppliers_name']; ?><br/>销量：<?php echo $this->_var['sales_num']; ?></span>
                    
                    <div class="enter_button">
                    <img src="themes/haohaios/images/mall_icon_small.png">
                    <em>进店逛逛&nbsp;</em>
                    </div>
                </div>
                
            </a>
        </div>
        <?php endif; ?>
            
            
            
        <div class="pro-detial">
            <div class="pro_con">
                <?php echo $this->_var['goods']['goods_desc']; ?>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
<div class="recommend_grid_wrap">
    <div id="recommend" class="grid">
     <div class="recommend_head">你可能还喜欢</div>
     <div class="bd">
         <ul>
         <?php $_from = $this->_var['rands_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_34314000_1460959761');if (count($_from)):
    foreach ($_from AS $this->_var['goods_0_34314000_1460959761']):
?>
             <li>
                 <div class="recommend_img"><a href="goods.php?id=<?php echo $this->_var['goods_0_34314000_1460959761']['goods_id']; ?>"><img src="<?php echo $this->_var['goods_0_34314000_1460959761']['goods_img']; ?>"></a></div>
                 <div class="recommend_title"><a href="goods.php?id=<?php echo $this->_var['goods_0_34314000_1460959761']['goods_id']; ?>"><?php echo $this->_var['goods_0_34314000_1460959761']['goods_name']; ?></a></div>
                 <div class="recommend_price">￥<span><?php echo $this->_var['goods_0_34314000_1460959761']['team_price']; ?></span></div>
                 <?php if ($this->_var['goods_0_34314000_1460959761']['rec_id'] > 0): ?>
                 <div class="like_click">
                     <a href="javascript:;" class="recommend_like liked"></a>
                 </div>
                 <?php else: ?>
                 <div class="like_click">
                     <a href="javascript:collect(<?php echo $this->_var['goods_0_34314000_1460959761']['goods_id']; ?>)" class="recommend_like"></a>
                 </div>
                <?php endif; ?>
             </li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
         </ul>
     </div>
    </div>
    <div class="recommend_bottom">
        <div class="line"></div>
        <p>已经到底部了</p>
    </div>
</div> 
        
        
        
        
        
        
        
        
        
        
        
        
        
        <div class="step">
            <div class="step_hd">
                拼团玩法<a class="step_more" href="tuan_rule.php">查看详情</a>
            </div>
            <div id="footItem" class="step_list">
                <div class="step_item step_item_on">
                    <div class="step_num">1</div>
                    <div class="step_detail">
                        <p class="step_tit">选择
                            <br>心仪商品</p>
                    </div>
                </div>
                <div class="step_item ">
                    <div class="step_num">2</div>
                    <div class="step_detail">
                        <p class="step_tit">支付开团
                            <br>或参团</p>
                    </div>
                </div>
                <div class="step_item ">
                    <div class="step_num">3</div>
                    <div class="step_detail">
                        <p class="step_tit">等待好友
                            <br>参团支付</p>
                    </div>
                </div>
                <div class="step_item">
                    <div class="step_num">4</div>
                    <div class="step_detail">
                        <p class="step_tit">达到人数
                            <br>团购成功</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
</body>
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
function goods_cut(){
	var num_val=document.getElementById('number');
	var new_num=num_val.value;
	 if(isNaN(new_num)){alert('请输入数字');return false}
	var Num = parseInt(new_num);
	if(Num>1)Num=Num-1;
	num_val.value=Num;
}
function goods_add(){
	var num_val=document.getElementById('number');
	var new_num=num_val.value;
	 if(isNaN(new_num)){alert('请输入数字');return false}
	var Num = parseInt(new_num);
	Num=Num+1;
	num_val.value=Num;
}
function changeAtt(t) {
t.lastChild.checked='checked';
for (var i = 0; i<t.parentNode.childNodes.length;i++) {
        if (t.parentNode.childNodes[i].className == 'cattsel') {
            t.parentNode.childNodes[i].className = '';
        }
    }
t.className = "cattsel";
changePrice();
}
function changePrice()
{
  var attr = getSelectedAttributes(document.forms['HHS_FORMBUY']);
  var qty = document.forms['HHS_FORMBUY'].elements['number'].value;
  Ajax.call('goods.php', 'act=price&id=' + goodsId + '&attr=' + attr + '&number=' + qty, changePriceResponse, 'GET', 'JSON');
}

function changePriceResponse(res)
{
  if (res.err_msg.length > 0)
  {
    alert(res.err_msg);
	document.forms['HHS_FORMBUY'].elements['number'].value = res.number;
  }
  else
  {
    document.forms['HHS_FORMBUY'].elements['number'].value = res.qty;

    if (document.getElementById('HHS_GOODS_AMOUNT'))
      document.getElementById('HHS_GOODS_AMOUNT').innerHTML = res.result;
  }
}
</script>

<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script language="javascript" type="text/javascript">

	wx.config({
	    debug: false,//这里是开启测试，如果设置为true，则打开每个步骤，都会有提示，是否成功或者失败
	    appId: '<?php echo $this->_var['appid']; ?>',
	    timestamp: '<?php echo $this->_var['timestamp']; ?>',//这个一定要与上面的php代码里的一样。
	    nonceStr: '<?php echo $this->_var['timestamp']; ?>',//这个一定要与上面的php代码里的一样。
	    signature: '<?php echo $this->_var['signature']; ?>',
	    jsApiList: [
	      // 所有要调用的 API 都要加到这个列表中
	        'onMenuShareTimeline',
	        'onMenuShareAppMessage',
	        'onMenuShareQQ',
	        'onMenuShareWeibo',
	        'checkJsApi',
	        'openLocation',
	        'getLocation'
	    ]
	});
	
	var title="<?php echo $this->_var['title']; ?>";
	var link= "<?php echo $this->_var['link']; ?>";
	var imgUrl="<?php echo $this->_var['imgUrl']; ?>";
	var desc= "<?php echo $this->_var['desc']; ?>";
	wx.ready(function () {
	    wx.onMenuShareTimeline({//朋友圈
	        title: title, // 分享标题
	        link: link, // 分享链接
	        imgUrl: imgUrl, // 分享图标
	        success: function () { 
	            // 用户确认分享后执行的回调函数
	        	statis(2,1);
	        },
	        cancel: function () { 
	            // 用户取消分享后执行的回调函数
	        	statis(2,2);
	        }
	    });
	    wx.onMenuShareAppMessage({//好友
	        title: title, // 分享标题
	        desc: desc, // 
	        link: link, // 分享链接
	        imgUrl: imgUrl, // 分享图标
	        type: '', // 分享类型,music、video或link，不填默认为link
	        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
	        success: function () { 
	        	// 用户确认分享后执行的回调函数
	            statis(1,1);    
	        },
	        cancel: function () { 
	            // 用户取消分享后执行的回调函数
	        	statis(1,2);
	        }
	    });
	  
	    wx.onMenuShareQQ({
	        title: title, // 分享标题
	        desc: desc, // 分享描述
	        link: link, // 分享链接
	        imgUrl: imgUrl, // 分享图标
	        success: function () { 
	           // 用户确认分享后执行的回调函数
	        	statis(4,1);
	        },
	        cancel: function () { 
	           // 用户取消分享后执行的回调函数
	        	statis(4,2);
	        }
	    });
	    wx.onMenuShareWeibo({
	        title: title, // 分享标题
	        desc: desc, // 分享描述
	        link: link, // 分享链接
	        imgUrl: imgUrl, // 分享图标
	        success: function () { 
	           // 用户确认分享后执行的回调函数
	        	statis(3,1);
	        },
	        cancel: function () { 
	            // 用户取消分享后执行的回调函数
	        	statis(3,2);
	        }
	    });
	    <?php if ($this->_var['goods']['is_nearby']): ?>
	    wx.checkJsApi({
	    	
	        jsApiList: [
	            'getLocation'
	        ],
	        success: function (res) {
	             //alert(JSON.stringify(res));
	            // alert(JSON.stringify(res.checkResult.getLocation));
	            if (res.checkResult.getLocation == false) {
	                alert('你的微信版本太低，不支持微信JS接口，请升级到最新的微信版本！');
	                return;
	            }
	        }
	    });
	    wx.getLocation({
	        success: function (res) {
	            var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
	            var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
	            var speed = res.speed; // 速度，以米/每秒计
	            var accuracy = res.accuracy; // 位置精度
	            $.ajax({
	                type:"post",//请求类型
	                url:"goods.php",//服务器页面地址
	                data:"act=save_location&lat="+latitude+"&lng="+longitude,
	                dataType:"json",//服务器返回结果类型(可有可无)
	                error:function(){//错误处理函数(可有可无)
	                    //alert("ajax出错啦");
	                },
	                success:function(data){
	                    if(data.error==1){
	                        //alert('错误'+data.message);
	                    }else{
	                    	//document.getElementById('loading').style.display='none';
	                		
	                    }
	                }
	            });
	        },
	        cancel: function (res) {
	            alert('用户拒绝授权获取地理位置');
	        }
	    });
	    <?php endif; ?>	
	    
	});
	
	function statis(share_type,share_status){
		$.ajax({
            type:"post",//请求类型
            url:"share.php",//服务器页面地址
            data:"act=link&share_status="+share_status+"&share_type="+share_type+"&link_url=<?php echo $this->_var['link2']; ?>",
            dataType:"json",//服务器返回结果类型(可有可无)
            error:function(){//错误处理函数(可有可无)
                //alert("ajax出错啦");
            },
            success:function(data){
                
            }
        });
	}

</script>
<div class="back-top"><span uigs="wap_to_top">顶部</span></div>
</html>
