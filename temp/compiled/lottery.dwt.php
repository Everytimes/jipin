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
<link href="<?php echo $this->_var['hhs_css_path']; ?>/lottery.css" rel="stylesheet" />
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.js,haohaios.js,index.js,swiper.min.js')); ?>
<link href="/js/dropload/dropload.min.css" rel="stylesheet" >

<script src="/js/dropload/dropload.min.js"></script>
</head>
<body>
    <div class="nav_fixed">
        <a href="javascript:;" class="fixed_nav_item  nav_cur"><span class="nav_txt">全部</span></a>
        <a href="javascript:;" class="fixed_nav_item"><span class="nav_txt">正在进行</span></a>
        <a href="javascript:;" class="fixed_nav_item"><span class="nav_txt nav_payment">即将开始</span></a>
        <a href="javascript:;" class="fixed_nav_item"><span class="nav_txt nav_receiving">已经结束</span></a>
    </div>
	<div class="lottery_container" style="padding:30px 0 60px 0">
        <div id="lottery_background">
            <div id="lottery_all">
                <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods_list']['iteration']++;
?>
		        <div class="lottery_goods <?php if ($this->_var['goods']['promote_start_date'] > $this->_var['timestamp']): ?>
		        op2
<?php elseif ($this->_var['goods']['promote_end_date'] > $this->_var['timestamp']): ?>
op1
<?php else: ?>
op3
<?php endif; ?>">
			        <img class="lottery_pic" src="<?php echo $this->_var['goods']['goods_img']; ?>">
			        <div class="lottery_info">
				        <div class="lottery_left_time">
					        <?php if ($this->_var['goods']['promote_start_date1'] > $this->_var['now_time']): ?>
					        <div class="lottery_left_time_head">开始时间</div>
					        <div class="lottery_left_time_detail"><?php echo $this->_var['goods']['start_date']; ?></div>
					        <?php else: ?>
					        <div class="lottery_left_time_head">剩余时间:</div>
					        <div class="endtime lottery_left_time_detail" data-endtime="<?php echo $this->_var['goods']['promote_end_date']; ?>"></div>
					        <?php endif; ?>
				        </div>
				        <div class="lottery_goods_name"><?php echo $this->_var['goods']['goods_name']; ?></div>
				        <div class="lottery_buy">
                            <div class="lottery_price_all">
					            <div class="lottery_sale_price">¥<?php echo $this->_var['goods']['team_price']; ?></div>
					            <div class="lottery_market_price">¥<?php echo $this->_var['goods']['market_price']; ?></div>
                            </div>
                            <?php if ($this->_var['goods']['promote_start_date1'] > $this->_var['now_time']): ?>
                            <div class="lottery_buy_button_off"><a href="<?php echo $this->_var['goods']['url']; ?>">即将开始</a></div>
					        <?php elseif ($this->_var['goods']['promote_end_date1'] > $this->_var['now_time']): ?>
					        <div class="lottery_buy_button_on"><a href="<?php echo $this->_var['goods']['url']; ?>">马上抢</a></div>
					        <?php else: ?>
					        <div class="lottery_buy_button_off"><a href="<?php echo $this->_var['goods']['url']; ?>">已开奖</a></div>
                            <?php endif; ?>
				        </div>
			        </div>
		        </div>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>
        </div>
	</div>
<?php echo $this->fetch('library/footer.lbi'); ?>
<script>
var timestamp = <?php echo $this->_var['timestamp']; ?>;
var serverTime = <?php echo $this->_var['timestamp']; ?> * 1000;
$(function(){
    var dateTime = new Date();
    var difference = dateTime.getTime() - serverTime;
	
    setInterval(function(){
      $(".endtime").each(function(){
        var obj = $(this);
        var endTime = new Date(parseInt(obj.data('endtime')) * 1000);
        var nowTime = new Date();
        var nMS=endTime.getTime() - nowTime.getTime() + difference;
        var myD=Math.floor(nMS/(1000 * 60 * 60 * 24));
        var myH=Math.floor(nMS/(1000*60*60)) % 24;
        var myM=Math.floor(nMS/(1000*60)) % 60;
        var myS=Math.floor(nMS/1000) % 60;
        var myMS=Math.floor(nMS/100) % 10;
        if(myD>= 0){
        	var str = "<span class='left_time_im'>"+myD+"</span>天<span class='left_time_im'>"+myH+"</span>小时<span class='left_time_im'>"+myM+"</span>分<span class='left_time_im'>"+myS+"</span>秒";
        }else{
			var str = "已结束！";	
			obj.prev('div').text('');
		}
		obj.html(str);
      });
    }, 100);

    $(".fixed_nav_item").click(function(event) {
    	var i = $(this).index();
    	if(i>0){
    		$(".lottery_goods").hide();
    		$(".op"+i).show();
    	}
    	else{
    		$(".lottery_goods").show();
    	}
    	$(".fixed_nav_item").removeClass('nav_cur');
    	$(this).addClass('nav_cur');
    });    
});

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
                    result += '        <div class="lottery_goods">';
                    result += '        <img class="lottery_pic" src="'+data.goodslist[i]['goods_img']+'">';
                    result += '        <div class="lottery_info">';
                    result += '        <div class="lottery_left_time">';
                    result += '        <div class="lottery_left_time_head">剩余时间:</div>';
                    if(timestamp > data.goodslist[i]['promote_start_date'])
                    {
                    result += '        <div class="lottery_left_time_detail">即将开始</div>';
                    }
                    else{
                    result += '        <div class="endtime lottery_left_time_detail" data-endtime="'+data.goodslist[i]['promote_end_date']+'"></div>';
                    }

                    result += '        </div>';
                    result += '        <div class="lottery_goods_name">'+data.goodslist[i]['goods_name']+'</div>';
                    result += '        <div class="lottery_buy">';
                    result += '                                <div class="lottery_price_all">';
                    result += '            <div class="lottery_sale_price">¥'+data.goodslist[i]['team_price']+'</div>';
                    result += '            <div class="lottery_market_price">¥'+data.goodslist[i]['market_price']+'</div>';
                    result += '                                </div>';
                    if(timestamp > data.goodslist[i]['promote_start_date'])
                    {
                    result += '        <div class="lottery_buy_button_off">即将开始</div>';
                    }
                    else if(timestamp < data.goodslist[i]['promote_end_date'])
                    {
                    result += '        <div class="lottery_buy_button_on"><a href="'+data.goodslist[i]['url']+'">马上抢</a></div>';
                    }
                    else{
                    result += '        <div class="lottery_buy_button_off">已结束</div>';
                    }
                    result += '        </div>';
                    result += '        </div>';
                    result += '        </div>';
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
		// document.getElementById('loading').style.display='none';
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
