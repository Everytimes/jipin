<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<title><?php echo $this->_var['shop_name']; ?></title>
<link rel="shortcut icon" href="favicon.ico" />
<link href="<?php echo $this->_var['hhs_css_path']; ?>/haohaios.css" rel="stylesheet" />
<link href="<?php echo $this->_var['hhs_css_path']; ?>/font-awesome.min.css" rel="stylesheet" />

<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.js,haohaios.js,user.js')); ?>
</head>
<body>
    <div>
        <div class="H5_con">
        
  <!--<?php if ($this->_var['team_info']['team_status'] == 1): ?>-->    
    
<div class="tips topStateWrap tips_succ tips_succ2">
    <div class="tips_ico"></div>
    <!--<?php if ($this->_var['is_team'] == 1): ?>-->  
    <div class="tips_tit">快来入团吧</div>
    <div class="tips_txt">就差你了</div>
    <!--<?php else: ?>-->
    <?php if ($this->_var['order']['team_first'] == 1): ?>
    <div class="tips_tit">开团成功</div>
    <?php else: ?>
    <div class="tips_tit">参团成功</div>
    <?php endif; ?>
    
    <div class="tips_txt">快去邀请好友加入吧</div>
    <!--<?php endif; ?>-->
</div>
<!--<?php endif; ?>-->
 
<!--<?php if ($this->_var['team_info']['team_status'] == 2): ?>--> 
    <!-- <?php if ($this->_var['is_teammen'] > 0): ?>   -->
     
<div class="tips topStateWrap tips_succ tips_succ2">
     <div class="tips_ico"></div>
     <div class="tips_tit">团购成功</div>
     <div class="tips_txt">我们会尽快为您发货，请耐心等待</div>
</div> 
<!-- <?php else: ?> --> 
<div class="tips topStateWrap tips_err">
    <div class="tips_ico"></div>
    <div class="tips_tit">来晚了一步 此团满员啦</div>
    <div class="tips_txt">你可以点击底部红色按钮再开一个团 </div>
</div>
 <!-- <?php endif; ?> -->
<!--<?php endif; ?>-->
<!--<?php if ($this->_var['team_info']['team_status'] == 3 || $this->_var['team_info']['team_status'] == 4): ?>-->   
<!-- <?php if ($this->_var['is_teammen'] > 0): ?>   --> 
<div class="tips topStateWrap tips_err">
    <div class="tips_ico"></div>
    <div class="tips_tit">团购失败</div>
    <div class="tips_txt">你可以点击底部红色按钮重新开团</div>
</div> 
<!-- <?php else: ?> -->
<div class="tips topStateWrap tips_err">
    <div class="tips_ico"></div>
    <div class="tips_tit">来晚了一步！</div>
</div>
 <!-- <?php endif; ?> -->
<!--<?php endif; ?>-->
        
        </div>
        <!--<?php if ($this->_var['team_info']['team_status'] == 1): ?>-->    
        <div class="share_box">
            <a class="share_link" id="share_button" href="javascript:void(0);" onclick="document.getElementById('share_img').style.display='';">直接分享好友参团</a>
<!--            <a class="share_pic" id="share_button" href="javascript:void(0);" onclick="document.getElementById('share_pic').style.display='';">二维码分享好友参团</a>
-->        </div>
        <!-- <?php endif; ?> -->
        <div class="H5_con">
               
            <div id="group_detail" class="tm <?php if ($this->_var['team_info']['team_status'] == 1): ?><?php elseif ($this->_var['team_info']['team_status'] == 2): ?>tm_succ<?php else: ?>tm_err<?php endif; ?>"><!--团购成功-->
            
                <!-- <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?> -->
                
                    <div class="td tuanDetailWrap">
                        <div class="td_img"><a href="goods_tz.php?id=<?php echo $this->_var['goods']['goods_id']; ?>&team_sign=<?php echo $this->_var['team_info']['team_sign']; ?>&is_team=<?php echo $this->_var['is_team']; ?>"><img src="<?php echo $this->_var['goods']['little_img']; ?>"></a></div>
                        <div class="td_info">
                            <p class="td_name"><a href="goods_tz.php?id=<?php echo $this->_var['goods']['goods_id']; ?>&team_sign=<?php echo $this->_var['team_info']['team_sign']; ?>&is_team=<?php echo $this->_var['is_team']; ?>"><?php echo $this->_var['goods']['goods_name']; ?></a></p>
                            <p class="td_mprice"> <span class="tuanTotal"><?php echo $this->_var['team_info']['team_num']; ?></span>人团： <i>¥</i><b><?php echo $this->_var['goods']['goods_price']; ?></b><i> /件</i></p>
                            <!-- <p>查看详情</p> -->
