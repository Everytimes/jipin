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
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.js,haohaios.js')); ?>
</head>
<body id="rank">
<div class="container">
    <div class="nav_fixed rank_fixed">
        <a href="rank.php?act=hot" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['action'] == 'hot'): ?> nav_cur<?php endif; ?>">热榜</span></a>
        <a href="rank.php?act=new" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['action'] == 'new'): ?> nav_cur<?php endif; ?>">新榜</span></a>
        <a href="rank.php?act=best" class="fixed_nav_item"><span class="nav_txt<?php if ($this->_var['action'] == 'best'): ?> nav_cur<?php endif; ?>">精品</span></a>
    </div>
	<section class="main-view" style="margin-top:52px; background:#fff;">
        <div id="tuan" class="tuan" style="padding-top: 10px; display: block;">

                <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods_list']['iteration']++;
?>
                
        <div class="rank_g">
            
            <div class="rank_g_img">
                <a href="<?php if ($this->_var['goods']['goods_number'] > 0): ?><?php echo $this->_var['goods']['url']; ?><?php else: ?>javascript:void(0);<?php endif; ?>"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>"></a>
                <?php if ($this->_var['goods']['goods_number'] < 1): ?><span class="sell_f"></span><?php endif; ?>
                <div class="rank_g_index">TOP <?php echo $this->_foreach['goods_list']['iteration']; ?></div>
            </div>
            <div class="rank_g_info">
                <p class="rank_g_name"><a href="<?php if ($this->_var['goods']['goods_number'] > 0): ?><?php echo $this->_var['goods']['url']; ?><?php else: ?>javascript:void(0);<?php endif; ?>"><?php echo $this->_var['goods']['goods_name']; ?></a></p>
            </div>
            <div class="rank_core">
                <div class="rank_g_volume">
                    已售 <b><?php echo empty($this->_var['goods']['buy_nums']) ? '0' : $this->_var['goods']['buy_nums']; ?></b> 件
                </div>
                <div class="rank_g_core">
                    <div class="rank_g_price">
                        <span><?php echo $this->_var['goods']['team_num']; ?>人团</span>
                        <b><span>¥ </span><?php echo $this->_var['goods']['team_price']; ?></b>
                    </div>
                    <a href="<?php if ($this->_var['goods']['goods_number'] > 0): ?><?php echo $this->_var['goods']['url']; ?><?php else: ?>javascript:void(0);<?php endif; ?>" class="rank_g_btn">去开团</a>
                </div>
            </div>
        </div>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        </div>
    </section>
 
</div>
<?php echo $this->fetch('library/footer.lbi'); ?>
</body>
</html>
