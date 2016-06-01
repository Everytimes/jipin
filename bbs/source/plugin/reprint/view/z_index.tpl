<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="<%plugin_path%>/view/css/mwt.css"/>
  <script src="<%plugin_path%>/view/js/jquery.js"></script>
  <script src="<%plugin_path%>/view/js/qrcode.js"></script>
  <script src="<%plugin_path%>/view/js/mwt.js" charset="utf-8"></script>
  <%js_script%>
  <script>
  function IsURL(str_url){
      var strRegex = "^(https|http)://";
	  var re=new RegExp(strRegex,"i");
	  return re.test(str_url);
  }

  function genqrcode(domid, url) {
      var qrcode = new QRCode(document.getElementById(domid), {
          width  : 150,
          height : 150
      });
	  qrcode.makeCode(url);
  }

  $(document).ready(function(){ 
      var toolurl = "<%toolurl%>";
      genqrcode("qrcode-div", toolurl);
  });
  </script>
</head>
<body>
  <table class="tb tb2">
    <tr><th colspan="15" class="partition">提示</th></tr>
    <tr><td class="tipsblock" s="1">
      <ul id="lis">
        <li>工具地址：</span><a href='<%toolurl%>' target='_blank'><%toolurl%></a></li>
        <li>建议使用手机扫描二维码打开<div id='qrcode-div' style='margin-top:5px;'></div></li>
      </ul>
    </td></tr>
  </table>
  <br>
  <table class="tb tb2">
    <tr><th colspan="15" class="partition">最佳实践（仅供参考）</th></tr>
    <tr><td class="tipsblock" s="1">
      <img src='<%plugin_path%>/view/js/reprint_tip.jpg'/>
    </td></tr>
  </table>

</body>
</html>
