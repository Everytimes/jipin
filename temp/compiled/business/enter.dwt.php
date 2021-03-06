<!doctype html>
<html lang="zh">
<head>
<meta name="Generator" content="haohaios v1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<title><?php echo $this->_var['page_title']; ?></title>
<link rel="shortcut icon" href="favicon.ico" />
<link href="/pintuans/themes/haohaios/style.css" rel="stylesheet" type="text/css" />
<link href="templates/enter.css" rel="stylesheet" type="text/css" />

<?php echo $this->smarty_insert_scripts(array('files'=>'../js/jquery.js,../js/haohaios.js,../js/leftnav.js,../js/region.js,../js/utils.js')); ?>

<!--[if IE]>
<?php echo $this->smarty_insert_scripts(array('files'=>'html5.js')); ?>
<![endif]-->
<script language="javascript">
	$(document).ready(function(){
		//除第一个订制流程外隐藏其他定制流程
		for(i=2;i<=10;i++)
		{
			$('#setp'+i).hide();
		} 
	});
	function regs(first,second)
	{
		 var reg = /^[0-9]+/;
		 var reg2 = /^1[3458]\d{9}$/;
		 if(second ==1)
		{
			var suppliers_name =  $("#suppliers_name").val();
			var address =  $("#address").val();
			var email   = $("#email").val();
			//var qq   = $("#qq").val();
			//var real_name = $("#real_name").val();
			var phone = $("#phone").val();
			var user_name = $("#user_name").val();
			var password = $("#password").val();
			var password1 = $("#password1").val();
			if(suppliers_name=='')
			{
				$("#suppliers_name_notice").html("请输入商家名称!");
				return false;
			}
			else if(suppliers_name.length > 24)
			{
				$("#suppliers_name_notice").html("商家名称不能大于24个字符!");
				return false;
			}
			
			if(address=='')
			{
				$("#address_notice").html("请输入详细地址!");
				return false;
			}	
			if(email=='')
			{
				$("#email_notice").html("请输入邮箱地址!");
				return false;
			}
			else if (!Utils.isEmail(email))
			{
				$("#email_notice").html("邮箱地址输入不合法!");
				return false;
			}
			/*
			if(qq=='')
			{
				$("#qq_notice").html("请输入客服qq!");
				return false;
			}
			else if(!reg.test(qq))
			{
				$("#qq_notice").html("客服qq格式输入不正确!");
				return false;
			}
			if(real_name=='')
			{
				$("#real_name_notice").html("请输入店长姓名!");
				return false;
			}*/
			if(phone=='')
			{
				$("#phone_notice").html("请输入手机号码!");
				return false;
			}
			else if(!reg2.test(phone))
			{
				$("#phone_notice").html("请输入正确手机号码!");
				return false;
			}
			if(user_name=='')
			{
				$("#user_notice").html("请输入登录用户名!");
				return false;
			}
			else
			{
				var result = Ajax.call('suppliers.php?act=check_user_name', 'user_name='+user_name, null, 'GET', 'JSON',false);
				if(result.error ==1)
				{
					$("#user_name_notice").html("该用户名已被使用!");
					return false;
				}
				else
				{
					$("#user_name_notice").html("");
				}
			}
			
			if(password=='')
			{
				$("#password_notice").html("密码不能为空!");
				return false;
			}
			else
			{
				$("#password_notice").html("");
			}
			if(password1=='')
			{
				$("#password1_notice").html("确认密码不能为空!");
				return false;
			}
			else
			{
				if(password1!=password)
				{
					$("#password1_notice").html("俩次输入不一致!");
					return false;
				}
				else
				{
					$("#password1_notice").html("");
				}
			}
			//$('#setp'+first).hide();
			//$('#setp'+second).show();
		} 
		 
		 
		 
	}
	function check_suppliers_name(value)
	{
		if(value=='')	
		{
			$("#suppliers_name_notice").html("请输入商家名称!");
		}
		else
		{
			Ajax.call( 'enter.php?act=is_suppliers_name', 'suppliers_name=' + value, suppliers_name_callback , 'GET', 'TEXT', true, true );
			//$("#suppliers_name_notice").html("");	
		}
	}
	function suppliers_name_callback(result){
		if(result==1){
			$('#suppliers_name_notice').html('商家名称已存在');
		}else{
			$('#suppliers_name_notice').html('');
		}
	}
	function check_user_name(value)
	{
		if(value=='')	
		{
			$("#user_name_notice").html("请输入管理登录用户名!");
		}
		else
		{
			Ajax.call( 'enter.php?act=is_user_name', 'user_name=' + value, user_name_callback , 'GET', 'TEXT', true, true );
			//$("#suppliers_name_notice").html("");	
		}
	}
	function user_name_callback(result){
		if(result==1){
			$('#user_name_notice').html('管理登录用户名已存在');
		}else{
			$('#user_name_notice').html('');
		}
	}
	function check_address(value)
	{
		if(value=='')
		{
			$("#address_notice").html("请输入详细地址!");
		}
		else
		{
			$("#address_notice").html("");
		}
	}
	function checkEmail(value)
	{
		if(value=='')
		{
			$("#email_notice").html("请输入邮箱地址!");
		}
		else if (!Utils.isEmail(value))
		{
		  $("#email_notice").html("请输入正确邮箱地址!");
		}
		else
		{
		 $("#email_notice").html("");	
		}
	}
	function checkqq(value)
	{
		 var reg = /^[0-9]+/;
		if(value=='')
		{
			$("#qq_notice").html("请输入客服qq!");
		}
		else if(!reg.test(value))
		{
			$("#qq_notice").html("客服qq格式不正确!");
		}
		else
		{
			$("#qq_notice").html("");
		}
	}
	function checkreal_name(value)
	{
		if(value=='')
		{
			$("#real_name_notice").html("请输入店长姓名!");
		}
		else
		{
			$("#real_name_notice").html("");
		}
	}
	function check_phone(value)
	{
		var reg2 = /^1[3458]\d{9}$/;
		if(value=='')
		{
			$("#phone_notice").html("请输入手机号码!");
		}
		else if(!reg2.test(value))
		{
			$("#phone_notice").html("请输入正确手机号码!");
		}	
		else
		{
			$("#phone_notice").html("");
		}
	}
