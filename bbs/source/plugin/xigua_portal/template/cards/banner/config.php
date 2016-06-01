<?php !defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:01
 */
return array(
    'modulename' => 'Banner',
    'introduce'  => xigua_cards::l('banner_in', 0),
    'icon'       => 'source/plugin/xigua_portal/template/cards/banner/images/nav.png',
    'preview'    => '',
    'version'    => '1.0.0',
    'lock'       => 0,
    'open'       => 1,
    'tpl'        => <<<TEXT
<a href="{link}" class="cl"><img src="{bg}" onerror="this.error=null;this.src=''" /></a>{close}
<script>$('#banner_{id}').find('a.close').on('click', function(){setcookie('close_{id}', 1,  '{cookiexpire}');$('#banner_{id}').remove();});</script>
TEXT
,
    'js'         => '',
    'css'        => <<<CSS
.banner a.cl, .banner img{width:100%;display:block}
.banner .close{cursor:pointer;position: absolute;padding:9px;width:22px;height:22px;right: 0;top: 50%;margin-top: -20px;background-position: center center;background-repeat: no-repeat;background-image: url(source/plugin/xigua_portal/template/cards/banner/images/close.png);background-size: 25px 25px;text-indent:9999px}
CSS
);