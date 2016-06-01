<?php
!defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:02
 */
function process_top($card)
{
    $card['var']['html'] = '';
    $card = xigua_cards::block($card);

    $param = $card['var']['param'];
    $data = $card['block_class']->getdata(array(), $param);
    unset($card['block_class']);
    $threads = xigua_cards::sort_by_tids($data, $param);

    if(!$threads){
        return $card;
    }

    $div = "";
    $first = array_shift($threads);

    if($card['var']['topcolor']){
        $topcolor = 'style="color:'.$card['var']['topcolor'].'"';
        $iconcolor = 'style="background-color:'.$card['var']['topcolor'].'"';
    }
    $icon = $card['var']['showicon'] ? '<em '.$iconcolor.'>'.xigua_cards::l('topicon', 0).'</em>' : '';
    $link = xigua_cards::thread_link($first['id']);
    $div .= '<h2 class="topline_p_h2"><a '.$topcolor.' href="'.$link.'">'.$icon.$first['title'].'</a></h2>';

    foreach ($threads as $k => $v) {
        $div .= '<p class="topline_p_mate">';
        $link = xigua_cards::thread_link($v['id']);
        if($card['var']['showkuo']){
            $v['title'] = '['.$v['title'].']';
        }
        $a = '<a href="'.$link.'">'.$v['title'].'</a>';
        $div .= $a;
        $div .= '</p>';
    }

    $card['var']['html'] = '<div class="topline_p">'.$div .'</div>';

    return $card;
}