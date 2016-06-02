<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta name="Generator" content="haohaios v1.0" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="templates/css/layout.css" rel="stylesheet" type="text/css" />
<title>商家管理</title>
<script type="text/javascript" src="templates/js/jquery_common.min.js"></script>
<script type="text/javascript" src="templates/js/supp.js"></script>
<script type="text/javascript" src="templates/js/jquery.uploadify.min.js"></script>
</head>
<body style="background:#FBFBFB">
<a href="javascript:;" onclick="myclose();" class="closebtn">关闭</a>
<div class="toptab">
	<ul class="listtab">		
		<li id='nav2'>选择上传</li>
	</ul>
</div>

<div id="show_html2" class="popupbox">
    <form action="javascript:;" method="post" name="myform" style="float:left; margin:15px 0">
		<input id="file_upload" name="file_upload" type="file" multiple="true">
      <div class="piclist">
			<ul id="url" class="picupload">
            </ul>        
        </div>
         <a href="javascript:;" onClick="choice_photo()">确定</a>
	</form>
</div>
<script>

$(function() {

	$('#file_upload').uploadify({

		//校验数据

		'formData'     	: {
			'timestamp' : '<?php echo $this->_var['timestamp']; ?>',
			'jsessionid' : '<?php echo $this->_var['suppliers_id']; ?>',
			'token'     : '<?php echo $this->_var['unique_salt']; ?>'//声明令牌
		},
		'swf'         	: 'templates/uploadify.swf',			//指定上传控件的主体文件，默认‘uploader.swf’

		'uploader'    	: 'uploadify.php',			//指定服务器端上传处理文件，默认‘upload.php’

		'auto'        	: true,					//手动上传

		'buttonImage' 	: 'templates/images/uploadify-browse.png',	//浏览按钮背景图片

		//'cancelImg'     : '/<?php echo $this->_var['temp_dir']; ?>images/cancel.png',

		'multi'       	: true,					//单文件上传

		'removeCompleted' : true,//是否消失进度

		'fileTypeExts'	: '*.gif; *.jpg; *.png; *.flv',	//允许上传的文件后缀

		'fileSizeLimit'	: '300MB',					//上传文件的大小限制，单位为B, KB, MB, 或 GB

		'successTimeout': 30,						//成功等待时间

		'onUploadSuccess' : function(file, data, response) {//每成功完成一次文件上传时触发一次

	    $('#url').append("<li><a href='"+data+"'  target=\"_blank\"><img src='"+data+"' width=\"100\" height=\"100\"></a><a href=\"\" class=\"name\"><?php echo $this->_var['item']['pic_name']; ?></a><input type=\"hidden\" checked id=\"delivery_pic\" name=\"delivery_pic\" value='/business/"+data+"' /></option></li>");
		//	myclose();
		document.getElementById('file_upload').style.display='none';
		
		},

		'onUploadError'   : function(file, data, response) {//当上传返回错误时触发

			$('#url').append("<li>"+data+"</li>");
		}
	});
});	
function choice_photo()
{    
	 var delivery_id = <?php echo $this->_var['delivery_id']; ?>;
	 var delivery_pic = document.getElementById("delivery_pic").value;
	 if(delivery_pic=='')
	 {
		 alert('图片不存在或没有上传');
		 return false;
	 }
	  //alert(photos[0]);
		getStatusUrl = 'suppliers.php?act=update_delivery_pic&delivery_id='+delivery_id+'&delivery_pic='+delivery_pic;
		$.ajax(
		{
			  url: getStatusUrl,
			  dataType: 'json',
			  global: false,
			  success: function(data)
			  {
				  parent.document.getElementById('delivery_pic_'+delivery_id).innerHTML ='上传成功';
					myclose();
			  },
			  error: function(XMLHttpRequest,textStatus, errorThrown){
			  }
		});	
	  /*
   for(var k=0;k<photos.length;k++)
   {    
		var html='';
	    html+='<div id="photourl_'+k+'" style="float:left;">';
		html+='<input type=hidden   name=photos[] id=goods_photo_url_'+k+' value='+photos[k]+'>';
		html+='<img src='+photos[k]+' style="width:200px; height:200px;">';
        html+='<a href="javascript:;" onClick="hideimg(\'photourl_'+k+'\',\'goods_photo_url_'+k+'\')">删除</a>';
		html+='</div>';
		var show=parent.document.getElementById("show_html2");
		show.innerHTML+=html;
  }*/
}
</script>



</body>

</html>