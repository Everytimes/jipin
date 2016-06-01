define(function(require){
    require("common");
    var ajax = require("ajax");
    var env = require("env");
    var o = {};
    var notice = "感谢使用";
    var formhash = '';
    var charset = 'utf-8';
    var coverimg = '';

    function isurl(str) {
        var expression=/http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/;
        var reg=new RegExp(expression);
        return reg.test(str);
    }

    function post_thread(fid,res)
    {
        console.log(res);
        var idxs = [];
        for (var i=0; i<res.words.length; ++i) {
            var item = res.words[i];
            if(item.tag && item.tag=="img") {
                idxs.push(i);
            }
        }
        //console.log(imgs);
        var total = idxs.length;
        if (total>0) {
            showmsg("抓取图片 ( 1/"+total+" )");
        }
        saveimg(fid, res.subject, res.words, idxs, 0);
    }

    function replace_illegal_char(content) {
        content = content.replace(/\(/g, '（');
        content = content.replace(/\)/g, '）');
        content = content.replace(/(<|>|'|")/g, '');
        content = content.replace(/&#13;/g, '');
        content = content.replace(/\[img.*?\]\[\/img\]/g, '');
        return content;
    }

    function cutstr(str, n) {
        if (str.length<n) return str;
        return str.substr(0,n);
    }

    function saveimg(fid, subject, words, idxs, i)
    {
        if (i>=idxs.length) {
            //alert("finish");
            //console.log(words);
            var content = words.join("");
            console.log(content);
            //console.log(html2bbcode(content));
            var typeid = 0;
            if (document.getElementById('fm-typeid').options.length>0) {
                typeid = get_select_value('fm-typeid');
            }
            var params = {
                subject: cutstr(subject, 33),
                message: replace_illegal_char(content),
                formhash: formhash,
                fid: fid,
                typeid: typeid,
                fromurl: get_text_value("fm-url"),
                coverimg: coverimg,
                charset: charset
            };
            //print_r(params); return;
            showmsg("发表帖子");
            jQuery.ajax({
                url: ajaxapi+"newthread&fid="+fid,
				type: "POST",
				dataType: "json",
				data: params,
                success: function(res) {
                    if (res.retmsg && res.retcode != 0) {
                        alert(res.retmsg);
						hidemsg();
                    } else {
                        showmsg("转帖成功");
						hidemsg();
                        window.location = "#/list";
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    hidemsg();
                    alert("指定的版块发帖必须归类，或转帖文章中含非法字符");
                }
            });
            return;
        }
        var idx = idxs[i];
        var imgurl = words[idx].src;
        ajax.post("saveimg", {imgurl:imgurl}, function(res){
            if (res.retcode!=0) {
                console.log("saveimg fail: "+imgurl);
                words[idx] = '';
            } else {
				var imgurl = res.imgurl;
                var width = res.imginfo.width;
                if (width>670) width=670;
                //var str = "[img="+width+",0]"+imgurl+"[/img]";
                // 取第一张符合封面条件的图片做封面
                if (res.imgfile!="" && coverimg=="") {
                    coverimg = res.imgfile;
                }
                var str = imgurl;
                words[idx] = str;
            }
            ++i;
            if (i<idxs.length) {
                showmsg("抓取图片 ( "+(i+1)+"/"+idxs.length+" )");
            }
            setTimeout(function(){
		        saveimg(fid, subject, words, idxs, i);
            }, 500);
        });
    }

    function init_page()
    {
        var msg = "<div style='padding:5px;'>"+
                  "<table width='100%'><tr><td valign='top' width='50'><div class='am-icon-btn am-success am-icon-check'></div></td>"+
                  "<td style='padding-left:10px;'>"+notice+"</td>"+
                  "</tr></table></div><br>";

        var code = "";
        var typesel = "<div id='div-typesel' style='display:none;'><b>选择分类</b>"+
                      "<div style='margin-bottom:10px;'><select id='fm-typeid' class='form-control'></select></div></div>";
        var fields = [
            {type:'html',html:msg},
            {type:'html',html:"<b>微信文章链接：</b>"},
            {type:'html',html:"<textarea id='fm-url' style='margin-bottom:6px;height:80px;' placeholder='请将微信文章链接粘贴至此处'></textarea>"},
            {type:'html',html:"<b>选择转帖发表的版块：</b>"},
            {type:'html',html:"<div style='margin-bottom:10px;'>"+forums_sel+"</div>"},
            {type:'html',html:typesel},
            {type:'button',id:"subbtn",color:"am-btn-primary",text:"提交"},
        ];
        code += show_fieldset(fields);
        jQuery("#frame-body").html(code);
        jQuery("#subbtn").click(function(){
            var params = {
                url : get_text_value("fm-url"),
                fid: get_select_value("fm-forumid")
            };
            if (!isurl(params.url)) {
                alert("请输入微信文章链接");
                jQuery("#fm-url").val("");
                jQuery("#fm-url").focus();
                return;
            }
            if (params.fid==0) {
                alert("请选择版块");
                return;
            }
            //print_r(params);
            showmsg("开始抓取文章内容");
            var fid = params.fid;
			coverimg = '';  //!< 封面图片归零
            ajax.post("crawl",params,function(res){
                if (res.retcode!=0) {
                    hidemsg();
                    alert(res.retmsg);
                } else {
                    //print_r(res);
                    formhash = res.formhash;
                    console.log(res);
                    post_thread(fid,res);
                }
            });
        });
        jQuery('#fm-forumid').change(load_typelist);
    }

    // 加载版块的分类列表
    function load_typelist() {
            var fid = get_select_value('fm-forumid');
			jQuery('#div-typesel').hide();
            if (fid!=0) {
                show_type_select(fid);
        }
    }

    function show_type_select(fid)
    {
        ajax.post('typelist',{fid:fid},function(res){
            console.log(res);
            if (res.typelist.length>0) {
			    jQuery('#div-typesel').show();
                var code = '';
                for (var i=0; i<res.typelist.length; ++i) {
                    var opt = res.typelist[i];
                    code += '<option value="'+opt.typeid+'">'+opt.name+'</option>';
                }
                jQuery('#fm-typeid').html(code);
            }
        });
    }

    function disable_page()
    {
        var msg = "<table width='100%'><tr><td valign='top'><div class='am-icon-btn am-warning am-icon-warning'></div></td>"+
                  "<td style='padding-left:10px;text-align:left;'>很抱歉，您的转帖配额已用完。如需继续使用，请联系插件作者。</td>"+
                  "</tr></table><br>";
        var fields = [
            {type:'html',html:msg},
            {type:'button',id:"subbtn",color:"am-btn-primary",text:"刷新页面"}
        ];
        var code = show_fieldset(fields);
        jQuery("#frame-body").html(code);
        jQuery("#subbtn").click(function(){
            window.location.reload();
        });
    }

    o.indexAction = function() {
        active_tab(0);
        ajax.post("config",{},function(res){
            //print_r(res);
            var quota = res.quota;
            charset = res.charset;
            if (quota<=0) {
			    disable_page();
            } else {
                if (quota<=10) {
                    notice = "您的转帖配额剩余 <b>"+quota+"</b> 条";
                }
		        init_page();
				var fid = res.fid;
                if (fid!=0) {
                    set_select_value('fm-forumid', fid);
                    load_typelist();
                }
            }
        });
    };

    return o;
});
