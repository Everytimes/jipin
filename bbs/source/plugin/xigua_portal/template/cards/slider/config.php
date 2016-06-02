<?php !defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:43
 */
return array(
    'modulename' => xigua_cards::l('slider', 0),
    'introduce'  => xigua_cards::l('slider_in', 0),
    'icon'       => 'source/plugin/xigua_portal/template/cards/slider/images/0.png',
    'preview'    => '',
    'version'    => '1.0.0',
    'lock'       => 0,
    'open'       => 1,
    'js'         => <<<TEXT
function runslider(_this){var bullets = _this.find('nav.bullets');var position = _this.find('ul.position');
new Swipe2(_this[0], {startSlide: 0,speed: 500,auto: 3000,continuous:true,callback:function(index){if(bullets.length>0){bullets.find('em:first-child').text(index+1);} if(position.length>0){var selectors=position[0].children;
for(var t=0;t<selectors.length;t++){selectors[t].className=selectors[t].className.replace("current","");} selectors[(index)%(selectors.length)].className="current";}}});}$('div.swipe').each(function(){runslider($(this));});
TEXT
,
    'tpl'        => '{html}',
    'src'        => <<<SRC
<script src="source/plugin/xigua_portal/template/cards/slider/images/slider.js"></script>
SRC
,
    'css'        => <<<CSS
.swipe {overflow: hidden;visibility: hidden;position: relative}
.swipe-wrap {overflow: hidden;position: relative}
.swipe-wrap > div {float: left;width: 100%;position: relative}
.swipe-wrap .i{background-repeat: no-repeat;background-size: cover;background-position: center center;width:100%}
.bullets {position: absolute;right:10px;bottom: 0;height:26px;line-height:26px;color:#fff;font-size:12px}
.bullets em:first-child{color:#74BA35}
.position {text-align:right}
.position li {display: inline-block;width: 6px;height: 6px;border-radius: 3px;background: #FFF;margin: 0 1px}
.position li.current{background:#74BA35}
.swipe-title{position: absolute;left: 0;right: 0;bottom: 0;padding: 0 14px;font-size: 14px;font-weight: normal;background: rgba(0,0,0,0.6);height: 26px;line-height: 26px;}
.swipe-title a{color: #FFF;text-shadow: 1px 1px 0 #000}
CSS

);