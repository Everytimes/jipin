<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF

<div style="margin:4px auto;border:1px solid #CCC;padding:10px;line-height:24px;background:#EEE">
<div style="margin:10px 0">
请选择：<select id="csdn123_hotnews">
<option value="no">----最新最热的精选资讯（每天自动更新）----</option>
</select>
</div>
<div style="margin:10px 0">
请选择：<select id="csdn123_weixin_new">
<option value="no">----最新最热的微信公众号精选内容（每天自动更新）----</option>
</select>
</div>
<div style="margin:10px 0">
关键词：<input type="text" id="csdn123keyword" class="px" placeholder="输入您想要采集的内容关键词"  size="45" />
<button type="button"  id="csdn123_getkeyword" class="pn vm" style="vertical-align:top;"><em>综合采集</em></button>
<button type="button"  id="csdn123_getimg" class="pn vm" style="vertical-align:top;"><em>采集图片</em></button>
<button type="button"  id="csdn123_weixin" class="pn vm" style="vertical-align:top;"><em>采集微信</em></button>
<button type="button"  id="csdn123_video" class="pn vm" style="vertical-align:top;"><em>采集视频</em></button>
<button type="button"  id="csdn123_haha" class="pn vm" style="vertical-align:top;"><em>采集笑话</em></button>
</div>
<div style="margin:10px 0">
请选择：<select id="csdn123_searchresult">
<option value="no">----请输入关键词或者网址采集资讯，这儿显示采集的结果内容----</option>
</select>
<span id="csdn123_loading"></span>
<button type="button"  id="csdn123_newsPre" class="pn vm" style="vertical-align:top;"><em>上一条</em></button>
<button type="button"  id="csdn123_newsNext" class="pn vm" style="vertical-align:top;"><em>下一条</em></button>
</div>
<div style="margin:10px 0">
网　址：<input type="text" id="csdn123_url" class="px" placeholder="请输入需要采集的网址"  size="60" />
<button type="button"  id="csdn123_likeGet" class="pn vm" style="vertical-align:top;"><em>网址采集</em></button>
</div>
<div style="margin:16px 0">
其　它：
<button type="button"  id="csdn123_reset" class="pn vm" style="vertical-align:top;"><em>恢复初始内容</em></button>
<button type="button"  id="csdn123_tongyici" class="pn vm" style="vertical-align:top;"><em>云端伪原创</em></button>
<button type="button"  id="csdn123_localtongyici" class="pn vm" style="vertical-align:top;"><em>本地伪原创</em></button>
<button type="button"  id="csdn123_localimgae" class="pn vm" style="vertical-align:top;"><em>图片本地化</em></button>
<button type="button"  id="csdn123_fromurl" class="pn vm" style="vertical-align:top;"><em>添加来源地址</em></button>
<button type="button"  id="csdn123_textformat" class="pn vm" style="vertical-align:top;"><em>内容自动排版</em></button>
</div>
<div class="mtn"><br />
常用采集关键词：{$csdn123_keywords}<br>
历史采集关键词：<span id="csdn123_tishi_historykeyword"></span>
</div>
</div>
<br />
<br />
<script src="{$_G['siteurl']}source/plugin/csdn123_news/res/jquery.min.js" type="text/javascript"></script>
<script src="{$_G['siteurl']}source/plugin/csdn123_news/res/jquery.cookie.js" type="text/javascript"></script>
<script type="text/javascript">
var _csdn123_siteurl = encodeURIComponent("{$_G['siteurl']}");
var csdn123_remoteUrl="";
var csdn123_jQ = jQuery.noConflict(true);
(function ( $, window, undefined ) {
$("#csdn123_getkeyword,#csdn123_getimg,#csdn123_weixin,#csdn123_video,#csdn123_haha").click(function(){

var csdn123keywordQuery = $("#csdn123keyword").val();
csdn123_getcookies(csdn123keywordQuery);
if(csdn123keywordQuery=="")
{
alert("输入您想要采集的内容关键词");
$("#csdn123keyword").focus();
return;
}
if(csdn123keywordQuery.length<2)
{
alert("您输入的关键太短了，请输入至少二个字符以上的关键词！");
$("#csdn123keyword").focus();
return;
}
csdn123keywordQuery=encodeURIComponent(csdn123keywordQuery);
$("#csdn123_loading").html('<img src="' + STATICURL + 'image/common/loading.gif" alt="loading" />');
var csdn123_ajax_url="{$csdn123_server}/zd_version/zd6/main_news.php?cms=dz&ip={$_SERVER['REMOTE_ADDR']}&query="+ csdn123keywordQuery +"&siteurl=" + _csdn123_siteurl + "&csdn123callback=?";
if($(this).text()=="采集图片")
{
csdn123_ajax_url="{$csdn123_server}/zd_version/zd6/main_news.php?cms=dz&ip={$_SERVER['REMOTE_ADDR']}&fromtype=img" + "&query="+ csdn123keywordQuery +"&siteurl=" + _csdn123_siteurl + "&csdn123callback=?";
} else if ($(this).text()=="采集微信") {
csdn123_ajax_url="{$csdn123_server}/zd_version/zd6/main_news.php?cms=dz&ip={$_SERVER['REMOTE_ADDR']}&fromtype=weixin" + "&query="+ csdn123keywordQuery +"&siteurl=" + _csdn123_siteurl + "&csdn123callback=?";
} else if ($(this).text()=="采集视频") {
csdn123_ajax_url="{$csdn123_server}/zd_version/zd6/main_news.php?cms=dz&ip={$_SERVER['REMOTE_ADDR']}&fromtype=video" + "&query="+ csdn123keywordQuery +"&siteurl=" + _csdn123_siteurl + "&csdn123callback=?";
} else if ($(this).text()=="采集笑话") {
csdn123_ajax_url="{$csdn123_server}/zd_version/zd6/main_news.php?cms=dz&ip={$_SERVER['REMOTE_ADDR']}&fromtype=haha" + "&query="+ csdn123keywordQuery +"&siteurl=" + _csdn123_siteurl + "&csdn123callback=?";
}
$.getJSON(csdn123_ajax_url, function(data) {
if(data.total>0){

$("#csdn123_searchresult").html("");
csdn123_getRemoteUrlContent(data.items[0].url);
var csdn123_i=0;		
for(csdn123_i=0;csdn123_i<data.items.length;csdn123_i++)
{
$("<option value='" + data.items[csdn123_i].url + "'>" + data.items[csdn123_i].title + "</option>").appendTo("#csdn123_searchresult");
}


} else {
alert("抱歉，未采集到内容！！网络蜘蛛正在拼命抓取此关键词最新的相关内容，请过一段时间再来尝试此关键词的采集");
$("#csdn123keyword").focus();
}
$("#csdn123_loading").html("");

});	
});

$("#csdn123_newsPre,#csdn123_newsNext").click(function(){

var csdn123_sel_index=$("#csdn123_searchresult option:selected").index();
if($(this).text()=="上一条")
{
csdn123_sel_index--;
} else {
csdn123_sel_index++;
}
if(csdn123_sel_index<=0)
{
csdn123_sel_index=0;
}
if(csdn123_sel_index>=$("#csdn123_searchresult option").length)
{
csdn123_sel_index--;
}
var csdn123_preObj=$("#csdn123_searchresult option").eq(csdn123_sel_index);
csdn123_preObj.attr('selected','selected');
csdn123_getRemoteUrlContent(csdn123_preObj.val());

});

$("#csdn123_likeGet").click(function(){

var csdn123_url=$("#csdn123_url").val();
$("#csdn123_loading").html('<img src="' + STATICURL + 'image/common/loading.gif" alt="loading" />');
if(/http.+?\/\w/g.test(csdn123_url))
{
csdn123_url=encodeURIComponent(csdn123_url);
var csdn123_ajax_catchUrl="{$csdn123_server}/zd_version/zd6/main_news.php?cms=dz&ip={$_SERVER['REMOTE_ADDR']}&likeurl=yes" +"&query="+ csdn123_url +"&siteurl=" + _csdn123_siteurl + "&csdn123callback=?";			
$.getJSON(csdn123_ajax_catchUrl, function(data) {
if(data.total>0){

$("#csdn123_searchresult").html("");
csdn123_getRemoteUrlContent(data.items[0].url);
var csdn123_i=0;		
for(csdn123_i=0;csdn123_i<data.items.length;csdn123_i++)
{
$("<option value='" + data.items[csdn123_i].url + "'>" + data.items[csdn123_i].title + "</option>").appendTo("#csdn123_searchresult");
}

} else {

alert("抱歉，未采集到内容！！网络蜘蛛正在拼命抓取此关键词最新的相关内容，请过一段时间再来尝试此关键词的采集");
$("#csdn123_url").focus();
}
$("#csdn123_loading").html("");
});

} else {

$("#csdn123_loading").html("");
alert("输入您想要采集的网址，以http开头");
$("#csdn123_url").focus();

}

});

$("#csdn123_tongyici").click(function(){

$("#csdn123_loading").html('<img src="' + STATICURL + 'image/common/loading.gif" alt="loading" />');
var csdn123_tongyiciText=$("#e_iframe").contents().find("body").text();
var csdn123_contentHtmlCode=$("#e_iframe").contents().find("body").html();
csdn123_tongyiciText=csdn123_tongyiciText.replace(/[^\u4e00-\u9fa5]/ig,"");
if(csdn123_tongyiciText=="")
{
$("#csdn123_loading").html('');
return;
}
$.post("{$_G['siteurl']}plugin.php?id=csdn123_news:csdn123_fun","csdn123_mycontent=" + csdn123_tongyiciText,function(data){

var csdn123_tempTongyiciArr;
for(var csdn123_i=0;csdn123_i<data.content.length;csdn123_i++)
{
csdn123_tempTongyiciArr=data.content[csdn123_i].split("=");
csdn123_contentHtmlCode=csdn123_contentHtmlCode.replace(csdn123_tempTongyiciArr[0],csdn123_tempTongyiciArr[1]);
}
csdn123_contentHtmlCode=csdn123_contentHtmlCode.replace(/hzw/ig,"");
$("#e_iframe").contents().find("body").html(csdn123_contentHtmlCode);
$("#csdn123_loading").html('');

},"json")

});

$("#csdn123_localtongyici").click(function(){

$("#csdn123_loading").html('<img src="' + STATICURL + 'image/common/loading.gif" alt="loading" />');
var csdn123_contentHtmlCode=$("#e_iframe").contents().find("body").html();
$.get("{$_G['siteurl']}plugin.php?id=csdn123_news:csdn123_fun"+"&csdn123_localmycontent=yes",function(data){

var csdn123_contentHtmlCode=$("#e_iframe").contents().find("body").html();
for(var csdn123_i=0;csdn123_i<data.length;csdn123_i++)
{
csdn123_tempTongyiciArr=data[csdn123_i].split("=");
csdn123_contentHtmlCode=csdn123_contentHtmlCode.replace(csdn123_tempTongyiciArr[0],csdn123_tempTongyiciArr[1]);
}
$("#e_iframe").contents().find("body").html(csdn123_contentHtmlCode);
$("#csdn123_loading").html('');

},"json")

});


$.getJSON("{$csdn123_server}/mydata/hotnews/json.hotnews.php?csdn123HotNewsCallback=?",function(data){

var csdn123_i=0;
for(csdn123_i=0;csdn123_i<data.length;csdn123_i++)
{
$("<option value='" + data[csdn123_i].url + "'>" + data[csdn123_i].title + "</option>").appendTo("#csdn123_hotnews");
}

});

$.getJSON("{$csdn123_server}/opensearch/weixin_new.php?csdn123newweixincallback=?",function(data){

var csdn123_i=0;
for(csdn123_i=0;csdn123_i<data.length;csdn123_i++)
{
$("<option value='" + data[csdn123_i].url + "'>" + data[csdn123_i].title + "</option>").appendTo("#csdn123_weixin_new");
}

});


$("#csdn123_searchresult,#csdn123_hotnews,#csdn123_weixin_new").change(function(){

csdn123_CurrentRemoteUrl=$(this).children('option:selected').val();
if(csdn123_CurrentRemoteUrl!="no")
{
csdn123_getRemoteUrlContent(csdn123_CurrentRemoteUrl);
}


});

$("#csdn123_localimgae").click(function(){

$("#csdn123_loading").html('<img src="' + STATICURL + 'image/common/loading.gif" alt="loading" />');
if(confirm("图片本地化会下载远程图片，在下载图片的过程中可能会导致网页很卡，是否要下载远程的图片到本地存储？？")==false)
{
$("#csdn123_loading").html('');
return false;
}
var csdn123_htmlcode=$("#e_iframe").contents().find("body").html();
var csdn123_imgPatt = new RegExp("src=(['\"])([^<>'\"]{20,600})\\\\1","g");
while(csdn123_imgArr=csdn123_imgPatt.exec(csdn123_htmlcode))
{
var csdn123_imgValue=csdn123_imgArr[2];
$.ajax({async:false,cache:false,data:"id=csdn123_news:csdn123_fun&csdn123_localimg=yes&csdn123_localimgUrl="+encodeURIComponent(csdn123_imgValue),type:"GET",url:"{$_G['siteurl']}plugin.php",success:function(data){

csdn123_htmlcode=csdn123_htmlcode.replace(csdn123_imgValue,data);

}})

}
$("#e_iframe").contents().find("body").html(csdn123_htmlcode);
$("#e_downremoteimg").click();
$("#csdn123_loading").html('');

});
$("#csdn123_fromurl").click(function(){

$("#csdn123_loading").html('<img src="' + STATICURL + 'image/common/loading.gif" alt="loading" />');
$.get("{$_G['siteurl']}plugin.php?id=csdn123_news:csdn123_fun&csdn123_fromurl=yes&csdn123_remoteUrl=" + encodeURIComponent(csdn123_remoteUrl),function(csdn123_obj){

if(csdn123_obj.indexOf("http")!=-1)
{
$("#e_iframe").contents().find("body").append("<br><br>来源地址：" + csdn123_obj);
alert("文章来源地址已经添加到文章的最下面！");
}
$("#csdn123_loading").html('');

});

});
$("#csdn123_textformat").click(function(){

$("#e_iframe").contents().find("body").find("p").before("<span>&nbsp;&nbsp;&nbsp;&nbsp;<span>");
$("#e_iframe").contents().find("body").find("p").after("<br>");
$("#e_iframe").contents().find("body").find("img").before("<br>");
$("#e_iframe").contents().find("body").find("img").after("<br>");

});
$("#csdn123_reset").click(function(){

if(csdn123_remoteUrl.length>8)
{
csdn123_getRemoteUrlContent(csdn123_remoteUrl);
}

});


})( csdn123_jQ, window);

