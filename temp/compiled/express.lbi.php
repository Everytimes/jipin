
<a href="javascript:void(0);" onclick="cancel_invoice();" class="close">X</a>
    <div class="exp_top">
        <p>物流信息<font>(<?php echo $this->_var['expressid']; ?>)</font></p>
        <p><font>运单号：<?php echo $this->_var['expressno']; ?></font></p>
    </div>
    <div class="exp_list" id='retData'>
        <ul>
        <?php if ($this->_var['express']['resultcode'] == 200): ?>
             <?php $_from = $this->_var['express']['result']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['name']['iteration']++;
?>
             <li <?php if (($this->_foreach['name']['iteration'] - 1) == 0): ?>class="on" <?php endif; ?>><i></i><?php echo $this->_var['item']['datetime']; ?><br/><?php echo $this->_var['item']['remark']; ?></li>
             <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <?php else: ?>
        <li><?php echo $this->_var['express']['reason']; ?></li>
        <?php endif; ?>
        </ul>
    </div>
