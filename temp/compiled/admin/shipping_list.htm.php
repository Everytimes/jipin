<!-- $Id: shipping_list.htm 17043 2010-02-26 10:40:02Z sxc_shop $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<!-- start payment list -->

<div class="form-div">
  <form action="shipping.php" name="searchForm">
  默认配送方式:
    <select name="default_shipping_id">
    <option value="0">请选择</option>
    <!-- <?php $_from = $this->_var['enabled_shipping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?> -->
    <option value="<?php echo $this->_var['item']['shipping_id']; ?>" <?php if ($this->_var['default_shipping_id'] == $this->_var['item']['shipping_id']): ?>selected='true'<?php endif; ?>><?php echo $this->_var['item']['shipping_name']; ?></option>
    <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
    </select>
    <input type="hidden" name="act" value="default_shipping"  />
    <input type="submit" value="确定" class="button" />
  </form>
</div>

<div class="list-div" id="listDiv">
<table cellspacing='1' cellpadding='3'>
  <tr>
    <th>快递编号</th>
    <th><?php echo $this->_var['lang']['shipping_name']; ?></th>
    <th><?php echo $this->_var['lang']['shipping_desc']; ?></th>
    <th nowrap="true"><?php echo $this->_var['lang']['insure']; ?></th>
    <th nowrap="true"><?php echo $this->_var['lang']['support_cod']; ?></th>
    <th nowrap="true"><?php echo $this->_var['lang']['shipping_version']; ?></th>
    <th><?php echo $this->_var['lang']['sort_order']; ?></th>
    <th>配送方式编号</th>
    <th><?php echo $this->_var['lang']['handler']; ?></th>
  </tr>
  <?php $_from = $this->_var['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'module');if (count($_from)):
    foreach ($_from AS $this->_var['module']):
?>
  <tr>
    <td class="first-cell" nowrap="true">
      <?php if ($this->_var['module']['install'] == 1): ?>
      <span><?php echo $this->_var['module']['id']; ?></span>
      <?php else: ?>
      <?php echo $this->_var['module']['id']; ?>
      <?php endif; ?>
    </td>
    <td class="first-cell" nowrap="true">
      <?php if ($this->_var['module']['install'] == 1): ?>
      <span onclick="listTable.edit(this, 'edit_name', '<?php echo $this->_var['module']['code']; ?>'); return false;"><?php echo $this->_var['module']['name']; ?></span>
      <?php else: ?>
      <?php echo $this->_var['module']['name']; ?>
      <?php endif; ?>
    </td>
    <td>
      <?php if ($this->_var['module']['install'] == 1): ?>
      <span onclick="listTable.edit(this, 'edit_desc', '<?php echo $this->_var['module']['code']; ?>'); return false;"><?php echo $this->_var['module']['desc']; ?></span>
      <?php else: ?>
      <?php echo $this->_var['module']['desc']; ?>
      <?php endif; ?>
    </td>
    <td align="right">
      <?php if ($this->_var['module']['install'] == 1 && $this->_var['module']['is_insure'] != 0): ?>
      <span onclick="listTable.edit(this, 'edit_insure', '<?php echo $this->_var['module']['code']; ?>'); return false;"><?php echo $this->_var['module']['insure_fee']; ?></span>
      <?php else: ?>
      <?php echo $this->_var['module']['insure_fee']; ?>
      <?php endif; ?>
    </td>
    <td align='center'><?php if ($this->_var['module']['cod'] == 1): ?><?php echo $this->_var['lang']['yes']; ?><?php else: ?><?php echo $this->_var['lang']['no']; ?><?php endif; ?></td>
    <td nowrap="true"><?php echo $this->_var['module']['version']; ?></td>
    <td align="right" valign="top"> <?php if ($this->_var['module']['install'] == 1): ?> <span onclick="listTable.edit(this, 'edit_order', '<?php echo $this->_var['module']['code']; ?>'); return false;"><?php echo $this->_var['module']['shipping_order']; ?></span> <?php else: ?> &nbsp; <?php endif; ?> </td>
    <th><?php if ($this->_var['module']['install'] == 1): ?><?php echo $this->_var['module']['id']; ?><?php else: ?>-<?php endif; ?></th>
    <td align="center" nowrap="true">
      <?php if ($this->_var['module']['install'] == 1): ?>
      <a href="javascript:confirm_redirect(lang_removeconfirm,'shipping.php?act=uninstall&code=<?php echo $this->_var['module']['code']; ?>')"><?php echo $this->_var['lang']['uninstall']; ?></a>
      <a href="shipping_area.php?act=list&shipping=<?php echo $this->_var['module']['id']; ?>"><?php echo $this->_var['lang']['shipping_area']; ?></a>
      <a href="shipping.php?act=edit_print_template&shipping=<?php echo $this->_var['module']['id']; ?>"><?php echo $this->_var['lang']['shipping_print_edit']; ?></a>
      <?php if ($this->_var['module']['shipping_code'] == 'cac'): ?>
      <a href="shipping_point.php?act=list&shipping=<?php echo $this->_var['module']['id']; ?>"><font color="#ff3300">设置取货点</font></a>
      <?php endif; ?>
      <?php else: ?>
      <a href="shipping.php?act=install&code=<?php echo $this->_var['module']['code']; ?>"><?php echo $this->_var['lang']['install']; ?></a>
      <?php endif; ?>
    </td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
</div>
<!-- end payment list -->
<script type="Text/Javascript" language="JavaScript">
<!--


onload = function()
{
    // 开始检查订单
    startCheckOrder();
}

//-->
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>