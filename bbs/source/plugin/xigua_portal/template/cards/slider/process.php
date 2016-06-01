<?php
!defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:02
 */
function process_slider($card)
{
    $card = xigua_cards::block($card);
    $param = $card['var']['param'];
    $param['items'] = intval($card['var']['param']['items']);
    $param['picrequired'] = '1';
//    $param['titlelength'] = '40';
    $data = $card['block_class']->getdata(array(), $param);
    unset($card['block_class']);

    $threads = xigua_cards::sort_by_tids($data, $param);


    $h = intval($card['var']['height']) .'px';
    $div = "<div class=\"swipe-wrap\" style='height:$h'>";
    $nav = '<nav class="bullets"><ul class="position">';
    $i = 0;

    $thumb = (boolean)$card['var']['thumb'];
    foreach ($threads as $k => $v) {
        if($v){
            $link = xigua_cards::thread_link($v['id']);
            $src  = xigua_cards::get_picurl($v['pic'], $thumb);
            $div .= "<div><a href=\"$link\"><div class='i' style='height:$h;background-image:url($src)'></div></a><div class=\"swipe-title\"><a href=\"$link\">$v[title]</a></div></div>";

            if($k == 0){
                $nav .= '<li class="current"></li>';
            }else{
                $nav .= '<li></li>';
            }
            $i ++;
        }
    }
    $div .= '</div>';
    $nav .= '</nav>';

    $nav = $card['var']['pointer'] ? "<nav class=\"bullets\"><em>1</em>/<em>$i</em></nav>" : $nav;
    $card['var']['html'] = '<div class="swipe cl">'.$div.$nav .'</div>';

    return $card;
}