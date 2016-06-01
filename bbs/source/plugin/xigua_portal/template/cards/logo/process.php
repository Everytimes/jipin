<?php
!defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:02
 */
function process_logo($card)
{
    global $_G;
    if($card['var']['bg']){
        $card['var']['boardlogo'] = '<img src="'.$card['var']['bg'].'" style="border:0" />';
    }else{
        $card['var']['boardlogo'] = $_G['style']['boardlogo'];
    }
    $card['var']['bg'] = '';
    $card['var']['bgcolor'] = $card['var']['bgcolor'] ? 'background-color:' . $card['var']['bgcolor'] . ';' : '';
    $card['var']['center'] = $card['var']['center'] ? 'text-align:center;' : 'text-indent:10px;';

    $card['var']['menu'] = $card['var']['menu'] ? '<a href="javascript:void(0);" class="menu logo_open"><span></span></a>' : '';
    if ($card['var']['menu']) {
        $right = 'style="right:50px"';
    }

    $link = $_G['siteurl'] . 'plugin.php?id=xigua_portal%3Aindex&redirect=1';
    $card['var']['user'] = $card['var']['user'] ? '<a ' . $right . ' class="func" href="' . $link . '"></a>' : '';

    $links = '';
    foreach ($card['var']['rightmenu'] as $k => $v) {
        $links .= '<li><a href="'.$card['var']['rightmenu_link'][$k].'">'.$v.'</a></li>';
    }

    $card['var']['links'] = <<<HTML
<div id="logo-menu-nav" ><ul>$links</ul></div>
HTML;

    return $card;
}