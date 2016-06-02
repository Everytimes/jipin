<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('guanzu');?><?php include template('common/header'); if($_G['inajax']) { if(error==1) { ?>
<h1>Error!</h1>
<?php } else { ?>
<div style="height: 280px; width: 250px;">
<div style="height: 20px; width: 250px;margin-top: 3px;">
    	<div style="height: 20px; width: 200px; line-height: 20px; margin-left: 10px; font-size: 13px; font-weight: 600; color: #090; float: left;"><b>关注微信公众账号</b></div>
        <div style="float: right; height: 20px; width: 20px; margin-right: 2px;">
            <a href="javascript:;" onclick="hideWindow('tom_weixin_guanzu');" style="background-image: url(source/plugin/tom_weixin/images/tom_guanzu_close.png); background-repeat: no-repeat; height: 20px; width: 20px; display: block; float: right;" ></a>
        </div>  
    </div>
    <div style="height: 220px; width: 220px; margin-top: 5px; margin-left: 15px;"><img width="220" height="220" src="<?php echo $erweima;?>"/></div>
  <div style="height: 20px; width: 220px; margin-top: 5px; margin-left: 15px; line-height: 20px; text-align: center; ">扫一扫关注官方微信</div>
</div>
<?php } } include template('common/footer'); ?>