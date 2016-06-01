<?php
!defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:02
 */
function process_nav($card)
{
    $perline_num = abs($card['var']['perline_num']);
    if (!$perline_num) {
        $perline_num = 1;
    }

    $names_chunk = array_chunk($card['var']['name'], $perline_num, TRUE);

    $width = (100 / $perline_num);
    $html = "<style>.main-nav-list a{width:$width%}</style>";
    foreach ($names_chunk as $names) {
        $html .= '<div class="main-nav-list">';
        foreach ($names as $k => $name) {
            $c = '';
            $c = $card['var']['color'][ $k ];
            $sc = $c ? " style=\"color:$c\"" : '';
            $html .= '<a href="' . $card['var']['link'][ $k ] . '"' . $sc . '>' . $name . '</a>';
        }
        $html .= '</div>';
    }

    if($card['var']['title']){
        $color = $card['var']['fcolor'] ? " style='color:". $card['var']['fcolor'] ."'" : '';
        $title = '<h3'.$color.'>'.$card['var']['title'].'</h3>';
    }

    if($card['var']['bg']){
        $bg = " style='background-color:". $card['var']['bg'] ."'";
    }
    $card['var']['html'] = '<nav class="main-nav"'.$bg.'>'. $title. $html .'</nav>';

    return $card;
}