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
<link href="<?php echo $this->_var['hhs_css_path']; ?>/user.css" rel="stylesheet" />
<link href="<?php echo $this->_var['hhs_css_path']; ?>/font-awesome.min.css" rel="stylesheet" />

<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.js,haohaios.js,user.js')); ?>
</head>
<body id="user">
<div class="container">
<?php if ($this->_var['action'] == 'default'): ?>
    <section class="main-view">
        <div class="my">
            <div class="my_head">
                <div class="my_head_pic">
                    <img class="my_head_img" width="130" height="130" src="<?php echo $this->_var['info']['headimgurl']; ?>">
                </div>
                <div class="my_head_info">
                    <h4 class="my_head_name "><?php echo $this->_var['info']['uname']; ?></h4>
                </div>
            </div>
        </div>
        <div class="nav">
            <div class="nav_item nav_order">
                <div class="nav_item_order_hd">
                    <a href="user.php?act=order_list">
                    <div class="nav_item_order">我的订单</div>
                    <div class="nav_item_order_bd">查看全部订单
                        <img class="nav_item_order_bd_arrow" src="themes/haohaios/images/personal_arrow.png">
                    </div>
                    </a>
                </div>
                <div class="nav_item_bd">
                    <a href="user.php?act=order_list&composite_status=100">
                        <div class="nav_item_order_img order_unpay"></div>
                        <span class="nav_item_txt">待付款</span>
                    </a>
                    <a href="user.php?act=order_list&composite_status=180">
                        <div class="nav_item_order_img order_unsend"></div>
                        <span class="nav_item_txt">待发货</span>
                    </a>
                    <a href="user.php?act=order_list&composite_status=120">
                        <div class="nav_item_order_img order_unreceived"></div>
                        <span class="nav_item_txt">待收货</span>
                    </a>
                    <a href="user.php?act=order_list&composite_status=999">
                        <div class="nav_item_order_img order_unevaluated"></div>
                        <span class="nav_item_txt">待评价</span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="nav">
            <ul class="nav_list">
                <li class="nav_cheap">
                    <a href="user.php?act=team_list">
                    <div class="nav_list_img"></div>
                    <div class="nav_list_txt">我的团</div>
                    </a>
                </li>
                <li class="nav_lottory">
                    <a href="user.php?act=lottery_list">
                    <div class="nav_list_img"></div>
                    <div class="nav_list_txt">我的抽奖</div>
                    </a>
                </li>
                <li class="nav_like">
                    <a href="user.php?act=collection_list">
                    <div class="nav_list_img"></div>
                    <div class="nav_list_txt">我的收藏</div>
                    </a>
                </li>
                <li class="nav_cart">
                    <a href="user.php?act=bonus">
                    <div class="nav_list_img"></div>
                    <div class="nav_list_txt">优惠券</div>
                    </a>
                </li>
                <li class="nav_adress">
                    <a href="user.php?act=address_list">
                    <div class="nav_list_img"></div>
                    <div class="nav_list_txt">收货地址</div>
                    </a>
                </li>
                <li class="nav_msg">
                    <?php if ($this->_var['is_check'] == 1): ?>
                    <a href="store.php?id=<?php echo $this->_var['suppliers_id']; ?>">
                    <div class="nav_list_img"></div>
                    <div class="nav_list_txt">我的小店</div>
                    </a>
                    <?php elseif ($this->_var['is_check'] == 2): ?>
                    <div class="nav_list_img"></div>
                    <div class="nav_list_txt">审核中</div>
                    <?php elseif ($this->_var['is_check'] == 3): ?>
                    <div class="nav_list_img"></div>
                    <div class="nav_list_txt">审核未过</div>
                    <?php else: ?>
                    <a href="enter.php">
                    <div class="nav_list_img"></div>
                    <div class="nav_list_txt">申请入驻</div>
                    </a>
                    <?php endif; ?> 
                </li>
				              
                <li class="nav_account">
                    <a href="user.php?act=account_log">
                    <div class="nav_list_img"></div>
                    <div class="nav_list_txt">我的账户</div>
                    </a>
                </li>
				
                <li class="nav_faq">
                    <a href="suggestion.php">
                    <div class="nav_list_img"></div>
                    <div class="nav_list_txt">常见问题</div>
                    </a>
                </li>
            </ul>
        </div>
    </section>
<?php endif; ?>
</div>
<?php if ($this->_var['info']['is_subscribe'] == 0): ?>
        <div class="guanzhu"><a href="<?php echo $this->_var['subscribe_url']; ?>">您还未关注我们，立即去关注</a></div>
        <?php endif; ?>
<?php echo $this->fetch('library/footer.lbi'); ?>
</body>
</html>
