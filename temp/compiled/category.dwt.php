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
<body id="catalog">
<div class="container">
    <div class="tuan" style="padding-top:10px; display: block;">
        <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
        <?php if ($this->_var['goods']['goods_id']): ?>
        <div class="tuan_g" >
            <div class="tuan_g_img">
                <a href="<?php if ($this->_var['goods']['goods_number'] > 0): ?><?php echo $this->_var['goods']['url']; ?><?php else: ?>javascript:void(0);<?php endif; ?>"><img src="<?php echo $this->_var['goods']['little_img']; ?>"></a>
                <?php if ($this->_var['goods']['goods_number'] < 1): ?>
                <span class="sell_f"></span>
                <?php endif; ?>
                <?php if ($this->_var['goods']['logo']): ?>
                <div class="tuan_seller"><img src="<?php echo $this->_var['goods']['logo']; ?>"></div>
                <?php endif; ?>
                <?php if ($this->_var['goods']['ts_a'] || $this->_var['goods']['ts_b'] || $this->_var['goods']['ts_c']): ?>
                <div class="tuan_g_img_text">
                    <?php if ($this->_var['goods']['ts_a']): ?>
                    <div class="tuan_g_img_item">
                        <div class="tuan_g_img_round"></div>
                        <div class="tuan_img_text_border"><span><?php echo $this->_var['goods']['ts_a']; ?></span></div>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->_var['goods']['ts_b']): ?>
                    <div class="tuan_g_img_item">
                        <div class="tuan_g_img_round"></div>
                        <div class="tuan_img_text_border"><span><?php echo $this->_var['goods']['ts_b']; ?></span></div>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->_var['goods']['ts_c']): ?>
                    <div class="tuan_g_img_item">
                        <div class="tuan_g_img_round"></div>
                        <div class="tuan_img_text_border"><span><?php echo $this->_var['goods']['ts_c']; ?></span></div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="tuan_g_info">
                <p class="tuan_g_name"><?php echo $this->_var['goods']['goods_name']; ?></p>
                <p class="tuan_g_cx"><?php echo $this->_var['goods']['goods_brief']; ?></p>
            </div>
            <div class="tuan_g_core">
                <div class="tuan_g_core_img"><img src="themes/haohaios/images/tuan_g_core-4935ae4c83.png"></div>
                <div class="tuan_g_price">
                    <span><?php echo $this->_var['goods']['team_num']; ?>人团</span>
                    <b>¥<?php echo $this->_var['goods']['team_price']; ?></b>
                </div>
                <a href="<?php if ($this->_var['goods']['goods_number'] > 0): ?><?php echo $this->_var['goods']['url']; ?><?php else: ?>javascript:void(0);<?php endif; ?>"><div class="tuan_g_btn">去开团</div></a>
            </div>
            <div class="like goods_list_like">
                <img src="themes/haohaios/images/<?php echo $this->_var['goods']['like']; ?>like.png">
                <a href="javascript:collect(<?php echo $this->_var['goods']['goods_id']; ?>)" class="like_click_button"></a>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </div>
</div>
<?php echo $this->fetch('library/footer.lbi'); ?>
</body>
</html>
