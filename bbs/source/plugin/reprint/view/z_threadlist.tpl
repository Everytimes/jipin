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
  var store,grid;
  function query() {
      store.baseParams = {};
      grid.load();
  }
  function init_grid() {
      var doso = query;
      store = new MWT.Store({
          url: v.ajaxapi+"threadlist"
      });
      grid = new MWT.Grid({
          render: "grid-div",
            store: store,
            pagebar: true,
            pageSize: 20,
            multiSelect:false, 
            bordered: true,
            cm: new MWT.Grid.ColumnModel([
              {head:"帖子ID", dataIndex:"tid", width:70, hide:false, sort:true,align:'center',render:function(val){
                  return "#"+val;
              }},
              {head:"帖子标题", dataIndex:"subject", width:200,sort:true,render:function(val,record){
                  if (val=='') return "<i style='color:gray'>帖子已删除</i>";
                  var tid = record.tid;
                  var url = "forum.php?mod=viewthread&tid="+tid;
                  return "<a href='"+url+"' target='_blank' style='word-break:break-all'>"+val+"</a>";
              }},
              {head:"原文链接", dataIndex:"fromurl", render:function(val){
                  return "<a href='"+val+"' target='_blank' style='word-break:break-all'>"+val+"</a>";
              }},
              {head:"转帖人", dataIndex:"op", width:100, sort:true, align:'center'},
              {head:"转帖时间", dataIndex:"ctime", width:150, sort:true, align:'center', render:function(val){
                return val;
              }},
              {head:"操作", dataIndex:"tid", width:100, align:'center', render:function(val){
                var delbtn = '<a name="rcddelbtn" href="javascript:void(0)" data-tid="'+val+'">删除记录</a>';
                var btns = [delbtn];
                return btns.join('&nbsp;');
              }},
            ])
      });
      grid.create();
      store.on('load',function(){
          jQuery("[name=rcddelbtn]").click(function(){
              var tid = jQuery(this).data('tid');
              var tip = '注意：该操作只删除转帖记录，并不会删除对应的帖子。\n\n确定要删除转帖记录吗？';
              if (window.confirm(tip)) {
                  var params = {tid:tid};
                  var api = v.ajaxapi + 'rthread&action=del';
                  jQuery.ajax({
                      url      : api,
                      type     : "POST",
                      dataType : "json",
                      data     : params,
                      complete : function(res) {
                      },
                      success  : function(res) {
                          if (res.retmsg && res.retcode != 0) alert(res.retmsg);
                          else query();
                      },
                      error    : function(XMLHttpRequest, textStatus, errorThrown) {
                          var errmsg = "Error("+XMLHttpRequest.readyState+") : "+textStatus;
                          alert(errmsg);
                      }
                  });
              }
          });
      });
      query();
  }

  $(document).ready(function(){ 
      init_grid(); 
  });
  </script>
</head>
<body>
  <table class="tb tb2">
    <tr><th colspan="15" class="partition">转帖文章</th></tr>
  </table>
  <div id='grid-div'></div>
</body>
</html>
