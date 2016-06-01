<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="haohaios v1.0" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>店铺管理平台</title>
	<link href="templates/css/login.css" rel="stylesheet" type="text/css" />
<?php if ($this->_var['auto_redirect']): ?>
<meta http-equiv="refresh" content="3;URL=<?php echo $this->_var['message']['back_url']; ?>" />
<?php endif; ?>	
</head>
<body>
	
	<div class="logintop">
		<h1 class="loginlogo" title="店铺管理平台">店铺管理平台</h1>
	</div>
	<div class="loginbox">
  
  <div align="center">
          <div style="margin:30px auto;">
          <p style="font-size: 16px; font-weight:bold; color: #2baa00;"><?php echo $this->_var['message']['content']; ?></p>
            <div class="blank"></div>
            <div class="blank"></div>
            <?php if ($this->_var['message']['url_info']): ?>
              <?php $_from = $this->_var['message']['url_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('info', 'url');if (count($_from)):
    foreach ($_from AS $this->_var['info'] => $this->_var['url']):
?>
              <p><a href="<?php echo $this->_var['url']; ?>"><?php echo $this->_var['info']; ?></a></p><br />
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php endif; ?>
            </div>
        </div>
	</div>
	
	<div class="loginfoot">
<!--		<p><b>您不是代理商？ 您点击<a href="./../business_user.php">申请</a>，成为我们的代理商。</b></p>
-->		<p> copyright&copy;2005-2014 版权所有 www.xaphp.cn &nbsp; </p>
	</div>


</body>
</html>