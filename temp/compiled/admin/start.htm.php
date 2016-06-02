<!-- $Id: start.htm 17216 2014-05-12 06:03:12Z pangbin $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<!-- start personal message -->
<?php if ($this->_var['admin_msg']): ?>
<div class="list-div" style="border: 1px solid #CC0000">
  <table cellspacing='1' cellpadding='3'>
    <tr>
      <th><?php echo $this->_var['lang']['pm_title']; ?></th>
      <th><?php echo $this->_var['lang']['pm_username']; ?></th>
      <th><?php echo $this->_var['lang']['pm_time']; ?></th>
    </tr>
    <?php $_from = $this->_var['admin_msg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'msg');if (count($_from)):
    foreach ($_from AS $this->_var['msg']):
?>
      <tr align="center">
        <td align="left"><a href="message.php?act=view&id=<?php echo $this->_var['msg']['message_id']; ?>"><?php echo sub_str($this->_var['msg']['title'],60); ?></a></td>
        <td><?php echo $this->_var['msg']['user_name']; ?></td>
        <td><?php echo $this->_var['msg']['send_date']; ?></td>
      </tr>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>
  </div>
<br />
<?php endif; ?>
<!-- end personal message -->

<div class="tab-div">
  <!-- tab bar -->
  <div id="tabbar-div">
    <p>
      <span class="tab-front" id="one1" onclick="setTab('one',1,3)"><?php echo $this->_var['lang']['order_stat']; ?></span>
      <span class="tab-back" id="one2" onclick="setTab('one',2,3)"><?php echo $this->_var['lang']['goods_stat']; ?></span>
      <span class="tab-back" id="one3" onclick="setTab('one',3,3)"><?php echo $this->_var['lang']['acess_stat']; ?></span>
    </p>
  </div>
  <div id="tabbody-div">
    <ul id="con_one_1">
        <li><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['await_ship']; ?>"><?php echo $this->_var['lang']['await_ship']; ?><strong><?php echo $this->_var['order']['await_ship']; ?></strong></a></li>
        <li><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['unconfirmed']; ?>"><?php echo $this->_var['lang']['unconfirmed']; ?><strong><?php echo $this->_var['order']['unconfirmed']; ?></strong></a></li>
        <li><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['await_pay']; ?>"><?php echo $this->_var['lang']['await_pay']; ?><strong><?php echo $this->_var['order']['await_pay']; ?></strong></a></li>
        <li><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['finished']; ?>"><?php echo $this->_var['lang']['finished']; ?><strong><?php echo $this->_var['order']['finished']; ?></strong></a></li>
    <!--    <li><a href="goods_booking.php?act=list_all"><?php echo $this->_var['lang']['new_booking']; ?><strong><?php echo $this->_var['booking_goods']; ?></strong></a></li>
        <li><a href="user_account.php?act=list&process_type=1&is_paid=0"><?php echo $this->_var['lang']['new_reimburse']; ?><strong><?php echo $this->_var['new_repay']; ?></strong></a></li>
        <li><a href="order.php?act=refund_list">退换货申请<strong><?php echo $this->_var['refund_goods']; ?></strong></a></li>
        <li><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['shipped_part']; ?>"><?php echo $this->_var['lang']['shipped_part']; ?><strong><?php echo $this->_var['order']['shipped_part']; ?></strong></a></li>-->
    </ul>
    <ul id="con_one_2" style="display:none;">
      <li><?php echo $this->_var['lang']['goods_count']; ?><strong><?php echo $this->_var['goods']['total']; ?></strong></li>
      <li><a href="goods.php?act=list&stock_warning=1"><?php echo $this->_var['lang']['warn_goods']; ?><strong><?php echo $this->_var['goods']['warn']; ?></strong></a></li>
      <!--<li><a href="goods.php?act=list&amp;intro_type=is_new"><?php echo $this->_var['lang']['new_goods']; ?><strong><?php echo $this->_var['goods']['new']; ?></strong></a></li>
      <li><a href="goods.php?act=list&amp;intro_type=is_best"><?php echo $this->_var['lang']['recommed_goods']; ?><strong><?php echo $this->_var['goods']['best']; ?></strong></a></li>
      <li><a href="goods.php?act=list&amp;intro_type=is_hot"><?php echo $this->_var['lang']['hot_goods']; ?><strong><?php echo $this->_var['goods']['hot']; ?></strong></a></li>
      <li><a href="goods.php?act=list&amp;intro_type=is_promote"><?php echo $this->_var['lang']['sales_count']; ?><strong><?php echo $this->_var['goods']['promote']; ?></strong></a></li>-->
    </ul>

    <ul id="con_one_3" style="display:none;">
      <li><?php echo $this->_var['lang']['acess_today']; ?><strong><?php echo $this->_var['today_visit']; ?></strong></li>
      <li><?php echo $this->_var['lang']['online_users']; ?><strong><?php echo $this->_var['online_users']; ?></strong></li>
<!--      <li><a href="user_msg.php?act=list_all"><?php echo $this->_var['lang']['new_feedback']; ?><strong><?php echo $this->_var['feedback_number']; ?></strong></a></li>
      <li><a href="comment_manage.php?act=list"><?php echo $this->_var['lang']['new_comments']; ?><strong><?php echo $this->_var['comment_number']; ?></strong></a></li>
-->    </ul>
  </div>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'tabs.js')); ?>

<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js')); ?>
<script type="Text/Javascript" language="JavaScript">
<!--
onload = function()
{
  /* 检查订单 */
  startCheckOrder();
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>
