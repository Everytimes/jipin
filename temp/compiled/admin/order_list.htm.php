<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js,../js/region.js')); ?>
<script language="javascript" type="text/javascript" src="../js/DatePicker/WdatePicker.js"></script>
<!-- 订单搜索 -->
<div class="form-div">
  <form action="javascript:searchOrder()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    <?php echo $this->_var['lang']['order_sn']; ?><input name="order_sn" type="text" id="order_sn" size="15">
    <?php echo htmlspecialchars($this->_var['lang']['consignee']); ?><input name="consignee" type="text" id="consignee" size="15">
    微信订单编号<input name="transaction_id" type="text" id="transaction_id" size="15">
        商品编号<input name="goods_sn" type="text" id="goods_sn" size="15">

    <?php echo $this->_var['lang']['all_status']; ?>
    <select name="status" id="status">
      <option value="-1"><?php echo $this->_var['lang']['select_please']; ?></option>
      <?php echo $this->html_options(array('options'=>$this->_var['status_list'],'selected'=>'-1')); ?>
    </select>
    购买类型
    <select name="type" id="type">
      <option value="-1">全部</option>
      <option value="1">团购购买</option>
      <option value="2">单独购买</option>
    </select>

     区域选择
     <select name="city_id" id="selCities"  onchange="region.changed(this, 3, 'selDistricts')">
          <option value=''>请选择</option>
            <?php $_from = $this->_var['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'region');if (count($_from)):
    foreach ($_from AS $this->_var['region']):
?>
              <option value="<?php echo $this->_var['region']['region_id']; ?>" <?php if ($this->_var['region']['region_id'] == $this->_var['goods']['city_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['region']['region_name']; ?></option>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </select>
         <select name="district_id" id="selDistricts">
				<option value="0">请选择</option>
				<?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
				<option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['district']['region_id'] == $this->_var['goods']['district_id']): ?>selected="selected"<?php endif; ?>  ><?php echo $this->_var['district']['region_name']; ?></option>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</select> 
  <?php if ($this->_var['suppliers_exists'] == 1): ?>    
      <!-- 供货商 -->
      <select name="suppliers_id">
	  <option value=''>请选择</option>
	  <option value="0">自营店</option><?php echo $this->html_options(array('options'=>$this->_var['suppliers_list_name'],'selected'=>$_GET['suppliers_id'])); ?></select>
      <?php endif; ?>        下单时间
    <input class="Wdate" type="text" name="start_time" readonly="readonly" onfocus="WdatePicker({dateFmt:'yyyy-M-d HH:mm'})"/>
      ~       
      <input class="Wdate" type="text" name="end_time" readonly="readonly" onfocus="WdatePicker({dateFmt:'yyyy-M-d HH:mm'})"/>
      
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
    <a href="order.php?act=list&composite_status=<?php echo $this->_var['os_unconfirmed']; ?>"><?php echo $this->_var['lang']['cs'][$this->_var['os_unconfirmed']]; ?></a>
    <a href="order.php?act=list&composite_status=<?php echo $this->_var['cs_await_pay']; ?>"><?php echo $this->_var['lang']['cs'][$this->_var['cs_await_pay']]; ?></a>
    <a href="order.php?act=list&composite_status=<?php echo $this->_var['cs_await_ship']; ?>"><?php echo $this->_var['lang']['cs'][$this->_var['cs_await_ship']]; ?></a>
  </form>
</div>

<!-- 订单列表 -->
<form method="post" action="order.php?act=operate" name="listForm" onsubmit="return check()">
  <div class="list-div" id="listDiv">
<?php endif; ?>

<table cellpadding="3" cellspacing="1">
  <tr>
    <th>
      <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" /><a href="javascript:listTable.sort('order_sn', 'DESC'); "><?php echo $this->_var['lang']['order_sn']; ?></a><?php echo $this->_var['sort_order_sn']; ?>
    </th>
    <th><a href="javascript:listTable.sort('add_time', 'DESC');"><?php echo $this->_var['lang']['order_time']; ?></a><?php echo $this->_var['sort_order_time']; ?></th>
    <th><a href="javascript:listTable.sort('pay_time', 'DESC'); ">支付时间</a><?php echo $this->_var['sort_pay_time']; ?></th>
    <th><a href="javascript:listTable.sort('consignee', 'DESC'); "><?php echo $this->_var['lang']['consignee']; ?></a><?php echo $this->_var['sort_consignee']; ?></th>
    <th><a href="javascript:listTable.sort('total_fee', 'DESC'); "><?php echo $this->_var['lang']['total_fee']; ?></a><?php echo $this->_var['sort_total_fee']; ?></th>
    <th><a href="javascript:listTable.sort('order_amount', 'DESC'); "><?php echo $this->_var['lang']['order_amount']; ?></a><?php echo $this->_var['sort_order_amount']; ?></th>
    <th><?php echo $this->_var['lang']['all_status']; ?></th>
    <th>购买类型</th>
    <th>商品ID</th>
    <th><a href="javascript:listTable.sort('extension_id', 'DESC');">商品名称</a><?php echo $this->_var['sort_extension_id']; ?></th>
    <th>商品数量</th>
    <th>商品价格</th>
    <th>微信单号</th>
    <th><?php echo $this->_var['lang']['handler']; ?></th>
  <tr>
  <?php $_from = $this->_var['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('okey', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['okey'] => $this->_var['order']):
?>
  <tr>
    <td align="center" valign="top" nowrap="nowrap"><input type="checkbox" name="checkboxes" value="<?php echo $this->_var['order']['order_sn']; ?>" /><a href="order.php?act=info&order_id=<?php echo $this->_var['order']['order_id']; ?>"><?php echo $this->_var['order']['order_sn']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><br /><div align="center"><?php echo $this->_var['lang']['group_buy']; ?></div><?php elseif ($this->_var['order']['extension_code'] == "exchange_goods"): ?><br /><div align="center"><?php echo $this->_var['lang']['exchange_goods']; ?></div><?php endif; ?></a></td>
    <td align="center"><?php echo htmlspecialchars($this->_var['order']['buyer']); ?><br /><?php echo $this->_var['order']['formated_order_time']; ?></td>
     <td align="center"><?php if ($this->_var['order']['formated_pay_time']): ?><?php echo $this->_var['order']['formated_pay_time']; ?><?php else: ?>无<?php endif; ?></td>
     
    <td align="center" valign="top"><?php if ($this->_var['order']['point_id'] == 0): ?>[<?php echo $this->_var['order']['region']; ?>]<?php echo htmlspecialchars($this->_var['order']['consignee']); ?><?php if ($this->_var['order']['tel']): ?> [TEL: <?php echo htmlspecialchars($this->_var['order']['tel']); ?>]<?php endif; ?> <br /><?php echo htmlspecialchars($this->_var['order']['address']); ?><?php else: ?>到店自提<?php endif; ?></td>
    <td align="center" valign="top" nowrap="nowrap"><?php echo $this->_var['order']['formated_total_fee']; ?></td>
    <td align="center" valign="top" nowrap="nowrap"><?php echo $this->_var['order']['formated_order_amount']; ?></td>
    <td align="center" valign="top" nowrap="nowrap"><?php echo $this->_var['lang']['os'][$this->_var['order']['order_status']]; ?>,<?php echo $this->_var['lang']['ps'][$this->_var['order']['pay_status']]; ?>,<?php echo $this->_var['lang']['ss'][$this->_var['order']['shipping_status']]; ?></td>
   <td align="center" valign="top" nowrap="nowrap"><?php if ($this->_var['order']['extension_code'] == 'team_goods'): ?>团购【<?php echo $this->_var['lang']['team_status'][$this->_var['order']['team_status']]; ?>】<?php else: ?>单独购买<?php endif; ?> <?php if ($this->_var['order']['point_id'] > 0): ?> 自提<?php endif; ?> <?php if ($this->_var['order']['package_one'] == 1): ?> 同楼购<?php endif; ?>
    <?php if ($this->_var['order']['team_status'] == 2 && $this->_var['order']['is_luck'] == 1): ?>
      <?php if ($this->_var['order']['is_lucker'] == 1): ?> <font color="red">中奖者</font><?php else: ?>未中奖<?php endif; ?>
    <?php endif; ?>
   </td>
    <td align="center"><?php echo $this->_var['order']['goods_id']; ?></td>
    <td align="center"><?php echo $this->_var['order']['goods_name']; ?></td>
    <td align="center"><?php echo $this->_var['order']['goods_number']; ?></td>
   <td align="center"><?php echo $this->_var['order']['goods_price']; ?></td>
   <td align="center"><?php if ($this->_var['order']['transaction_id']): ?><?php echo $this->_var['order']['transaction_id']; ?><?php else: ?>无<?php endif; ?></td>
    <td align="center" valign="top"  nowrap="nowrap">
     <a href="order.php?act=info&order_id=<?php echo $this->_var['order']['order_id']; ?>"><?php echo $this->_var['lang']['detail']; ?></a>
     <?php if ($this->_var['order']['can_remove']): ?>
     <br /><a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['order']['order_id']; ?>, remove_confirm, 'remove_order')"><?php echo $this->_var['lang']['remove']; ?></a>
     <?php endif; ?>
     <?php if ($this->_var['order']['shipping_status'] > 0): ?>
     <br /><a href="order.php?act=info&order_id=<?php echo $this->_var['order']['order_id']; ?>&view_print=1" >打印</a>
     <?php endif; ?>
    </td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>

<!-- 分页 -->
<table id="page-table" cellspacing="0">
  <tr>
    <td align="right" nowrap="true">
    <?php echo $this->fetch('page.htm'); ?>
    </td>
  </tr>
</table>

<?php if ($this->_var['full_page']): ?>
  </div>
  <div>
    <input name="confirm" type="submit" id="btnSubmit" value="<?php echo $this->_var['lang']['op_confirm']; ?>" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="invalid" type="submit" id="btnSubmit1" value="<?php echo $this->_var['lang']['op_invalid']; ?>" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="cancel" type="submit" id="btnSubmit2" value="<?php echo $this->_var['lang']['op_cancel']; ?>" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="remove" type="submit" id="btnSubmit3" value="<?php echo $this->_var['lang']['remove']; ?>" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="print" type="submit" id="btnSubmit4" value="<?php echo $this->_var['lang']['print_order']; ?>" class="button" disabled="true" onclick="this.form.target = '_blank'" />
  
    <input name="shipping_print" type="submit" id="btnSubmit5" value="打印快递单" class="button" disabled="true" onclick="this.form.target = '_blank'" />
    
    
    <input name="batch" type="hidden" value="1" />
    <input name="order_id" type="hidden" value="" />
  </div>
</form>
<script language="JavaScript">
region.isAdmin = true;
listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
var str="";
<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>

listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';

if('<?php echo $this->_var['key']; ?>'!='sort_by'&&'<?php echo $this->_var['key']; ?>'!='sort_order'){
	str+="<?php echo $this->_var['key']; ?>=<?php echo $this->_var['item']; ?>&";
}
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
str=str.slice(0,-1);



    onload = function()
    {
        // 开始检查订单
        startCheckOrder();
        getDownUrl(1);
    }

    /**
     * 搜索订单
     */
    function searchOrder()
    {
        listTable.filter['order_sn']         = Utils.trim(document.forms['searchForm'].elements['order_sn'].value);
        listTable.filter['consignee']        = Utils.trim(document.forms['searchForm'].elements['consignee'].value);
        listTable.filter['transaction_id']   = document.forms['searchForm'].elements['transaction_id'].value;
        listTable.filter['composite_status'] = document.forms['searchForm'].elements['status'].value;
        listTable.filter['goods_sn']         = document.forms['searchForm'].elements['goods_sn'].value;
        
        listTable.filter['city_id']          = document.forms['searchForm'].elements['city_id'].value;
        listTable.filter['district_id']      = document.forms['searchForm'].elements['district_id'].value;
        listTable.filter['suppliers_id']     = document.forms['searchForm'].elements['suppliers_id'].value;
        
        listTable.filter['type']             = document.forms['searchForm'].elements['type'].value;
        listTable.filter['start_time']       = document.forms['searchForm'].elements['start_time'].value;
        listTable.filter['end_time']         = document.forms['searchForm'].elements['end_time'].value;
        listTable.filter['page']             = 1;
        listTable.loadList();
        getDownUrl();
    }

    function check()
    {
      var snArray = new Array();
      var eles = document.forms['listForm'].elements;
      for (var i=0; i<eles.length; i++)
      {
        if (eles[i].tagName == 'INPUT' && eles[i].type == 'checkbox' && eles[i].checked && eles[i].value != 'on')
        {
          snArray.push(eles[i].value);
        }
      }
      if (snArray.length == 0)
      {
        return false;
      }
      else
      {
        eles['order_id'].value = snArray.toString();
        return true;
      }
    }
    /**
     * 显示订单商品及缩图
     */
    var show_goods_layer = 'order_goods_layer';
    var goods_hash_table = new Object;
    var timer = new Object;

    /**
     * 绑定订单号事件
     *
     * @return void
     */
    function bind_order_event()
    {
        var order_seq = 0;
        while(true)
        {
            var order_sn = Utils.$('order_'+order_seq);
            if (order_sn)
            {
                order_sn.onmouseover = function(e)
                {
                    try
                    {
                        window.clearTimeout(timer);
                    }
                    catch(e)
                    {
                    }
                    var order_id = Utils.request(this.href, 'order_id');
                    show_order_goods(e, order_id, show_goods_layer);
                }
                order_sn.onmouseout = function(e)
                {
                    hide_order_goods(show_goods_layer)
                }
                order_seq++;
            }
            else
            {
                break;
            }
        }
    }
    listTable.listCallback = function(result, txt) 
    {
        if (result.error > 0) 
        {
            alert(result.message);
        }
        else 
        {
            try 
            {
                document.getElementById('listDiv').innerHTML = result.content;
                bind_order_event();
                if (typeof result.filter == "object") 
                {
                    listTable.filter = result.filter;
                }
                listTable.pageCount = result.page_count;
                
                getDownUrl();
            }
            catch(e)
            {
                alert(e.message);
            }
        }
    }
    /**
     * 浏览器兼容式绑定Onload事件
     *
     */
    if (Browser.isIE)
    {
        window.attachEvent("onload", bind_order_event);
    }
    else
    {
        window.addEventListener("load", bind_order_event, false);
    }

    /**
     * 建立订单商品显示层
     *
     * @return void
     */
    function create_goods_layer(id)
    {
        if (!Utils.$(id))
        {
            var n_div = document.createElement('DIV');
            n_div.id = id;
            n_div.className = 'order-goods';
            document.body.appendChild(n_div);
            Utils.$(id).onmouseover = function()
            {
                window.clearTimeout(window.timer);
            }
            Utils.$(id).onmouseout = function()
            {
                hide_order_goods(id);
            }
        }
        else
        {
            Utils.$(id).style.display = '';
        }
    }

    /**
     * 显示订单商品数据
     *
     * @return void
     */
    function show_order_goods(e, order_id, layer_id)
    {
        create_goods_layer(layer_id);
        $layer_id = Utils.$(layer_id);
        $layer_id.style.top = (Utils.y(e) + 12) + 'px';
        $layer_id.style.left = (Utils.x(e) + 12) + 'px';
        if (typeof(goods_hash_table[order_id]) == 'object')
        {
            response_goods_info(goods_hash_table[order_id]);
        }
        else
        {
            $layer_id.innerHTML = loading;
            Ajax.call('order.php?is_ajax=1&act=get_goods_info&order_id='+order_id, '', response_goods_info , 'POST', 'JSON');
        }
    }

    /**
     * 隐藏订单商品
     *
     * @return void
     */
    function hide_order_goods(layer_id)
    {
        $layer_id = Utils.$(layer_id);
        window.timer = window.setTimeout('$layer_id.style.display = "none"', 500);
    }

    /**
     * 处理订单商品的Callback
     *
     * @return void
     */
    function response_goods_info(result)
    {
        if (result.error > 0)
        {
            alert(result.message);
            hide_order_goods(show_goods_layer);
            return;
        }
        if (typeof(goods_hash_table[result.content[0].order_id]) == 'undefined')
        {
            goods_hash_table[result.content[0].order_id] = result;
        }
        Utils.$(show_goods_layer).innerHTML = result.content[0].str;
    }

    function getDownUrl(is_first)
    {

		  var aTags = document.getElementsByTagName('A');
	      for (var i = 0; i < aTags.length; i++)
	      { 
	        if (aTags[i].href.indexOf('download') >= 0)
	        {
	          if(typeof(is_first) != "undefined"&&is_first){
	        	  
	      		  aTags[i].href = "order.php?act=download&"+str+"&sort_by="+listTable.filter['sort_by']+"&sort_order="+listTable.filter['sort_order'];
	      	  
	          }else{
	      		  
	      		aTags[i].href = "order.php?act=download&order_sn="+listTable.filter['order_sn']+"&consignee="+listTable.filter['consignee']
	      		+"&transaction_id="+listTable.filter['transaction_id']
				+"&goods_sn="+listTable.filter['goods_sn']

	      		+"&composite_status="+listTable.filter['composite_status']+"&start_time="+listTable.filter['start_time']+"&end_time="+listTable.filter['end_time']+"&type="+listTable.filter['type']
	      		+"&sort_by="+listTable.filter['sort_by']+"&sort_order="+listTable.filter['sort_order'];
	      	  } 
	        }
	      }
    }

/*
    listTable.listCallback = function(result, txt)
    {
      if (result.error > 0)
      {
        alert(result.message);
      }
      else
      {
        try
        {
        
          document.getElementById('listDiv').innerHTML = result.content;

          if (typeof result.filter == "object")
          {
            listTable.filter = result.filter;
          }

          listTable.pageCount = result.page_count;
       
          
          

        }
        catch (e)
        {
          alert(e.message);
        }
      }
    }
*/
</script>


<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>