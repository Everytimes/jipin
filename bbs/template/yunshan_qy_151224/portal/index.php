<?php exit('Desgin By http://addon.discuz.com/?@51353.developer Access Denied ');?>
<!--{template common/header}-->
<style id="diy_style" type="text/css"></style>
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
<div class="index_page reset-box-sizing">
  <div class="row">
  	<div class="col-md-12"></div>
    <div class="col-md-6">
      <div class="index_focus">
      <!--[diy=yunshandiy1]--><div id="yunshandiy1" class="area"></div><!--[/diy]-->
      </div>
    
    </div>
    <div class="col-md-6">
      <div class="index_right">
      <!--[diy=yunshandiy2]--><div id="yunshandiy2" class="area"></div><!--[/diy]-->
      </div>
    </div>
  </div>
</div>
<div class="index_page reset-box-sizing">
	<div class="row">
    	<div class="col-md-12"></div>
    	<div class="col-md-4">
        	<div class="index_page_title"><span class="name ft16">谁说会改回去</span></div>
            <div class="index_bd">
            <!--[diy=yunshandiy3]--><div id="yunshandiy3" class="area"></div><!--[/diy]-->
        	</div>
        </div>
        <div class="col-md-4">
    <div class="index_page_title">
        <span class="name ft16">生活攻略</span>
    </div>


    <div class="index_be">
    <!--[diy=yunshandiy4]--><div id="yunshandiy4" class="area"></div><!--[/diy]-->
    </div>
</div>
        <div class="col-md-4">
                    
    <div class="index_page_title">
        <span class="name ft16">最新动态</span>
    </div>


    <div class="index_bca">
    <!--[diy=yunshandiy5]--><div id="yunshandiy5" class="area"></div><!--[/diy]-->
    </div>
   
                    
    <div class="index_page_title">
        <span class="name ft16">精品推荐</span>
    </div>


    <div class="index_bcb cl">
    <!--[diy=yunshandiy6]--><div id="yunshandiy6" class="area"></div><!--[/diy]-->
    </div>

                </div>
    </div>
</div>
<div class="index_page reset-box-sizing">
	<div class="row">
    <div class="col-md-12"></div>
    <div class="col-md-8">
    	<div class="index_page_title"><span class="name ft16">娱乐风尚</span></div>
        <div class="index_ca">
        	<div class="row">
            <!--[diy=yunshandiy7]--><div id="yunshandiy7" class="area"></div><!--[/diy]-->
            </div>
         </div>
    </div>
    <div class="col-md-4">
    <div class="index_page_title"><span class="name">都市品牌</span></div>
    <div class="index_cb">
    <!--[diy=yunshandiy8]--><div id="yunshandiy8" class="area"></div><!--[/diy]-->
        
    </div>
    </div>
    </div>
</div>
<div class="index_page reset-box-sizing">
<div class="row">
	<div class="col-md-12"></div>
    <div class="col-md-12">
    	<div class="index_page_title"><span class="name ft16">社区热图</span></div>
        <div class="index_da">
            <div class="row">
            <!--[diy=yunshandiy9]--><div id="yunshandiy9" class="area"></div><!--[/diy]-->
            </div>
    	</div>
    </div>

</div>
</div>
<div class="index_page reset-box-sizing">
            <div class="row">
                <div class="col-md-12"></div>
                <div class="col-md-12">
    <div class="index_page_title">
        <span class="name">友情链接</span>
    </div>


    <div class="index_ea">
    <!--[diy=yunshandiy10]--><div id="yunshandiy10" class="area"></div><!--[/diy]-->
    </div>
</div>
    <div class="col-md-12">
    <div class="index_eb">
    <!--[diy=yunshandiy11]--><div id="yunshandiy11" class="area"></div><!--[/diy]-->
    </div>
</div>
            </div>
        </div>
<script>
    jQuery(".index_focus").slide({
                    mainCell: "ul",
                    effect: "fade",
                    autoPlay: true,
                    autoPage: true,
                    delayTime: 400,
                    interTime: 3000
                });
    </script>
<script>
jQuery(".index_bca").slide({
                    titCell: "dl dt", //鼠标触发对象
                    targetCell: "dl dd", //与titCell一一对应，第n个titCell控制第n个targetCell的显示隐藏
                    effect: "fade", //targetCell下拉效果
                    defaultPlay: true, //默认是否执行效果（默认true）
                    returnDefault: true //鼠标从.sideMen移走后返回默认状态（默认false）
                });

</script>
<!--{template common/footer}-->
