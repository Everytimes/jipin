<?php !defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:43
 */
return array(
    'modulename' => xigua_cards::l('image', 0),
    'introduce'  => xigua_cards::l('image_in', 0),
    'icon'       => 'source/plugin/xigua_portal/template/cards/image/images/1.png',
    'preview'    => '',
    'version'    => '1.0.0',
    'lock'       => 0,
    'open'       => 1,
    'js'         => <<<JS
if($('div.image-wrapper').length>0){ $('div.image-wrapper').each(function(){new IScroll($(this)[0], { eventPassthrough: true, scrollX: true, scrollY: false, preventDefault: false });});}
JS
,
    'src'        => '<script src="source/plugin/xigua_portal/template/cards/image/images/iscroll.js"></script>',
    'tpl'        => '{html}',
    'css'        => <<<CSS
.image h3{padding-left:10px;font-size:20px}
.image-wrapper{position:relative;z-index:1;height:120px;width:100%;overflow:hidden;margin:10px 0 20px}
.image-wrapper:after{content:"";background:-webkit-gradient(linear,left top,right top,color-stop(100%,#fff),color-stop(0%,rgba(249,249,249,0)));width:30px;height:100%;position:absolute;right:0;top:0;z-index:999}
.image-scroller{width:792px;height:100%;position:absolute;z-index:1;-webkit-transform:translateZ(0);-moz-transform:translateZ(0);-ms-transform:translateZ(0);-o-transform:translateZ(0);transform:translateZ(0);-webkit-touch-callout:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-text-size-adjust:none;-moz-text-size-adjust:none;-ms-text-size-adjust:none;-o-text-size-adjust:none;text-size-adjust:none}
.image-list li:first-child{margin-left:10px}
.image-list li{display:inline-block;margin-right:10px;text-align:center;height:120px;width:150px;overflow:hidden}
.image-list a{display:block;position:relative;height:100%;background-repeat:no-repeat;background-position:center center;background-size:cover}
.image-list .image-tit{position:absolute;bottom:0;left:0;width:100%;background-color:rgba(0,0,0,0.5);color:#fff;height:26px;line-height:26px;overflow:hidden;font-size:14px;padding:0 5px;text-overflow:ellipsis;white-space:nowrap;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;-ms-box-sizing:border-box;box-sizing:border-box}
CSS
);