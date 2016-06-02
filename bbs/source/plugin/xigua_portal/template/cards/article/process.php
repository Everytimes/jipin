<?php
!defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:02
 */
function process_article($card)
{

    if(!in_array($card['var']['script'], array(
        'articlehot',
        'articlespecified',
        'articlenew',
    ))){
        $card['var']['script'] = 'articlehot';
    }
    $class_name = 'block_' . $card['var']['script'];
    require_once libfile($class_name, 'class/block/portal');
    $card['block_class'] = new $class_name();


    $param = $card['var']['param'];

    $cond = array('getpic' => 1);
    if($param['summarylength']> 0){
        $cond['getsummary'] = 1;
    }

    $data = $card['block_class']->getdata($cond, $param);
    unset($card['block_class']);
    $lists = sort_by_aids($data, $param);

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

    $pstyle = $card['var']['color'] ? 'color:'.$card['var']['color'].';' : '';
    $showreply = $param['orderby'];
    if($showreply != 'commentnum'){
        $class = 'icon-viewnum';
    }else{
        $class = 'icon-commentnum';
    }

    $list = '<ul class="td">';
    foreach ($lists as $value) {

        $img  = $value['picflag'] ? xigua_cards::get_picurl($value['pic'], (boolean)$card['var']['thumb']) : '';
        $divpic = $img ? '<div class="td-i" style="background-image:url('.$img.');"></div>' : '';
        $divstyle = $divpic ? '' : 'style="padding-left:0"';
        $link = portal_article_link($value['id']);
        if($summary = trim($value['summary'])){
            $summary =  '<p class="td-s">'.trim(strip_tags($value['summary'])).'</p>';
            $pstyle .= 'font-size:15px';
        }
        $lastpost = strip_tags(dgmdate($value['fields']['dateline'], 'u'));
        $num =( $showreply == 'dateline' ? $value['fields']['viewnum'] : $value['fields'][$showreply]);

        $list .= <<<LI
<li><a class="cl" href="$link">$divpic<div class="td-t" $divstyle><p style="$pstyle">$value[title]</p>$summary <div class="cl"><em class="td-t-num">$lastpost</em><span class="$class">$num</span></div></div></a></li>
LI;
    }
    $list .= '</ul>';

    if($card['var']['title_link']){
        $list .= '<a href="'.$title_link.'" class="news-more" style="margin:10px 10px 0">'.xigua_cards::l('showmore',0).'</a>';
    }
    $card['var']['html'] = $header.$list;

    return $card;
}

function portal_article_link($aid){
    global $_G;
    return rtrim($_G['siteurl'],'/').'/portal.php?mod=view&aid='.$aid;
}

function sort_by_aids($data, $param)
{
    $threads = array();
    if($param['aids']){
        $tmp = array();
        foreach ($data['data'] as $value) {
            $tmp[$value['id']] = $value;
        }
        $tids = array_filter(explode(',', $param['aids']));
        foreach ($tids as $tid) {
            if($tmp[$tid]){
                $threads[] = $tmp[$tid];
            }
        }
    }else{
        $threads = $data['data'];
    }

    return $threads;
}