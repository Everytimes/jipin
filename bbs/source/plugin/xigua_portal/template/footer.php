<?php if (!defined('IN_DISCUZ')) { exit('Access Denied'); } ?>
<footer class="footer">
    <div class="copyright"><?php echo '&copy;'.date('Y') . ' '.$wechat['wsq_sitename'] .' ' . $_G['setting']['icp']?></div>
</footer>
<div id="back2top" class="back2top"></div>
<div id="shortcut-i-pannel1" style="display: none!important;">
    <div class="con"><div class="ic-bg ic-closebtn"></div><div class="tip"><img src="<?php echo $wechat['wsq_sitelogo'];?>"><?php xigua_cards::l('shortcut')?></div><div class="ic-bg ic-arrow"></div>
    </div>
</div>
<?php if($diy){?>
<link href="source/plugin/xigua_portal/static/css/diy.css?20150521" rel="stylesheet" />
<link href="source/plugin/xigua_portal/static/css/form.css" rel="stylesheet" />
<script src="source/plugin/xigua_portal/static/js/art/lib/sea.js"></script>
<script type="text/javascript">
seajs.config({alias: {    "jquery": "jquery-1.10.2.js"}});
seajs.use(['jquery', 'src/dialog-plus'], function ($, dialog) {
if(!$.support.leadingWhitespace){
    alert('<?php xigua_cards::l('donst_support')?>');
    window.opener=null;window.open('','_self');window.close();
    return false;
}
window.dialog = dialog;
(function(b){b.fn.dragsort=function(o){var e=b.extend({},b.fn.dragsort.defaults,o),j=[],a=null,l=null;this.selector&&b("head").append("<style type='text/css'>"+(this.selector.split(",").join(" "+e.dragSelector+",")+" "+e.dragSelector)+" { cursor: move; }</style>");this.each(function(p,k){if(b(k).is("table")&&b(k).children().size()==1&&b(k).children().is("tbody"))k=b(k).children().get(0);var n={draggedItem:null,placeHolderItem:null,pos:null,offset:null,offsetLimit:null,scroll:null,container:k,init:function(){b(this.container).attr("data-listIdx", p).mousedown(this.grabItem).find(e.dragSelector).css("cursor","move");b(this.container).children(e.itemSelector).each(function(d){b(this).attr("data-itemIdx",d)})},grabItem:function(d){if(!(d.which!=1||b(d.target).is(e.dragSelectorExclude))){for(var c=d.target;!b(c).is("[data-listIdx='"+b(this).attr("data-listIdx")+"'] "+e.dragSelector);){if(c==this)return;c=c.parentNode}a!=null&&a.draggedItem!=null&&a.dropItem();b(d.target).css("cursor","move");a=j[b(this).attr("data-listIdx")];a.draggedItem= b(c).closest(e.itemSelector);c=parseInt(a.draggedItem.css("marginTop"));var f=parseInt(a.draggedItem.css("marginLeft"));a.offset=a.draggedItem.offset();a.offset.top=d.pageY-a.offset.top+(isNaN(c)?0:c)-1;a.offset.left=d.pageX-a.offset.left+(isNaN(f)?0:f)-1;if(!e.dragBetween){c=b(a.container).outerHeight()==0?Math.max(1,Math.round(0.5+b(a.container).children(e.itemSelector).size()*a.draggedItem.outerWidth()/b(a.container).outerWidth()))*a.draggedItem.outerHeight():b(a.container).outerHeight();a.offsetLimit= b(a.container).offset();a.offsetLimit.right=a.offsetLimit.left+b(a.container).outerWidth()-a.draggedItem.outerWidth();a.offsetLimit.bottom=a.offsetLimit.top+c-a.draggedItem.outerHeight()}c=a.draggedItem.height();f=a.draggedItem.width();var h=a.draggedItem.attr("style");a.draggedItem.attr("data-origStyle",h?h:"");if(e.itemSelector=="tr"){a.draggedItem.children().each(function(){b(this).width(b(this).width())});a.placeHolderItem=a.draggedItem.clone().attr("data-placeHolder",true);a.draggedItem.after(a.placeHolderItem); a.placeHolderItem.children().each(function(){b(this).css({borderWidth:0,width:b(this).width()+1,height:b(this).height()+1}).html("&nbsp;")})}else{a.draggedItem.after(e.placeHolderTemplate);a.placeHolderItem=a.draggedItem.next().css({height:c,width:f}).attr("data-placeHolder",true)}a.draggedItem.css({background:"#FFFACD",position:"absolute",opacity:0.8,"z-index":999,height:c,width:f});b(j).each(function(g,i){i.createDropTargets();i.buildPositionTable()});a.scroll={moveX:0,moveY:0,maxX:b(document).width()-b(window).width(), maxY:b(document).height()-b(window).height()};a.scroll.scrollY=window.setInterval(function(){if(e.scrollContainer!=window)b(e.scrollContainer).scrollTop(b(e.scrollContainer).scrollTop()+a.scroll.moveY);else{var g=b(e.scrollContainer).scrollTop();if(a.scroll.moveY>0&&g<a.scroll.maxY||a.scroll.moveY<0&&g>0){b(e.scrollContainer).scrollTop(g+a.scroll.moveY);a.draggedItem.css("top",a.draggedItem.offset().top+a.scroll.moveY+1)}}},10);a.scroll.scrollX=window.setInterval(function(){if(e.scrollContainer!= window)b(e.scrollContainer).scrollLeft(b(e.scrollContainer).scrollLeft()+a.scroll.moveX);else{var g=b(e.scrollContainer).scrollLeft();if(a.scroll.moveX>0&&g<a.scroll.maxX||a.scroll.moveX<0&&g>0){b(e.scrollContainer).scrollLeft(g+a.scroll.moveX);a.draggedItem.css("left",a.draggedItem.offset().left+a.scroll.moveX+1)}}},10);a.setPos(d.pageX,d.pageY);b(document).bind("selectstart",a.stopBubble);b(document).bind("mousemove",a.swapItems);b(document).bind("mouseup",a.dropItem);e.scrollContainer!=window&& b(window).bind("DOMMouseScroll mousewheel",a.wheel);return false}},setPos:function(d,c){var f=c-this.offset.top,h=d-this.offset.left;if(!e.dragBetween){f=Math.min(this.offsetLimit.bottom,Math.max(f,this.offsetLimit.top));h=Math.min(this.offsetLimit.right,Math.max(h,this.offsetLimit.left))}this.draggedItem.parents().each(function(){if(b(this).css("position")!="static"&&(b(this).css("display")!="table")){var m=b(this).offset();f-=m.top;h-=m.left;return false}});if(e.scrollContainer== window){c-=b(window).scrollTop();d-=b(window).scrollLeft();c=Math.max(0,c-b(window).height()+5)+Math.min(0,c-5);d=Math.max(0,d-b(window).width()+5)+Math.min(0,d-5)}else{var g=b(e.scrollContainer),i=g.offset();c=Math.max(0,c-g.height()-i.top)+Math.min(0,c-i.top);d=Math.max(0,d-g.width()-i.left)+Math.min(0,d-i.left)}a.scroll.moveX=d==0?0:d*e.scrollSpeed/Math.abs(d);a.scroll.moveY=c==0?0:c*e.scrollSpeed/Math.abs(c);this.draggedItem.css({top:f,left:h})},wheel:function(d){if((b.browser.safari||b.browser.mozilla)&& a&&e.scrollContainer!=window){var c=b(e.scrollContainer),f=c.offset();if(d.pageX>f.left&&d.pageX<f.left+c.width()&&d.pageY>f.top&&d.pageY<f.top+c.height()){f=d.detail?d.detail*5:d.wheelDelta/-2;c.scrollTop(c.scrollTop()+f);d.preventDefault()}}},buildPositionTable:function(){var d=this.draggedItem==null?null:this.draggedItem.get(0),c=[];b(this.container).children(e.itemSelector).each(function(f,h){if(h!=d){var g=b(h).offset();g.right=g.left+b(h).width();g.bottom=g.top+b(h).height();g.elm=h;c.push(g)}}); this.pos=c},dropItem:function(){if(a.draggedItem!=null){b(a.container).find(e.dragSelector).css("cursor","move");a.placeHolderItem.before(a.draggedItem);a.draggedItem.attr("style",a.draggedItem.attr("data-origStyle")).removeAttr("data-origStyle");a.placeHolderItem.remove();b("[data-dropTarget]").remove();window.clearInterval(a.scroll.scrollY);window.clearInterval(a.scroll.scrollX);var d=false;b(j).each(function(){b(this.container).children(e.itemSelector).each(function(c){if(parseInt(b(this).attr("data-itemIdx"))!= c){d=true;b(this).attr("data-itemIdx",c)}})});d&&e.dragEnd.apply(a.draggedItem);a.draggedItem=null;b(document).unbind("selectstart",a.stopBubble);b(document).unbind("mousemove",a.swapItems);b(document).unbind("mouseup",a.dropItem);e.scrollContainer!=window&&b(window).unbind("DOMMouseScroll mousewheel",a.wheel);return false}},stopBubble:function(){return false},swapItems:function(d){if(a.draggedItem==null)return false;a.setPos(d.pageX,d.pageY);for(var c=a.findPos(d.pageX,d.pageY),f=a,h=0;c==-1&&e.dragBetween&& h<j.length;h++){c=j[h].findPos(d.pageX,d.pageY);f=j[h]}if(c==-1||b(f.pos[c].elm).attr("data-placeHolder"))return false;l==null||l.top>a.draggedItem.offset().top||l.left>a.draggedItem.offset().left?b(f.pos[c].elm).before(a.placeHolderItem):b(f.pos[c].elm).after(a.placeHolderItem);b(j).each(function(g,i){i.createDropTargets();i.buildPositionTable()});l=a.draggedItem.offset();return false},findPos:function(d,c){for(var f=0;f<this.pos.length;f++)if(this.pos[f].left<d&&this.pos[f].right>d&&this.pos[f].top< c&&this.pos[f].bottom>c)return f;return-1},createDropTargets:function(){e.dragBetween&&b(j).each(function(){var d=b(this.container).find("[data-placeHolder]"),c=b(this.container).find("[data-dropTarget]");if(d.size()>0&&c.size()>0)c.remove();else d.size()==0&&c.size()==0&&b(this.container).append(a.placeHolderItem.clone().removeAttr("data-placeHolder").attr("data-dropTarget",true))})}};n.init();j.push(n)});return this};b.fn.dragsort.defaults={itemSelector:"li",dragSelector:"li",dragSelectorExclude:"input, textarea, a[href]", dragEnd:function(){},dragBetween:false,placeHolderTemplate:"<li>&nbsp;</li>",scrollContainer:window,scrollSpeed:5}})(jQuery);
        var diy = {
            ele: null,
            settings: {},

            init: function (options) {
                if (options) {
                    options = $.extend(this.settings, options);
                    this.settings = options;
                }
                $('body').append('<a class="diy-add"><?php xigua_cards::l('add')?></a>');
            },

            edit: function (opt) {
                var type = opt.type;
                var obj = $('#'+type);
                var cid = 'c_'+type, eid = 'e_'+type, did = 'e_'+type;

                obj.css({position: 'relative'});
                obj.append('<div class="diy-cover" id="'+cid+'"></div>');
                obj.append('<div class="diy-id">'+opt.modulename+'</div>');
                obj.append('<a href="javascript:;" data-id="'+opt.id+'" id="'+eid+'" class="diy-edit button2"><?php xigua_cards::l('edit')?></a>');
                obj.append('<a href="javascript:;" data-id="'+opt.id+'" id="'+did+'" class="diy-del button1"><?php xigua_cards::l('del')?></a>');

                $('#'+eid+ ', #'+did).hover(function(){
                    $('#'+cid).show();
                }, function(){
                    $('#'+cid).hide();
                });
            }
        };
        diy.init();
<?php foreach ($cards as $id => $card) { ?>
diy.edit({id:'<?php echo $card['id']?>',type:'<?php echo $id?>',modulename:'<?php echo $card['modulename'],' ',$card['id']?>'});<?php } ?>
        $("#wrap").dragsort({
            dragSelector:  'li.card-mod',
            dragBetween: true,
            placeHolderTemplate: '<li class="card-mod B2"><div></div></li>',
            scrollSpeed: 5,
            dragEnd: function () {
                var cids = [], index = [];
                $('li.card-mod').each(function(){
                    index.push($(this).attr('data-itemidx'));
                    cids.push($(this).attr('data-id'));
                });
                if(index.length>0&&cids.length>0 && cids.length == index.length){
                    var cid = cids.join('_'), idx = index.join('_');
                    $.ajax({
                        type:'POST',
                        url : '<?php echo $actionurl;?>',
                        data: "ac=order&cid="+cid+"&idx="+idx+"&formhash=<?php echo FORMHASH?>",
                        success:function(data){}
                    });
                }
            }
        });
        var d = null;
    $('.diy-edit').on('click', function () {
        if(d){d.remove();}
        var this_ = $(this);
        d=dialog({
            fixed:true,
            url:'<?php echo $actionurl?>&ac=card&cid='+this_.attr('data-id'),
            title:'Loading...',
            width:600
        });
        d.show();
    });
    $('.diy-add').on('click',function(){
        if(d){ d.remove(); }
        d=dialog({
            fixed:true,
            title: '<?php xigua_cards::l('addnew_title')?>',
            content:"<div class='mcards'><ul class='cl'><?php echo $module?></ul></div>",
            cancelValue:'<?php xigua_cards::l('cancel')?>',
            okValue:'<?php xigua_cards::l('add')?>',
            ok :function(){
                var loading = 0, that = this, s = $('.selected');
                if(loading || s.length!=1){ return false; }
                $.ajax({
                    type:'POST',
                    url : '<?php echo $actionurl;?>',
                    data: "ac=new&type="+s.attr('data-type')+"&formhash=<?php echo FORMHASH?>",
                    success:function(data){
                        loading = 1;
                        that.content("<div class='mcards'>"+data+"</div>");
                        setTimeout(function(){
                            window.location.href = window.location.href;
                        }, 1500);
                    }
                });
                return false;
            },
            cancel:function(){}
        });
        d.show(this);
        $('div.mcards a').on('click', function(){
            $(this).parent().siblings().find('a').removeClass('selected');
            $(this).addClass('selected');
        });
    });
    $('.diy-del').on('click', function(){
        var this_ = $(this);
        if(confirm('<?php xigua_cards::l('confirm')?>')){
            $.ajax({
                type:'POST',
                url : '<?php echo $actionurl;?>',
                data: "ac=del&cid="+this_.attr('data-id')+"&formhash=<?php echo FORMHASH?>",
                success:function(data){
                    this_.parent().remove();
                    alert('<?php xigua_cards::l('del_success')?>');
                }
            });
        }
    });
});
</script>
<?php }?>
<?php echo $src;?>
<script type="text/javascript">
var cookiepre = '<?php echo $_G['config']['cookie']['cookiepre']?>',cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain']?>',cookiepath = '<?php echo $_G['config']['cookie']['cookiepath']?>', FORMHASH = '<?php echo  FORMHASH?>';
function setcookie(cookieName, cookieValue, seconds, path, domain, secure) {if(cookieValue == '' || seconds < 0) {cookieValue = '';seconds = -2592000;} if(seconds) { var expires = new Date();expires.setTime(expires.getTime() + seconds * 1000);} domain = !domain ? cookiedomain : domain;path = !path ? cookiepath : path;document.cookie = escape(cookiepre + cookieName) + '=' + escape(cookieValue) + (expires ? '; expires=' + expires.toGMTString() : '') + (path ? '; path=' + path : '/') + (domain ? '; domain=' + domain : '') + (secure ? '; secure' : '');}
function getcookie(name, nounescape) {name = cookiepre + name;var cookie_start = document.cookie.indexOf(name);var cookie_end = document.cookie.indexOf(";", cookie_start);if(cookie_start == -1) {return '';} else {var v = document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length));return !nounescape ? unescape(v) : v;}}
$(function(){var window_ = $(window);window_.scroll(function(){if (window_.scrollTop()>200){$("#back2top").addClass('back2top_show');}else{$("#back2top").removeClass('back2top_show');}});
$("#back2top").on('touchstart', function(){$('body,html').animate({scrollTop:0},500);return false;});
if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent) && /Safari/i.test(navigator.userAgent)) {if(!getcookie('ic-closebtn')){$('#shortcut-i-pannel').fadeIn();}}
$('div.ic-closebtn').on('touchstart', function(){setcookie('ic-closebtn', 1, 432000);$('#shortcut-i-pannel').hide();return false;});
<?php echo $js;?>
});
</script>
<?php echo $code?>
</body>
</html>