<!-- $Id: bonus_type.htm 14216 2008-03-10 02:27:21Z testyang $ -->



<?php if ($this->_var['full_page']): ?>

<?php echo $this->fetch('pageheader.htm'); ?>

<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<div class="form-div">

  <form action="javascript:searchlist()" name="searchForm">

    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />

    商家 

    

    <select name="suppliers_id"  id="suppliers_id">

    	<option value="">请选择</option>
        <option value="0">自营店</option>
        <?php $_from = $this->_var['suppliers_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'suppliers');if (count($_from)):
    foreach ($_from AS $this->_var['suppliers']):
?>
        <option value="<?php echo $this->_var['suppliers']['suppliers_id']; ?>"><?php echo $this->_var['suppliers']['suppliers_name']; ?></option>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </select>

    

     <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />

  </form>

</div>

<!-- start bonus_type list -->

<form method="post" action="" name="listForm">

<div class="list-div" id="listDiv">

<?php endif; ?>



  <table cellpadding="3" cellspacing="1">

    <tr>

      <th><a href="javascript:listTable.sort('type_name'); "><?php echo $this->_var['lang']['type_name']; ?></a><?php echo $this->_var['sort_type_name']; ?></th>

      <th>商家</th>

      <th><a href="javascript:listTable.sort('send_type'); "><?php echo $this->_var['lang']['send_type']; ?></a><?php echo $this->_var['sort_send_type']; ?></th>

      <th><a href="javascript:listTable.sort('type_money'); "><?php echo $this->_var['lang']['type_money']; ?></a><?php echo $this->_var['sort_type_money']; ?></th>

      <th><a href="javascript:listTable.sort('min_amount'); "><?php echo $this->_var['lang']['min_amount']; ?></a><?php echo $this->_var['sort_min_amount']; ?></th>

      <th><?php echo $this->_var['lang']['send_count']; ?></th>

      <th><?php echo $this->_var['lang']['use_count']; ?></th>

      <th><?php echo $this->_var['lang']['handler']; ?></th>

    </tr>

    <?php $_from = $this->_var['type_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'type');if (count($_from)):
    foreach ($_from AS $this->_var['type']):
?>

    <tr>

      <td align="center" class="first-cell"><span onclick="listTable.edit(this, 'edit_type_name', <?php echo $this->_var['type']['type_id']; ?>)"><?php echo htmlspecialchars($this->_var['type']['type_name']); ?></span></td>

      <td align="center" class="first-cell"><?php if ($this->_var['type']['suppliers_id'] == 0): ?>自营<?php else: ?><?php echo $this->_var['type']['suppliers_name']; ?><?php endif; ?></td>

      <td align="center"><?php echo $this->_var['type']['send_by']; ?></td>

      <td align="center"><span onclick="listTable.edit(this, 'edit_type_money', <?php echo $this->_var['type']['type_id']; ?>)"><?php echo $this->_var['type']['type_money']; ?></span></td>

      <td align="center"><span onclick="listTable.edit(this, 'edit_min_amount', <?php echo $this->_var['type']['type_id']; ?>)"><?php echo $this->_var['type']['min_amount']; ?></span></td>

      <td align="center"><span><?php echo $this->_var['type']['send_count']; ?></span></td>

      <td align="center"><?php echo $this->_var['type']['use_count']; ?></td>

      <td align="center">

        <?php if ($this->_var['type']['send_type'] == 3): ?>

        <a href="bonus.php?act=gen_excel&tid=<?php echo $this->_var['type']['type_id']; ?>"><?php echo $this->_var['lang']['report_form']; ?></a> |

        <?php endif; ?>

        <?php if ($this->_var['type']['send_type'] != 2): ?>

        <a href="bonus.php?act=send&amp;id=<?php echo $this->_var['type']['type_id']; ?>&amp;send_by=<?php echo $this->_var['type']['send_type']; ?>&suppliers_id=<?php echo $this->_var['type']['suppliers_id']; ?>"><?php echo $this->_var['lang']['send']; ?></a> |

        <?php endif; ?>

        <a href="bonus.php?act=bonus_list&amp;bonus_type=<?php echo $this->_var['type']['type_id']; ?>"><?php echo $this->_var['lang']['view']; ?></a> |

        <a href="bonus.php?act=edit&amp;type_id=<?php echo $this->_var['type']['type_id']; ?>"><?php echo $this->_var['lang']['edit']; ?></a> |

        <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['type']['type_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')"><?php echo $this->_var['lang']['remove']; ?></a></span></td>

    </tr>

      <?php endforeach; else: ?>

    <tr><td class="no-records" colspan="11"><?php echo $this->_var['lang']['no_records']; ?></td></tr>

      <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>

    <tr>

      <td align="right" nowrap="true" colspan="9"><?php echo $this->fetch('page.htm'); ?></td>

    </tr>

  </table>



<?php if ($this->_var['full_page']): ?>

</div>

</form>

<!-- end bonus_type list -->



<script type="text/javascript" language="JavaScript">

<!--

  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;

  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;



  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>

  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';

  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>



  

  onload = function()

  {

     // 开始检查订单

     startCheckOrder();

  }

  

  

 function searchlist()

  {

      var suppliers_id = document.forms['searchForm'].elements['suppliers_id'].value;

      listTable.filter['suppliers_id'] = suppliers_id;

      listTable.filter['page'] = 1;

	  listTable.loadList();

  }

//-->

</script>

<?php echo $this->fetch('pagefooter.htm'); ?>

<?php endif; ?>