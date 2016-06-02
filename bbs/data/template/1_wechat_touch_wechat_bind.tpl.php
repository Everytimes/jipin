<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); include template('wechat:wechat_header'); if($_G['wechat']['setting']['wechat_allowregister']) { ?>
<form id="registerform"method="post" class="block" autocomplete="off" action="<?php echo $selfurl;?>register">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="wxopenid" value="<?php echo $wxopenid;?>" />
<input type="hidden" name="avatar" value="<?php echo $_GET['avatar'];?>" />
<input type="hidden" name="submit" value="yes" />
<div class="loginbox registerbox">
<div class="login_from">
<li><input type="text" tabindex="1" class="px p_fre" size="30" autocomplete="off" value="<?php echo $defaultusername;?>" name="username" placeholder="用户名：3-15位" fwin="login"></li>
</div>
<div class="btn_register"><button tabindex="7" value="true" name="submit" type="submit" class="formdialog pn pnc"><span>立即注册</span></button></div>
</div>
</form>
<?php } ?>

<form id="loginform" method="post" autocomplete="off" action="<?php echo $selfurl;?>login">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="wxopenid" value="<?php echo $wxopenid;?>" />
<input type="hidden" name="submit" value="yes" />
<div class="loginbox">
<div class="login_from">
<ul>
<li><input type="text" value="" tabindex="1" class="px p_fre" size="30" autocomplete="off" value="" name="username" placeholder="请输入用户名" fwin="login"></li>
<li><input type="password" tabindex="2" class="px p_fre" size="30" value="" name="password" placeholder="密码" fwin="login"></li>
<li class="questionli">
<div class="login_select">
<span class="login-btn-inner">
<span class="login-btn-text">
<span class="span_question">安全提问(未设置请忽略)</span>
</span>
<span class="icon-arrow">&nbsp;</span>
</span>
<select id="questionid_<?php echo $loginhash;?>" name="questionid" class="sel_list">
<option value="0" selected="selected">安全提问(未设置请忽略)</option>
<option value="1">母亲的名字</option>
<option value="2">爷爷的名字</option>
<option value="3">父亲出生的城市</option>
<option value="4">您其中一位老师的名字</option>
<option value="5">您个人计算机的型号</option>
<option value="6">您最喜欢的餐馆名称</option>
<option value="7">驾驶执照最后四位数字</option>
</select>
</div>
</li>
<li class="bl_none answerli" style="display:none;"><input type="text" name="answer" id="answer_<?php echo $loginhash;?>" class="px p_fre" size="30" placeholder="答案"></li>
</ul>
</div>
<div class="btn_login"><button tabindex="3" value="true" name="submit" type="submit" class="formdialog pn pnc"><span>绑定已有帐号</span></button></div>
<?php if($connecturl) { ?>
<p>或使用QQ登录</p>
<div class="btn_qqlogin"><a href="<?php echo $connecturl;?>">使用QQ帐号登录</a></div>
<?php } ?>
</div>
</div>
</form>

<script type="text/javascript">
(function() {
$(document).on('change', '.sel_list', function() {
var obj = $(this);
$('.span_question').text(obj.find('option:selected').text());
if(obj.val() == 0) {
$('.answerli').css('display', 'none');
$('.questionli').addClass('bl_none');
} else {
$('.answerli').css('display', 'block');
$('.questionli').removeClass('bl_none');
}
});
 })();
</script>

</body>
</html>