<!-- $Id: agency_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js,../js/region.js,listtable.js')); ?>

<div class="main-div">
 <div id="tabbar-div">
    <p>
      <span class="tab-front" id="general-tab">基本信息</span>
     
      <span class="tab-back" id="bank-tab">开户行</span>
      <!-- <?php if (0): ?> -->
      <span class="tab-back" id="detail-tab">相关资质</span>
      <!-- <?php endif; ?> -->
      <span class="tab-back" id="content-tab">详细描述</span>
      <!-- <?php if (0): ?> -->
      <span class="tab-back" id="gallery-tab">广告轮播</span>
      <!-- <?php endif; ?> -->
      
    </p>
  </div>
  <div id="tabbody-div">
<form method="post" action="suppliers.php" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
<!--

<form method="post" action="suppliers.php" name="theForm" enctype="multipart/form-data" >-->

<table cellspacing="1" cellpadding="3" width="100%" id="general-table">
  <tr>
    <td class="label"><?php echo $this->_var['lang']['label_suppliers_name']; ?></td>
    <td><input type="text" name="suppliers_name"  size="50" value="<?php echo $this->_var['suppliers']['suppliers_name']; ?>" /><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <!-- <?php if (0): ?> -->
  <tr>
    <td class="label">店长姓名：</td>
    <td>  <input name="real_name" type="text" size="40" id="real_name" class="input"  value="<?php echo $this->_var['suppliers']['real_name']; ?>" /></td>
  </tr>
   <tr>
    <td class="label">二级域名：</td>
    <td><input name="url_name" type="text" size="10" id="url_name" class="input"  value="<?php echo $this->_var['suppliers']['url_name']; ?>" />.900nz.com 注：必须是3-10位字母组合而成</td>
  </tr>
  <tr>
    <td class="label">店铺类别:</td>
    <td><select name="rank_id">
      <option value="0">请选择</option>
      <?php echo $this->html_options(array('options'=>$this->_var['ranks'],'selected'=>$this->_var['suppliers']['rank_id'])); ?>
    </select></td>
  </tr>
  
  <?php if ($_SESSION['site_id'] == ''): ?>
  <tr>
    <td class="label">站点选择：</td>
    <td> 
    
    全选:
        <input type="checkbox" name="checkbox" value="checkbox"  onclick='listTable.selectAll(this, "site_id")' />
         <br />
     <?php if ($this->_var['form_action'] == 'insert'): ?>
     	 <?php $_from = $this->_var['site_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
         <input name="site_id[]" type="checkbox" value="<?php echo $this->_var['list']['id']; ?>" id='site_id' ><?php echo $this->_var['list']['name']; ?>&nbsp;&nbsp;
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
     <?php else: ?>
     <?php echo $this->_var['site_html']; ?>
     <?php endif; ?>
    </td>
  </tr>
  <?php else: ?>
  <input name="site_id[]"  type="hidden" value="<?php echo $_SESSION['site_id']; ?>">
  <?php endif; ?>
   <tr>
     <tr>
    <td class="label">指定厂家：</td>
    <td> 
     <?php if ($this->_var['form_action'] == 'insert'): ?>
     	 <?php $_from = $this->_var['companys_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
         <input name="companys_id[]" type="checkbox" value="<?php echo $this->_var['list']['companys_id']; ?>"><?php echo $this->_var['list']['companys_name']; ?>&nbsp;&nbsp;
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
     <?php else: ?>
     <?php echo $this->_var['company_html']; ?>
     <?php endif; ?>
    </td>
  </tr>
   <!-- <?php endif; ?> --> 
<!-- 
   <tr>
                  <td  class="label">品牌logo：</td>
                  <td>

                  <input name="supp_logo" type="file"  size="40" />&nbsp;&nbsp;大小建议158像素*86像素&nbsp;&nbsp;

                  <?php if ($this->_var['suppliers']['supp_logo']): ?><a  href="./../<?php echo $this->_var['suppliers']['supp_logo']; ?>" target="_blank">查看</a><?php endif; ?>

                  </td>

                </tr>
<tr>
           
            <td  class="label">店铺banner：</td>
            <td>
         <input name="supp_banner" type="file"  size="40" />&nbsp;&nbsp;大小建议1200像素*200像素&nbsp;&nbsp;
          <?php if ($this->_var['supp_list']['supp_banner']): ?><a  href="./../<?php echo $this->_var['suppliers']['supp_banner']; ?>" target="_blank">查看</a><?php endif; ?>
            </td>
          </tr>
          
          
            <tr>
          <td class="label">经度：</td>
          <td>
          <input name="longitude" type="text" size="40" id="address"  class="input"  value="<?php echo $this->_var['suppliers']['longitude']; ?>"/>
          </td>
        </tr>
          <tr>
          <td class="label">纬度：</td>
          <td>
          <input name="latitude" type="text" size="40" id="latitude"  class="input"  value="<?php echo $this->_var['suppliers']['latitude']; ?>"/>
          </td>
        </tr>
 -->          
          
          
           <tr>
          <td class="label">经营区域：</td>
          <td>
		<select name="province_id" id="selProvinces" onchange="region.changed(this, 2, 'selCities')">
           <option value=''>请选择</option>
             <?php $_from = $this->_var['provinces']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'region');if (count($_from)):
    foreach ($_from AS $this->_var['region']):
?>
               <option value="<?php echo $this->_var['region']['region_id']; ?>" <?php if ($this->_var['region']['region_id'] == $this->_var['suppliers']['province_id']): ?> selected="selected"<?php endif; ?>> <?php echo $this->_var['region']['region_name']; ?></option>
             <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
         </select>
		  <select name="city_id" id="selCities"  onchange="region.changed(this, 3, 'selDistricts')">
          <option value=''>请选择</option>
            <?php $_from = $this->_var['cityes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'region');if (count($_from)):
    foreach ($_from AS $this->_var['region']):
?>
              <option value="<?php echo $this->_var['region']['region_id']; ?>" <?php if ($this->_var['region']['region_id'] == $this->_var['suppliers']['city_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['region']['region_name']; ?></option>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </select>
         <select name="district_id" id="selDistricts">
				<option value="0">请选择</option>
				<?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
				<option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['district']['region_id'] == $this->_var['suppliers']['district_id']): ?>selected="selected"<?php endif; ?>  ><?php echo $this->_var['district']['region_name']; ?></option>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</select> 
          </td>
        </tr>

         <tr>
          <td class="label">详细地址：</td>
          <td>
          <input name="address" type="text" size="40" id="address"  class="input"  value="<?php echo $this->_var['suppliers']['address']; ?>"/>
          </td>
        </tr>
         <tr>
          <td class="label">邮箱：</td>
          <td>
          <input name="email" type="text" size="40" id="email" class="input"  value="<?php echo $this->_var['suppliers']['email']; ?>" />
          </td>
        </tr>
        <!-- <?php if (0): ?> -->
         <tr>
           <td class="label">备用邮箱</td>
           <td><input name="email1" type="text" size="40" id="email1" class="input"  value="<?php echo $this->_var['suppliers']['email1']; ?>" /></td>
         </tr>
         <tr>
	<!-- <?php endif; ?> -->
          <td class="label">手机号码：</td>

          <td>

          <input name="phone" type="text" size="40" id="phone"   class="input"  value="<?php echo $this->_var['suppliers']['phone']; ?>"  />

            <span id="phone_notice" style="color:#FF0000"> *</span>

          </td>
        </tr>
        <tr>
          <td class="label">客服QQ：</td>
          <td>
          <input name="qq" type="text" size="40" id="qq" class="input"  value="<?php echo $this->_var['suppliers']['qq']; ?>" />
          </td>
        </tr>
        <!-- <?php if (0): ?> -->
         <tr>
           <td class="label">备用手机</td>
           <td><input name="phone1" type="text" size="40" id="phone1" class="input"  value="<?php echo $this->_var['suppliers']['phone1']; ?>" /></td>
         </tr>
           <tr>
          <td class="label">客服QQ：</td>
          <td>
          <input name="qq" type="text"  size="40" class="input"  value="<?php echo $this->_var['suppliers']['qq']; ?>" />
            <span style="color:#FF0000" id="password_notice"> *</span>
          </td>
        </tr>
           <tr>
             <td class="label">推荐人：</td>
             <td>  <input name="recommend_person" type="text"  size="40" class="input"  value="<?php echo $this->_var['suppliers']['recommend_person']; ?>" /></td>
           </tr>
           <!-- <?php endif; ?> -->
              <tr>
                <td class="label">用户名：</td>
                <td><input name="user_name" type="text" size="20"   class="input"  value="<?php echo $this->_var['suppliers']['user_name']; ?>"/></td>
              </tr>
              <tr>
                <td class="label">密码：</td>
                <td><input name="password" type="text" size="20"  class="input"  /></td>
              </tr>
              <tr>
                <td class="label">佣金比例：</td>
                <td>
                <input name="percentage" type="text" size="20"  class="input"  value="<?php if ($this->_var['suppliers']['percentage']): ?><?php echo $this->_var['suppliers']['percentage']; ?><?php else: ?><?php echo $this->_var['cfg_percentage']; ?><?php endif; ?>" />
                <span style="color:#FF0000" id="percentage_notice"> %</span>
                </td>
              </tr>
  <?php if ($this->_var['suppliers']['suppliers_id']): ?>
  <?php if ($this->_var['suppliers']['user_id']): ?>
  <tr>
    <td class="label">解绑店主二维码：</td>
    <td><div id="qrcode"></div></td>
  </tr>
  <?php else: ?>
  <tr>
    <td class="label">绑定店主二维码：</td>
    <td><div id="qrcode"></div></td>
  </tr>
  <?php endif; ?>
  <script src="/js/jquery.js"></script>
  <script src="/js/qrcode.js"></script>
<script type="text/javascript">
var suppliers_id = <?php echo $this->_var['suppliers']['suppliers_id']; ?>;
var uri = <?php if ($this->_var['suppliers']['user_id']): ?>'unbind'<?php else: ?>'bind'<?php endif; ?>;
var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: location.origin + "/"+uri+".php?suppliers_id="+suppliers_id,
    width: 128,
    height: 128,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
});
</script>
  <?php endif; ?>           
</table>
<table width="90%" id="gallery-table" style="display:none">
<?php if ($this->_var['photo_list']): ?>
         <?php $_from = $this->_var['photo_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
					<tr id="gallery_<?php echo $this->_var['list']['photo_id']; ?>">
                      <td width="10">
                      
                      <a href="javascript:;" onclick="if (confirm('确定要删除吗')) dropImg('<?php echo $this->_var['list']['photo_id']; ?>')">[-]</a> <?php if ($this->_var['list']['photo_file']): ?><?php echo $this->_var['list']['photo_file']; ?>,链接:<?php echo $this->_var['list']['link']; ?><a  href="./../<?php echo $this->_var['list']['photo_file']; ?>" target="_blank">查看</a><?php endif; ?></td>
                    </tr>                    
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php else: ?>
	<tr id="gallery_<?php echo $this->_var['list']['photo_id']; ?>">
                      <td width="10">
                      http://www.900nong.com/themes/default/images/flexslider.jpg <a  href="http://www.900nong.com/themes/default/images/flexslider.jpg" target="_blank">查看</a>
     </td>
     </tr>

<?php endif; ?>
</table>
<table width="90%" id="content-table" style="display:none">
 <tr>
 <td class="label">商家描述：</td>
 <td>
<?php echo $this->_var['FCKeditor']; ?>

 </td>
 </tr>
</table>

<table width="90%" id="bank-table" style="display:none">
 <tr>
  <td class="label">开户行名称：</td>
  <td><input name="bank_name"  id='bank_name' type="text" class="input" value="<?php echo $this->_var['supp_row']['bank_name']; ?>" />可以输入50个汉字字符
    </td>
</tr>
<tr>
  <td class="label">开户行姓名：</td>
  <td><input type="text" name="bank_p_name" id='bank_p_name' class="input" value="<?php echo $this->_var['supp_row']['bank_p_name']; ?>" />
可以输入个10汉字或字母</td>
</tr>
     <tr>
          <td class="label">开户行账号：</td>
          <td>
            <input type="text" name="bank_account" id='bank_account' class="input"  value="<?php echo $this->_var['supp_row']['bank_account']; ?>" /> 可以输入20个数字
          </td>
        </tr>
 
</table>


<table width="90%" id="detail-table" style="display:none">
 <tr>
  <td class="label">营业执照：</td>
  <td><input name="business_license" type="file"  size="40" />
    <?php if ($this->_var['suppliers']['business_license']): ?><a  href="./../<?php echo $this->_var['suppliers']['business_license']; ?>" target="_blank">查看</a><?php endif; ?>
    </td>
</tr>
<tr>
  <td class="label">身份证：</td>
  <td><input name="cards" type="file"  size="40" />
    <?php if ($this->_var['suppliers']['cards']): ?><a  href="./../<?php echo $this->_var['suppliers']['cards']; ?>" target="_blank">查看</a><?php endif; ?></td>
</tr>
     <tr>
          <td class="label">组织机构代码证：</td>
          <td>
            <input name="business_scope" id="business_scope" type="file" >
          <?php if ($this->_var['suppliers']['business_scope']): ?>
          <a href="./../<?php echo $this->_var['suppliers']['business_scope']; ?>" target="_blank">查看</a>
          <?php endif; ?>
          </td>
        </tr>
   <tr>
          <td align="right">税务登记证：</td>
          <td>
            <input name="certificate" id="certificate" type="file" >
        
          <?php if ($this->_var['suppliers']['certificate']): ?>
          <a href="./../<?php echo $this->_var['suppliers']['certificate']; ?>" target="_blank">查看</a>
          <?php endif; ?>
          </td>
        </tr>

</table>
 <div class="button-div">
    <input type="submit" class="button" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
     <!--   <input type="button" class="button" value="<?php echo $this->_var['lang']['button_submit']; ?>" onclick="return validate()" />-->

      <input type="reset" class="button" value="<?php echo $this->_var['lang']['button_reset']; ?>" />

      <input type="hidden" name="act" value="<?php echo $this->_var['form_action']; ?>" />
      <input type="hidden" name="page" value="<?php echo $this->_var['page']; ?>" />
	
      <input type="hidden" name="id" value="<?php echo $this->_var['suppliers']['suppliers_id']; ?>" /></td>
    </div>
</form>
</div>
</div>





<script language="JavaScript">
<!--
document.forms['theForm'].elements['suppliers_name'].focus();
function get_site_list(id)
{
  Ajax.call('suppliers.php', 'act=get_sitelist&province_id=' + id ,site_listresponse, "GET", "JSON");
	
}
function site_listresponse(result)
{
	 document.getElementById('selCities').innerHTML = result.content;
}

onload = function()

{

    // 开始检查订单

    startCheckOrder();

}

region.isAdmin = true;
document.getElementById("tabbar-div").onmouseover = function(e)
{
    var obj = Utils.srcElement(e);

    if (obj.className == "tab-back")
    {
        obj.className = "tab-hover";
    }
}

document.getElementById("tabbar-div").onmouseout = function(e)
{
    var obj = Utils.srcElement(e);

    if (obj.className == "tab-hover")
    {
        obj.className = "tab-back";
    }
}

document.getElementById("tabbar-div").onclick = function(e)
{
    var obj = Utils.srcElement(e);

    if (obj.className == "tab-front")
    {
        return;
    }
    else
    {
        objTable = obj.id.substring(0, obj.id.lastIndexOf("-")) + "-table";

        var tables = document.getElementsByTagName("table");
        var spans  = document.getElementsByTagName("span");

        for (i = 0; i < tables.length; i++)
        {
            if (tables[i].id == objTable)
            {
                tables[i].style.display = (Browser.isIE) ? "block" : "table";
            }
            else
            {
                tables[i].style.display = "none";
            }
        }
        for (i = 0; spans.length; i++)
        {
            if (spans[i].className == "tab-front")
            {
                spans[i].className = "tab-back";
                obj.className = "tab-front";
                break;
            }
        }
    }
}


/**

 * 检查表单输入的数据

 */



function selectshowtype(val)
{
	if(val.value =='1')
	{
		document.getElementById('show_type_html').style.display = 'none';
	}
	else
	{
		document.getElementById('show_type_html').style.display = 'block';
	}
}

function s_type(val){

		if(val=='private'){

			tab1.style.display="table-row";

			tab2.style.display="none";	

		}else if(val=='conmpany'){

			tab1.style.display="none";

			tab2.style.display="table-row";	

		}

	}

	

	

	

	

	

/**

 * 添加图片

**/

  function addImg(obj)

  {

	 

	  var src  = obj.parentNode.parentNode; 

	 

	  var idx  = rowindex(src);

      var tbl  = document.getElementById('gallery-table');

	 

      var row  = tbl.insertRow(idx + 1);

	  

      //var cell = row.insertCell(-1);

      row.innerHTML = src.innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");

	  

    

  }

  

  

  function removeImg(obj)

  {

      var row = rowindex(obj.parentNode.parentNode);

      var tbl = document.getElementById('gallery-table');

      tbl.deleteRow(row);

  }





  /**

   * 删除已上传图片

   */

  function dropImg(imgId)

  {

    Ajax.call('suppliers.php?act=drop_image', "img_id="+imgId, dropImgResponse, "GET", "JSON");

  }



  function dropImgResponse(result)

  {

      if (result.error == 0)

      {

          document.getElementById('gallery_' + result.content).style.display = 'none';

      }

  }

//-->

</script>



<?php echo $this->fetch('pagefooter.htm'); ?>