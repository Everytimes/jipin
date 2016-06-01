<?php
!defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:02
 */
function process_news($card)
{
    $showpicall = ($card['var']['showpic'] == 'all');
    $card = xigua_cards::block($card);

    $param = $card['var']['param'];
//    $param['titlelength'] = '32';
    if($card['var']['showpic'] == 'all'){
        $param['picrequired'] = '1';
    }
    $data = $card['block_class']->getdata(array('getpic' => 1), $param);
    unset($card['block_class']);
    $threads = xigua_cards::sort_by_tids($data, $param);

    $thumb = (boolean)$card['var']['thumb'];
    if($card['var']['themecolor']){
        $color = 'style="color:'.$card['var']['themecolor'].'"';
        $bordercolor = 'style="border-top-color:'.$card['var']['themecolor'].'"';
    }

    $title_link = $card['var']['title_link'] ? $card['var']['title_link'] : 'javascript:void(0);';
    $header = '<div class="news-t" '.$bordercolor.'><h3>'.
              '<a '.$color.' href="'.$title_link.'">'.$card['var']['title'].'</a></h3>';
    if($card['var']['subtitle']){
        $header .= '<nav class="tmore">';
        foreach ($card['var']['subtitle'] as $i => $subtitle) {
            $header .= '<a '.$color.' href="'.$card['var']['subtitle_link'][$i].'">'.$subtitle.'</a>';
        }
        $header .= '</nav>';
    }
    $header .= '</div>';

    if($card['var']['showpic'] != 'invisible'){
        $imglist = array();
        foreach ($threads as $k => $thread) {
            if($showpicall){
                $imglist[] = $thread;
                unset($threads[$k]);
            }else{
                if($thread['picflag']!=0 && count($imglist)<2){
                    $imglist[] = $thread;
                    unset($threads[$k]);
                }
            }
        }
        if($imglist){
            $image_navs = array();
            foreach ($imglist as $img_thread) {
                $link = xigua_cards::thread_link($img_thread['id']);
                $pic  = xigua_cards::get_picurl($img_thread['pic'], $thumb);
                $image_navs[] = '<li><a href="'.$link.'"><img src="'.$pic.'"><span class="img-tit">'.$img_thread['title'].'</span></a></li>';
            }
            $image_nav = '<ul class="news-pic-list">'. implode('',$image_navs) .'</ul>';
            if($showpicall){
                $tmp = '';
                foreach ($image_navs as $key => $val) {
                    if($key % 2 == 0){
                        $tmp .= '<ul class="news-pic-list">';
                    }
                    $tmp .= $val;
                    if($key % 2 == 1){
                        $tmp .= '</ul>';
                    }
                }
                $image_nav = $tmp;
            }
        }
    }

    $showreply = in_array($card['var']['showreply'], array('replies', 'views')) ? $card['var']['showreply'] : 'views';
    if($showreply == 'views'){
        $class = 'news-num-view';
    }

    $list = '<div class="news-c">';

    if($card['var']['showsubtop']){
        $first = array_shift($threads);
        $first_link = xigua_cards::thread_link($first['id']);
        $list .= '<h4><a '.$color.' href="'.$first_link.'">'.$first['title'].'</a></h4>';
    }

    if($card['var']['showpic'] == 'top'){
        $list = $list . $image_nav;
    }
    $list .= '<div><ul class="news-list">';
    foreach ($threads as $thread) {
        $link = xigua_cards::thread_link($thread['id']);

        $list .= '<li><a href="'.$link.'">'.$thread['title'].'<span class="news-num '.$class.'">'.$thread['fields'][$showreply].'</span></a></li>';
    }
    $list .= '</ul></div>';
    if($card['var']['showpic'] == 'bottom'){
        $list = $list . $image_nav;
    }

    if($showpicall){
        $list .= $image_nav;
    }

    if($card['var']['title_link']){
        $list .= '<a href="'.$card['var']['title_link'].'" class="news-more">'.xigua_cards::l('showmore',0).'</a>';
    }

    $card['var']['html'] = $header.$list;

    return $card;
}