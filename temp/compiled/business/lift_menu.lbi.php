<div class="headcon">

		<h1 title="商家管理平台">商家管理平台</h1>

		<div class="headright">

			<div class="welcome"></div>

			<div class="operate"><a href="?act=logout">退出登录</a>
            <?php if ($_SESSION['role_id'] == ''): ?>
            <a href="suppliers.php?act=edit_password">修改密码</a>
            <?php endif; ?>
            <!-- 
            <a href="/store.php?id=<?php echo $this->_var['suppliers_id']; ?>" target="_blank">我的店铺</a>
             -->
            </div>

		</div>

	</div>

<div class="leftcon" >

		<ul class="menu">

			<li <?php if ($this->_var['action'] == 'default'): ?> class="choise"<?php endif; ?>>

				<a href="suppliers.php?act=default">欢迎页</a>

			</li>
            <?php if ($this->_var['suppliers_array']['is_check'] == 1): ?>
            
            <li >
				<a href="javascript:;" class="article">商品管理</a>

                <div class="second_menu" >

                
                   <a href="?act=my_goods" class="goods <?php if ($this->_var['action'] == 'my_goods'): ?>choise<?php endif; ?>">商品列表</a>

                    
                   <a href="?act=add_goods" class="goods <?php if ($this->_var['action'] == 'add_goods'): ?>choise<?php endif; ?>">新增商品</a>

                    
                   <a href="?act=goods_trash" class="goods <?php if ($this->_var['action'] == 'goods_trash'): ?>choise<?php endif; ?>">商品回收站</a>

                    
                </div>

            </li>
            
	              
						<li >
				<a href="javascript:;" class="article">订单管理</a>

                <div class="second_menu" >

                
                   <a href="?act=goods_order" class="goods  <?php if ($this->_var['action'] == 'goods_order'): ?>choise<?php endif; ?>">发货订单</a>
				   <a href="?act=goods_order2" class="goods  <?php if ($this->_var['action'] == 'goods_order2'): ?>choise<?php endif; ?>">自提订单</a>
                    <!-- 
                    <a href="?act=delivery" class="goods  <?php if ($this->_var['action'] == 'delivery'): ?>choise<?php endif; ?>">到店提货</a>
                     
                   <a href="?act=delivery_list" class="goods  <?php if ($this->_var['action'] == 'delivery_list'): ?>choise<?php endif; ?>">提货管理</a>
                   -->

                    <a href="?act=shipping_delivery_list" class="goods  <?php if ($this->_var['action'] == 'shipping_delivery_list'): ?>choise<?php endif; ?>">发货管理</a>
                </div>

            </li>
            
	              
						<li >
				<a href="javascript:;" class="article">结算管理</a>

                <div class="second_menu" >

                
                   <a href="?act=bank_config" class="goods  <?php if ($this->_var['action'] == 'bank_config'): ?>choise<?php endif; ?>">开户行设置</a>

                    
                   <a href="?act=my_order" class="goods  <?php if ($this->_var['action'] == 'my_order'): ?>choise<?php endif; ?>">订单结算</a>

                </div>

            </li>
            
	              
						<li >
				<a href="javascript:;" class="article">商家管理</a>

                <div class="second_menu" >

                
                   <a href="?act=supp_info" class="goods  <?php if ($this->_var['action'] == 'supp_info'): ?>choise<?php endif; ?>">店铺设置</a>

                    
                   <a href="?act=bunus" class="goods  <?php if ($this->_var['action'] == 'bunus'): ?>choise<?php endif; ?>">优惠券管理</a>

                    
                   <a href="?act=ad" class="goods  <?php if ($this->_var['action'] == 'ad'): ?>choise<?php endif; ?>">广告轮播</a>

                    
                   <a href="?act=supp_shipping" class="goods  <?php if ($this->_var['action'] == 'supp_shipping'): ?>choise<?php endif; ?>">配送方式</a>

                    
                </div>

            </li>
            
	              
						<li >
				<a href="javascript:;" class="article">系统设置</a>

                <div class="second_menu" >

                
                   <a href="?act=edit_password" class="goods  <?php if ($this->_var['action'] == 'edit_password'): ?>choise<?php endif; ?>">密码修改</a>

                    
                </div>

            </li>
            
	              
						<li >
				<a href="javascript:;" class="article">统计报表</a>

                <div class="second_menu" >

                
                   <a href="?act=order_stats" class="goods  <?php if ($this->_var['action'] == 'order_stats'): ?>choise<?php endif; ?>">订单统计</a>

                    
                   <a href="?act=sale_list" class="goods  <?php if ($this->_var['action'] == 'sale_list'): ?>choise<?php endif; ?>">销售明细</a>

                    
                   <a href="?act=sale_order" class="goods  <?php if ($this->_var['action'] == 'sale_order'): ?>choise<?php endif; ?>">销售排行</a>

                    
                </div>

            </li>
            
             

     		<?php else: ?>
            	<li >
				<a href="javascript:;" class="goods">店铺管理</a>

                <div class="second_menu" <?php if ($this->_var['action'] != ''): ?><?php else: ?> style="display:none;"<?php endif; ?>>
                   <a href="?act=supp_info" class="goods choise">账号设置</a>
                </div>
            </li>
            <?php endif; ?>

		</ul>

	</div>

    

<script>

$(document).ready(function(){

  $(".menu li").click(function(){

  		if($(this).find(".second_menu").css("display")=='none')

		{

			$(this).find(".second_menu").slideDown("slow");

		}

		else{

			$(this).find(".second_menu").slideUp("slow");

		}

	});

});	







</script>