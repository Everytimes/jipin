define(function(require){

require("mwt");

H5Page=function(opt)
{
    this.listeners={};
    this.render=null;
    this.header=null;
    this.footer=null;
    this.body="";
    this.bodyStyle="";
    this.scroll=true;
    if(opt){
        if(opt.render)this.render=opt.render;
        if(opt.header)this.header=opt.header;
        if(opt.footer)this.footer=opt.footer;
        if(opt.bodyStyle)this.bodyStyle=opt.bodyStyle;
        if(opt.body)this.body=opt.body;
        if(isset(opt.scroll)){this.scroll=opt.scroll;}
    };

    function get_header(cfg){
		var code = "<header data-am-widget='header' "+
               "class='am-header am-header-default am-header-fixed'>";
		if (cfg.leftbtn) {
            var im = cfg.leftbtn;
            var href = im.href;
            if (href=="goback") href="javascript:history.go(-1);";
            else if (href=='void') href="javascript:void(0);";
            var icon = "";
            if (im.icon) icon="<i class='am-header-icon am-icon-"+im.icon+"'></i>";
            var text = im.text ? im.text : "";
            var id = im.id ? "id='"+im.id+"'" : "";
            code += "<div class='am-header-left am-header-nav'>"+
               "<a "+id+" href='"+href+"' class=''>"+icon+text+"</a></div>";
		}
		code += "<h1 class='am-header-title'>"+cfg.title+"</h1>";
		if (cfg.rightbtn) {
            var im = cfg.rightbtn;
            var href = im.href;
            if (href=="goback") href="javascript:history.go(-1);";
            else if (href=='void') href="javascript:void(0);";
            var icon = "";
            if (im.icon) icon="<i class='am-header-icon am-icon-"+im.icon+"'></i>";
            var text = im.text ? im.text : "";
            var id = im.id ? "id='"+im.id+"'" : "";
            code += "<div class='am-header-right am-header-nav'>"+
               "<a "+id+" href='"+href+"' class=''>"+icon+text+"</a></div>";
		}
		code += "</header>";
		return code;
    }

    function get_footer(cfg) {
        var list=cfg.list;
        var code = "<div data-am-widget='navbar' class='am-navbar am-cf am-navbar-default' id=''>"+
               "<ul class='am-navbar-nav am-cf am-avg-sm-4'>";
		for (var i=0; i<list.length; ++i) {
			var im = list[i];
			var style = im.active ? "style='color:yellow'" : "";
			code += "<li><a href='"+im.href+"' "+style+">"+
				"<span class='am-icon-"+im.icon+"'></span>"+
				"<span class='am-navbar-label'>"+im.title+"</span></a></li>";
		}
		code += "</ul></div>";
		return code;
    }

    this.create=function(get_pagebody_fun){
        var code="";
        var mtop=0,mbottom=0;
        if(this.header&&!this.header.hide){
            mtop="49px";
            code+=get_header(this.header);
        };
        if(this.footer){
            mbottom="49px";
            code+=get_footer(this.footer);
        }
        if (this.scroll) {
			code+="<div id='wrapper' style='position:absolute;left:0;right:0;top:"+mtop+";bottom:"+mbottom+";overflow:hidden;background:#ddd;'>"+
				"<div class='h5pagebody' style='"+this.bodyStyle+"'>";
			if(get_pagebody_fun)code+=get_pagebody_fun();
			code+=this.body;
			code+="</div><div id='pull-down'><span>刷新...</span></div>";
			code+="</div>";
			$("#"+this.render).html(code);
			this.init_scroll();
        } else {
			code+="<div style='position:absolute;left:0;right:0;top:"+mtop+";bottom:"+mbottom+";overflow:auto;background:#fff;'>";
			if(get_pagebody_fun)code+=get_pagebody_fun();
			code+=this.body;
			code+="</div>";
			$("#"+this.render).html(code);
        }
    };

    this.setbody=function(code){
        $("#h5page-body").html(code);
    };

    var y_start;
    this.init_scroll=function(){
        var thiso=this;
        var myScroll=this.iScroll=new $.AMUI.iScroll('#wrapper',{
            click: true
        });
        myScroll.on('scrollStart',function(){
            y_start=this.y;
        });
        myScroll.on("scrollEnd",function(){
			y_end = this.y;
			//alert(y_start+" to "+y_end);
			if (y_start==0 && y_end==0 && this.distY>200) {
                thiso.fire("pulldown");
			}
		});
    };
};

MWT.extends(H5Page, MWT.Event);

return H5Page;

});
