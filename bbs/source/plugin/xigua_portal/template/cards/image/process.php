<?php
!defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:02
 */
function process_image($card)
{
    $card = xigua_cards::block($card);

    $param = $card['var']['param'];
    $param['items'] = intval($card['var']['param']['items']);
    $param['picrequired'] = '1';

    $data = $card['block_class']->getdata(array(), $param);
    unset($card['block_class']);
    $threads = xigua_cards::sort_by_tids($data, $param);

    $div = '';

    foreach ($threads as $k => $v) {
        $link = xigua_cards::thread_link($v['id']);
        $src  = xigua_cards::get_picurl($v['pic'], $card['var']['thumb']);
        $div .= "<li><a href='$link' style='background-image:url($src)'><span class='image-tit'>$v[title]</span></a></li>";
    }

    $color = $card['var']['title_color'] ? 'style="color:'.$card['var']['title_color'].'"' : '';
    $title = $card['var']['title'];

    $id = $card['type'].'-'.$card['id'];
    $style = '<style>#'.$id.'{width:'.(160*count($threads)+10).'px}</style>';

    $div = $style.'<h3 '.$color.'>'.$title.'</h3><div class="image-wrapper"><div id="'.$id.'" class="image-scroller"><ul class="image-list">'.$div.'</ul></div></div>';
    $card['var']['html'] = $div;

    return $card;
}