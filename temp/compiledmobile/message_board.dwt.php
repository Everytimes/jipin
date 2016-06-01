<!DOCTYPE html>
<html manifest="/manifest/tmallCateAppCache.manifest">
<head>
<meta name="Generator" content="HHSHOP v2.7.3" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          
<meta charset="utf-8">     
<title><?php echo $this->_var['page_title']; ?>触屏版</title>         
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport">     
<meta content="yes" name="apple-mobile-web-app-capable">     
<meta content="black" name="apple-mobile-web-app-status-bar-style">     
<meta content="telephone=no" name="format-detection">    
<LINK rel=apple-touch-icon-precomposed href="themes/default/images/touch-icon.png">
<LINK rel="shortcut icon" type=image/x-icon href="themes/default/images/favicon2.ico"> 
<script charset="utf-8" async="" src="themes/default/js/a_002.js"></script>
<link rel="stylesheet" type="text/css" href="themes/default/css/help-wap.css">
<LINK rel=stylesheet type=text/css href="themes/default/cart.css">
<link rel="stylesheet" type="text/css" href="themes/default/css/pagenav.css">
<LINK rel=stylesheet type=text/css href="themes/default/style.css">
<script src="themes/default/js/aplus_v2.js" exparams="category=&amp;userid=&amp;aplus" id="tb-beacon-aplus" async="" type="text/javascript"></script>
<script src="themes/default/js/a.js" async="" type="text/javascript"></script>
</head>
<body>
<script type="text/javascript">
(function (d) {
var t=d.createElement("script");t.type="text/javascript";t.async=true;t.id="tb-beacon-aplus";
t.setAttribute("exparams","category=&userid=&aplus");
t.src=("https:"==d.location.protocol?"https://s":"http://a")+".tbcdn.cn/s/aplus_v2.js";
d.getElementsByTagName("head")[0].appendChild(t);
})(document);
</script>
<style type="text/css">
.q-list li{font-size:12px;}
.q-list li p {font-size: 12px;}
</style>
<header class="navbar">
  <ul>
	  <li>留言板</li>
	  <li>
		  <a class="c-btn c-btn-aw" href="javascript:history.go(-1)"><span>返回</span></a>
	  </li>
	  <li>
	 	 <a class="c-btn on del" style="" href="#message"><span>我要留言</span></a>
	  </li>
  </ul>
  </header>
  
  
<section class="content">
<div id="J_plugin_cart">
<div class="bcont">
<div id="J_allGoods">
<div class="cont"> 
<section class="order on"> 
<div class="shop"> 
<div class="title"> 
<div class="info"><h3>留言板</h3> <p></p></div>  
</div> 
</div>

