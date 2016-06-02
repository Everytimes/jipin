<!doctype html>
<html lang="zh-CN">
<head>
<meta name="Generator" content="haohaios v1.0" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<title><?php echo $this->_var['page_title']; ?></title>
<link rel="shortcut icon" href="favicon.ico" />
<link href="<?php echo $this->_var['hhs_css_path']; ?>/haohaios.css" rel="stylesheet" />
<link href="<?php echo $this->_var['hhs_css_path']; ?>/font-awesome.min.css" rel="stylesheet" />
<link href="<?php echo $this->_var['hhs_css_path']; ?>/swiper.min.css" rel="stylesheet" />
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.js,haohaios.js,index.js,swiper.min.js')); ?>
<script type="text/javascript">
    var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
    
    <!--
    function checkSearchForm()
    {
        if(document.getElementById('keyword').value)
        {
            return true;
        }
        else
        {
            alert("<?php echo $this->_var['lang']['no_keywords']; ?>");
            return false;
        }
    }
    -->
    
</script>
<link href="/js/dropload/dropload.min.css" rel="stylesheet" >
<script src="/js/dropload/dropload.min.js"></script>
</head>
<body id="index">
<div id="loading"><?php echo $this->_var['loading']; ?></div>
<div class="container" id="container" style="display:none;">
    <?php echo $this->fetch('library/header.lbi'); ?>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php $_from = $this->_var['playerdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');$this->_foreach['fnum'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fnum']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
        $this->_foreach['fnum']['iteration']++;
?>
            <div class="swiper-slide">
                <a href="<?php echo $this->_var['item']['url']; ?>"><img src="<?php echo $this->_var['item']['src']; ?>" width="100%"></a>
            </div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="quick_entrance">
        <ul>
            <li><a href="spike.php"><img src="themes/haohaios/images/spike.png"><em></em><span>秒杀</span></a></li>
            <li><a href="lottery.php"><img src="themes/haohaios/images/lottery.png"><em></em><span>抽奖</span></a></li>
            <?php $_from = $this->_var['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
            <li><a href="<?php echo $this->_var['cat']['url']; ?>"><img src="<?php echo $this->_var['cat']['img']; ?>"><em></em><span><?php echo htmlspecialchars($this->_var['cat']['name']); ?></span></a></li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </div>
	<div class="top_search">
        <form id="searchForm" name="searchForm" method="get" action="search.php" onSubmit="return checkSearchForm()">
            <input name="keywords" id="keyword" type="text" class="text" value="<?php echo htmlspecialchars($this->_var['search_keywords']); ?>" maxlength="60" x-webkit-speech="" lang="zh-CN" onwebkitspeechchange="foo()" placeholder="请输入您要搜索的商品关键字" x-webkit-grammar="builtin:search" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
            <input type="submit" value="搜 索" class="submit" />
        </form>
    </div>
	<div style="height:8px">&nbsp;</div>
    <div id="tuan" class="tuan">
        <div ms-repeat-item="goods_list" id="inner">
            <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods_list']['iteration']++;
?>
            <div class="tuan_g">
                
                    <div class="tuan_g_img">
                        <a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['little_img']; ?>"></a>
                        <!--span class="tuan_mark tuan_mark2">
                        <b><?php echo $this->_var['goods']['team_discount']; ?>折</b>
                        <span><?php echo $this->_var['goods']['team_num']; ?>人团</span>
                        </span-->
                        <?php if ($this->_var['goods']['logo']): ?>
                        <div class="tuan_seller"><img src="<?php echo $this->_var['goods']['logo']; ?>"></div>
                        <?php endif; ?>
						<?php if ($this->_var['goods']['ts_a'] || $this->_var['goods']['ts_b'] || $this->_var['goods']['ts_c']): ?>
                        <div class="tuan_g_img_text">
                            <?php if ($this->_var['goods']['ts_a']): ?>
                            <div class="tuan_g_img_item">
                                <div class="tuan_g_img_round"></div>
                                <div class="tuan_img_text_border"><span><?php echo $this->_var['goods']['ts_a']; ?></span></div>
                            </div>
                            <?php endif; ?>
                            <?php if ($this->_var['goods']['ts_b']): ?>
                            <div class="tuan_g_img_item">
                                <div class="tuan_g_img_round"></div>
                                <div class="tuan_img_text_border"><span><?php echo $this->_var['goods']['ts_b']; ?></span></div>
                            </div>
                            <?php endif; ?>
                            <?php if ($this->_var['goods']['ts_c']): ?>
                            <div class="tuan_g_img_item">
                                <div class="tuan_g_img_round"></div>
                                <div class="tuan_img_text_border"><span><?php echo $this->_var['goods']['ts_c']; ?></span></div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="tuan_g_info">
                        <p class="tuan_g_name"><?php echo $this->_var['goods']['goods_name']; ?></p>
                        <p class="tuan_g_cx"><?php echo $this->_var['goods']['goods_brief']; ?></p>
                    </div>
                    <div class="tuan_g_core">
                        <div class="tuan_g_core_img"><img src="themes/haohaios/images/tuan_g_core-4935ae4c83.png"></div>
                        <div class="tuan_g_price">
                            <span><?php echo $this->_var['goods']['team_num']; ?>人团</span>
                            <b>¥<?php echo $this->_var['goods']['team_price']; ?></b>
                        </div>
                        <a href="<?php echo $this->_var['goods']['url']; ?>"><div class="tuan_g_btn">去开团</div></a>
                    </div>
                    <div class="like goods_list_like">
                        <img src="themes/haohaios/images/<?php echo $this->_var['goods']['like']; ?>like.png">
                        <a href="javascript:collect(<?php echo $this->_var['goods']['goods_id']; ?>)" class="like_click_button"></a>
                    </div>
                
            </div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
    </div>
</div>
<?php echo $this->fetch('library/footer.lbi'); ?>
<script>
var page = 2;
// dropload
var dropload = $('#tuan').dropload({
    scrollArea : window,
    loadDownFn : function(me){
        $.ajax({
            type: 'GET',
            url: 'index.php?act=next&page='+page,
            dataType: 'json',
            success: function(data){
                var result = '';
                for(var i in data.goodslist){
                	if(!data.goodslist[i]['goods_name'])
                		continue;
                    result += '<div class="tuan_g" >';
                    result += '<div class="tuan_g_img">';
                    result += '<a href="'+data.goodslist[i]['url']+'"><img src="'+data.goodslist[i]['little_img']+'"></a>';

                    if(data.goodslist[i]['logo']){
                        result += '<div class="tuan_seller"><img src="'+data.goodslist[i]['logo']+'"></div>';
                    }
                    result += '</div>';
                    result += '<div class="tuan_g_info">';
                    result += '<p class="tuan_g_name">'+data.goodslist[i]['goods_name']+'</p>';
                    result += '<p class="tuan_g_cx">'+data.goodslist[i]['goods_brief']+'</p>';
                    result += '</div>';
                    result += '<div class="tuan_g_core">';
                    result += '<div class="tuan_g_core_img"><img src="themes/haohaios/images/tuan_g_core-4935ae4c83.png"></div>';
					result += '<div class="tuan_g_price">';
					result += '<span>'+data.goodslist[i]['team_num']+'人团</span>';
					result += '<b>¥'+data.goodslist[i]['team_price']+'</b>';
					result += '</div>';
					result += '<a href="'+data.goodslist[i]['url']+'"><div class="tuan_g_btn">去开团</div></a>';
                    result += '</div>';
                    result += '<div class="like goods_list_like">';
                    result += '<img src="themes/haohaios/images/'+data.goodslist[i]['like']+'like.png">';
                    result += '<a href="javascript:collect('+data.goodslist[i]['goods_id']+')" class="like_click_button"></a>';
                    result += '</div>';
                    result += '</div>';
                }
                // 为了测试，延迟1秒加载
                $('#inner').append(result);
                page++;
                if(data.nextPage ==0)
                    dropload.lock();
                me.resetload();
            },
            error: function(xhr, type){
                // alert('Ajax error!');
                me.resetload();
            }
        });
    }
});
<?php if ($this->_var['nextPage'] == 0): ?>
dropload.lock();
<?php endif; ?>
</script>
<script>
	window.onload=function(){
		document.getElementById('loading').style.display='none';
		document.getElementById('container').style.display='';
		
				var swiper = new Swiper('.swiper-container', {
	        pagination: '.swiper-pagination',
	        paginationClickable: true,
	        spaceBetween: 30,
	        centeredSlides: true,
	        autoplay: 2500,
	        autoplayDisableOnInteraction: false
	    });
	}
</script>

<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script language="javascript" type="text/javascript">

	wx.config({
	    debug: false,//这里是开启测试，如果设置为true，则打开每个步骤，都会有提示，是否成功或者失败
	    appId: '<?php echo $this->_var['appid']; ?>',
	    timestamp: '<?php echo $this->_var['timestamp']; ?>',//这个一定要与上面的php代码里的一样。
	    nonceStr: '<?php echo $this->_var['timestamp']; ?>',//这个一定要与上面的php代码里的一样。
	    signature: '<?php echo $this->_var['signature']; ?>',
	    jsApiList: [
	      // 所有要调用的 API 都要加到这个列表中
	        'onMenuShareTimeline',
	        'onMenuShareAppMessage',
	        'onMenuShareQQ',
	        'onMenuShareWeibo'
	    ]
	});
	
	var title="<?php echo $this->_var['title']; ?>";
	var link= "<?php echo $this->_var['link']; ?>";
	var imgUrl="<?php echo $this->_var['imgUrl']; ?>";
	var desc= "<?php echo $this->_var['desc']; ?>";
	wx.ready(function () {
	    wx.onMenuShareTimeline({//朋友圈
	        title: title, // 分享标题
	        link: link, // 分享链接
	        imgUrl: imgUrl, // 分享图标
	        success: function () { 
	            // 用户确认分享后执行的回调函数
	        	statis(2,1);
	        },
	        cancel: function () { 
	            // 用户取消分享后执行的回调函数
	        	statis(2,2);
	        }
	    });
	    wx.onMenuShareAppMessage({//好友
	        title: title, // 分享标题
	        desc: desc, // 
	        link: link, // 分享链接
	        imgUrl: imgUrl, // 分享图标
	        type: '', // 分享类型,music、video或link，不填默认为link
	        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
	        success: function () { 
	        	// 用户确认分享后执行的回调函数
	            statis(1,1);    
	        },
	        cancel: function () { 
	            // 用户取消分享后执行的回调函数
	        	statis(1,2);
	        }
	    });
	  
	    wx.onMenuShareQQ({
	        title: title, // 分享标题
	        desc: desc, // 分享描述
	        link: link, // 分享链接
	        imgUrl: imgUrl, // 分享图标
	        success: function () { 
	           // 用户确认分享后执行的回调函数
	        	statis(4,1);
	        },
	        cancel: function () { 
	           // 用户取消分享后执行的回调函数
	        	statis(4,2);
	        }
	    });
	    wx.onMenuShareWeibo({
	        title: title, // 分享标题
	        desc: desc, // 分享描述
	        link: link, // 分享链接
	        imgUrl: imgUrl, // 分享图标
	        success: function () { 
	           // 用户确认分享后执行的回调函数
	        	statis(3,1);
	        },
	        cancel: function () { 
	            // 用户取消分享后执行的回调函数
	        	statis(3,2);
	        }
	    });
	});
	
	function statis(share_type,share_status){
		$.ajax({
            type:"post",//请求类型
            url:"share.php",//服务器页面地址
            data:"act=link&share_status="+share_status+"&share_type="+share_type+"&link_url=<?php echo $this->_var['link2']; ?>",
            dataType:"json",//服务器返回结果类型(可有可无)
            error:function(){//错误处理函数(可有可无)
                //alert("ajax出错啦");
            },
            success:function(data){
                
            }
        });
	}

</script>
</body>
</html>
