<?php !defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:43
 */
return array(
    'modulename' => 'Logo',
    'introduce'  => xigua_cards::l('logo_in', 0),
    'icon'       => 'source/plugin/xigua_portal/template/cards/logo/images/nav.png',
    'preview'    => '',
    'version'    => '1.0.0',
    'lock'       => 0,
    'open'       => 1,
    'tpl'        => <<<HTML
<div class="logo_wrapper cl" style="{bg}{bgcolor}">
    <div class="logo_img" style="{center}">{boardlogo}</div>
    {user} {menu} {links}
</div>
HTML
,
    'js'         => <<<JS
$('a.logo_open').on('touchstart', function(){
$('body').prepend('<div id="drawer"></div>');
$('#root').append('<div id="drawer_mask"></div>').addClass('drawer_anit');
$('#drawer').append($('#logo-menu-nav').html());
$('#drawer_mask').on("touchstart", function(){
$('#root').removeClass('drawer_anit');
setTimeout(function(){
$('#drawer_mask').remove();
$('#drawer').hide().remove();
}, 390); return false;});return false;});
JS
,
    'css'        => <<<CSS
.logo .logo_wrapper{position:relative;width:100%;height:50px;overflow: hidden;border-bottom:1px solid #ececec;background-size:100% auto}
.logo .logo_img, .logo .logo_img img{height:40px}
.logo .logo_img{padding-top:5px;margin: 0 auto;text-indent:10px}
.logo .func{display: block;position: absolute;right:10px;top: 12px;padding:5px;z-index:99;width:18px;height:18px;background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAsCAMAAAAgsQpJAAAAWlBMVEUAAAB3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3cyECA3AAAAHXRSTlMAQ/z37xHLC62GBb+OdSjnfrdbUTUtGiJp2aSbA4RYnp4AAAGESURBVDjLnVTZkoMgEAQRQRERj8Qc/v9vbgbMqjPIVm0/pGLbMD2XDGHujRPCmb5jOXR+/YW/ljZtsR5QtE1ap8yK4FXyvqgr9TLyRYvwYFJ3tjGcjE8y2qipboIXJd8JXsLBmQghsJiODIejntQPAtkz1wOHi1R/OIesK/cheySsonN62iAOnHMs5JDfmZJgR2LhDViVoTLHFVB3LLwD2/zPIzOprNuQNS2uQyZVSZvAOrDT0zIWxLiHXnPSa80w5vT0JPahTs2jZRRvvQKEtsNotwnX6d3SK4K+2K5RnHVieKdkU7USVBON24N5gqLGw+y3aN7yu5Qdr7/3G3map0g7e2BvdRnDHzhVxRoqNLfPqNxpIKArBIM4VXMMYZMfLx6Uw2bQwX0zEe2TUcq9ySO7gIW3r3AhJPdkV3iHb80NjsQ/l5i+Iw2laVkGMCuPbSW7nJBHxQIlZTk0kMTCXnhP07FfweKQF9oQFEo/5YXQOcEenx/F/jRZMf5wKDIFr6r5B5d3M3CqkODqAAAAAElFTkSuQmCC) no-repeat center center;background-size: 18px auto}
.logo .menu{display: block;position: absolute;right:10px;top:9px;width:28px;height:28px}
.logo .menu span{display: block;margin:0 auto;width:16px;height:0;box-shadow: 0 10px 0 1px #7C7C7C,0 18px 0 1px #7C7C7C,0 26px 0 1px #7C7C7C}
#drawer{width: 100%;height: 100%;background: #333;position: fixed;top: 0;right: 0;left:30%;color: #fff;display:block}
.drawer_anit{-webkit-transform: translate3d(-70%, 0, 0);-moz-transform: translate3d(-70%, 0, 0);-ms-transform:  translate3d(-70%, 0, 0);transform: translate3d(-70%, 0, 0);box-shadow:-4px 0 4px rgba(0,0,0,0.5),4px 0 4px rgba(0,0,0,0.5)}
#drawer_mask{opacity: 0;position: absolute;top: 0;left: 0;width: 100%;height: 100%;background: #000;padding-bottom: 60px;z-index:199}
#drawer li a {overflow:hidden;display: block;padding:13px 15px;font-size:15px;color:#fff;margin-left:15px;border-bottom: 1px solid #282828}
#logo-menu-nav{display:none}
CSS

);