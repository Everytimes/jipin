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
<body>
<div class="container">
    <?php if ($this->_var['action'] == "account_raply" || $this->_var['action'] == "account_log" || $this->_var['action'] == "account_deposit" || $this->_var['action'] == "account_detail"): ?> 
    <script type="text/javascript">
          <?php $_from = $this->_var['lang']['account_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
            var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </script>
    <div class="account_top">
        <p>可用资金：<?php echo $this->_var['surplus_amount']; ?></p>
    </div>
    <div class="nav_fixed" style="top:40px;"> 
        <a href="user.php?act=account_detail"<?php if ($this->_var['action'] == 'account_detail'): ?> class="cur"<?php endif; ?>><?php echo $this->_var['lang']['add_surplus_log']; ?></a>
        <a href="user.php?act=account_raply"<?php if ($this->_var['action'] == 'account_raply'): ?> class="cur"<?php endif; ?>><?php echo $this->_var['lang']['surplus_type_1']; ?></a>
        <a href="user.php?act=account_log"<?php if ($this->_var['action'] == 'account_log'): ?> class="cur"<?php endif; ?>><?php echo $this->_var['lang']['view_application']; ?></a>
    </div>
    <?php endif; ?>
    <div class="account_box"> 
        <?php if ($this->_var['action'] == "account_raply"): ?>
        <form name="formSurplus" method="post" action="user.php" onSubmit="return submitSurplus()">
            <div class="account_deposit">
                <h3>每次提现金额在￥1～￥200以内</h3>
                <ul>
                    <li>
                        <input type="text" name="amount" value="<?php echo htmlspecialchars($this->_var['order']['amount']); ?>" class="inp" placeholder="<?php echo $this->_var['lang']['repay_money']; ?>" />
                    </li>
                    <li>
                        <textarea name="user_note" class="tex" placeholder="<?php echo $this->_var['lang']['process_notic']; ?>"><?php echo htmlspecialchars($this->_var['order']['user_note']); ?></textarea>
                    </li>
                    <li>
                        <input type="hidden" name="surplus_type" value="1" />
                        <input type="hidden" name="act" value="act_account" />
                        <input type="submit" name="submit"  class="bnt" value="<?php echo $this->_var['lang']['submit_request']; ?>" />
                    </li>
                </ul>
            </div>
        </form>
        <?php endif; ?> 
        <?php if ($this->_var['action'] == "account_deposit"): ?>
        <form name="formSurplus" method="post" action="user.php" onSubmit="return submitSurplus()">
            <div class="account_deposit">
                <ul>
                    <li>
                        <input type="text" name="amount" class="inp" value="<?php echo htmlspecialchars($this->_var['order']['amount']); ?>" placeholder="<?php echo $this->_var['lang']['deposit_money']; ?>" />
                    </li>
                    <li>
                        <textarea name="user_note" class="tex" placeholder="<?php echo $this->_var['lang']['process_notic']; ?>"><?php echo htmlspecialchars($this->_var['order']['user_note']); ?></textarea>
                    </li>
                    <li>
                        <label><?php echo $this->_var['lang']['payment']; ?></label>
                        <?php $_from = $this->_var['payment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                        <input type="radio" name="payment_id" value="<?php echo $this->_var['list']['pay_id']; ?>" />
                        <?php echo $this->_var['list']['pay_name']; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?></li>
                    <li>
                        <input type="hidden" name="surplus_type" value="0" />
                        <input type="hidden" name="rec_id" value="<?php echo $this->_var['order']['id']; ?>" />
                        <input type="hidden" name="act" value="act_account" />
                        <input type="submit" class="bnt" name="submit" value="<?php echo $this->_var['lang']['submit_request']; ?>" />
                    </li>
                </ul>
            </div>
        </form>
        <?php endif; ?> 
        
        <?php if ($this->_var['action'] == "act_account"): ?>
        <table width="100%" class="list_table">
            <tr>
                <td width="25%" align="right"><?php echo $this->_var['lang']['surplus_amount']; ?></td>
                <td width="80%"><?php echo $this->_var['amount']; ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo $this->_var['lang']['payment_name']; ?></td>
                <td><?php echo $this->_var['payment']['pay_name']; ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo $this->_var['lang']['payment_fee']; ?></td>
                <td><?php echo $this->_var['pay_fee']; ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo $this->_var['lang']['payment_desc']; ?></td>
                <td bgcolor="#ffffff"><?php echo $this->_var['payment']['pay_desc']; ?></td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $this->_var['payment']['pay_button']; ?></td>
            </tr>
        </table>
        <?php endif; ?> 
        
        <?php if ($this->_var['action'] == "account_detail"): ?>
        <div class="account_detail">
            <table width="100%" class="list_table">
                <tr align="center">
                    <td><?php echo $this->_var['lang']['process_time']; ?></td>
                    <td><?php echo $this->_var['lang']['surplus_pro_type']; ?></td>
                    <td><?php echo $this->_var['lang']['money']; ?></td>
                    <td><?php echo $this->_var['lang']['change_desc']; ?></td>
                </tr>
                
                <?php $_from = $this->_var['account_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                
                <tr>
                    <td align="center"><?php echo $this->_var['item']['change_time']; ?></td>
                    <td align="center"><?php echo $this->_var['item']['type']; ?></td>
                    <td align="center"><?php echo $this->_var['item']['amount']; ?></td>
                    <td title="<?php echo $this->_var['item']['change_desc']; ?>">&nbsp;&nbsp;<?php echo $this->_var['item']['short_change_desc']; ?></td>
                </tr>
                
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                
            </table>
        </div>
        <?php echo $this->fetch('library/pages.lbi'); ?>
        <?php endif; ?> 
        
        <?php if ($this->_var['action'] == "account_log"): ?>
        <div class="account_log">
            <table width="100%" class="list_table">
                <tr align="center">
                    <td><?php echo $this->_var['lang']['process_time']; ?></td>
                    <td><?php echo $this->_var['lang']['surplus_pro_type']; ?></td>
                    <td><?php echo $this->_var['lang']['money']; ?></td>
                    
                    <!--td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_notic']; ?></td>

            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['admin_notic']; ?></td-->
                    
                    <td><?php echo $this->_var['lang']['is_paid']; ?></td>
                    <td><?php echo $this->_var['lang']['handle']; ?></td>
                </tr>
                
                <?php $_from = $this->_var['account_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                
                <tr>
                    <td align="center"><?php echo $this->_var['item']['add_time']; ?></td>
                    <td align="center"><?php echo $this->_var['item']['type']; ?></td>
                    <td align="center"><?php echo $this->_var['item']['amount']; ?></td>
                    
                    <!--td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['short_user_note']; ?></td>

            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['short_admin_note']; ?></td-->
                    
                    <td align="center"><?php echo $this->_var['item']['pay_status']; ?></td>
                    <td align="center"><?php echo $this->_var['item']['handle']; ?> 
                        
                        <?php if (( $this->_var['item']['is_paid'] == 0 && $this->_var['item']['process_type'] == 1 ) || $this->_var['item']['handle']): ?> 
                        
                        <a href="user.php?act=cancel&id=<?php echo $this->_var['item']['id']; ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_remove_account']; ?>')) return false;"><?php echo $this->_var['lang']['is_cancel']; ?></a> 
                        
                        <?php endif; ?></td>
                </tr>
                
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                
            </table>
        </div>
        <?php echo $this->fetch('library/pages.lbi'); ?>
        <?php endif; ?>
    </div>
</div>
<div class="blank"></div>
<div class="footer">
    <ul>
        <li><a href="index.php" class="nav-controller"><i class="icon-index"></i>首页</a></li>
		<li><a href="catalog.php" class="nav-controller"><i class="icon-catalog"></i>分类</a></li>
		<li><a href="/bbs" class="nav-controller"><i class="icon-square"></i>团员之家</a></li>
        <li><a href="rank.php?act=hot" class="nav-controller"><i class="icon-rank"></i>热榜</a></li>
        <li><a href="user.php" class="nav-controller"><i class="icon-user"></i>个人中心</a></li>
    </ul>
</div>
</body>
</html>