function checkenterinfo()
{
	/*
	var business_license   = $("#business_license").val();
	var business_scope   = $("#business_scope").val();
	var cards   = $("#cards").val();
	var certificate = $("#certificate").val();
	var agreement =  $("#agreement").val();
	
	
	if(business_license=='')
	{
		$("#business_license_notice").html("请上传企业营业执照!");
		return false;
	}
	else
	{
		$("#business_license_notice").html("");
	}
	if(business_scope=='')
	{
		$("#business_scope_notice").html("请上传企业组织机构代码证!");
		return false;
	}
	else
	{
		$("#business_scope_notice").html("");
	}
	
	if(cards=='')
	{
		$("#cards_notice").html("请上传企业法人身份证!");
		return false;
	}
	else
	{
		$("#cards_notice").html("");
	}
	if(certificate=='')
	{
		$("#certificate_notice").html("请上传税务登记证!");
		return false;
	}
	else
	{
		$("#certificate_notice").html("");
	}
	if(agreement=='')
	{
		$("#agreement_notice").html("请先同意入驻协议!");
		return false;
	}
	else
	{
		$("#agreement_notice").html("");
	}*/
	
	return true;
}
</script>
</head>
<body>
<?php echo $this->fetch('library/top.lbi'); ?>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<?php echo $this->fetch('library/ur_here.lbi'); ?>
<div class="wp"><?php 
$k = array (
  'name' => 'ads',
  'id' => '15',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></div>
<div class="blank30"></div>
<form action="enter.php" name="myfrom"  enctype="multipart/form-data"   method="post" onSubmit="return regs(1,1);">
<div class="wp">
    <div id="setp1"> 
    
        <div class="breadcrumb">
	        <ul>
		        <li class="current">1. 填写申请信息<em></em><i></i></li>
		        <!-- <li>2. 资质上传<em></em><i></i></li> -->
                <li>2. 等待审核<em></em><i></i></li>
	        </ul>
        </div>
        <ul class="bod">
            <li>
                <label>商家名称：</label>
                <input name="suppliers_name" type="text" onblur="check_suppliers_name(this.value);" id="suppliers_name" class="inp"/>
                 <span id="suppliers_name_notice">*</span>
                
            </li>
            <?php if (0): ?>
            <li>
                <label>经营区域：</label>
            <select name="province_id" id="selProvinces" onchange="region.changed(this, 2, 'selCities')">
           <option value=''>请选择</option>
             <?php $_from = $this->_var['provinces']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'region');if (count($_from)):
    foreach ($_from AS $this->_var['region']):