<div class="spec">
<ul>
<form action="javascript:addToCart(<?php echo $this->_var['team_info']['extension_id']; ?>,0,0,5,<?php echo $this->_var['team_info']['team_sign']; ?>,<?php echo $this->_var['team_info']['shared_by']; ?>);" method="post" name="HHS_FORMBUY" id="HHS_FORMBUY">
<?php $_from = $this->_var['specification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('spec_key', 'spec');if (count($_from)):
    foreach ($_from AS $this->_var['spec_key'] => $this->_var['spec']):
?>
    <li>
        <label><?php echo $this->_var['spec']['name']; ?>：</label>
        <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
            <a <?php if ($this->_var['key'] == 0): ?>class="cattsel"<?php endif; ?> onclick="changeAtt(this)" href="javascript:;" name="<?php echo $this->_var['value']['id']; ?>" title="[<?php if ($this->_var['value']['price'] > 0): ?><?php echo $this->_var['lang']['plus']; ?><?php elseif ($this->_var['value']['price'] < 0): ?><?php echo $this->_var['lang']['minus']; ?><?php endif; ?> <?php echo $this->_var['value']['format_price']; ?>]"><?php echo $this->_var['value']['label']; ?><input style="display:none" id="spec_value_<?php echo $this->_var['value']['id']; ?>" type="radio" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" <?php if ($this->_var['key'] == 0): ?>checked<?php endif; ?> /></a>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <input type="hidden" name="spec_list" value="<?php echo $this->_var['key']; ?>" />
    </li>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</form>
</ul>
</div>
                        </div>
                    </div>
                
                <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
            </div>
            <div class="pp">
                <div class="pp_users" id="pp_users">
                    <!-- <?php $_from = $this->_var['team_mem']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?> -->
                    <a class="pp_users_item pp_users_normal" href="#"><img src="<?php echo $this->_var['item']['headimgurl']; ?>"></a>
                    <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
                    
                    <!-- <?php $_from = $this->_var['d_num_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?> -->
                    <a class="pp_users_item pp_users_blank" href="#"><img src="themes/haohaios/images/avatar_4_64.png"></a>
                     <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
                  
                </div>
                <!--<?php if ($this->_var['team_info']['team_status'] == 2): ?>-->
                <div class="pp_tips" id="flag_1_a" >对于诸位大侠的相助，团长感激涕零</div>
                 <!--<?php else: ?>-->
                 <div class="pp_tips" id="flag_1_a" ><?php echo $this->_var['group_share_ads']; ?></div>
                 <!-- <?php endif; ?> -->
   
                <!--<?php if ($this->_var['team_info']['team_status'] == 1): ?>-->
                <div class="pp_tips" id="flag_0_a" >还差<b><?php echo $this->_var['d_num']; ?></b>人，引首以望，延颈鹤望，就等你来啦~~</div>
               
                <div class="pp_state" id="flag_0_b" >
                    <div class="pp_time">
                        剩余<font id="time"></font>结束
                    </div>
                </div>
                <!--<?php endif; ?>-->
                <!--<?php if ($this->_var['team_info']['team_status'] == 2): ?>-->
                <!--div class="pp_state_txt" id="flag_1_b" >团购成功，我们会尽快为您发货，请耐心等待</div-->
                <!--<?php endif; ?>-->
            </div>
            <div class="pp_list">
                <div id="showYaoheList">
                     <!-- <?php $_from = $this->_var['team_mem']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['name']['iteration']++;
?> -->
                     <!-- <?php if ($this->_var['item']['team_first'] == 1): ?> -->
                    <div class="pp_list_item">
                        <img class="pp_list_avatar" alt="" src="<?php echo $this->_var['item']['headimgurl']; ?>">
                        <div class="pp_list_info" id="pp_list_info">
                            <span class="pp_list_name">团长<b><?php echo $this->_var['item']['uname']; ?></b></span>
                            <span class="pp_list_time"><?php echo $this->_var['item']['date']; ?>开团</span>
                        </div>
                    </div>
                     <!-- <?php else: ?> -->
                    <div class="pp_list_item">
                        <img class="pp_list_avatar" alt="" src="<?php echo $this->_var['item']['headimgurl']; ?>">
                        <div class="pp_list_info" id="pp_list_info">
                            <span class="pp_list_name"><b><?php echo $this->_var['item']['uname']; ?></b></span>
                            <span class="pp_list_time"><?php echo $this->_var['item']['date']; ?>参团</span>
                        </div>
                    </div>
                     <!-- <?php endif; ?> -->
                     <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
                </div>
                
                <!--<?php if ($this->_var['team_info']['team_status'] == 1): ?>-->
                <div id="chamemeber" class="pp_list_blank" >
                    还差
                    <span><?php echo $this->_var['d_num']; ?></span> 人，让小伙伴们都来组团吧！

                </div>
                <!--<?php endif; ?>-->
            </div>
        </div>
        <!--div id="shareit">
            <img class="arrow" src="http://dev.vxtong.com/cases/nuannan/imgs/share-it.png">
        </div-->
        <div class="step">
            <div class="step_hd">
                拼团玩法<a class="step_more" href="tuan_rule.php">查看详情</a>
            </div>
            <div id="footItem" class="step_list">
                <div class="step_item">
                    <div class="step_num">1</div>
                    <div class="step_detail">
                        <p class="step_tit">选择
                            <br>心仪商品</p>
                    </div>
                </div>
                <div class="step_item">
                    <div class="step_num">2</div>
                    <div class="step_detail">
                        <p class="step_tit">支付开团
                            <br>或参团</p>
                    </div>
                </div>
                <div class="step_item <?php if ($this->_var['team_info']['team_status'] == 1): ?> step_item_on<?php endif; ?>">
                    <div class="step_num">3</div>
                    <div class="step_detail">
                        <p class="step_tit">等待好友
                            <br>参团支付</p>
                    </div>
                </div>
                <div class="step_item <?php if ($this->_var['team_info']['team_status'] == 2): ?>step_item_on<?php endif; ?>" >
                    <div class="step_num">4</div>
                    <div class="step_detail">
                        <p class="step_tit">达到人数
                            <br>团购成功</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div class="H5_con fixopt" style="display:block;">

 
            <!--<?php if ($this->_var['team_info']['team_status'] == 2 || $this->_var['team_info']['team_status'] == 3 || $this->_var['team_info']['team_status'] == 4): ?>-->
            <div class="fixopt_item">
                <a class="fixopt_btn bottomBtn" href="goods.php?id={$goods.goods_id">我也开个团，点击回商品列表</a>
            </div>
            <!--<?php else: ?>-->
            
             <!-- <?php if ($this->_var['is_team'] == 1): ?> --> 
            <div class="fixopt_item fixopt_item1">
                <a class="fixopt_home" href="index.php" ></a>
                <a class="fixopt_share" id="share_button" href="javascript:void(0);" onclick="document.getElementById('share_img').style.display='';"></a>
                <a class="fixopt_btn" href="javascript:void(0);" onclick="$('#HHS_FORMBUY').submit();">我也要参团</a>
            </div>
            <!-- <?php else: ?> -->
            <div class="fixopt_item fixopt_item2">
                <a class="fixopt_home" href="index.php" ></a>
                <a class="fixopt_btn"  id="share_button" href="javascript:void(0);" onclick="document.getElementById('share_img').style.display='';">还差<?php echo $this->_var['d_num']; ?>人组团成功</a>
            </div>
           <!-- <?php endif; ?> -->
            
            <!--<?php endif; ?>-->
        
        
        </div>
</div>
<a class="explain_tuan" id="share_button" href="javascript:void(0);" onclick="document.getElementById('share_tuan').style.display='';"></a>
<div id="share_tuan" onclick="document.getElementById('share_tuan').style.display='none';"><img src="themes/haohaios/images/share-tuan.png" ></div>

<div id="share_img" class="share_img"<?php if ($this->_var['is_team'] == 1 || $this->_var['team_info']['team_status'] != 1): ?> style="display:none;"<?php endif; ?> onclick="document.getElementById('share_img').style.display='none';">
    <p><img class="arrow" src="themes/haohaios/images/share.png" ></p>
    <p style="margin-top:120px; margin-right:50px;">点击右上角，</p>
    <p style="margin-right:50px;">将它分享给好友</p>
    <p style=" text-align:center; font-size:30px; line-height:80px;">参团人数+1</p>
    <p align="center">还差<?php echo $this->_var['d_num']; ?>人就能组团成功</p>
    <!-- <?php if ($this->_var['team_info']['shared_money'] > 0): ?> -->
    <p style=" text-align:center; font-size:18px; line-height:80px;">分享购买后可获得￥<?php echo $this->_var['team_info']['shared_money']; ?>佣金</p>
    <!-- <?php endif; ?> -->
    <p align="center">快邀请小伙伴参团吧</p>
</div>


<!--<div id="share_pic" style="position:fixed;top:0;right:0;z-index:999;display:none; background:#000;opacity:0.8;filter:alpha(opacity=90);width:100%;height:100%; padding:30px 0; text-align:right;" onclick="document.getElementById('share_pic').style.display='none';"><img src="http://qr.liantu.com/api.php?text=<?php echo $this->_var['link']; ?>&w=200&m=10"><p style="margin:0 30px; line-height:30px; font-size:16px;"><br/>长按二维码保存，发送给朋友或分享到朋友圈，让你的团尽快成功！</p></div>-->
</body>
<script type="text/javascript">
<?php $_from = $this->_var['lang']['clips_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<!--<?php if ($this->_var['team_info']['team_status'] == 1): ?>-->
var daysms = 24 * 60 * 60 * 1000;
var hoursms = 60 * 60 * 1000;
var Secondms = 60 * 1000;
var microsecond = 1000;
var DifferHour = 0;
var DifferMinute = 0;
var DifferSecond = 0;
    
var systime=<?php echo $this->_var['systime']; ?>;
var team_start=<?php echo $this->_var['team_start']; ?>*1000;
var team_end=<?php echo $this->_var['team_start']; ?>*1000+<?php echo $this->_var['team_suc_time']; ?>*24*3600*1000;
setInterval("systime_clock()",1000);
function systime_clock(){
    systime++;
}

function clock()
{   
    //当前时间
  var time = new Date();
  time.setTime(systime*1000);

  var Diffms = team_end - time.getTime();
  var Diffms1=Diffms;
  var a='';
  var b='';
  var c='';
  var d='';
  DifferHour = Math.floor(Diffms / daysms);
  Diffms -= DifferHour * daysms;
  DifferMinute = Math.floor(Diffms / hoursms);
  Diffms -= DifferMinute * hoursms;
  DifferSecond = Math.floor(Diffms / Secondms);
  Diffms -= DifferSecond * Secondms;
  var dShhs = Math.floor(Diffms / microsecond);
  if(Diffms1>=0){
       a="还剩<strong class='tcd-h'>"+DifferHour+"</strong>天;";
       b="<span >"+DifferMinute+"</span>时";
       c="<span >"+DifferSecond+"</span>分";
       d="<span>"+dShhs+"</span>秒";
      document.getElementById('time').innerHTML =a+b+c+d;
     
  }else{//已结束
  /*
      document.getElementById('handler').innerHTML="<button type='button' onclick='window.location=\'index.php\';'>我也要开个团，点此到商品列表</button>";
      
       document.getElementById('flag_0_a').style.display ="none";
       document.getElementById('flag_0_b').style.display ="none";*/
      window.location.reload();
  }
}
 
window.setInterval("clock()", 1000); 
<!-- <?php endif; ?> -->

function changeAtt(t) {
t.lastChild.checked='checked';
for (var i = 0; i<t.parentNode.childNodes.length;i++) {
        if (t.parentNode.childNodes[i].className == 'cattsel') {
            t.parentNode.childNodes[i].className = '';
        }
    }
t.className = "cattsel";
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
</html>
