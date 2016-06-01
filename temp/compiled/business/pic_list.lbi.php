<?php $_from = $this->_var['pic_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item_0_93762400_1438740535');if (count($_from)):
    foreach ($_from AS $this->_var['item_0_93762400_1438740535']):
?>

					<li>

						<a href="<?php echo $this->_var['item_0_93762400_1438740535']['pic']; ?>"  target="_blank"><img src="<?php echo $this->_var['item_0_93762400_1438740535']['pic']; ?>" width="200" height="200"></a>

						<a href="" class="name"><?php echo $this->_var['item_0_93762400_1438740535']['pic_name']; ?></a>

						<div class="r"><!--<a href="?act=edit_pic&id=<?php echo $this->_var['item_0_93762400_1438740535']['id']; ?>">更换</a>--><a href="javascript:;" onclick="if (confirm('确定要删除吗')) drop_delete_pic('<?php echo $this->_var['item_0_93762400_1438740535']['id']; ?>')">删除</a></div>

						<div class="yin">引</div>

					</li>

					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>