?>
               <option value="<?php echo $this->_var['region']['region_id']; ?>" <?php if ($this->_var['region']['region_id'] == $this->_var['supp_list']['province_id']): ?> selected="selected"<?php endif; ?>> <?php echo $this->_var['region']['region_name']; ?></option>
             <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
         </select>
		  <select name="city_id" id="selCities"  onchange="region.changed(this, 3, 'selDistricts')">
          <option value=''>请选择</option>

            <?php $_from = $this->_var['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'region');if (count($_from)):
    foreach ($_from AS $this->_var['region']):
?>
              <option value="<?php echo $this->_var['region']['region_id']; ?>" <?php if ($this->_var['region']['region_id'] == $this->_var['supp_list']['city_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['region']['region_name']; ?></option>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </select>
         <select name="district_id" id="selDistricts">
				<option value="0">请选择</option>
				<?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
				<option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['district']['region_id'] == $this->_var['supp_list']['district_id']): ?>selected="selected"<?php endif; ?>  ><?php echo $this->_var['district']['region_name']; ?></option>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</select> 
    
            </li>
            <?php endif; ?>
            <li>
                <label>详细地址：</label>
                <input name="address" onblur="check_address(this.value);" type="text" id="address" class="inp" />    <span id="address_notice">*</span>  
            </li>
            <li>
                <label>邮箱：</label>
                <input name="email" onblur="checkEmail(this.value);" type="text" id="email" class="inp" />
                <span id="email_notice">*</span>  
            </li>
            <?php if (0): ?>
            <li>
                <label>客服QQ：</label>
                <input name="qq" type="text"  onblur="checkqq(this.value);" id="qq" class="inp" />
                 <span id="qq_notice">*</span>  
            </li>
             <li>
                <label>推荐人：</label>
                <input name="recommend_person" type="text" id="recommend_person" class="inp" />
           		 <span id="recommend_person_notice"></span>  
            </li>
            <li>
                <label>店长：</label>
                <input name="real_name" type="text" onblur="checkreal_name(this.value);" id="real_name" class="inp" />
           		 <span id="real_name_notice">*</span>  
            </li>
            <?php endif; ?>
            <li>
                <label>手机号码：</label>
                <input name="phone" type="text" onblur="check_phone(this.value);" id="phone" class="inp" />
                 <span id="phone_notice">*</span>  
            </li>
            <li>
                <label>管理登录用户名：</label>
                <input name="user_name" type="text" id="user_name" class="inp" onblur="check_user_name(this.value);" />
           		 <span id="user_name_notice">*</span>  
            </li>
            <li>
                <label>登录密码：</label>
                <input name="password" type="password" id="password" class="inp" />
           		 <span id="password_notice">*</span>  
            </li>
            <li>
                <label>密码确认：</label>
                <input name="password1" type="password" id="password1" class="inp" />
           		 <span id="password1_notice" >*</span>  
            </li>
            
            <li>
                <label>&nbsp;</label>
                
                <input name="act" type="hidden" value="enter_act">
                <input name="Submit" type="submit" value="立即入驻" class="us_Submit_reg yahei">
                <!-- 
                <input name="" value="下一步" type="button" class="us_Submit_reg yahei" onClick="return regs(1,2)">
             -->
            </li>
        </ul>
    </div>
    
    <div id="setp2">
        <div class="breadcrumb">
	        <ul>
		        <li>1. 填写申请信息<em></em><i></i></li>
		        <!-- <li class="current">2. 资质上传<em></em><i></i></li> -->
                <li>2. 等待审核<em></em><i></i></li>
	        </ul>
        </div>
        <ul class="bod">
            <li>
                <label>企业营业执照：</label>
                <input name="business_license" id="business_license" type="file" class="file">
                <span id="business_license_notice">*</span>&nbsp;&nbsp;建议图片大小保持在1M以内
            </li>
            <li>
                <label>组织机构代码证：</label>
                <input name="business_scope" id="business_scope" type="file" class="file">
                <span id="business_scope_notice">*</span>&nbsp;&nbsp;建议图片大小保持在1M以内
            </li>
            <li>
                <label>企业法人身份证：</label>
                <input name="cards" type="file" id="cards" class="file">
                 <span id="cards_notice">*</span>&nbsp;&nbsp;建议图片大小保持在1M以内
            </li>
            <li>
                <label>税务登记证：</label>
                <input name="certificate" id="certificate" type="file" class="file">
                 <span id="certificate_notice">*</span>&nbsp;&nbsp;建议图片大小保持在1M以内
            </li>
           
             <li class="agree">
                <label>&nbsp;</label>
                <input name="agreement" type="checkbox" id="agreement" value="1" checked="checked" />我已阅读并同意<a href="article.php?id=479" target="_blank">《商家入驻协议》</a>
             <span id="agreement_notice">*</span>
            </li>
            <li>
                <label>&nbsp;</label>
                <input name="act" type="hidden" value="enter_act">
                <input name="Submit" type="submit" value="立即入驻" class="us_Submit_reg yahei">
            </li>
        </ul>
    </div>


</div>
</form>
   <script>
	region.isAdmin = true;
	</script>


<div class="blank30"></div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>
