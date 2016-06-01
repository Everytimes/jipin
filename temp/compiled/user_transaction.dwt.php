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

<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.js,haohaios.js,user.js,shopping_flow.js,region.js')); ?>


<script type="text/javascript">

		//调用微信JS api 支付

	  function jsApiCall(code,returnrul,is_check,team_sign){
            
            if(is_check==1){
                
                $.ajax({
                    type:"post",//请求类型
                    url:"team_info.php",//服务器页面地址
                    data:"team_sign="+team_sign,
                    dataType:"json",
                    error:function(){
                        //alert("ajax出错啦");
                    },
                    success:function(data){
                  
                        if(data.error==0){
                        
                            WeixinJSBridge.invoke('getBrandWCPayRequest',code,function(res){

            					WeixinJSBridge.log(res.err_msg);
            					
            					if(res.err_msg.indexOf('ok')>0){
            
            						window.location.href=returnrul;
            
            					}
            				});
	                    }else{
	                       window.location=data.url;
	                    }
                    }
                });
                
	        }else{
	        
                WeixinJSBridge.invoke('getBrandWCPayRequest',code,function(res){

					WeixinJSBridge.log(res.err_msg);

					// alert(res.err_code+'调试信息：'+res.err_desc+res.err_msg);

					if(res.err_msg.indexOf('ok')>0){

						window.location.href=returnrul;

					}

				});
	        }
			

		}
 
		function callpay(code,returnrul,is_check,team_sign)

		{

			 if (typeof WeixinJSBridge == "undefined"){

			    if( document.addEventListener ){

			        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);

			    }else if (document.attachEvent){

			        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 

			        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);

			    }

			}else{
							
			    jsApiCall(code,returnrul,is_check,team_sign);
			} 
		}
		
	</script>
	