function csdn123_keyword(str)
{
csdn123_jQ("#csdn123keyword").val(str);
csdn123_jQ("#csdn123_getkeyword").click();
}

function csdn123_getRemoteUrlContent(url)
{
csdn123_remoteUrl=url;
csdn123_jQ("#csdn123_loading").html('<img src="' + STATICURL + 'image/common/loading.gif" alt="loading" />');
csdn123_catchUrl="{$csdn123_server}/zd_version/zd6/getContent.php?cms=dz&ip={$_SERVER['REMOTE_ADDR']}&siteurl=" + _csdn123_siteurl + "&url="+ encodeURIComponent(url) +"&csdn123content=?";
csdn123_jQ.getJSON(csdn123_catchUrl,function(data){

if(data.status=="ok")
{
csdn123_jQ("#subject").val(data.title);
csdn123_jQ("#e_iframe").contents().find("body").html(data.content);
csdn123_jQ("#csdn123_loading").html('');
}

});

}

function csdn123_getcookies(csdn123keywordQuery)
{
var csdn123TempCookies=csdn123_jQ.cookie("csdn123");
if(csdn123TempCookies==undefined && csdn123keywordQuery=="")
{
return false;

}else if(csdn123keywordQuery!=""){

if(csdn123TempCookies && csdn123TempCookies.indexOf("|")>0)
{
csdn123TempCookies=csdn123TempCookies.replace(csdn123keywordQuery + "|","");
}
if(csdn123TempCookies==undefined)
{
csdn123TempCookies=csdn123keywordQuery + "|";
} else {
csdn123TempCookies=csdn123keywordQuery + "|" + csdn123TempCookies;
}
}
csdn123_jQ.cookie("csdn123",csdn123TempCookies);
var csdn123TempCookiesArr=csdn123TempCookies.split("|");
var csdn123_j=0;
var csdn123_cookieKeyword="";
for(csdn123_j=0;csdn123_j<csdn123TempCookiesArr.length;csdn123_j++)
{
if(csdn123TempCookiesArr[csdn123_j]!="" && csdn123TempCookiesArr[csdn123_j]!="undefined")
{
csdn123_cookieKeyword+="<a href=\"javascript:csdn123_keyword('" + csdn123TempCookiesArr[csdn123_j] + "')\">" + csdn123TempCookiesArr[csdn123_j] + "</a>&nbsp;|&nbsp;"
}
if(csdn123_j>16)
{
break;
}
}
csdn123_jQ("#csdn123_tishi_historykeyword").html(csdn123_cookieKeyword);
}
csdn123_getcookies("");
</script>

EOF;
?>