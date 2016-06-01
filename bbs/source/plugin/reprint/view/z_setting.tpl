<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="<%plugin_path%>/view/js/mwt.css"/>
  <script src="<%plugin_path%>/view/js/jquery.js"></script>
  <script src="<%plugin_path%>/view/js/mwt.js" charset="utf-8"></script>
  <%js_script%>
  <script>
    var jq=jQuery.noConflict();
    jq(document).ready(function($) {
        set_radio_value("zlabel",v.zlabel);
    });
  </script>
</head>
<body>
  <form method="post" action="admin.php?action=plugins&operation=config&identifier=reprint&pmod=z_setting">
  <table class="tb tb2">
    <tr><th colspan="15" class="partition">设置</th></tr>
    <tr>
      <td width='100'>去掉【转】字：</td>
      <td width='150'>
        <label><input type='radio' name='zlabel' value='0'> 是</label>&nbsp;&nbsp;
        <label><input type='radio' name='zlabel' value='1'> 否</label>
      </td>
      <td class='tips2' id='smsid-desc'>去掉转帖标题中的【转】字</td>
    </tr>
    <tr>
      <td colspan="3">
        <input type="submit" id='subbtn' class='btn' value="提交"/>
      </td>
    </tr>
  </table>
  </form>
</body>
</html>
