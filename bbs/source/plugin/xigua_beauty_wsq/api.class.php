<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install.php 34718 2014-07-14 08:56:39Z nemohou $
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class xigua_beauty_wsq_api {


    public function  __construct()
    {
        require_once libfile('function/cache');
        global $_G;
        if(!$_G['cache']['plugin']){
            loadcache('plugin');
        }
        $this->vars = $_G['cache']['plugin']['xigua_beauty_wsq'];
        $this->pic_num     = min(max(intval($this->vars['pic_num']), 0), 9);
        $this->font_num    = max(intval($this->vars['font_num']), 0);
        $this->radius      = intval($this->vars['radius']);
        $this->repnum      = $this->vars['repnum'];
        $this->repfontnum  = $this->vars['repfontnum'];
        $this->show_gender = $this->vars['gender'];
        $this->subjectlen  = $this->vars['subjectlen'];

        /*template*/
        $this->template = intval($this->vars['template']);  // 0=system , 1=style1 ,2=tieba,3=image,4=buluo,5=qingxin,6=baobao1

        if($this->vars['specify']){
            $sps = explode("\n", trim($this->vars['specify']));
            if($sps){
                foreach ($sps as $sp) {
                    list($tplid, $fids) = explode('=', trim($sp));
                    if(in_array($_G['fid'], explode(',', $fids))){
                        $this->template = intval($tplid);
                    }
                }
            }
        }

        if(in_array($_G['fid'], unserialize($this->vars['disableforums']))){
            $this->pic_num = 0;
        }

        $this->max_height = $this->vars['max_height'];
        if(in_array($this->template, array(3,6,8))){
            $this->pic_num = 0;
            $this->font_num = 0;
        }

        if( $this->template == 4 || $this->template == 8){
            $this->repnum = 0;
        }

        /*imgstyles*/
        $this->imgstyles = $this->vars['imgstyles'];  //big,jingmei,duli,nine

        $this->showviews = $this->vars['showviews'];

        $this->expire = $this->vars['expire'];
        $this->viewall = $this->vars['viewall'];
        $this->show_threadtype = $this->vars['show_threadtype'];
        $this->tagpos = $this->vars['tagpos'];
        $this->tagcolor = $this->vars['tagcolor'];
        $this->tagrandom = $this->vars['tagrandom'];
        $this->smilie = $this->vars['smilie'];


        $this->buluo = ($this->template ==9 || $this->template ==10);
        if($this->buluo){
            $this->pic_num = 0;
            $this->repnum = 0;
            $this->viewall = '';
        }
        $this->videoids = array();
    }

    public function forumdisplay_variables(& $params)
    {
        $params['forum']['picstyle'] = 0;
    }

    function forumdisplay_threadBottom() {
        require_once libfile('function/discuzcode');
        $return = array();

        foreach ($GLOBALS['threadlist'] as $val) {
            $tids[] = $val['tid'];
        }
        sort($tids);

        $messages = $this->get_message_from_cache($GLOBALS['threadlist'], $tids);

        foreach($GLOBALS['threadlist'] as $thread) {
            $tid = $thread['tid'];

            $retval = '';
            if($this->font_num> 0 && $message = $messages[$tid]['message']){
                $viewall = '';
                if($this->viewall && strrpos($message, '...')!==false)
                {
                    $viewall = "<a href='javascript:;' class='wot' style='font-size:14px'>$this->viewall</a>";
                }
                if($this->buluo){
                    $retval = $message;
                }else{
                    $retval = '<div style="font-size:14px;width:100%;min-width:280px;color:#666;line-height:2.3rem">'.$message.$viewall.'</div>';
                }
            }
            if($this->pic_num> 0)
            {
            $piclist      = $messages[$tid]['piclist'];
            if($this->imgstyles != 'nine'){
                $piclist = array_slice($piclist, 0, 4);
            }
            if($c = count($piclist)){

                if($this->imgstyles == 'duli')
                {
                    $retval .= '<div style="position:relative;margin-top:10px;overflow:auto;border-radius:'.$this->radius.'px;height:100px;"><ul style="width:2000px">';
                    foreach ($piclist as $k => $pic) {
                        $retval .= "<li style='float:left;margin-right:3px;position:relative;height:100px;'><img class='xigua_lazy' src=\"$pic\" style='max-width:280px;min-height:10px;max-height:100px!important;margin:0;border-radius:{$this->radius}px'></li>";
                    }
                    $retval .= '</ul></div>';
                }
                else if($this->imgstyles == 'nine'){

                    $width  = 'width:32%';
                    $height = 'height:90px';
                    $mr     = 'margin-right:3px';

                    $piclists = array_chunk($piclist, 3);
                    foreach ($piclists as $itemlist) {

                        $i = 1;
                        $retval .= '<div style="margin-top:3px;overflow:hidden;">';
                        foreach ($itemlist as $k => $pic) {
                            if($i %3 == 0){
                                $mr = '';
                            }else{
                                $mr = 'margin-right:3px';
                            }
                            $dstyle = "style='$width;$height;$mr;float:left;border-radius:{$this->radius}px;overflow:hidden;background:url($pic) no-repeat center center;background-size:cover;'";

                            $retval .= "<div $dstyle></div>";
                            $i ++;
                        }

                        $retval .= '<div style="clear:both"></div></div>';
                    }
                }
                else
                {
                    if($this->imgstyles == 'jingmei'){
                        $mr = 'margin-right:3px';
                        if($c == 1){
                            $width  = 'width:33%';
                            $height = 'height:90px';
                            $mr     = 'margin-right:0%';
                        }else if ($c == 3){
                            $width  = 'width:33%';
                            $height = 'height:90px';
                            $mr     = 'margin-right:.5%';
                        }else if ($c == 2){
                            $width  = 'width:33%';
                            $height = 'height:90px';
                        }else if ($c == 4){
                            $width  = 'width:24%';
                            $height = 'height:67px';
                        }
                    }
                    else if($this->imgstyles == 'big')
                    {
                        $max_width = '';
                        if ($c == 1) {
                            $width  = 'width:100%';
                            $height = $this->max_height ? 'height:'.$this->max_height.'px;min-height:'.$this->max_height.'px' : 'height:150px;min-height:150px;';
                            $max_width = 'max-width:100%';
                        }else if ($c == 3){
                            $width  = 'width:32%';
                            $height = 'height:87px';
                        }else if ($c == 2){
                            $width  = 'width:49%';
                            $height = 'height:135px';
                        }else if ($c == 4){
                            $width  = 'width:24%';
                            $height = 'height:65px';
                        }
                        $mr = 'margin-right:3px';
                    }
                    $retval .= '<div style="margin-top:10px;overflow:hidden;">';

                    if($this->vars['onlyone'] && count($piclist) == 1){
                        foreach ($piclist as $k => $pic) {
                            $retval .= "<img src='$pic' style='border-radius:{$this->radius}px;max-width:100%;display:block;margin:0 auto'>";
                        }
                    }else{
                        foreach ($piclist as $k => $pic) {
                            if($k == $c-1){
                                $mr = '';
                            }

                            $dstyle = "style='$max_width;$width;$height;$mr;float:left;border-radius:{$this->radius}px;overflow:hidden;background:url($pic) no-repeat center center;background-size:cover;'";
                            $retval .= "<div $dstyle></div>";
                        }
                    }
                    $retval .= '<div style="clear:both"></div></div>';
                }
            }
            }

            $return[$thread['tid']] = $retval;
        }

        return $return;
    }

    function forumdisplay_threadStyleTemplate() {
        $return = array();
        $return['style1'] = $this->get_template();
        return $return;
    }

    function forumdisplay_threadStyle() {
        global $_G;
        $return = array();
        if($this->template == 0){
            return $return;
        }
        $this->has_stylesheet = 0;

        $sp = array(3,6,8,9, 10);
        foreach ($GLOBALS['threadlist'] as $val) {
            $tids[] = $val['tid'];
            $uids[] = $val['authorid'];
        }
        sort($tids);
        sort($uids);

        $need_at = in_array($this->template, $sp);
        if($need_at)
        {
            $bgrs = $this->get_attachment_img_from_cache($GLOBALS['threadlist'], $tids);
        }

        $authors = $this->getuserbyuid_from_cache($GLOBALS['threadlist'], $uids);

        if($_G['uid']> 0){
            $recommends = $this->get_recommends($_G['uid'], $tids);
        }

        if($this->repnum> 0){
            $replies_svalues = $this->get_replies_by_tids($tids);
        }

        foreach($GLOBALS['threadlist'] as $k => $thread) {
            if(in_array($thread['tid'], $_G['wechat']['setting']['showactivity']['tids'])) {
                continue;
            }
            if(!$thread['author'] && !$thread['authorid']){
                continue;
            }else if(!$thread['author'] && $thread['authorid']){
                $avata = avatar(0, 'small', TRUE);
            }else{
                $avata = avatar($thread['authorid'], 'small', TRUE);
            }
            if(!$thread['displayorder']) {
                $author = $authors[$thread['authorid']];
                $replies = $this->get_postlist_by_tid($replies_svalues[$thread['tid']], $this->repnum);
                $r = array(
                    'id' => 'style1',
                    'var' => array(
                        'uid' => $thread['authorid'],
                        'author_avatar' => $avata,
                        'recommend_duplicate' => $_G['uid'] ? (in_array($thread['tid'], $recommends) ? 'praise' : 'noPraise'): 'praise',
                        'subject' => $this->get_digest($thread['digest']) . ($this->subjectlen ? cutstr($thread['subject'], $this->subjectlen) : $thread['subject']),
                        'replies' => $replies,
                        'hasrep'  => $replies ? 1 : 0,
                        'adminid' => $author['adminid'],
                        'thread_type' => ($this->show_threadtype && $_G['forum']['threadtypes']['types'][$thread['typeid']]) ? '<a href="javascript:;" class="studioBtn db">'.$_G['forum']['threadtypes']['types'][$thread['typeid']].'</a>' : '',
                        'special' => $this->get_special($thread),
                        'gender' => $this->get_gender($thread['authorid'], $authors[$thread['authorid']]['gender']),
                        'stylesheet' => $this->get_stylesheet(),
                        'views_str' => $this->get_views($thread['views']),
                    )
                );
                if($need_at){
                    $max_height = $this->max_height;
                    $bgr = $bgrs[$thread['tid']];
                    if($bgr){
                        $width = $bgr['width'] ? $bgr['width'] .'px' : '100%';
                        if($this->template == 8){
                            $r['var']['background_pic'] = "<div style='width:100%;height:{$max_height}px;background:url($bgr[src]) no-repeat center center #ddd;background-size:cover'></div>";
                        }else if($this->buluo){
                            $r['var']['background_pic'] = "background:url($bgr[src]) no-repeat center center #ddd;background-size:cover";
                        }else{
                            $r['var']['background_pic'] = "<div style='max-height:{$max_height}px;overflow:hidden;background:#ddd'><img src='$bgr[src]' style='max-width:100%;width:$width;margin:0 auto;display:block' /></div>";
                        }
                    }else{
                        if($this->template == 6){
                            $r['var']['background_pic'] = "<div style='width:100%;height:64px;overflow:hidden;background:#ddd'></div>";
                        }else if( $this->template == 8){
                            $r['var']['background_pic'] = "<div class='noxg' style='height:{$max_height}px'></div>";
                        }else{
                            $r['var']['background_pic'] = '';
                        }
                    }
                }
                $return[$thread['tid']] = $r;
            }
        }
        return $return;
    }

    public function get_digest($digest = 0)
    {
        if(!in_array($digest, array(1,2,3))){
            return '';
        }
        global $_G;
        $thread_digest = lang('template', 'thread_digest');
        $digcolor = array( 1=>'#92B743', 2 => '#5BCAE1', 3 => '#F46751');
        $digtext  = array( 1=>$thread_digest.'I', 2 => $thread_digest.'II', 3 => $thread_digest.'III');

        $f = 'font-size:12px;';
        if($this->template == 6){
            $f = 'font-size:16px;';
        }

        return '<i style="background:'.$digcolor[$digest].';'.$f.'color:#fff;vertical-align:middle;font-style:normal;border-radius:5px 5px 0 5px;padding:1px 3px">'.$digtext[$digest].'</i> ';
    }

    public function get_gender($uid, $gender)
    {
        $icon = '';
        if($this->show_gender == 0)
        {
            return $icon;
        }
        if(isset($this->gender[$uid])){
            return $this->gender[$uid];
        }
        if($this->show_gender == 1)
        {
            $pos_1 = '';
            $pos_2 = 'background-position:0 -30px';
        }else if($this->show_gender == 3){
            $pos_1 = 'background-position:-34px 0';
            $pos_2 = 'background-position:-34px -30px';
        }else if($this->show_gender == 4){
            $pos_1 = 'background-position:-54px 0';
            $pos_2 = 'background-position:-54px -30px';
        }else{
            $pos_1 = 'background-position:-16px 0';
            $pos_2 = 'background-position:-16px -30px';
        }
        if($gender == 1){
            $icon = "<span class='gen' style='$pos_1'></span>";
        }else if($gender == 2){
            $icon = "<span class='gen' style='$pos_2'></span>";
        }
        $this->gender[$uid] = $icon;
        return $icon;
    }

    public function get_special($t)
    {
        global $_G;

        $html = '';
        switch($t['special']){
            case 1:
                $html = '<a href="javascript:;" class="showBtn br f11 c2 db">'.lang('plugin/xigua_beauty_wsq', 'toupiao').'</a>';
                break;
            case 3:
                $unit = $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][2]]['unit'].$_G['setting']['extcredits'][$_G['setting']['creditstransextra'][2]]['title'];
                $html = '<a href="javascript:;" class="showBtn br f11 c2 db">'.lang('plugin/xigua_beauty_wsq', 'xuanshang').' '.$t['price']." $unit</a>";
                break;
        }
        return $html;
    }

    public function get_postlist_by_tid($svalue, $limit = 3)
    {
        $rep = '';
        $ret = array();
        if($limit == 0){
            return $ret;
        }

        if($data = array_slice($svalue, 0, $limit)) {
            foreach ($data as $post) {
                $avatar = $post['avatar'];
                $message = $post['message'];
                $rep .= '<li><img onerror="javascript:this.src=\'../cdn/discuz/images/personImg.jpg\'" class="sImg db fl lazy" width="25" height="25" src="' . $avatar . '" style="display:block;"><a href="javascript:;" style="color:#666" class="sW fl"><span>' . $post['author'] . ' : </span>' . $message . '</a></li>';
            }
        }
        return $rep ? '<ul>' .$rep .'</ul>' : '';
    }

    function mobile_parsesmiles($message, $first = 1) {
        global $_G;
        static $enablesmiles;
        if($enablesmiles === null) {
            $url = !in_array(strtolower(substr(STATICURL, 0, 6)), array('http:/', 'https:', 'ftp://')) ? $_G['siteurl'] : '';
            $enablesmiles = false;
            if(!empty($_G['cache']['smilies']) && is_array($_G['cache']['smilies'])) {
                foreach($_G['cache']['smilies']['replacearray'] AS $key => $smiley) {
                    $enablesmiles[$key] = '<img width="18px" src="'.$url.STATICURL.'image/smiley/'.$_G['cache']['smileytypes'][$_G['cache']['smilies']['typearray'][$key]]['directory'].'/'.$smiley.'" />';
                }
            }
        }
        $enablesmiles && $message = preg_replace($_G['cache']['smilies']['searcharray'], $enablesmiles, $message, $_G['setting']['maxsmilies']);

        if($this->smilie == 0){
            return strip_tags($message);
        }
        if($first && $this->smilie != 1){
            return strip_tags($message);
        }
        return $message;
    }

    public static function is_picurl($pic){
        return in_array(strtolower(substr($pic, 0, 6)), array('http:/', 'https:', 'ftp://'));
    }

    public function get_picurl($pic, $remote = 0){
        global $_G;
        if(self::is_picurl($pic)){
            return $pic;
        }

        if($remote){
            $attach__ = $_G['setting']['ftp']['attachurl'] . 'forum/' . $pic;
        }else{
            $pic = $_G['setting']['attachurl'].'forum/'.$pic;
            if(self::is_picurl($pic)){
                return $pic;
            }
            $attach__ = $_G['siteurl'].$pic;
        }
        return $attach__;
    }

    public function get_views($views = 0)
    {
        global $_G;
        if($this->showviews)
        {
            $views = intval($views);
            return <<<HTML
<a><i class="eye"></i>$views</a>
HTML;
        }
        return '';
    }

    public function get_template()
    {
        $piclang = lang('plugin/xigua_beauty_wsq', 'pic');
        $viewall = lang('plugin/xigua_beauty_wsq', 'viewall');
        $reply = lang('plugin/xigua_beauty_wsq', 'reply');
        $r = '';

        switch($this->template)
        {
            case '3':
                $r = <<<HTML
{stylesheet}<div class="topicBox threadList" tid="<%= Variables.forum_threadlist[i].tid %>" page="<%= Variables.page %>" id="thread<%= Variables.forum_threadlist[i].tid %>"><i class="lvon" style="display:none"></i>
    {background_pic}
		<div class="topicCon">
		<p class="personImgDate">
			<span class="perImg db">
                <img src="{author_avatar}" onerror="javascript:this.src=\'../cdn/discuz/images/personImg.jpg\'" class="bImg lazy" width="35" height="35" uid="<%= Variables.forum_threadlist[i].authorid %>" style="display:block">
                <% if({adminid}) {%>
                <span class="statusBg1 brBig db c2 pa"><i class="iconStationmaster commF f11"></i></span>
                <% } %>
                <span class="timeT">
                    <%= Variables.forum_threadlist[i].author %>
                    {gender}
                    <% if(Variables.forum_threadlist[i].authorLv) { %><span class="lv lv<%=Variables.forum_threadlist[i].authorLv %>"><%=Variables.forum_threadlist[i].authorLv %></span><% } %>
                    <% if(Variables.forum_threadlist[i].hook_author_info) { %>
                    <em><%== stripCode(Variables.forum_threadlist[i].hook_author_info) %></em>
                    <% } %>
                    <i><%= Variables.forum_threadlist[i].lastpost %></i>
                </span>
		    </span>

		    <span class="perDate db" tid="<%= Variables.forum_threadlist[i].tid %>" fid="<%= Variables.forum.fid %>">
			    <a href="javascript:;" class="incoA db"></a>
		    </span>
		    <span class="perPop" tid="<%= Variables.forum_threadlist[i].tid %>" style="display:none"></span>
		 </p>
		<div class="detailCon">
		    <p>{special}{thread_type}{subject}
		    <% if(Variables.forum_threadlist[i].attachment> 0){%>
		    <a class="photoInco db" href="javascript:;">$piclang</a>
		    <% } %>
		    </p>
		    <% if(Variables.forum_threadlist[i].hook_thread_bottom) { %>
			<div class="tl"><%== Variables.forum_threadlist[i].hook_thread_bottom %></div>
		    <% } %>
		    <span class="replyShare db fr" style="clear:both">
			<a class="topicadminMsg" tid="<%= Variables.forum_threadlist[i].tid %>"></a>
					<a href="javascript:;" class="praiseBtn" tid="<%= Variables.forum_threadlist[i].tid %>">
						<i class="{recommend_duplicate}"></i>
						<span><%= Variables.forum_threadlist[i].recommend_add %></span>
					</a>
			<a href="javascript:;" class="incoRBtn" tid="<%= Variables.forum_threadlist[i].tid %>"><i class="incoR spr"></i><%= Variables.forum_threadlist[i].replies == 0 ? "0" : Variables.forum_threadlist[i].replies%></a>
			{views_str}
		    </span>
		</div>
	</div>
	<% if({hasrep}){ %>
	<div class="topicList">
	{replies}
	<% if (Variables.forum_threadlist[i].replies> 3){%>
	<p class="more"><a href="javascript:;" title="">$viewall<%= Variables.forum_threadlist[i].replies %>$reply</a></p>
	<% } %>
	</div>
	<% } %>
</div>
HTML;
                break;
            case '2':
                $r = <<<HTML
{stylesheet}<div class="topicBox threadList" tid="<%= Variables.forum_threadlist[i].tid %>" page="<%= Variables.page %>" id="thread<%= Variables.forum_threadlist[i].tid %>"><i class="lvon" style="display:none"></i>
    <div class="ti_title">{special}{thread_type}{subject}
    <% if(Variables.forum_threadlist[i].attachment> 0){%><a class="photoInco db" href="javascript:;">$piclang</a><% } %>
    </div>
    <span class="perDate db" tid="<%= Variables.forum_threadlist[i].tid %>" fid="<%= Variables.forum.fid %>"><a href="javascript:;" class="incoA db"></a></span>
    <span class="perPop" tid="<%= Variables.forum_threadlist[i].tid %>" style="display:none"></span>

    <div class="medias_wrap">
        <% if(Variables.forum_threadlist[i].hook_thread_bottom) { %>
            <%== Variables.forum_threadlist[i].hook_thread_bottom %>
        <% } %>
        <div style="clear:both"></div>
    </div>
    <div class="ti_infos">
        <div class="ti_author_time"><span class="ti_author"><%= Variables.forum_threadlist[i].author %> {gender}</span>
        <% if(Variables.forum_threadlist[i].authorLv) { %>
        <span class="gBg1 fb f8 c2" style="vertical-align:middle;background:<% if(Variables.forum_threadlist[i].authorLv<=2){ %>#92B743<% }else if(Variables.forum_threadlist[i].authorLv>2 && Variables.forum_threadlist[i].authorLv<=5){ %>#5BCAE1<% }else if(Variables.forum_threadlist[i].authorLv>5 && Variables.forum_threadlist[i].authorLv<=8){ %>#F46751<% }else{ %>#FBA41F<% } %>">LV<%= Variables.forum_threadlist[i].authorLv %></span>
        <% } %>
        <% if(Variables.forum_threadlist[i].hook_author_info) { %>
        <em><%== stripCode(Variables.forum_threadlist[i].hook_author_info) %></em>
        <% } %>
        <span class="ti_time"><%= Variables.forum_threadlist[i].lastpost %></span>
        </div>
        <div class="ti_zan_reply">
            <span class="replyShare db" style="clear:both">
                <a href="javascript:;" style="margin-left:5px;" class="praiseBtn" tid="<%= Variables.forum_threadlist[i].tid %>">
                    <i class="{recommend_duplicate}"></i>
                    <span><%= Variables.forum_threadlist[i].recommend_add %></span>
                </a>
                <a href="javascript:;" style="margin-left:5px;" class="incoRBtn" tid="<%= Variables.forum_threadlist[i].tid %>"><i class="incoR spr"></i><%= Variables.forum_threadlist[i].replies == 0 ? "0" : Variables.forum_threadlist[i].replies%></a>
                {views_str}
            </span>
        </div>
        <div style="clear:both"></div>
    </div>
    <% if({hasrep}){ %>
    <div class="topicList">
    {replies}
    <% if (Variables.forum_threadlist[i].replies> 3){%>
    <p class="more"><a href="javascript:;" title="">$viewall<%= Variables.forum_threadlist[i].replies %>$reply</a></p>
    <% } %>
    </div>
    <% } %>
</div>
HTML;
                break;
            case '1' :
                $r = <<<HTML
{stylesheet}<div class="topicBox threadList" tid="<%= Variables.forum_threadlist[i].tid %>" page="<%= Variables.page %>" id="thread<%= Variables.forum_threadlist[i].tid %>"><i class="lvon" style="display:none"></i>
	<div class="topicCon">
		<p class="personImgDate">
			<span class="perImg db">
                <img src="{author_avatar}" onerror="javascript:this.src=\'../cdn/discuz/images/personImg.jpg\'" class="bImg lazy" width="35" height="35" uid="<%= Variables.forum_threadlist[i].authorid %>" style="display:block">
                <% if({adminid}) {%>
                <span class="statusBg1 brBig db c2 pa"><i class="iconStationmaster commF f11"></i></span>
                <% } %>
                <span class="timeT">
                    <%= Variables.forum_threadlist[i].author %>
                    {gender}
<% if(Variables.forum_threadlist[i].authorLv) { %><span class="lv lv<%=Variables.forum_threadlist[i].authorLv %>"><%=Variables.forum_threadlist[i].authorLv %></span><% } %>
                    <% if(Variables.forum_threadlist[i].hook_author_info) { %>
                    <em><%== stripCode(Variables.forum_threadlist[i].hook_author_info) %></em>
                    <% } %>
                    <i><%= Variables.forum_threadlist[i].lastpost %></i>
                </span>
		    </span>

		    <span class="perDate db" tid="<%= Variables.forum_threadlist[i].tid %>" fid="<%= Variables.forum.fid %>">
			    <a href="javascript:;" class="incoA db"></a>
		    </span>
		    <span class="perPop" tid="<%= Variables.forum_threadlist[i].tid %>" style="display:none"></span>
		 </p>
		<div class="detailCon">
		    <p>{special}{thread_type}{subject}
		    <% if(Variables.forum_threadlist[i].attachment> 0){%>
		    <a class="photoInco db" href="javascript:;">$piclang</a>
		    <% } %>
		    </p>
		    <% if(Variables.forum_threadlist[i].hook_thread_bottom) { %>
			<div class="tl"><%== Variables.forum_threadlist[i].hook_thread_bottom %></div>
		    <% } %>
		    <span class="replyShare db fr" style="clear:both">
			<a class="topicadminMsg" tid="<%= Variables.forum_threadlist[i].tid %>"></a>
					<a href="javascript:;" class="praiseBtn" tid="<%= Variables.forum_threadlist[i].tid %>">
						<i class="{recommend_duplicate}"></i>
						<span><%= Variables.forum_threadlist[i].recommend_add %></span>
					</a>
			<a href="javascript:;" class="incoRBtn" tid="<%= Variables.forum_threadlist[i].tid %>"><i class="incoR spr"></i><%= Variables.forum_threadlist[i].replies == 0 ? "0" : Variables.forum_threadlist[i].replies%></a>
			{views_str}
		    </span>
		</div>
	</div>
	<% if({hasrep}){ %>
	<div class="topicList">
	{replies}
	<% if (Variables.forum_threadlist[i].replies> 3){%>
	<p class="more"><a href="javascript:;" title="">$viewall<%= Variables.forum_threadlist[i].replies %>$reply</a></p>
	<% } %>
	</div>
	<% } %>
</div>
HTML;
                break;
            case '4':  //buluo
                $r = <<<HTML
{stylesheet}<div class="topicBox threadList" tid="<%= Variables.forum_threadlist[i].tid %>" page="<%= Variables.page %>" id="thread<%= Variables.forum_threadlist[i].tid %>"><i class="lvon" style="display:none"></i>
	<div class="topicCon">
    <img src="{author_avatar}" onerror="javascript:this.src=\'../cdn/discuz/images/personImg.jpg\'" class="bImg lazy" width="35" height="35" uid="<%= Variables.forum_threadlist[i].authorid %>" style="display:block">
    <% if({adminid}) {%>
        <span class="statusBg1 brBig db c2 pa"><i class="iconStationmaster commF f11"></i></span>
    <% } %>
		<div class="detailCon rrdetail">
		  <p><span><%= Variables.forum_threadlist[i].author %></span>
        {gender}
        <% if(Variables.forum_threadlist[i].authorLv) { %><span class="lv lv<%=Variables.forum_threadlist[i].authorLv %>"><%=Variables.forum_threadlist[i].authorLv %></span><% } %>
        <% if(Variables.forum_threadlist[i].hook_author_info) { %>
        <em><%== stripCode(Variables.forum_threadlist[i].hook_author_info) %></em>
        <% } %></p>
		    <p>{special}{thread_type}{subject}
		    <% if(Variables.forum_threadlist[i].attachment> 0){%>
		    <a class="photoInco db" href="javascript:;">$piclang</a>
		    <% } %>
		    </p>
		    <% if(Variables.forum_threadlist[i].hook_thread_bottom) { %>
			<span class="tl xgpreview"><%== Variables.forum_threadlist[i].hook_thread_bottom %></span>
		    <% } %>

		    <span class="rrTime"><%= Variables.forum_threadlist[i].lastpost %></span>
		    <span class="replyShare db fl" style="clear:both;padding-top:0">
                <a href="javascript:;" class="praiseBtn" style="margin-left:0" tid="<%= Variables.forum_threadlist[i].tid %>">
                    <i class="{recommend_duplicate}"></i>
                    <span><%= Variables.forum_threadlist[i].recommend_add %></span>
                </a>
                <a href="javascript:;" class="incoRBtn" tid="<%= Variables.forum_threadlist[i].tid %>"><i class="incoR spr"></i><%= Variables.forum_threadlist[i].replies == 0 ? "0" : Variables.forum_threadlist[i].replies%></a>
			{views_str}
		    </span>
		    <div style="clear:both"></div>
		</div>
	</div>
</div>
HTML;
                break;
            case '5':
$r = <<<HTML
{stylesheet}<div class="topicBox threadList" tid="<%= Variables.forum_threadlist[i].tid %>" page="<%= Variables.page %>" id="thread<%= Variables.forum_threadlist[i].tid %>"><i class="lvon" style="display:none"></i>
    <div class="groom-con">
        <div class="ht-tit">
            <img src="{author_avatar}" onerror="javascript:this.src=\'../cdn/discuz/images/personImg.jpg\'" class="bImg lazy" uid="<%= Variables.forum_threadlist[i].authorid %>">
            <% if({adminid}) {%>
            <span class="statusBg1 brBig db c2 pa"><i class="iconStationmaster commF f11"></i></span>
            <% } %>
           <span style="top:42px" class="perDate db" tid="<%= Variables.forum_threadlist[i].tid %>" fid="<%= Variables.forum.fid %>">
			    <a href="javascript:;" class="incoA db"></a>
		    </span>
		    <span class="perPop" tid="<%= Variables.forum_threadlist[i].tid %>" style="display:none;top:70px"></span>
            <div class="htt-content">
                <p class="httc-name"><%= Variables.forum_threadlist[i].author %> {gender}
                <% if(Variables.forum_threadlist[i].authorLv) { %><span class="lv lv<%=Variables.forum_threadlist[i].authorLv %>"><%=Variables.forum_threadlist[i].authorLv %></span><% } %>
                <% if(Variables.forum_threadlist[i].hook_author_info) { %>
                <span><%== stripCode(Variables.forum_threadlist[i].hook_author_info) %></span>
                <% } %>
                </p>
                <p class="httc-info">
                    <span class="time"><%= Variables.forum_threadlist[i].lastpost %></span>
                </p>
            </div>
        </div>
        <div class="ht-content-ellipsis">
            <span class="indexContent">
            {special}{thread_type}{subject}
            <% if(Variables.forum_threadlist[i].attachment> 0){%><a class="photoInco db" href="javascript:;">$piclang</a><% } %>
            </span>
        </div>
        <div class="userscimg">
<% if(Variables.forum_threadlist[i].hook_thread_bottom) { %>
<span class="tl xgpreview"><%== Variables.forum_threadlist[i].hook_thread_bottom %></span>
<% } %>
        </div>
    </div>
    <p class="ht-foot">
        <a href="javascript:;" class="praiseBtn" style="margin-left:0" tid="<%= Variables.forum_threadlist[i].tid %>">
            <i class="{recommend_duplicate}"></i>
            <span><%= Variables.forum_threadlist[i].recommend_add %></span>
        </a>
    <a href="javascript:;" class="incoRBtn" tid="<%= Variables.forum_threadlist[i].tid %>"><i class="incoR spr"></i><%= Variables.forum_threadlist[i].replies == 0 ? "0" : Variables.forum_threadlist[i].replies%></a>
{views_str}
    </p>
    <% if({hasrep}){ %>
	<div class="topicList">
        {replies}
        <% if (Variables.forum_threadlist[i].replies> 3){%>
        <p class="more"><a href="javascript:;" title="">$viewall<%= Variables.forum_threadlist[i].replies %>$reply</a></p>
        <% } %>
	</div>
	<% } %>
</div>
HTML;

                break;
            case '6': //baobao1
                $r = <<<HTML
{stylesheet}<div class="topicBox threadList" tid="<%= Variables.forum_threadlist[i].tid %>" page="<%= Variables.page %>" id="thread<%= Variables.forum_threadlist[i].tid %>"><i class="lvon" style="display:none"></i>
		<div class="topicCon">
		<p class="personImgDate">
			<span class="perImg db">
                <img src="{author_avatar}" onerror="javascript:this.src=\'../cdn/discuz/images/personImg.jpg\'" class="bImg lazy" width="35" height="35" uid="<%= Variables.forum_threadlist[i].authorid %>" style="display:block">
                <% if({adminid}) {%>
                <span class="statusBg1 brBig db c2 pa"><i class="iconStationmaster commF f11"></i></span>
                <% } %>
                <span class="timeT">
                    <%= Variables.forum_threadlist[i].author %>
                    {gender}
                    <% if(Variables.forum_threadlist[i].authorLv) { %><span class="lv lv<%=Variables.forum_threadlist[i].authorLv %>"><%=Variables.forum_threadlist[i].authorLv %></span><% } %>
                    <% if(Variables.forum_threadlist[i].hook_author_info) { %>
                    <em><%== stripCode(Variables.forum_threadlist[i].hook_author_info) %></em>
                    <% } %>
                    <i><%= Variables.forum_threadlist[i].lastpost %></i>
                </span>
		    </span>

		    <span class="perDate db" tid="<%= Variables.forum_threadlist[i].tid %>" fid="<%= Variables.forum.fid %>">
			    <a href="javascript:;" class="incoA db"></a>
		    </span>
		    <span class="perPop" tid="<%= Variables.forum_threadlist[i].tid %>" style="display:none"></span>
		 </p>
		<div class="detailCon" style="position: relative;">
		    {background_pic}
		    <p class="ht-content ht-c">{special}{thread_type}{subject}</p>
		    <% if(Variables.forum_threadlist[i].hook_thread_bottom) { %>
			<div class="tl"><%== Variables.forum_threadlist[i].hook_thread_bottom %></div>
		    <% } %>
<p class="ht-foot">
<a href="javascript:;" class="praiseBtn" style="margin-left:0" tid="<%= Variables.forum_threadlist[i].tid %>">
    <i class="{recommend_duplicate}"></i>
    <span><%= Variables.forum_threadlist[i].recommend_add %></span>
</a>
<a href="javascript:;" class="incoRBtn" tid="<%= Variables.forum_threadlist[i].tid %>"><i class="incoR spr"></i><%= Variables.forum_threadlist[i].replies == 0 ? "0" : Variables.forum_threadlist[i].replies%></a>
{views_str}
</p>
		</div>
	</div>
	<% if({hasrep}){ %>
	<div class="topicList">
	{replies}
	<% if (Variables.forum_threadlist[i].replies> 3){%>
	<p class="more"><a href="javascript:;" title="">$viewall<%= Variables.forum_threadlist[i].replies %>$reply</a></p>
	<% } %>
	</div>
	<% } %>
</div>
HTML;
                break;
            case '7':
                $r = <<<HTML
{stylesheet}<div class="topicBox threadList" tid="<%= Variables.forum_threadlist[i].tid %>" page="<%= Variables.page %>" id="thread<%= Variables.forum_threadlist[i].tid %>"><i class="lvon" style="display:none"></i>
    <div class="groom-con">
        <div class="ht-tit">
            <img src="{author_avatar}" onerror="javascript:this.src=\'../cdn/discuz/images/personImg.jpg\'" class="bImg lazy" uid="<%= Variables.forum_threadlist[i].authorid %>">
            <% if({adminid}) {%>
            <span class="statusBg1 brBig db c2 pa"><i class="iconStationmaster commF f11"></i></span>
            <% } %>
           <span style="top:42px" class="perDate db" tid="<%= Variables.forum_threadlist[i].tid %>" fid="<%= Variables.forum.fid %>">
			    <a href="javascript:;" class="incoA db"></a>
		    </span>
		    <span class="perPop" tid="<%= Variables.forum_threadlist[i].tid %>" style="display:none;top:70px"></span>
            <div class="htt-content">
                <p class="httc-name"><%= Variables.forum_threadlist[i].author %> {gender}
                <% if(Variables.forum_threadlist[i].authorLv) { %><span class="lv lv<%=Variables.forum_threadlist[i].authorLv %>"><%=Variables.forum_threadlist[i].authorLv %></span><% } %>
                <% if(Variables.forum_threadlist[i].hook_author_info) { %>
                <span><%== stripCode(Variables.forum_threadlist[i].hook_author_info) %></span>
                <% } %>
                </p>
                <p class="httc-info">
                    <span class="time"><%= Variables.forum_threadlist[i].lastpost %></span>
                </p>
            </div>
        </div>
        <div class="ht-content-ellipsis">
            <span class="indexContent">
            {special}{thread_type}{subject}
            <% if(Variables.forum_threadlist[i].attachment> 0){%><a class="photoInco db" href="javascript:;">$piclang</a><% } %>
            </span>
        </div>
    </div>
    <div class="userscimg"><% if(Variables.forum_threadlist[i].hook_thread_bottom) { %>
<span class="tl xgpreview"><%== Variables.forum_threadlist[i].hook_thread_bottom %></span>
<% } %></div>
    <p class="ht-foot">
        <a href="javascript:;" class="praiseBtn" style="margin-left:0" tid="<%= Variables.forum_threadlist[i].tid %>">
            <i class="{recommend_duplicate}"></i>
            <span><%= Variables.forum_threadlist[i].recommend_add %></span>
        </a>
    <a href="javascript:;" class="incoRBtn" tid="<%= Variables.forum_threadlist[i].tid %>"><i class="incoR spr"></i><%= Variables.forum_threadlist[i].replies == 0 ? "0" : Variables.forum_threadlist[i].replies%></a>
{views_str}
    </p>
    <% if({hasrep}){ %>
	<div class="topicList">
        {replies}
        <% if (Variables.forum_threadlist[i].replies> 3){%>
        <p class="more"><a href="javascript:;" title="">$viewall<%= Variables.forum_threadlist[i].replies %>$reply</a></p>
        <% } %>
	</div>
	<% } %>
</div>
HTML;
                break;
            case '8':
                $r = <<<HTML
{stylesheet}<div class="topicBox threadList" tid="<%= Variables.forum_threadlist[i].tid %>" page="<%= Variables.page %>" id="thread<%= Variables.forum_threadlist[i].tid %>"><i class="lvon" style="display:none"></i>
		<div class="topicCon">
		<div class="detailCon">
		    {background_pic}
		    <p class="ht-content ht-c">{special}{thread_type}{subject}</p>
		    <% if(Variables.forum_threadlist[i].hook_thread_bottom) { %>
			<div class="tl"><%== Variables.forum_threadlist[i].hook_thread_bottom %></div>
		    <% } %>
<p class="ht-foot">
<a href="javascript:;" class="praiseBtn" style="margin-left:0" tid="<%= Variables.forum_threadlist[i].tid %>">
    <i class="{recommend_duplicate}"></i>
    <span><%= Variables.forum_threadlist[i].recommend_add %></span>
</a>
<a href="javascript:;" class="incoRBtn" tid="<%= Variables.forum_threadlist[i].tid %>"><i class="incoR spr"></i><%= Variables.forum_threadlist[i].replies == 0 ? "0" : Variables.forum_threadlist[i].replies%></a>
</p>
</div>
	</div>
</div>
HTML;
                break;
            case 9:
            case 10:
                $r = <<<HTML
{stylesheet}<div class="threadList topicBox" tid="<%= Variables.forum_threadlist[i].tid %>" page="<%= Variables.page %>" id="thread<%= Variables.forum_threadlist[i].tid %>"><i class="lvon" style="display:none"></i><div class="dtc"><% if(Variables.forum_threadlist[i].attachment> 0){%><div class="ig" style="{background_pic}"></div><% } %><div class="text-container"><h3 class="text">{special}{thread_type}{subject}</h3><div class="list-content "><%== Variables.forum_threadlist[i].hook_thread_bottom %></div></div><div class="info "><div><span class="nick"><span class="single-ellipsis"><%= Variables.forum_threadlist[i].author %></span><span class="vm"><% if(Variables.forum_threadlist[i].hook_author_info) { %> <%== stripCode(Variables.forum_threadlist[i].hook_author_info) %><% } %></span></span></div><div class="fl-right"><i class="read-icon"></i> <span class="rmt"><%= Variables.forum_threadlist[i].views %></span> <i class="reply-icon"></i> <span class="rnt"><%= Variables.forum_threadlist[i].replies %></span></div></div></div></div>
HTML;
                break;
        }
        return $r;
    }

    public function get_stylesheet()
    {
        if($this->has_stylesheet){
            return '';
        }
        $style = '';
        global $_G;
        if($this->vars['showlv']){
            $lvclass = 'font-size:12px;color:#FFF;border-radius:12px;position:absolute;left:37px;top:38px;width:15px;line-height:15px;text-align:center;background:#FBA41F';
        }else{
            $lvclass = 'display:none';
        }
        $commonstyle = <<<STYLESHEET
.threadList .lv{ {$lvclass} }
.threadList .lv1,.threadList .lv2,.threadList .lv3{background:#92B743}
.threadList .lv4,.threadList .lv5,.threadList .lv6{background:#5BCAE1}
.threadList .lv7,.threadList .lv8,.threadList .lv9{background:#F46751}
.threadList .eye{background:url($_G[siteurl]source/plugin/xigua_beauty_wsq/eye.png) no-repeat;background-size:auto 12px;padding:0 10px;height:19px;margin-right:5px;opacity:.8}
.threadList .gen{background:url($_G[siteurl]source/plugin/xigua_beauty_wsq/gender1.png) no-repeat;width:16px;height:15px;background-size:70px 45px;padding:0;margin:0;display:inline-block;vertical-align:middle;position:relative}
STYLESHEET;

        switch($this->template)
        {
            case 9:
            case 10:
                $color = $this->tagcolor ? $this->tagcolor : '#FF5B36';
                if($this->template ==10){
                    $ig = 'float:left;margin-right:12px;';
                }else{
                    $ig = 'float:right;margin-left:12px;';
                }
                $style = <<<STYLE
<style>.threadList .lvon{}
.threadList .topicCon{padding:0}.threadList .xg_thread{border-radius:0!important;background:0 0!important;box-shadow:none!important;border:0!important}#container{margin:0}.threadList .list-content img{height:16px}.threadList{position:relative;padding:14px 10px 0;background-color:#fff;border-bottom:1px solid #e6e6e6;border-radius:0!important;margin:0!important}.threadList .studioBtn{display:inline-block;margin-right:5px;padding:2px;height:15px;font-size:11px;line-height:15px;height:100%;line-height:100%;font-weight:400;position:relative;top:-2px;background-color:$color;color:#fff}.threadList li{position:relative;z-index:1;border-radius:2px;padding:14px 10px 0;background-color:#fff}.threadList .dtc{padding-top:1px;padding-bottom:15px}
.threadList .dtc .ig{position:relative;overflow:hidden;border-radius:1px;width:80px;height:80px;$ig}.threadList .dtc .text-container{height:62px}.threadList .text-container{overflow:hidden;max-height:62px}.threadList h3.text{display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;position:relative;margin-bottom:2px;font-size:17px;font-weight:600;line-height:20px;word-break:break-all;color:#454545;-webkit-line-clamp:2}.threadList .list-content{display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;margin-bottom:2px;padding-top:2px;font-size:14px;line-height:18px;word-break:break-all;color:gray;-webkit-line-clamp:2}.threadList .info{overflow:hidden;position:relative;margin-top:2px;font-size:12px;line-height:16px;color:#a6a6a6}.threadList .info .nick{display:inline-block;float:left;overflow:hidden;max-width:250px;white-space:nowrap;text-overflow:ellipsis}.threadList .info .nick .single-ellipsis{float:left}.threadList .info .nick .vm{position:absolute;vertical-align:middle;margin-left:5px;max-width:90px;overflow:hidden;text-overflow:ellipsis}.threadList .info .nick .vm img{width:11px!important;height:11px!important}.honour,.my{display:inline-block;margin-top:0;padding:1px 1px 0 2px;height:12px;font-size:11px;line-height:12px;text-align:center;vertical-align:top;color:#f8bf43;background:0 0;-webkit-transform:scale(.95)}.threadList .info .fl-right{float:right;margin-top:-1px}.threadList .info .fl-right .rmt,.threadList .info .fl-right .rnt{display:inline-block;overflow:hidden;margin-top:2px;margin-right:5px;max-width:80px;height:15px;font-size:10px;line-height:15px;vertical-align:middle;white-space:nowrap;text-overflow:ellipsis}.threadList .info .fl-right .like-icon,.threadList .info .fl-right .read-icon,.threadList .info .fl-right .reply-icon{display:inline-block;position:relative;margin-top:1px;width:11px;height:11px;vertical-align:middle;background-size:100%}.threadList .info .fl-right .read-icon{position:relative;top:1px;width:12px;height:10px;background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAUCAMAAACgaw2xAAAAZlBMVEUAAACsrKysrKysrKysrKysrKysrKysrKysrKzk5OSsrKysrKysrKysrKysrKysrKysrKzk5OTk5OTk5OTk5OTk5OTk5OSsrKysrKzk5OTk5OSsrKzk5OTk5OTk5OTk5OTk5OTk5OS6ts8FAAAAIXRSTlMAHPeVm+V3caH1aSwkBvy4RxFfCNC7k4qJVUknw8KCdm4dsru3AAAAr0lEQVQY052R2RKDIAxFAVndFbVVu/H/P1makJYZZ/pgXhLumUluAkvBdaeEUJ3mpKBs22vPm4b3l9ZmqBT699CipNIWFWTvIVWFRF0WmMcQphEqJCbpbAgxFiSGsVrUOQjrp9yjKA2NegK4Q20kU+CuGYaXA+DQv0rAg5gDajURmLGVjcN38Epgg1VE/bW7oP5Au2W24Hpzbt5Qt7R6xTDoJP+OeDy75KgdP+psvAEqJQxqJ4gFpgAAAABJRU5ErkJggg==)}.threadList .info .fl-right .reply-icon{top:1px;width:12px;height:10px;background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAUCAMAAACgaw2xAAAAPFBMVEUAAACsrKzk5OSsrKysrKysrKysrKzk5OSsrKysrKysrKysrKzk5OSsrKysrKysrKysrKysrKysrKzk5OST+fY/AAAAEnRSTlMAS+cLsfO+SXqEHBLk49rYi4AFsFYbAAAAd0lEQVQY031QWw6AIAxjbDzEN97/rgYwlojQj42s0LKqEciaCBhLz3wSYgUwyVTuy/xRmCW/sfSjnarhhmCTalQt4luc1g6tIvR1abQRAanFoYFozLvf7S7YjaQbImJffT76tcQOhC0xfguNYdgPOnbMAT7FV143oI4El6U4Bo0AAAAASUVORK5CYII=)}.threadList .info .fl-right .rmt,.threadList .info .fl-right .rnt{display:inline-block;overflow:hidden;margin-top:2px;margin-right:5px;max-width:80px;height:15px;font-size:10px;line-height:15px;vertical-align:middle;white-space:nowrap;text-overflow:ellipsis}</style >
STYLE;
                break;
            case 3:
            case 1:
                $tmp = str_replace('left:37px;top:38px;','top: 32px;left:31px;', $commonstyle);
                $style = "<style>$tmp</style>";
                break;
            case '2':
                $style = <<<STYLESHEET
<style>
.threadList .lvon{}
.threadList{position:relative;border-radius:{$this->radius}px;box-shadow:0 1px 3px rgba(0,0,0,0.2);background:#FFF}
.threadList .ti_title {word-break:break-all;color:#262626;font-size:16px;line-height:23px;margin-bottom:5px;padding:10px 25px 0 10px}
.threadList .ti_title .studioBtn {margin-right:5px;border:1px solid #769cdc;color:#769cdc}
.threadList .medias_wrap {margin-bottom: 10px;padding:10px 10px 0}
.threadList>.perPop{top:35px}
.threadList .ti_author_time {line-height:40px;height:40px;padding-left:10px;float:left}
.threadList .ti_author {color:#626466;font-size:14px}
.threadList .ti_time {margin-left:6px;color:#abaeb2;font-size:12px}
.threadList .ti_zan_reply{line-height:40px;height:40px;float:right;padding-right:10px}
.threadList .ti_infos:after{content: '';display: block;height: 1px;box-shadow: 0 1px 1px rgba(0,0,0,.1);margin-top: -1px;z-index: 1;position: relative;}
.threadList>.xg_thread{box-shadow:none!important}
.threadList .topicList{background:#f5f7fa;border-top:none}
.threadList .topicList .more{border-top:1px solid #eaebec!important}
$commonstyle
</style>
STYLESHEET;

                break;
            case 4:
                $tmp = str_replace('left:37px;top:38px;width:15px;line-height:15px;','top: 32px;left:31px;width:15px;line-height:15px!important;', $commonstyle);
                $style = <<<STYLESHEET
<style>.threadList .lvon{}
.threadList>.xg_thread{box-shadow:none!important}
.threadList{position:relative;border-radius:{$this->radius}px;box-shadow:0 1px 3px rgba(0,0,0,0.2);background:#FFF}
.threadList .rrdetail{margin-top:0;margin-left: 44px;font-size: 14px;}
.threadList .rrdetail span, .threadList .rrdetail em{vertical-align:middle;line-height: 20px;}
.threadList .rrTime{float:left;padding-top: 5px;height:27px;line-height:27px!important;text-align: right;}
.threadList .rrdetail span.xglv{line-height:15px;}
.threadList .rrdetail .xgpreview{background:#f7f7f7;padding:10px;border-left:3px solid #ddd;font-size:.9em;margin:5px 0;display:block;clear:both;}
$tmp
</style>
STYLESHEET;
                break;
            case 5:
                $r = $this->radius.'px';
                if($this->tagpos == 1){
                    $pos = "border-top-left-radius:$r;border-bottom-left-radius:$r;top:16px;right:0;";
                }elseif($this->tagpos == 2){
                    $pos = "border-bottom-right-radius:$r;border-bottom-left-radius:$r;top:0;right:16px;";
                }elseif($this->tagpos == 3){
                    $pos = "border-bottom-right-radius:$r;border-bottom-left-radius:$r;top:0;left:64px;padding:0 7px;font-size:12px;";
                }elseif($this->tagpos == 4){
                    $pos = "border-bottom-left-radius:$r;top:0;right:0;";
                }

                $random = array(
                    '#5BABEB',
                    '#F288A2',
                    '#E3B342',
                    '#8CBDDC',
                    '#FF5B36',
                    '#92B743',
                    '#5BCAE1',
                    '#F1914F',
                    '#B4B953',
                    '#9E8CCB',
                );
                $this->tagcolor = $this->tagrandom ? $random[array_rand($random, 1)] : $this->tagcolor;
                $c = $this->tagcolor ? 'background-color:'.$this->tagcolor : 'background-color:#FF5B36;';

                $style = "
<style type=\"text/css\">.threadList .lvon{}
.threadList>.xg_thread{box-shadow:none!important}
.threadList {box-sizing:border-box;margin-bottom:8px;background-color:#fff;width:100%;border-radius:$r}
.threadList .groom-con{position:relative;padding:16px;padding-bottom:0;display:block}
.threadList .ht-tit{display:-webkit-box;display:-moz-box;display:box;padding-bottom:10px}
.threadList .ht-tit .bImg{display:block;width:35px;height:35px;left:16px;top:16px}
.threadList .ht-tit .statusBg1{top:38px;left:37px}
.threadList .ht-tit .htt-content{padding-left:48px;padding-top:5px}
.threadList .ht-tit .htt-content .httc-name{color:#333;display:block;font-size:14px;width:100%}
.threadList .ht-tit .htt-content .httc-info{padding-top:5px}
.threadList .ht-tit .htt-content .httc-info .time{font-size:12px;color:#7f7f7f}
.threadList .ht-content-ellipsis{overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:7;-webkit-box-orient:vertical}
.threadList .studioBtn{border-radius:0;position:absolute;display:inline-block;padding:4px 7px;font-size:14px;color:#fff;$pos;$c}
.threadList .indexContent{display:block;word-break:break-all;font-size:16px;line-height:2.3rem;color:#333}
.threadList .userscimg{padding:8px 0 0 0}
.threadList .ht-foot{display:-webkit-box;display:-moz-box;display:box;margin-top:12px;background-color:#f8f8f8;padding:7px 0;border-radius:inherit}
.threadList .ht-foot a{width:33.4%;display:block;box-sizing:border-box;height:30px;text-align:center;position:relative;border-right:1px solid #ebebeb;color:#a7abb0;line-height:30px;font-size:14px;min-width:22px}
.threadList .ht-foot a:last-child{border-right:0}
.threadList .ht-foot a:last-child i{background-position:center center!important}
$commonstyle
</style>
";
                break;
            case 6:
                $tmp = str_replace('left:37px;top:38px;width:15px;line-height:15px;','top: 32px;left:31px;width:15px;line-height:15px!important;', $commonstyle);
                $random = array(
                    '#5BABEB',
                    '#F288A2',
                    '#E3B342',
                    '#8CBDDC',
                    '#FF5B36',
                    '#92B743',
                    '#5BCAE1',
                    '#F1914F',
                    '#B4B953',
                    '#9E8CCB',
                );
                $this->tagcolor = $this->tagrandom ? $random[array_rand($random, 1)] : $this->tagcolor;
                $c = $this->tagcolor ? 'background-color:'.$this->tagcolor : 'background-color:#FF5B36;';

                $style = "
<style type=\"text/css\">.threadList .lvon{}
.threadList .topicCon{padding:10px 0 0}
.threadList .perPop{z-index:99}
.threadList .timeT{padding-left:58px}
.threadList .ht-content{position:absolute;left:0;top:0;margin:10px}
.threadList .ht-content a{text-shadow:none!important;border:0;color:#fff;display:inline;font-size:16px;line-height:inherit;height:auto;$c}
.threadList .ht-c,.threadList .list_fc_link p{color:#fff;text-shadow:1px 1px 1px #000;font-size:16px;line-height:22px}
.threadList .ht-foot{display:-webkit-box;display:-moz-box;display:box;margin-top:0;background-color:#f8f8f8;border-bottom-left-radius:5px;border-bottom-right-radius:5px;padding:7px 0}
.threadList .ht-foot a{width:33.4%;display:block;box-sizing:border-box;height:30px;text-align:center;position:relative;border-right:1px solid #ebebeb;color:#a7abb0;line-height:30px;font-size:14px;min-width:22px}
.threadList .ht-foot a:last-child{border-right:0}
.threadList .ht-foot a:last-child i{background-position:center center!important}
.threadList .list_fc_link{position:relative}
.threadList .list_fc_link p{position:absolute;margin:10px}
.threadList .list_fc_link img {margin:0 0 15px}
.threadList .list_ff_link{padding:0 10px 10px}
$tmp
</style>";
                break;
            case 7:
                $r = $this->radius.'px';
                if($this->tagpos == 1){
                    $pos = "border-top-left-radius:$r;border-bottom-left-radius:$r;top:16px;right:0;";
                }elseif($this->tagpos == 2){
                    $pos = "border-bottom-right-radius:$r;border-bottom-left-radius:$r;top:0;right:16px;";
                }elseif($this->tagpos == 3){
                    $pos = "border-bottom-right-radius:$r;border-bottom-left-radius:$r;top:0;left:64px;padding:0 7px;font-size:12px;";
                }

                $random = array(
                    '#5BABEB',
                    '#F288A2',
                    '#E3B342',
                    '#8CBDDC',
                    '#FF5B36',
                    '#92B743',
                    '#5BCAE1',
                    '#F1914F',
                    '#B4B953',
                    '#9E8CCB',
                );
                $this->tagcolor = $this->tagrandom ? $random[array_rand($random, 1)] : $this->tagcolor;
                $c = $this->tagcolor ? 'background-color:'.$this->tagcolor : 'background-color:#FF5B36;';

                $style = "
<style type=\"text/css\">.threadList .lvon{}
.threadList>.xg_thread{box-shadow:none!important}
.threadList {box-sizing:border-box;margin-bottom:8px;background-color:#fff;width:100%;border-radius:$r}
.threadList .groom-con{position:relative;padding:16px;padding-bottom:0;display:block}
.threadList .ht-tit{display:-webkit-box;display:-moz-box;display:box;padding-bottom:10px}
.threadList .ht-tit .bImg{display:block;width:35px;height:35px;left:16px;top:16px;border-radius:0}
.threadList .ht-tit .statusBg1{top:38px;left:37px}
.threadList .ht-tit .htt-content{padding-left:48px;padding-top:5px}
.threadList .ht-tit .htt-content .httc-name{color:#333;display:block;font-size:14px;width:100%}
.threadList .ht-tit .htt-content .httc-info{padding-top:5px}
.threadList .ht-tit .htt-content .httc-info .time{font-size:12px;color:#7f7f7f}
.threadList .ht-content-ellipsis{overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:7;-webkit-box-orient:vertical}
.threadList .studioBtn{border-radius:0;position:absolute;display:inline-block;padding:4px 7px;font-size:14px;color:#fff;$pos;$c}
.threadList .indexContent{display:block;word-break:break-all;font-size:16px;line-height:2.3rem;color:#333}
.threadList .userscimg{padding:8px 16px;background:#f7f7f7}
.threadList .ht-foot{display:-webkit-box;display:-moz-box;display:box;background-color:#fff;padding:7px 0;border-radius:inherit}
.threadList .ht-foot a{width:33.4%;display:block;box-sizing:border-box;height:30px;text-align:center;position:relative;border-right:1px solid #ebebeb;color:#a7abb0;line-height:30px;font-size:14px;min-width:22px}
.threadList .ht-foot a:last-child{border-right:0}
.threadList .ht-foot a:last-child i{background-position:center center!important}
$commonstyle
</style>
";
                break;
            case 8:
                $r = $this->radius.'px';
                if($this->tagpos == 1){
                    $pos = "border-top-left-radius:$r;border-bottom-left-radius:$r;top:5px;right:0;";
                }elseif($this->tagpos == 2){
                    $pos = "border-bottom-right-radius:$r;border-bottom-left-radius:$r;top:0;right:5px;";
                }elseif($this->tagpos == 3){
                    $pos = "border-bottom-right-radius:$r;border-bottom-left-radius:$r;top:0;left:5px;";
                }

                $random = array(
                    '#5BABEB',
                    '#F288A2',
                    '#E3B342',
                    '#8CBDDC',
                    '#FF5B36',
                    '#92B743',
                    '#5BCAE1',
                    '#F1914F',
                    '#B4B953',
                    '#9E8CCB',
                );
                $this->tagcolor = $this->tagrandom ? $random[array_rand($random, 1)] : $this->tagcolor;
                $c = $this->tagcolor ? 'background-color:'.$this->tagcolor : 'background-color:#FF5B36;';
                $adh = ($this->max_height + 48).'px';
                $style = "
<style>.threadList .lvon{}
.threadList{width:49%;background:#fff;float:left;border-radius:{$this->radius}px;margin-right:2%}
.threadList:nth-of-type(2n){margin-right:0}
.threadList .topicCon{padding:0}
.threadList .detailCon{margin:0}
.threadList .timeT{padding-left:58px}
.threadList .ht-content{margin:5px}
.threadList .ht-c,.threadList .list_fc_link p{color:#777;font-size:12px;line-height:18px!important;height:18px;overflow:hidden}
.threadList .ht-foot{display:-webkit-box;display:-moz-box;display:box;margin-top:0;background-color:#f8f8f8}
.threadList .ht-foot a{width:50%;display:block;box-sizing:border-box;height:30px;text-align:center;position:relative;border-right:1px solid #ebebeb;color:#a7abb0;line-height:30px;font-size:14px;min-width:22px}
.threadList .ht-foot a:last-child{border:0!important}
.threadList .list_fc_link{position:relative}
.threadList .list_ff_link{padding:0 10px 10px}.threadList .list_fc_link p {height:auto;padding:5px}
.threadList .studioBtn{margin:0;border-radius:0;position:absolute;padding:3px 6px;font-size:12px;color:#fff;$pos;$c;border:0}
.threadList .noxg{width:100%;background:#ddd url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAuCAYAAABXuSs3AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNXG14zYAAAAWdEVYdENyZWF0aW9uIFRpbWUAMDUvMDUvMTUSSv07AAACKElEQVRoge2Y0a6rIBBF9wgoQnv6/z/Xr7AVBeG+XMzp1VZ6LdomXUlfTCpLMuwZpfP5HA6HAzjn+AScc2iaBoVS6mOkAYAxBqUUiqIo9nZ5CiJCURQoQgh7uzxNCAGzNeK9h3MOl8tla6cRzjnKsoQQAnNVMRH33qNtW/R9v4ngPZxzcM5BSomqqibyk0fx3u8u/RtjDObKeSL+jofVez+5lpyDWmsIIW6uWWtxvV5ndyQ3Sdv78/MDIQSI6OYnhMDxeAQR5facsCj+N+xn5WKmKqWyyD1iUZxz/nBHiWiXzrsonlIGb1kq79pZF8W994vyzrmXCaWyKN40zWyORoZhQNd1L5VKISkO+76Hc+7mAeI803UdrLXZBO+RFAfGGBhjUNc1Qgjw3oMxhrZtVy0eh6jY2OIhj6X56NA/lWNrRaNMHJzuiaWk1KYBLIQYG9paNhOXUo6l9go2EVdKoaoqAK9rVtln2FjPryarOOccUsos956IExHKslx9Y845DodDtjlmVryu61ULMsagtV4ltsRsqRDRf+/W753OOTXeFWeM4XQ6JZcNEUFrPb4R5R5178ZhXFhrDaUUnHPo+x7W2jGLOedgjKEsSzDGxv9sMZ8n5Xh8y/n3ZRlImytykNyA1swVOXi/jyiJfMW35iu+NV/xrfmKb81XfGs+V3yvIWkNRITCGINhGPZ2SSKEgGEYYIwBt9bCWgsp5W4jaiohBBhjAAB/AG+Qsfgc2gHuAAAAAElFTkSuQmCC) no-repeat center center}
.threadList .xg_thread{border-radius:{$this->radius}px!important;background:none!important;box-shadow:none!important;border:0!important;height:$adh}
</style>";
                break;
        }
        $this->has_stylesheet = TRUE;
        return $style;
    }

    public function get_attachment_img($tid)
    {
        if(!$tid){
            return array();
        }
        global $_G;
        $this->pic_num = 1;
        $query = DB::query("SELECT a.aid,a.tableid from " . DB::table('forum_attachment') . " as a  where a.tid='$tid' LIMIT $this->pic_num");
        while($arow = DB::fetch($query))
        {
            if($arow['tableid'] == 127){
                continue;
            }
            $table = DB::table('forum_attachment_'.intval($arow['tableid']));
            $aid   = $arow['aid'];
            $row = DB::fetch(DB::query("SELECT width,attachment,remote FROM $table WHERE aid='$aid' AND isimage IN (-1,1) AND width>150 ORDER BY width DESC LIMIT 1"));
            if($row['attachment']){
                $width = $row['width'];
                $pic = $this->get_picurl($row['attachment'], $row['remote']);
            }
        }
        return $pic ? array(
            'src' => $pic,
            'width' => intval($width)
        ) : array();
    }

    public function get_recommends($uid, $tids)
    {
        if($uid==0){
            return array();
        }
        $rows = DB::fetch_all('SELECT tid FROM %t WHERE recommenduid=%d AND tid in(%n)', array('forum_memberrecommend', $uid, $tids));
        $ret = array();
        foreach ($rows as $k => $row) {
            $ret[] = $row['tid'];
        }
        return $ret;
    }


    public function get_replies_by_tids($tids)
    {
        $rows = DB::fetch_all('SELECT * FROM %t WHERE skey in(%n)', array('mobile_wsq_threadlist', $tids));
        $ret = array();
        $pids = array();
        foreach ($rows as $k => $row) {
            $postlist = unserialize($row['svalue']);
            foreach ($postlist as $pk => $post) {
                $message = trim(cutstr($post['message'], $this->repfontnum));
                if (empty($message) || ($message == '...' && $post['message']!='...')) {
                    unset($postlist[$pk]);
                    continue;
                }
                $postlist[$pk]['message']   = $message;
                $postlist[$pk]['avatar'] = avatar($post['authorid'], 'small', TRUE);
                $pids[$row['skey']][] = $post['pid'];
            }
            $ret[$row['skey']] = $postlist;
        }
        if($this->vars['check']){
            $ret = $this->check_post($ret, $pids);
        }
        return $ret;
    }
    public function check_post($postlist, $pids)
    {
        foreach ($pids as $tid => $p) {
            $table = table_forum_post::get_tablename('tid:' . $tid);
            foreach ($p as $pid) {
                $tables[$table][] = $pid;
            }
        }
        $allow = array();
        foreach ($tables as $table => $pid) {
            $tmp = DB::fetch_all('SELECT pid FROM %t WHERE pid IN(%n) AND invisible=0', array(
                $table,
                $pid
            ), 'pid');
            $allow = array_merge($allow, $tmp);
        }
        $allows = array();
        foreach ($allow as $k => $v) {
            $allows[$v['pid']] = 1;
        }
        foreach ($postlist as $tid => $posts) {
            foreach ($posts as $pk => $post) {
                if(empty($allows[$post['pid']])){
                    unset($postlist[$tid][$pk]);
                }
            }
        }
        return $postlist;
    }

    //cache
    public function getuserbyuid_from_cache($threads, $uids)
    {
        $cache_key = md5('xg_users_'.implode('', $uids));
        $cache_path = 'u';
        if(!$data = $this->readfromcache($cache_key, $cache_path))
        {
            foreach ($uids as $uid) {
                $data[$uid] = getuserbyuid($uid);
            }
            if($this->show_gender != 0)
            {
                $rows = DB::fetch_all("SELECT uid, gender FROM %t WHERE uid in(%n)", array('common_member_profile', $uids));
                foreach ($rows as $k => $row) {
                    $data[$row['uid']]['gender'] = $row['gender'];
                }
            }
            $this->writetocache($cache_key, $data, $cache_path);
        }
        return $data;
    }

    public function get_attachment_img_from_cache($threads, $tids)
    {
        $cache_key = md5('xg_attachment_'.implode('', $tids));
        $cache_path = 'a';
        if(!$data = $this->readfromcache($cache_key, $cache_path))
        {
            foreach ($threads as $thread) {
                $tid = $thread['tid'];

                $data[$tid] = $this->get_attachment_img($tid);
            }
            $this->writetocache($cache_key, $data, $cache_path);
        }
        return $data;
    }

    public function get_message_from_cache($threads, $tids)
    {
        $cache_key = md5('xg_thread_'.implode('', $tids));
        $cache_path = 'm';
        if(!$data = $this->readfromcache($cache_key, $cache_path))
        {
            foreach ($threads as $thread) {
                $tid = $thread['tid'];
                $img_piclist = array();

                /*message*/
                if($this->font_num> 0) {
                    $oldmessage = $message = DB::result_first(
                        'SELECT message FROM %t WHERE tid=%d AND first=1  AND invisible=0 LIMIT 1',
                        array(table_forum_post::get_tablename('tid:' . $tid), $tid)
                    );

                    $sppos = strpos($message, chr(0).chr(0).chr(0));
                    if($sppos !== false) {
                        $message = substr($message, 0, $sppos);
                    }

                    $message = preg_replace(array(lang('forum/misc', 'post_edit_regexp'), lang('forum/misc', 'post_edithtml_regexp'), lang('forum/misc', 'post_editnobbcode_regexp')), '', $message);

                    if(strpos($message, '[/hide]') !== FALSE){
                        $message = preg_replace('/\[hide\].*?\[\/hide\]/i', '', $message);
                    }

                    if (
                        strpos($message, '[/attach]') !== FALSE ||
                        strpos($message, '[/attachimg]') !== FALSE ||
                        strpos($message, '[/url]') !== FALSE ||
                        strpos($message, '[/img]') !== FALSE ||
                        strpos($message, '[/media]') !== FALSE ||
                        strpos($message, '[/audio]') !== FALSE ||
                        strpos($message, '[/flash]') !== FALSE
                    ) {

                        if($this->pic_num> 0 && strpos($message, '[/img]') !== FALSE )
                        {
                            $pattern = "/\[img.*?\](.*?)\[\/img\]/i";
                            preg_match_all($pattern, $message, $matchsimg);
                            $img_piclist = $matchsimg[1];
                            foreach ($img_piclist as $kkkk => $vvvv) {
                                if(strpos($vvvv, 'mobcent/') !== false){
                                    unset($img_piclist[$kkkk]);
                                }
                            }
                        }

                        $pattern = "/(\[attach(img)?\]|\[(img|url|media|audio|flash)(.*)\]).*?(\[\/attach(img)?\]|\[\/(img|url|media|audio|flash)\])/i";
                        $message = preg_replace($pattern, '', $message);
                    }
                    $message = str_replace(array('&nbsp;', '&amp;', '&quot;', '&lt;', '&gt;', '[', ']'), array('', '', '', '', '', '<', '>'), $message);
                    $message = strip_tags($message);

                    if ($message) {
                        $message = cutstr($message, $this->font_num);
                        $message = $this->mobile_parsesmiles($message);
                        $message = preg_replace('/\{?\:\w+/', '', $message);
                    }

                    global $_G;
                    if($this->vars['showvideo'] && $_G['cache']['plugin']['xigua_media']){
                        if(strpos($oldmessage, '[/media]') !== FALSE || strpos($oldmessage, '[/flash]') !== FALSE) {
                            $height = $_G['cache']['plugin']['xigua_media']['height'];
                            preg_match("/\[(media|flash)\=?([\w,]*)\]\s*(.*?)\s*\[\/(media|flash)\]/ies", $oldmessage, $match);
                            $attr = $match[2];
                            $url = $match[3];
                            $link = $_G['siteurl']. 'plugin.php?id='.urlencode('xigua_media:fetchid').'&param='. urlencode(base64_encode(http_build_query(array(
                                    'attr' => $attr,
                                    'url'  => $url,
                                    'formhash' => FORMHASH
                                ))));
                            $message .= '<iframe style="width:100%;height:'.$height.'px" frameborder="0" scrolling="no" allowfullscreen="true" src="'.$link.'"></iframe>';
                            $this->videoids[] = $tid;
                        }
                    }

                    $data[ $tid ]['message'] = trim($message);
                }

                /*pic*/
                if($this->pic_num> 0) {
                    $piclist = array();

                    $tid = $thread['tid'];
                    $query = DB::query("SELECT a.aid,a.tableid from " . DB::table('forum_attachment') . " as a  where a.tid='$tid' ORDER BY aid ASC LIMIT $this->pic_num");
                    while ($arow = DB::fetch($query)) {
                        if($arow['tableid'] == 127){
                            continue;
                        }
                        $table = DB::table('forum_attachment_' . intval($arow['tableid']));
                        $aid = $arow['aid'];
                        $row = DB::fetch_first("SELECT remote,thumb,attachment FROM $table WHERE aid='$aid' AND isimage IN(-1, 1) LIMIT 1");
                        if ($row['attachment']) {
                            $piclist[] = $this->get_picurl($row['thumb'] ? getimgthumbname($row['attachment']) : $row['attachment'], $row['remote']);
                        }
                    }
                    if((empty($piclist)||count($piclist) <$this->pic_num) && $img_piclist){
                        $merger = array_slice($img_piclist, 0, $this->pic_num-count($piclist));
                        $piclist = array_merge($merger, $piclist);
                    }
                    $data[ $tid ]['piclist'] = $piclist;
                }

            }
            foreach ($this->videoids as $k => $v) {
                unset($data[ $v ]['piclist']);
            }

            $this->writetocache($cache_key, $data, $cache_path);
        }
        return $data;
    }

    function writetocache($script, $array = array(), $prefix = 'm')
    {
        $datas = array(
            'expireat' => time()+$this->expire,
            'data'     => $array
        );
        $cachedata = " return ".arrayeval($datas).";";

        if(memory('check')){
            return memory('set', $prefix.$script, serialize($datas), $this->expire);
        }

        global $_G;

        $dir = DISCUZ_ROOT.'./data/sysdata/xigua_beauty_cache/';
        if(!is_dir($dir)) {
            dmkdir($dir, 0777);
        }
        if($fp = @fopen("$dir$prefix$script.php", 'wb')) {
            fwrite($fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n//Identify: ".md5($prefix.$script.'.php'.$cachedata.$_G['config']['security']['authkey'])."\n\n$cachedata?>");
            fclose($fp);
        } else {
            exit('Can not write to cache files, please check directory ./data/ and ./data/sysdata/ and ./data/sysdata/xigua_beauty_cache/ .');
        }
    }

    function readfromcache($script, $prefix = 'm')
    {
        if(memory('check')){
            $data = memory('get', $prefix.$script);
            $ret = unserialize($data);
            return $ret['data'];
        }
        $dir = DISCUZ_ROOT.'./data/sysdata/xigua_beauty_cache/';
        if(!is_dir($dir)) {
            dmkdir($dir, 0777);
        }

        $ret = array();

        if(is_file("$dir$prefix$script.php")){
            $rets =  include "$dir$prefix$script.php";
            $ret = $rets['data'];
            if(time()> $rets['expireat'] )
            {
                $ret = array();
            }
        }
        return $ret;
    }
}