</head>
<body id="user">
<div class="container">
<?php if ($this->_var['action'] == 'order_list'): ?>
    <div class="nav_fixed">
        <a href="user.php?act=order_list" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['composite_status'] == ''): ?> nav_cur<?php endif; ?>">全部订单</span></a>
        <a href="user.php?act=order_list&composite_status=100" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['composite_status'] == 100): ?> nav_cur<?php endif; ?>">待付款</span></a>
        <a href="user.php?act=order_list&composite_status=120" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['composite_status'] == 120): ?> nav_cur<?php endif; ?>">待收货</span></a>
        <a href="user.php?act=order_list&composite_status=999" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['composite_status'] == 999): ?> nav_cur<?php endif; ?>">待评价</span></a>
    </div>
    <div id="dealliststatus1" >
        <?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
        <div class="order">
            <div class="order_hd">
               <?php if ($this->_var['item']['suppliers_name']): ?>商家:<?php echo $this->_var['item']['suppliers_name']; ?><?php else: ?>自营<?php endif; ?> 订单编号:<?php echo $this->_var['item']['order_sn']; ?>　成交时间:<?php echo $this->_var['item']['order_time']; ?> 
            </div>
            <div class="order_bd">
                <div class="order_glist">
                    <?php $_from = $this->_var['item']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['foreach_goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foreach_goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['foreach_goods_list']['iteration']++;
?>
                    <div class="order_goods" onclick="window.location='user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>';">
                        <div class="order_goods_img">
                            <img alt="<?php echo $this->_var['goods']['goods_name']; ?>" src="<?php echo $this->_var['goods']['goods_thumb']; ?>">
                        </div>
                        <div class="order_goods_info">
                            <div class="order_goods_name"><?php echo $this->_var['goods']['goods_name']; ?></div>
                            <div class="order_goods_attr">
                                <div class="order_goods_attr_item">
                                    <div class="order_goods_price"><i>¥</i><?php echo $this->_var['goods']['goods_price_fmt']; ?><i>/件</i></div>数量：<?php echo $this->_var['goods']['goods_number']; ?>
                                </div>
                                <p class="order_goods_attr_item"><?php echo $this->_var['goods']['goods_attr']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <div class="order_ft">
                        <div class="order_total">
                            <span class="order_total_info">共1件商品 ，免运费</span>
                            <span class="order_price">总金额：<b>¥<?php echo $this->_var['item']['total_fee']; ?></b></span>
                            <span class="coupon_icon" ms-if="order.coupons.length>0"></span>
                        </div>
                        <div class="order_opt">
                            <span class="order_status"><?php echo $this->_var['item']['order_status']; ?></span>
                            <div class="order_btn">
                            <!-- 
                                <a href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>">查看详情</a>
                                -->
                                <?php echo $this->_var['item']['handler']; ?>
                                
                                <!--a click="orderCancel(order.order_id)">取消订单</a>
                                <a class="order_btn_receive" ms-click="expressShow(order.order_id)">查看物流</a>
                                <a class="order_btn_receive" ms-click="orderReceive(order.order_id)">确认收货</a-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        
        
                

<div class="common">
    <div class="common-title">
        <p class="common_tit_l"><b>提交评价</b></p>
        <p class="common_tit_r"><a href="javascript:void(0);" class="close-common common-city"><img src="themes/haohaios/images/city_close.gif"></a></p>
    </div>
    <div class="common-content">
        <ul>
            <li>
                <label>评分</label>
                <div id="QuacorGrading">
                <input name="1" type="button" />
                <input name="2" type="button" />
                <input name="3" type="button" />
                <input name="4" type="button" />
                <input name="5" type="button" />
                </div>
            </li>
            <li>
                <label>内容</label>
                <textarea name="content" id="comment"></textarea>
            </li>
            <li>
                <label>　</label>
                <input id="btn-send" type="submit"  value="提交评论">
            </li>
        </ul>
    </div>
</div>
<div class="common-bg"></div>
<script>
var stars = 0;
var id_value = 0;
var order_id = 0;
$(function () {
    H_login = {};
    H_login.openLogin = function(){
        $('.order_btn_buy').click(function(){
            id_value = $(this).data('id');
            order_id = $(this).data('order_id');
            $("#comment").val('');
            $('.common').show();
            $('.common-bg').show();
        });
    };
    H_login.closeLogin = function(){
        $('.close-common').click(function(){
            $('.common').hide();
            $('.common-bg').hide();
        });
    };
    H_login.run = function () {
        this.closeLogin();
        this.openLogin();
    };
    H_login.run();

    $("#btn-send").click(function(event) {
       var comment = $.trim($("#comment").val());
       if (comment.length>0) {
        $.ajax({
            url: '/comment.php?act=create',
            type: 'POST',
            dataType: 'json',
            data: {comment: comment, stars: stars,id_value: id_value,order_id: order_id},
            success: function (res) {
                if(res.isError == 1){
                    alert(res.message)
                }
                else{
                    location.href='user.php?act=order_list&composite_status=999';
                }
            }
        })
        
       }
    });
});

var GradList = document.getElementById("QuacorGrading").getElementsByTagName("input");
/*
for(var di=0;di<parseInt(document.getElementById("QuacorGradingValue").getElementsByTagName("font")[0].innerHTML);di++){
	GradList[di].style.backgroundPosition = 'left center';
}
*/
for(var i=0;i < GradList.length;i++){
	GradList[i].onmouseover = function(){
		for(var Qi=0;Qi<GradList.length;Qi++){
			GradList[Qi].style.backgroundPosition = 'right center';
		}
		for(var Qii=0;Qii<this.name;Qii++){
			GradList[Qii].style.backgroundPosition = 'left center';
		}
        stars = this.name;
		//document.getElementById("QuacorGradingValue").innerHTML = '<b><font size="5" color="#fd7d28">'+this.name+'</font></b>分';
	}
}
</script>

        <?php echo $this->fetch('library/pages.lbi'); ?>
        
<!-- 
        <div class="list" id="invoice" style="display:none;">
            <h3>物流跟踪</h3>
            <div id="retData"></div>
        </div>
       -->  

    </div>
    <div class="express_box" id="invoice" style="display:none;">
            
    </div>
    
    

    
<div id="hexiao_img" class="hexiao_img" style="display:none;" onclick="document.getElementById('hexiao_img').style.display='none';">
    <div class="qrcode" id="qrcode"></div>
</div>
    
    
    

    <script src="/js/qrcode.js"></script>
    <script>
    var root = 'http://<?php echo $this->_var['root']; ?>';
    var qrcode = new QRCode(document.getElementById("qrcode"), '');
    function showCode(order_id){
        document.getElementById('hexiao_img').style.display='';
        qrcode.clear();
        qrcode.makeCode(root+"/handle.php?order_id="+parseInt(order_id));
    }
    </script>
    

<?php endif; ?>
<?php if ($this->_var['action'] == 'team_list'): ?>
<div class="con">
    <div class="nav_fixed">
        <a href="user.php?act=team_list" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['composite_status'] == ''): ?> nav_cur<?php endif; ?>">全部</span></a>
        <a href="user.php?act=team_list&composite_status=100" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['composite_status'] == 100): ?> nav_cur<?php endif; ?>">组团中</span></a>
        <a href="user.php?act=team_list&composite_status=120" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['composite_status'] == 120): ?> nav_cur<?php endif; ?>">已成团</span></a>
        <a href="user.php?act=team_list&composite_status=999" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['composite_status'] == 999): ?> nav_cur<?php endif; ?>">组团失败</span></a>
    </div>
    <div class="mt_order" style="margin-top:52px;">
        <?php if ($this->_var['orders']): ?>
        <?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
        
        <div class="mt_g">
            <?php $_from = $this->_var['item']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['foreach_goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foreach_goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['foreach_goods_list']['iteration']++;
?>
            <div class="mt_g_img" >
                <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>"></a>
            </div>
            <div class="mt_g_info" >
                <p class="mt_g_name"><?php echo $this->_var['goods']['goods_name']; ?></p>
                <p class="mt_g_price">成团价：<span><b>¥<?php echo $this->_var['goods']['goods_price_fmt']; ?></b>/件 </span><i></i></p>
            </div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
        <div class="mt_status">
            <span class="mt_status_txt"><?php echo $this->_var['item']['team_status']; ?></span>
            <a class ="mt_status_lk1" href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>"> 订单详情 </a>
            <a class ="mt_status_lk1 marg_right" href="share.php?team_sign=<?php echo $this->_var['item']['team_sign']; ?>"> 团详情 </a>
            <?php if ($this->_var['item']['square'] == 1): ?>
            <a href="javascript:void(0);" class="mt_status_lk1 marg_right qfabu" data-id="<?php echo $this->_var['goods']['goods_id']; ?>" data-order_id="<?php echo $this->_var['item']['order_id']; ?>">发布</a>
            <?php endif; ?>
        </div>
        <div class="groups_line"></div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <?php echo $this->fetch('library/pages.lbi'); ?>
        <?php else: ?>
        <a href="index.php"><div class="mt_nogroups"><h4>您还没有参加过任何团哦，赶快去首页火拼吧！</h4></div></a>
        <?php endif; ?>
        
    </div>
</div>
<div style="height:58px;visibility:hidden "></div>



<div class="common">
    <div class="common-title">
        <p class="common_tit_l"><b>发布广场</b></p>
        <p class="common_tit_r"><a href="javascript:void(0);" class="close-common common-city"><img src="themes/haohaios/images/city_close.gif"></a></p>
    </div>
    <div class="common-content">
        <ul>
            <li>
                <label>描述</label>
                <textarea id="square"></textarea>
            </li>
            <li>
                <label>　</label>
                <input id="btn-square" type="submit"  value="发布">
            </li>
        </ul>
    </div>
</div>
<div class="common-bg"></div>
<script>
var stars = 0;
var goods_id = 0;
var order_id = 0;
$(function () {
    H_login = {};
    H_login.openLogin = function(){
        $('.qfabu').click(function(){
            goods_id = $(this).data('id');
            order_id = $(this).data('order_id');
            $("#comment").val('');
            $('.common').show();
            $('.common-bg').show();
        });
    };
    H_login.closeLogin = function(){
        $('.close-common').click(function(){
            $('.common').hide();
            $('.common-bg').hide();
        });
    };
    H_login.run = function () {
        this.closeLogin();
        this.openLogin();
    };
    H_login.run();

    $("#btn-square").click(function(event) {
       var square = $.trim($("#square").val());
       console.info(square)
       if (square.length>0) {
        $.ajax({
            url: '/square.php?act=create',
            type: 'POST',
            dataType: 'json',
            data: {square: square,order_id: order_id},
            success: function (res) {
                if(res.isError == 1){
                    alert(res.message)
                }
                else{
                    alert('发布成功！')
                    location.reload();
                }
            }
        })
        
       }
    });
});

</script>







<?php endif; ?>




<?php if ($this->_var['action'] == 'lottery_list'): ?>
    <div id="dealliststatus1" style="padding-top:0;">
        <?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
        <div class="order">
        <?php if ($this->_var['item']['team_status'] == 2): ?> 
            <?php if ($this->_var['item']['is_lucker'] == 1): ?>
            <div class="zj"></div>
            <?php else: ?>
            <div class="wzj"></div>
            <?php endif; ?>
        <?php endif; ?>
            
            <div class="order_hd">
               <?php if ($this->_var['item']['suppliers_name']): ?>商家:<?php echo $this->_var['item']['suppliers_name']; ?><?php else: ?>自营<?php endif; ?> 订单编号:<?php echo $this->_var['item']['order_sn']; ?>　成交时间:<?php echo $this->_var['item']['order_time']; ?> 
            </div>
            <div class="order_bd">
                <div class="order_glist">
                    <?php $_from = $this->_var['item']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['foreach_goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foreach_goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['foreach_goods_list']['iteration']++;
?>
                    <div class="order_goods" onclick="window.location='user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>';">
                        <div class="order_goods_img">
                            <img alt="<?php echo $this->_var['goods']['goods_name']; ?>" src="<?php echo $this->_var['goods']['goods_thumb']; ?>">
                        </div>
                        <div class="order_goods_info">
                            <div class="order_goods_name"><?php echo $this->_var['goods']['goods_name']; ?></div>
                            <div class="order_goods_attr">
                                <div class="order_goods_attr_item">
                                    <div class="order_goods_price"><i>¥</i><?php echo $this->_var['goods']['goods_price_fmt']; ?><i>/件</i></div>数量：<?php echo $this->_var['goods']['goods_number']; ?>
                                </div>
                                <p class="order_goods_attr_item"><?php echo $this->_var['goods']['goods_attr']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <div class="order_ft">
                        <div class="order_total">
                            <span class="order_total_info">共1件商品 ，免运费</span>
                            <span class="order_price">总金额：<b>¥<?php echo $this->_var['item']['total_fee']; ?></b></span>
                            <span class="coupon_icon" ms-if="order.coupons.length>0"></span>
                        </div>
                        <div class="order_opt">
                            <span class="order_status"><?php echo $this->_var['item']['order_status']; ?></span>
                            <div class="order_btn">
                            <!-- 
                                <a href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>">查看详情</a>
                                -->
                                <?php echo $this->_var['item']['handler']; ?>
                                
                                <!--a click="orderCancel(order.order_id)">取消订单</a>
                                <a class="order_btn_receive" ms-click="expressShow(order.order_id)">查看物流</a>
                                <a class="order_btn_receive" ms-click="orderReceive(order.order_id)">确认收货</a-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        <?php echo $this->fetch('library/pages.lbi'); ?>


    </div>
    <div class="express_box" id="invoice" style="display:none;">
            
    </div>
<?php endif; ?>




<?php if ($this->_var['action'] == order_detail): ?>
    <div class="mod_container"   id="dealliststatus1">
        <div id="detailCon" class="wx_wrap">
            <div class="<?php if ($this->_var['order']['shipping_status_cy'] == 2): ?>state state_3<?php elseif ($this->_var['order']['shipping_status_cy'] == 1): ?>state state_2<?php elseif ($this->_var['order']['pay_status_cy'] == 2): ?>state state_1<?php endif; ?>">
                <div class="state_step">
                    <ul>
                        <li class="state_step_1"></li>
                        <li class="state_step_2"></li>
                        <li class="state_step_3"></li>
                    </ul>
                <span class="state_arrow">
                <i class="state_arrow_i"></i>
                <i class="state_arrow_o"></i>
                </span>
                </div>
                <div class="address">
                    <div class="address_row">
                        <div class="address_tit">订单状态：</div>
                        <div class="address_cnt">
                            <b><?php echo $this->_var['order']['order_status']; ?></b>
                        </div>
                    </div>
                    <!-- 
                    <div class="address_row">
                        <div class="address_tit">支付状态：</div>
                        <div class="address_cnt">
                            <b><?php echo $this->_var['order']['pay_status']; ?></b>
                        </div>
                    </div>
                    <div class="address_row">
                        <div class="address_tit">配送状态：</div>
                        <div class="address_cnt">
                            <b><?php echo $this->_var['order']['shipping_status']; ?></b>
                        </div>
                    </div> -->
                    <div class="address_row">
                        <div class="address_tit">总 额：</div>
                        <div class="address_cnt">
                            <span class="address_price"><?php echo $this->_var['order']['formated_total_fee']; ?></span>
                            <span class="address_paytype">（<?php echo $this->_var['order']['pay_name']; ?>）</span>
                        </div>
                    </div>
                    <div class="address_row">
                        <div class="address_tit">订单编号：</div>
                        <div class="address_cnt"><?php echo $this->_var['order']['order_sn']; ?></div>
                    </div>
                    <div class="address_row">
                        <div class="address_tit">下单时间：</div>
                        <div class="address_cnt"><?php echo $this->_var['order']['add_time']; ?></div>
                    </div>
                    <?php if ($this->_var['order']['shipping_id'] != $this->_var['notExpress']): ?>
                    <div class="address_row">
                        <div class="address_tit">送 至：</div>
                        <div class="address_cnt"><?php echo htmlspecialchars($this->_var['order']['province']); ?> <?php echo htmlspecialchars($this->_var['order']['city']); ?> <?php echo htmlspecialchars($this->_var['order']['district']); ?> <?php echo $this->_var['order']['address']; ?></div>
                    </div>
                    <div class="address_row">
                        <div class="address_tit">收 货 人：</div>
                        <div class="address_cnt"><?php echo htmlspecialchars($this->_var['order']['consignee']); ?> <?php echo htmlspecialchars($this->_var['order']['mobile']); ?></div>
                    </div>
                    <div class="address_row">
                        <div class="address_tit">配送方式：</div>
                        <div class="address_cnt"><?php echo $this->_var['order']['shipping_name']; ?><br><?php echo $this->_var['order']['invoice_no']; ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->_var['order']['shipping_id'] == $this->_var['notExpress']): ?>
                    <div class="address_row">
                        <div class="address_tit">取货地址：</div>
                        <div class="address_cnt"><?php echo $this->_var['order']['shipping_point']; ?></div>
                    </div>
                    <?php endif; ?>
                </div>
               <?php if (1): ?>
                <div class="state_btn">
                <?php echo $this->_var['order']['handler']; ?> 
                </div>
                <div class="state_btn"> </div>
                <?php endif; ?>
            </div>
            <div class="ptit">商品信息
            </div>
            <div class="order order_height">
                <div class="order_bd">
                    <div class="order_glist">
                        <div class="order_item">
                            <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                            <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" class="order_goods" style="float:left;border-bottom:none;">
                                <div class="order_goods_img">
                                    <img src="<?php echo $this->_var['goods']['little_img']; ?>">
                                </div>
                            </a>
                            <div class="order_goods_info">
                                <a class="order_goods" href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>">
                                    <div class="order_goods_name"><?php echo $this->_var['goods']['goods_name']; ?></div>
                                    <div class="order_goods_attr">
                                        <div class="order_goods_attr_item">数量：<?php echo $this->_var['goods']['goods_number']; ?>
                                            <div class="order_goods_price"><i>¥</i><?php echo $this->_var['goods']['goods_price']; ?><i>/件</i></div>
                                        </div>
                                        <p class="order_goods_attr_item"><?php echo nl2br($this->_var['goods']['goods_attr']); ?></p>
                                    </div>
                                </a>
                            </div>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </div>
                    </div>
                    <div>
                    <?php if ($this->_var['order']['team_sign'] && $this->_var['order']['team_status'] != 0): ?>
                        <a class ="mt_status_lk1 marg_right" href="share.php?team_sign=<?php echo $this->_var['order']['team_sign']; ?>">查看团详情 </a>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <div class="express_box" id="invoice" style="display:none;">
        <!-- 
        <h3>物流跟踪</h3>
        <ul>
         <div id="retData"></div> 
         </ul>-->
     </div>
<?php endif; ?>
<?php if ($this->_var['action'] == team_detail): ?>

    <div class="mod_container">
        <div id="detailCon" class="wx_wrap">
            
            <div class="ptit">商品信息
            </div>
            <div class="order order_height">
                <div class="order_bd">
                    <div class="order_glist">
                        <div class="order_item">
                            <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                            <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" class="order_goods" style="float:left;border-bottom:none;">
                                <div class="order_goods_img">
                                    <img src="<?php echo $this->_var['goods']['little_img']; ?>">
                                </div>
                            </a>
                            <div class="order_goods_info">
                                <a class="order_goods" href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>">
                                    <div class="order_goods_name"><?php echo $this->_var['goods']['goods_name']; ?></div>
                                    <div class="order_goods_attr">
                                        <br>
                                        <div class="order_goods_attr_item">数量：<?php echo $this->_var['goods']['goods_number']; ?>
                                            <div class="order_goods_price"><i>¥</i><?php echo $this->_var['goods']['goods_price']; ?><i>/件</i></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </div>
                    </div>
                    
                    <div>
                        <?php $_from = $this->_var['team_mem']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
				            <div class="my_head" style="float:left;">
				                <div class="my_head_pic">
				                    <img class="my_head_img" width="130" height="130" src="<?php echo $this->_var['item']['headimgurl']; ?>">
				                </div>
				            </div>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </div>
                    <div style="clear:both;"></div>
                     <div>
                    	<span id="time"></span>
                    </div>
                    
                    <div>
                     <?php $_from = $this->_var['team_mem']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                     	<?php if (($this->_foreach['name']['iteration'] - 1) == 0): ?>
				             团长：<?php echo $this->_var['item']['user_name']; ?> 	开团时间：<?php echo $this->_var['item']['date']; ?>
                     	<?php else: ?>
                     	<?php echo $this->_var['item']['user_name']; ?> 	参团时间：<?php echo $this->_var['item']['date']; ?>
                     	<?php endif; ?>
                     <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </div>
                     <?php if ($this->_var['order']['team_status'] == 1): ?>
                     正在进行
                     <?php elseif ($this->_var['order']['team_status'] == 2): ?>
                     成功
                     <?php elseif ($this->_var['order']['team_status'] == 3): ?>
                     失败待退款
                     <?php elseif ($this->_var['order']['team_status'] == 4): ?>
                     失败退款成功
                     <?php endif; ?>
                     <div id="handler">
                     <?php if ($this->_var['order']['team_status'] == 1): ?>
                      <button onclick="window.location='share.php?team_sign=<?php echo $this->_var['order']['team_sign']; ?>';">分享给朋友</button>
                      <?php else: ?>
                      <button type="button" onclick="window.location='index.php';">我也要开个团，点此到商品列表</button>
                      <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>

    var daysms = 24 * 60 * 60 * 1000;
    var hoursms = 60 * 60 * 1000;
    var Secondms = 60 * 1000;
    var microsecond = 1000;
    var DifferHour = 0;
    var DifferMinute = 0;
    var DifferSecond = 0;
    	
    var systime=<?php echo $this->_var['systime']; ?>;
    var team_start=<?php echo $this->_var['team_start']; ?>*1000;
    var team_end=<?php echo $this->_var['team_start']; ?>*1000+<?php echo $this->_var['team_suc_time']; ?>*24*3600*1000;
    setInterval("systime_clock()",1000);
    function systime_clock(){
    	systime++;
    }

    function clock()
    {	
    	//当前时间
      var time = new Date();
      time.setTime(systime*1000);

      var Diffms = team_end - time.getTime();
      var Diffms1=Diffms;
      var a='';
      var b='';
      var c='';
      var d='';
      DifferHour = Math.floor(Diffms / daysms);
      Diffms -= DifferHour * daysms;
      DifferMinute = Math.floor(Diffms / hoursms);
      Diffms -= DifferMinute * hoursms;
      DifferSecond = Math.floor(Diffms / Secondms);
      Diffms -= DifferSecond * Secondms;
      var dShhs = Math.floor(Diffms / microsecond);
      if(Diffms1>=0){
    	   //a="还剩<strong class='tcd-h'>"+DifferHour+"</strong>天;";
    	   b="还剩<strong >"+DifferMinute+"</strong>时";
    	   c="<strong >"+DifferSecond+"</strong>分";
    	   d="<strong >"+dShhs+"</strong>秒";
    	  document.getElementById('time').innerHTML =b+c+d;
    	 
      }else{//已结束
    	  document.getElementById('handler').innerHTML="<button type='button' onclick='window.location=\'index.php\';'>我也要开个团，点此到商品列表</button>";
    	   document.getElementById('time').innerHTML ="<strong style='color:#999;'>已结束</strong>"
      }
    }
     
    window.setInterval("clock()", 1000);
    </script>
<?php endif; ?>
<?php if ($this->_var['action'] == 'address_list'): ?>
    <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,region.js,shopping_flow.js')); ?>
    <script type="text/javascript">
      region.isAdmin = false;
      <?php $_from = $this->_var['lang']['flow_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
      var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      
      onload = function() {
        if (!document.all)
        {
          document.forms['theForm'].reset();
        }
      }
      
    </script>
    
    <div class="wx_bar">
        <div class="wx_bar_back">
            <a id="listPageback" href="javascript:void(0);"></a>
        </div>
        <div class="wx_bar_act">
            <a href="javascript:void(0);" class="wx_bar_new" style="display: none;" id="_new"></a>
        </div>
    </div>
    <div class="wx_wrap">
        <div class="address_list" id="addressList">
            <div class="address">
                <?php $_from = $this->_var['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'consignee');if (count($_from)):
    foreach ($_from AS $this->_var['sn'] => $this->_var['consignee']):
?>
                
                <ul <?php if ($this->_var['consignee']['address_id'] == $this->_var['default_address_id']): ?>class="selected"<?php endif; ?> >
                    <li><span><?php echo htmlspecialchars($this->_var['consignee']['address']); ?></span></li>
                    <li><strong><?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?></strong><?php echo htmlspecialchars($this->_var['consignee']['mobile']); ?></li>
                    <li ><a class="edit" href="user.php?act=edit_consignee&address_id=<?php echo $this->_var['consignee']['address_id']; ?>" >编辑</a></li>
                </ul>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>

            <div class="address_list_link"> 
                <a href="user.php?act=edit_consignee" class="item item_new">新增收货地址</a>
            </div>
            <div class="margin_footer"></div>
        </div>
    </div>

<?php endif; ?>
<?php if ($this->_var['action'] == 'edit_address'): ?>
    <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,region.js,shopping_flow.js')); ?>
    <script type="text/javascript">
      region.isAdmin = false;
      <?php $_from = $this->_var['lang']['flow_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
      var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      
      onload = function() {
        if (!document.all)
        {
          document.forms['theForm'].reset();
        }
      }
      
    </script>
            <?php $_from = $this->_var['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'consignee');if (count($_from)):
    foreach ($_from AS $this->_var['sn'] => $this->_var['consignee']):
?>
            <form action="user.php" method="post" name="theForm" onsubmit="return checkConsignee(this)">
              <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
              
                <tr>
                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignee_name']; ?>：</td>
                  <td align="left" bgcolor="#ffffff"><input name="consignee" type="text" class="inputBg" id="consignee_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?>" />
              </td>

                </tr>
                <tr>
                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['backup_phone']; ?>：</td>
                  <td align="left" bgcolor="#ffffff"><input name="mobile" type="text" class="inputBg" id="mobile_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['mobile']); ?>" /></td>
                </tr>
                <tr>
                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['country_province']; ?>：</td>
                  <td colspan="3" align="left" bgcolor="#ffffff">
                    <select name="country" id="selCountries_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 1, 'selProvinces_<?php echo $this->_var['sn']; ?>')">
                      <option value="0"><?php echo $this->_var['lang']['please_select']; ?></option>
                      <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?>
                      <option value="<?php echo $this->_var['country']['region_id']; ?>" <?php if ($this->_var['consignee']['country'] == $this->_var['country']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['country']['region_name']; ?></option>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </select>
                    <select name="province" id="selProvinces_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 2, 'selCities_<?php echo $this->_var['sn']; ?>')">
                      <option value="0"><?php echo $this->_var['lang']['please_select']; ?></option>
                      <?php $_from = $this->_var['province_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province');if (count($_from)):
    foreach ($_from AS $this->_var['province']):
?>
                      <option value="<?php echo $this->_var['province']['region_id']; ?>" <?php if ($this->_var['consignee']['province'] == $this->_var['province']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['province']['region_name']; ?></option>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </select>
                    <select name="city" id="selCities_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 3, 'selDistricts_<?php echo $this->_var['sn']; ?>')">
                      <option value="0"><?php echo $this->_var['lang']['please_select']; ?></option>
                      <?php $_from = $this->_var['city_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?>
                      <option value="<?php echo $this->_var['city']['region_id']; ?>" <?php if ($this->_var['consignee']['city'] == $this->_var['city']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['city']['region_name']; ?></option>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </select>
                    <select name="district" id="selDistricts_<?php echo $this->_var['sn']; ?>" <?php if (! $this->_var['district_list'][$this->_var['sn']]): ?>style="display:none"<?php endif; ?>>
                      <option value="0"><?php echo $this->_var['lang']['please_select']; ?></option>
                      <?php $_from = $this->_var['district_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
                      <option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['consignee']['district'] == $this->_var['district']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['district']['region_name']; ?></option>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </select>
              </td>
                </tr>

                <tr>
                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detailed_address']; ?>：</td>
                  <td align="left" bgcolor="#ffffff"><input name="address" type="text" class="inputBg" id="address_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['address']); ?>" />
                </td>
                </tr>

                <tr>
                  <td align="right" bgcolor="#ffffff">&nbsp;</td>
                  <td colspan="3" align="center" bgcolor="#ffffff"><?php if ($this->_var['consignee']['consignee']): ?>
                    <input type="submit" name="submit" class="bnt_blue_1" value="<?php echo $this->_var['lang']['confirm_edit']; ?>" />
                    <input name="button" type="button" class="bnt_blue"  onclick="if (confirm('<?php echo $this->_var['lang']['confirm_drop_address']; ?>'))location.href='user.php?act=drop_consignee&id=<?php echo $this->_var['consignee']['address_id']; ?>'" value="<?php echo $this->_var['lang']['drop']; ?>" />
                    <?php else: ?>
                    <input type="submit" name="submit" class="bnt_blue_2"  value="<?php echo $this->_var['lang']['add_address']; ?>"/>
                    <?php endif; ?>
                    <input type="hidden" name="act" value="act_edit_address" />
                    <input name="address_id" type="hidden" value="<?php echo $this->_var['consignee']['address_id']; ?>" />
                  </td>
                </tr>
              </table>
            </form>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>




     <?php if ($this->_var['action'] == 'bonus'): ?>
      <script type="text/javascript">
        <?php $_from = $this->_var['lang']['profile_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
          var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </script>
    <div class="nav_fixed nav_bonus">
        <a href="user.php?act=bonus" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['status'] == ''): ?> nav_cur<?php endif; ?>">优惠券</span></a>
        <a href="user.php?act=bonus&status=not_start" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['status'] == 'not_start'): ?> nav_cur<?php endif; ?>">未激活</span></a>
        <a href="user.php?act=bonus&status=overdue" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['status'] == 'overdue'): ?> nav_cur<?php endif; ?>">已过期</span></a>
    </div>
    
    <div class="wrapper_coupons" >
    
   	<?php if ($this->_var['bonus']['using']): ?>
   	<div class="curr_used_coupons" style="display:block;">
        <b class="can_use">使用中：</b>
   		<?php $_from = $this->_var['bonus']['using']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
            <div class="coup_one slide_width slideleft" onclick="toggle(this);">
                
                <div class="half_width">
                    <img src="themes/haohaios/images/yellow_bd15f0c.png" class="coup_img">
                    <div>
                        <p class="pin martop"></p>
                    </div>
                    <div>
                            <b class="pin1"><?php echo $this->_var['item']['suppliers_name']; ?></b>
                        </div>
                    <div class="coup_text_left left_next">
                        <?php if ($this->_var['item']['free_all'] == 1): ?>
                        <p>免单券</p>
                        <?php else: ?>
                        <p><?php echo $this->_var['item']['type_money']; ?>元</p>
                        <?php endif; ?>
                        <div class="text_copus_desc"><?php echo $this->_var['bonus_ad']; ?></div>
                    </div>
                    <div class="coup_time_right">
                        <b>有效期</b>
                        <br>
                        <div class="text_copus_time"> <?php echo $this->_var['item']['use_startdate']; ?> ~
                            <br><?php echo $this->_var['item']['use_enddate']; ?></div>
                    </div>
                </div>
                
                <div class="ordre_posi">
                    <div class="coup_order">
                        <span class="unbind"><a href="user.php?act=cancel_order&order_id=<?php echo $this->_var['item']['order_id']; ?>" onclick="if(confirm('确定要取消吗？') ) return true;else return false;">取消订单</a></span>
                        <div class="order_item">
                            <a href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>" class="coup_order_goods_img">
                                <img src="<?php echo $this->_var['item']['goods']['goods_thumb']; ?>">
                            </a>
                            <div class="coup_order_info">
                                <div class="coup_order_goods">
                                    <div class="order_goods_name"><?php echo $this->_var['item']['goods']['goods_name']; ?></div>
                                    <div class="order_goods_attr">
                                        <div class="order_goods_attr_item">
                                            <div class="coup_goods_price"><i>¥</i><?php echo $this->_var['item']['goods']['total_fee']; ?><i>元</i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="coup_order" ms-if="coupon.order_goods.length==0">
                    	<div class="center err_ord"></div>
                    </div>
                </div>
            </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
        <?php endif; ?>
        
        <?php if ($this->_var['bonus']['ok']): ?>
        <div class="curr_used_coupons" style="display:block;">
            <b class="can_use">当前可用：</b>
        <?php $_from = $this->_var['bonus']['ok']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
            <div class="coup_one">
                <div>
                    <img src="themes/haohaios/images/yellow_bd15f0c.png" class="coup_img">
                    <div>
                        <b class="pin"></b>
                    </div>
                    <div>
                            <b class="pin1"><?php echo $this->_var['item']['suppliers_name']; ?></b>
                        </div>
                    <div class="coup_text_left ">
                        <?php if ($this->_var['item']['free_all'] == 1): ?>
                        <p>免单券</p>
                        <?php else: ?>
                        <p><?php echo $this->_var['item']['type_money']; ?>元</p>
                        <?php endif; ?>
                        <div class="text_copus_desc"><?php echo $this->_var['bonus_ad']; ?>
                                <br>记得及时使用哦~ ~ </div>
                    </div>
                    <div class="coup_time_right add_right">
                        <b>有效期</b>
                        <br>
                        <div class="text_copus_time"> <?php echo $this->_var['item']['use_startdate']; ?> ~
                            <br><?php echo $this->_var['item']['use_enddate']; ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
        <?php endif; ?>

        <div>
        <?php if ($this->_var['bonus']['used']): ?>
        <b class="can_use">已使用：</b>
        <?php $_from = $this->_var['bonus']['used']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
            
            <div class="coup_one">
                <div>
                    <img src="themes/haohaios/images/gray_010a283.png" class="coup_img">
                    <img src="themes/haohaios/images/used_b0be89f.png" class="seal">
                    <div>
                        <b class="pin"></b>
                    </div>
                       <div>
                            <b class="pin1"><?php echo $this->_var['item']['suppliers_name']; ?></b>
                        </div>
                    <div class="coup_text_left">
                        <?php if ($this->_var['item']['free_all'] == 1): ?>
                        <p class="used">免单券</p>
                        <?php else: ?>
                        <p class="used"><?php echo $this->_var['item']['type_money']; ?>元</p>
                        <?php endif; ?>
                        <div class="text_copus_desc"><?php echo $this->_var['bonus_ad']; ?>
                                <br>记得及时使用哦~ ~ </div>
                    </div>
                    <div class="coup_time_right">
                        <b class="userd">使用时间</b>
                        <br>
                        <div class="text_copus_time"><?php echo $this->_var['item']['used_date']; ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php endif; ?>
            
            <?php if ($this->_var['bonus']['not_start']): ?>
            <b class="can_use">未激活：</b>
            <?php $_from = $this->_var['bonus']['not_start']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
            <div class="coup_one">
                <div>
                    <img src="themes/haohaios/images/gray_010a283.png" class="coup_img">
                    <img src="themes/haohaios/images/frozen_b2e18e4.png" class="seal">
                    <div>
                        <b class="pin"></b>
                    </div><div>
                            <b class="pin1"><?php echo $this->_var['item']['suppliers_name']; ?></b>
                        </div>
                    <div class="coup_text_left">
                        <p class="used"><?php echo $this->_var['item']['type_money']; ?>元优惠劵</p>
                        <div class="text_copus_desc"><?php echo $this->_var['bonus_ad']; ?>
                                <br>记得及时使用哦~ 哦~ </div>
                    </div>
                    <div class="coup_time_right" ms-class="add_right:status==0">
                        <b class="userd">有效期</b>
                        <br>
                         <div class="text_copus_time"><?php echo $this->_var['item']['use_startdate']; ?> ~
                            <br><?php echo $this->_var['item']['use_enddate']; ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php endif; ?>
            <?php if ($this->_var['bonus']['overdue']): ?>
            <b class="can_use">已过期：</b>
			<?php $_from = $this->_var['bonus']['overdue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
            <div class="coup_one">
                <div>
                    <img src="themes/haohaios/images/gray_010a283.png" class="coup_img">
                    <img src="themes/haohaios/images/expired_9a12150.png" class="seal">
                    <div>
                        <b class="pin"></b>
                    </div>
                    <div>
                            <b class="pin1"><?php echo $this->_var['item']['suppliers_name']; ?></b>
                        </div>
                    <div class="coup_text_left">
                        <p class="used"><?php echo $this->_var['item']['type_money']; ?>元优惠劵</p>
                        <div class="text_copus_desc"><?php echo $this->_var['bonus_ad']; ?>
                                <br>记得及时使用哦~ ~ </div>
                    </div>
                    <div class="coup_time_right" ms-class="add_right:status==0">
                        <b class="userd">有效期</b>
                        <br>
                         <div class="text_copus_time"><?php echo $this->_var['item']['use_startdate']; ?> ~
                            <br><?php echo $this->_var['item']['use_enddate']; ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php endif; ?>
<div class="addBouns">
      <form name="addBouns" action="user.php" method="post" onSubmit="return addBonus()">
          <input name="bonus_sn" type="text" size="30" class="inp" placeholder="<?php echo $this->_var['lang']['bonus_number']; ?>" />
          <input type="hidden" name="act" value="act_add_bonus" class="inp" />
          <input type="submit" class="bnt" style="border:none;" value="绑定优惠券" />
      </form>
 </div>    
        </div>
        
        <div ms-if="!all_coupons.length">
            <div ms-if="net_err" class="center  margintop">
                
            </div>
            <div ms-if="no_coupons" class="center margintop" ms-html="no_coupons_text">
            </div>
        </div>
    </div>

    <?php endif; ?>
   
   
   
   
   
   
    <?php if ($this->_var['action'] == 'collection_list'): ?>
  <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
  
<div id="likes">
            <div class="no-like" style="display: none;">还没有添加任何商品到收藏，<br>去找找你心仪的商品吧~</div>
            
            
            <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
            <div class="likes-like">
                <div class="likes-like_goods">
                    <div class="likes-like_goods_img">
                        <img src="<?php echo $this->_var['goods']['goods_img']; ?>">
                    </div>
                    <div class="likes-like_goods_name"><?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?></div>
                    <div class="core-container">
                        <div class="likes-like_goods_core">
                            <div class="likes_g_price">
                                <span><?php echo $this->_var['goods']['team_num']; ?>2人团</span>
                                <b><span>¥</span><?php echo $this->_var['goods']['shop_price']; ?></b>
                            </div>
                            <a href="<?php echo $this->_var['goods']['url']; ?>" class="likes_g_btn">去开团</a>
                        </div>
                    </div>
                    <div class="like-like_button gif">
                        <a href="javascript:if (confirm('<?php echo $this->_var['lang']['remove_collection_confirm']; ?>')) location.href='user.php?act=delete_collection&collection_id=<?php echo $this->_var['goods']['rec_id']; ?>'"><img src="themes/haohaios/images/like_high.png"></a>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            

        </div>
        <?php echo $this->fetch('library/pages.lbi'); ?>
   <?php endif; ?>
   
   
   
   
</div>
<div class="footer">
    <ul>
        <li><a href="index.php" class="nav-controller"><i class="icon-index"></i>首页</a></li>
		<li><a href="catalog.php" class="nav-controller"><i class="icon-catalog"></i>分类</a></li>
		<li><a href="/bbs" class="nav-controller"><i class="icon-square"></i>团员之家</a></li>
        <li><a href="rank.php?act=hot" class="nav-controller"><i class="icon-rank"></i>热榜</a></li>
        <li><a href="user.php" class="nav-controller active"><i class="icon-user"></i>个人中心</a></li>
    </ul>
</div>

</body>
<script type="text/javascript">
<?php $_from = $this->_var['lang']['clips_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
function toggle(thisObj){
	if(thisObj.className.indexOf('slideleft')!==-1){
		thisObj.className='coup_one slide_width ';
	}else{
		thisObj.className="coup_one slide_width slideleft";
	}
}
</script>
  
<script language="javascript">
	function cancel_invoice(){
		document.body.style.overflow = "";
		document.getElementById('invoice').style.display='none';
		document.getElementById('dealliststatus1').style.display='';
		document.getElementById("dealliststatus1").style.backgroundColor="";
		document.getElementById("dealliststatus1").style.opacity = '';
	}
    function get_invoice(expressid,expressno){	
    	document.getElementById("invoice").style.display="";
    	document.getElementById("invoice").innerHTML="<center>正在查询物流信息，请稍后...</center>";
    	if(document.getElementById("dealliststatus1")){
    		//document.getElementById("dealliststatus1").style.display="none";
    		
    		document.body.style.overflow = "hidden";
    		document.getElementById("dealliststatus1").style.backgroundColor="#EEEEEE";
    		document.getElementById("dealliststatus1").style.opacity = 50/100;
    		/**/
    	}
    	
    	/*
    	var expressid = document.getElementById("shipping_name").innerHTML;
    	var expressno = document.getElementById("invoice_no").innerHTML;
    	
    	var expressid="<?php echo $this->_var['order']['shipping_name']; ?>";
    	var expressno="<?php echo $this->_var['order']['invoice_no']; ?>"; 
    	*/ 

    	Ajax.call('/plugins/juhe/kuaidi.php?com='+ expressid+'&nu=' + expressno,'showtest=showtest', 
    			get_invoice_reponse, 'GET', 'JSON');
    }
	function get_invoice_reponse(result){ 
		/*
		  {"message":"ok","status":"1","state":"3","data":
            [{"time":"2012-07-07 13:35:14","context":"客户已签收"},
             {"time":"2012-07-07 09:10:10","context":"离开 [北京石景山营业厅] 派送中，递送员[温]，电话[]"},
             {"time":"2012-07-06 19:46:38","context":"到达 [北京石景山营业厅]"},
             {"time":"2012-07-06 15:22:32","context":"离开 [北京石景山营业厅] 派送中，递送员[温]，电话[]"},
             {"time":"2012-07-06 15:05:00","context":"到达 [北京石景山营业厅]"},
             {"time":"2012-07-06 13:37:52","context":"离开 [北京_同城中转站] 发往 [北京石景山营业厅]"},
             {"time":"2012-07-06 12:54:41","context":"到达 [北京_同城中转站]"},
             {"time":"2012-07-06 11:11:03","context":"离开 [北京运转中心驻站班组] 发往 [北京_同城中转站]"},
             {"time":"2012-07-06 10:43:21","context":"到达 [北京运转中心驻站班组]"},
             {"time":"2012-07-05 21:18:53","context":"离开 [福建_厦门支公司] 发往 [北京运转中心_航空]"},
             {"time":"2012-07-05 20:07:27","context":"已取件，到达 [福建_厦门支公司]"}
            ]} 
		*/
/*
		if((result.status==0||result.status==3||result.status==5)&&result.message=='ok'){
			var str="";
			$.each(result.data,function(i,e){
				str+=e.context+"	".e.time;
			})
			document.getElementById("retData").innerHTML=str;
		}else{
			document.getElementById("retData").innerHTML=result.message;
		}*/
		
		document.getElementById("invoice").innerHTML=result;
	}
</script>
</html>
