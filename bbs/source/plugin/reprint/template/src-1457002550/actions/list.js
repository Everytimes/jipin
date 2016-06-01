define(function(require){
    var env = require("env");
    var pagebar,store,o = {};

    function showlist() {
        jQuery("#tlist").html("");
        for (var i=0; i<store.size(); ++i) {
            var rd = store.get(i);
            var tid = rd.tid;
            var subject = rd.subject=='' ? '[该帖已被删除]' : rd.subject;
            var fromurl = rd.fromurl;
            var url = siteurl+"/forum.php?mod=viewthread&tid="+tid;
            var code = '<li><a href="'+url+'" target="_blank" class="am-text-truncate">#'+tid+' '+subject+"</a></li>";
            jQuery("#tlist").append(code);
        }
        jQuery("#sumb").html(store.totalProperty);
    }

    function init_page() {
        var code = '<p align="right" style="margin:0;padding:5px;">已转帖 <b id="sumb"></b> 篇</p>'+
                   '<ul id="tlist" class="am-list" style="margin-top:0;"></ul>';
        jQuery("#frame-body").html(code);

        store = new MWT.Store({
            url: ajaxapi+"threadlist"
        });
        store.on("load",showlist);
        pagebar = new MWT.Pagebar({
            store: store,
            pageSize: 10
        });
    }

    function query() {
        pagebar.changePage(1);
    }

    o.indexAction = function() {
        active_tab(1);
        init_page();
        query();
    };

    return o;
});