<section class="q-list J_List">
  <div class="m-review" id="detail-review" style="overflow: hidden;">
    <div class="content">
      <ul class="list">
        <?php $_from = $this->_var['msg_lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'msg');$this->_foreach['message_lists'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['message_lists']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['msg']):
        $this->_foreach['message_lists']['iteration']++;
?>
        <li>
          <blockquote> 
            <?php echo $this->_var['msg']['msg_content']; ?>
          </blockquote>
          <p class="property">商品：<?php echo $this->_var['msg']['goods_name']; ?></p>
          <div class="other"> <span class="user"><?php echo $this->_var['msg']['user_name']; ?><?php if ($this->_var['msg']['user_name'] == ''): ?><?php echo $this->_var['lang']['anonymous']; ?><?php endif; ?></span>
            <time>(<?php echo $this->_var['msg']['msg_time']; ?>) </time>
          </div>
          <?php if ($this->_var['msg']['re_content']): ?>
       <font class="f2"><?php echo $this->_var['lang']['shopman_reply']; ?>：</font><br />
       <?php echo $this->_var['msg']['re_content']; ?>
      <?php endif; ?>
        </li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
      </ul>
      <?php echo $this->fetch('library/pages.lbi'); ?>
    </div>
  </div>
</section>
	  
</section> 	
</div> 
</div> 
</div>
 </div>
</section>

  
  
 

<a name="message"></a>

<section class="content">
<div id="J_plugin_cart">
<div class="bcont">
<div id="J_allGoods">
<div class="cont"> 
<section class="order on"> 
<div class="shop"> 
<div class="title"> 
<div class="info"><h3><?php echo $this->_var['lang']['post_message']; ?></h3> <p></p></div>  
</div> 
</div>
<form action="message.php" method="post" name="formMsg" onSubmit="return submitMsgBoard(this)" style="padding:8px">
<table width="100%" border="0" cellpadding="3">
<tr>
<td><input placeholder="<?php echo $this->_var['lang']['email']; ?>" name="user_email" type="text" class="inputBg" size="20" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" /></td>
</tr>
<tr>

<td style=" height:30px; line-height:30px;">
<input style="vertical-align:middle" name="msg_type" type="radio" value="0" checked="checked" />
<?php echo $this->_var['lang']['message_type']['0']; ?>
<input style="vertical-align:middle; margin-left:5px;" type="radio" name="msg_type" value="1" />
<?php echo $this->_var['lang']['message_type']['1']; ?>
<input style="vertical-align:middle; margin-left:5px;" type="radio" name="msg_type" value="2" />
<?php echo $this->_var['lang']['message_type']['2']; ?>
<input style="vertical-align:middle; margin-left:5px;" type="radio" name="msg_type" value="3" />
<?php echo $this->_var['lang']['message_type']['3']; ?>
<input style="vertical-align:middle; margin-left:5px;" type="radio" name="msg_type" value="4" />
<?php echo $this->_var['lang']['message_type']['4']; ?> </td>
</tr>
<tr>

<td><input placeholder="<?php echo $this->_var['lang']['message_title']; ?>" name="msg_title" type="text" class="inputBg" size="30" /></td>
</tr>
<?php if ($this->_var['enabled_mes_captcha']): ?>
<tr>

<td><input placeholder="<?php echo $this->_var['lang']['comment_captcha']; ?>" type="text" size="8" name="captcha"  class="inputBg" />
<img src="captcha.php?<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?'+Math.random()" /> </td>
</tr>
<?php endif; ?>
<tr>

<td><textarea placeholder="<?php echo $this->_var['lang']['message_content']; ?>"  class="B_blue"  name="msg_content" cols="50" rows="4" wrap="virtual" style="border:1px solid #ccc;"></textarea></td>
</tr>
<tr>

<td><input type="hidden" name="act" value="act_add_message" />
<input type="submit" value="<?php echo $this->_var['lang']['post_message']; ?>"  class="c-btn"  />
</td>
</tr>
</table>
</form>
<script type="text/javascript">
<?php $_from = $this->_var['lang']['message_board_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

/**
* 提交留言信息
*/
function submitMsgBoard(frm)
{
var msg = new Object;

msg.user_email  = frm.elements['user_email'].value;
msg.msg_title   = frm.elements['msg_title'].value;
msg.msg_content = frm.elements['msg_content'].value;
msg.captcha     = frm.elements['captcha'] ? frm.elements['captcha'].value : '';

var msg_err = '';

if (msg.user_email.length > 0)
{
if (!(Utils.isEmail(msg.user_email)))
{
msg_err += msg_error_email + '\n';
}
}
else
{
msg_err += msg_empty_email + '\n';
}
if (msg.msg_title.length == 0)
{
msg_err += msg_title_empty + '\n';
}
if (frm.elements['captcha'] && msg.captcha.length==0)
{
msg_err += msg_captcha_empty + '\n'
}
if (msg.msg_content.length == 0)
{
msg_err += msg_content_empty + '\n'
}
if (msg.msg_title.length > 200)
{
msg_err += msg_title_limit + '\n';
}

if (msg_err.length > 0)
{
alert(msg_err);
return false;
}
else
{
return true;
}
}

</script>	  
</section> 	
</div> 
</div> 
</div>
 </div>
</section>


 
 


<script src="themes/default/js/seed-min.js" data-config="{combine:true}"></script> 
<script src="themes/default/js/wap_common.js"></script>
 
</body>
</html>
