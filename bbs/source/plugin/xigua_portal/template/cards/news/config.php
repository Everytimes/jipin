<?php !defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:43
 */
return array(
    'modulename' => xigua_cards::l('news', 0),
    'introduce'  => xigua_cards::l('news_in', 0),
    'icon'       => 'source/plugin/xigua_portal/template/cards/news/images/news.png',
    'preview'    => '',
    'version'    => '1.0.0',
    'lock'       => 0,
    'open'       => 1,
    'js'         => <<<JS
$('div.news-box').each(function(){
var _this = $(this);
var ofst = _this.parent().offset(), h = _this.parent().height(), scrol, newst = _this.find('div.news-t').clone();
newst.addClass('news-t-fix').hide().appendTo(_this);
window_.scroll(function(){scrol = window_.scrollTop();if (scrol>=ofst.top && scrol<=(ofst.top+h)){newst.show();}else{newst.hide();}});});
JS
,
    'src'        => '',
    'tpl'        => '<div class="news-box">{html}</div>',
    'css'        => <<<CSS
div.news-t-fix {position: fixed;left:0;top:0;z-index:99;opacity:.9;background: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#fff),color-stop(100%,rgba(255,255,255,0.75)))}
.news-box{padding-bottom:20px}
.news-t{background:#fff;width:100%;height:45px;line-height:45px;border-bottom:1px solid #EBEAEA;border-top:2px solid #2B73DF;display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-o-box;display:box}
.news-t h3{font-weight:700;font-size:23px;margin-left:12px;overflow:hidden}
.news-t h3 a{color:#2B73DF}
.tmore{overflow:hidden;-webkit-box-flex:1;-moz-box-flex:1;-ms-box-flex:1;box-flex:1;text-align:right}
.tmore a{height:41px;position:relative;display:inline-block;margin-right:12px;font-size:18px;color:#2B73DF}
.tmore .app-link:before{content:"";background-color:#2B73DF;display:inline-block;height:14px;width:1px;position:relative;margin-right:12px}
.news-c{overflow:hidden;padding:10px 10px 0}
.news-c h4{margin:6px 0 8px;font-size:20px;text-align:center}
.news-c h4 a{color:#D53830;font-weight:normal;font-size:18px}
.news-list li{height:32px;line-height:32px;display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-o-box;display:box}
.news-list li a{padding-right:35px;display:block;-webkit-box-flex:1;-moz-box-flex:1;-ms-box-flex:1;box-flex:1;white-space:nowrap;position:relative;text-overflow:ellipsis;overflow:hidden;font-size:16px;}
.news-num{position:absolute;right:0;top:0;line-height:16px;height:16px;padding-right:15px;margin-top:8px;font-size:10px;color:#A7A7A7;background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAcCAYAAAB/E6/TAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QzVFRjg2RDRBNEQ0MTFFMkE5QzE5MjQxNDU0NzQxMDYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QzVFRjg2RDVBNEQ0MTFFMkE5QzE5MjQxNDU0NzQxMDYiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpCQzlBRDdFQkE0QjAxMUUyQTlDMTkyNDE0NTQ3NDEwNiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpCQzlBRDdFQ0E0QjAxMUUyQTlDMTkyNDE0NTQ3NDEwNiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pq7PfNcAAAEMSURBVHjaYvz//z/D8uXL0xgYGPKBWIuBuuAaEE+MjIycxbhs2bJkIGcOA21BCguQqGZnZ2fg5ORkYGZmpqrpf//+Zfj+/TvDz58/q1mAlijy8PDQxBsgh0PNVmTi4uJioDUA2cEEBDS3CGQH7W2BWTbsLGLBJujm5obC37VrF1niA+Ijxp07d/5HF3z79i0jMl9YWPg/IXFgMYPso/+DK46A4D+p4sCCGdmngyzVYXMROeLDO8MOL4tAlSpdLFJUVMSZj6gCuLm5GeTl5RlkZGTuo1ikrKwMxjQAHUw0tuQmEKcD8SwWNEuagEVJPTkmIheqWFMdNSwhKnnTwxJIsfv/fyOoWUxrDBBgAOYjmN4eLJk+AAAAAElFTkSuQmCC");background-repeat:no-repeat;background-position:right bottom;background-size:auto 14px}
.news-num-view{padding-right:0;background:none}
.news-pic-list{display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-o-box;display:box;line-height:1;margin-bottom:16px;margin-top:5px}
.news-pic-list li{-webkit-box-flex:1;-moz-box-flex:1;-ms-box-flex:1;box-flex:1;text-align:left;height:105px;position:relative;margin-right:3px;width:50%}
.news-pic-list li a{color:#666;font-size:14px;display:block;width:100%;height:105px;overflow:hidden}
.news-pic-list li img{margin:0 auto;width:100%}
.news-pic-list .img-tit{background-color:rgba(0,0,0,0.5);color:#FFF;height:22px;line-height:22px;overflow:hidden;padding:0 5px;text-overflow:ellipsis;white-space:nowrap;width:100%;position:absolute;bottom:0;left:0;-webkit-box-sizing:border-box;box-sizing:border-box;text-align:center}
.news-more{text-align:center;display:block;background:#ECECEC;height:35px;line-height: 35px;margin-top:12px;border-radius: 1px;}
.news-more::after {content: "";background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAALBAMAAABv+6sJAAAAIVBMVEUAAABXV1dXV1dXV1dXV1dXV1dXV1dXV1dXV1dXV1dXV1ffA55cAAAACnRSTlMAA5+Ymo8GCa7pLAkHJQAAAFJJREFUCNdjYChgAAIwxbFYAMQSXsHAkLVKEchi1FqVwMC6ahFQWGjVUqCAFVAYKOgAZDIDhYVWLQGyQMJqYEGw8EqQIFQYJAgRBgrCQFQAiAQAGbYU57mg1kEAAAAASUVORK5CYII=) no-repeat 0 center;background-size:10px 6px;display: inline-block;height: 10px;width: 10px;margin-left: 6px;vertical-align: 1px;}
CSS
);