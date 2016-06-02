<?php
!defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:02
 */
function process_word($card)
{
    $card['var']['html'] = '';
    $card = xigua_cards::block($card);

    $param = $card['var']['param'];
    $data = $card['block_class']->getdata(array(), $param);
    $threads = $data['data'];
    unset($card['block_class']);

    $color = $card['var']['title_color'] ? ' style="color:'.$card['var']['title_color'].'"' : '';

    $list = '';
    foreach ($threads as $v) {
        $link = xigua_cards::thread_link($v['id']);
        $list .= '<li><a href="'.$link.'">'.$v['title'].'</a></li>';
    }

    $div = '<h3'.$color.'>'.$card['var']['title'].'</h3><ul>'.$list.'</ul>';

    $card['var']['html'] = $div;

    return $card;
}