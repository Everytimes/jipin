<?php exit('Desgin By http://addon.discuz.com/?@51353.developer Access Denied ');?>
<!--{if $_G['uid']}-->
<div class="ys_um_plugin pull-left mr10">
<!--{hook/global_usernav_extra1}-->
</div>
<div id="ys_um" class="ys_um unreset-box-sizing">
 	<!--repalce_emohuser_start-->
    <i class="fa {if $tipTotalCnt}fa-user-plus{else}fa-user{/if}"></i>
    <a href="home.php?mod=space&uid=$_G[uid]" target="_blank" title="{lang visit_my_space}" id="mymenu" class="showmenu pull-right" onMouseOver="showMenu({'ctrlid':'mymenu','pos':'34!','ctrlclass':'a','duration':2});">{$_G[member][username]}</a>
    <!--repalce_emohuser_end--> 
    
  
</div>
<!--{elseif !empty($_G['cookie']['loginuser'])}-->
<a id="loginuser" class="noborder"><!--{echo dhtmlspecialchars($_G['cookie']['loginuser'])}--></a>
<a href="member.php?mod=logging&action=login" onclick="showWindow('login', this.href)" style="margin-right:10px;">{lang activation}</a>
<a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a>
<!--{elseif !$_G[connectguest]}-->
	<!--{template member/login_simple}-->
<!--{else}-->
<div id="ys_um" class="unreset-box-sizing">
		<a href="member.php?mod=logging&action=logout&formhash={FORMHASH}" class="pull-right">{lang logout}</a>
		<a href="home.php?mod=spacecp&ac=credit&showcredit=1" class="pull-right mr10">{lang credits}: 0</a>
        <a class="pull-right mr10">{lang usergroup}: $_G[group][grouptitle]</a>
        
		<strong class="vwmy qq mr10">{$_G[member][username]}</strong>
        <div class="pull-right">
        <!--{hook/global_usernav_extra1}-->
        </div>
        
	
</div>
<!--{/if}-->
