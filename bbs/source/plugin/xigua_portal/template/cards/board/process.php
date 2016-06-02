<?php
!defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:02
 */
function process_board($card)
{
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

    include_once libfile('function/forumlist');
    $fids = dintval($card['var']['fids'], TRUE);
    $forums = C::t('forum_forum')->fetch_all_by_fid($fids);
    $forum_fields = C::t('forum_forumfield')->fetch_all($fids);
    foreach($forums as $forum) {

        if($forum_fields[$forum['fid']]['fid']) {
            $forum = array_merge($forum, $forum_fields[$forum['fid']]);
        }
        $forum['extra'] = empty($forum['extra']) ? array() : dunserialize($forum['extra']);
        if(!is_array($forum['extra'])) {
            $forum['extra'] = array();
        }

        if($forum['icon']) {
            $forum['icon'] = get_forumimg($forum['icon']);
        }
        $forumlist[ $forum['fid'] ] = $forum;
    }

    $list = '<ul class="b-l cl">';
    foreach ($forumlist as $f) {

        $link = forum_link($f['fid']);

        $list .= ' <li><a href="'.$link.'"><img src="'.$f['icon'].'" onerror="this.error=null;this.src=\'source/plugin/xigua_portal/template/cards/board/images/bg.png\'"><span class="b-tit">'.$f['name'].'</span></a></li>';
    }
    $list .= '</ul>';

    $card['var']['html'] = $header . $list;

    return $card;
}
function forum_link($fid){
    global $_G;
    return "$_G[siteurl]forum.php?mod=forumdisplay&fid=$fid";
}