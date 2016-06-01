<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$__FORMHASH = FORMHASH;$return = <<<EOF

<style type = "text/css">
#digg_dz{width:400px;height:48px;line-height:48px;font-family: hiragino sans gb,microsoft yahei,simsun;margin:25px auto;}
#digg_dz .tp_wrap .tp_up,#digg_dz .tp_wrap .tp_down{float:left;width:48px;height:48px}
#digg_dz .tp_wrap .tp_down{float:right;}
#digg_dz .tp_wrap div a{display:block;background:url(source/plugin/digg/images/digg_dz_bg.png) -10000px no-repeat;width:48px;height:48px;_background:url(source/plugin/digg/images/digg_dz_bg.ie6.png)}
#digg_dz .tp_wrap .tp_up a{background-position:0px 0px}
#digg_dz .tp_wrap .tp_up a:hover{background-position:-74px 0px}
#digg_dz .tp_wrap .tp_up a.hason{background-position:-148px 0px;cursor:default}
#digg_dz .tp_wrap .tp_down a{background-position:0px -71px;}
#digg_dz .tp_wrap .tp_down a:hover{background-position:-74px -71px;}
#digg_dz .tp_wrap .tp_down a.hason{background-position:-148px -71px;cursor:default}
#digg_dz .tp_wrap .tp_up a.hason1{background-position:-229px 0px;cursor:default}
#digg_dz .tp_wrap .tp_down a.hason1{background-position:-229px -72px;}
#digg_dz .tp_wrap .tp_num{height:48px;line-height:48px;margin:0px 52px;overflow:hidden;position:relative}
#digg_dz .tp_num_down,#digg_dz .tp_num_up{height:24px;overflow:hidden;margin-top:28px}
#digg_dz .tp_num_down .tp_line{background:#17b2fa;border-radius:0px 2px 2px 0px;}
#digg_dz .tp_num_up .tp_line{background:#ffa447;border-radius:2px 0px 0px 2px;}
#digg_dz .tp_num_down{float:right;width:40%;}
#digg_dz .tp_num_up{float:left;width:60%;}
#digg_dz .tp_c{color:#17b2fa;right:0px}
#digg_dz .tp_d{color:#ffa447;left:0px}
#digg_dz .tp_num .tp_line{width:100%;height:4px;}
#digg_dz .tp_num span{display:block;height:20px;font-size:12px;line-height:20px;padding:0px 10px;top:5px;position:absolute}
#digg_dz .tp_num em{font-style:normal;padding:0px 5px}
</style>

<div id="digg_dz" class="digg_dz" style="">
<div class="tp_wrap">
<div class="tp_down" id="tp_down_btn">
<a class="threadvotebox" id="recommend_subtract_digg" href="forum.php?mod=misc&amp;action=recommend&amp;do=subtract&amp;tid={$_G['tid']}&amp;hash={$__FORMHASH}" 
EOF;
 if($_G['uid']) { 
$return .= <<<EOF
onclick="ajaxmenu(this, 3000, 1, 0, '43', 'recommendupdate(-{$_G['group']['allowrecommend']})');setTimeout(diggUpdate,3000);return false;"
EOF;
 } else { 
$return .= <<<EOF
 onclick="showWindow('login', this.href)"
EOF;
 } 
$return .= <<<EOF
 onmouseover="this.title = $('recommendv_subtract').innerHTML + ' {$langvar['activity_member_unit']}{$_G['setting']['recommendthread']['subtracttext']}'" title="{$langvar['makebottomonce']}" hidefocus="true"></a>
</div>
<div class="tp_up" id="tp_up_btn">
<a class="threadvotebox" id="recommend_add_digg" href="forum.php?mod=misc&amp;action=recommend&amp;do=add&amp;tid={$_G['tid']}&amp;hash={$__FORMHASH}" 
EOF;
 if($_G['uid']) { 
$return .= <<<EOF
onclick="ajaxmenu(this, 3000, 1, 0, '43', 'recommendupdate({$_G['group']['allowrecommend']})');setTimeout(diggUpdate,3000);return false;"
EOF;
 } else { 
$return .= <<<EOF
 onclick="showWindow('login', this.href)"
EOF;
 } 
$return .= <<<EOF
 onmouseover="this.title = $('recommendv_add').innerHTML + ' {$langvar['activity_member_unit']}{$_G['setting']['recommendthread']['addtext']}'" title="{$langvar['maketoponce']}" hidefocus="true"></a>
</div>
<div class="tp_num">
<span class="tp_c"><em id="recommendv_sub_digg">{$recommend_sub}</em></span>
<span class="tp_d"><em id="recommendv_add_digg">{$recommend_add}</em></span>
<div class="tp_num_down" id="tp_d" style="width:{$rate_sub}%;">
<div class="tp_line"></div>
</div>
<div class="tp_num_up" id="tp_u" style="width:{$rate_add}%;">
<div class="tp_line"></div>
</div>
</div>
</div>
</div>
<script type="text/javascript">

function diggUpdate(){
var add=$('recommendv_add').innerHTML;
var sub=$('recommendv_subtract').innerHTML;
$('recommendv_sub_digg').innerHTML=sub;
$('recommendv_add_digg').innerHTML=add;
var addNum=Number(add);
var subNum=Number(sub);	
var addRate=100*addNum/(addNum+subNum);
var subRate=100-addRate;
$('tp_u').style.width=addRate.toFixed(2)+"%";
$('tp_d').style.width=subRate.toFixed(2)+"%";

}
</script>

EOF;
?>