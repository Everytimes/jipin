<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/23
 * Time: 23:15
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
//ini_set('display_errors', 1);
//error_reporting(E_ALL ^ E_NOTICE);

include_once DISCUZ_ROOT . './source/plugin/xigua_weban/function.php';

class plugin_xigua_weban {

    public function discuzcode($param){
        global $_G;
        if($param['caller'] == 'discuzcode') {
            $search = $replace = array();
            for ($i = 1; $i <= 105; $i++) {
                $facelang = lang('plugin/xigua_weban', 'w' . $i);
                $_i = $i < 10 ? '0' . $i : $i;
                $img = "source/plugin/xigua_weban/static/Expression@2x_{$_i}278965.png";
                if ($facelang) {
                    $search[] = $facelang;
                    $replace[] = "<img src='$img' style='vertical-align:middle;width:22px'>";
                }
            }
            $_G['discuzcodemessage'] = str_replace($search, $replace, $_G['discuzcodemessage']);

            if(defined('IN_MOBILE') && IN_MOBILE && $_G['cache']['plugin']['xigua_media']){
                $lower = strtolower($_G['discuzcodemessage']);
                if(
                    strpos($lower, '[/media]') !== FALSE ||
                    strpos($lower, '[/flash]') !== FALSE
                ){
                    $_G['discuzcodemessage'] = preg_replace("/\[(media|flash)\=?([\w,]*)\]\s*(.*?)\s*\[\/(media|flash)\]/ies", 'parsexiguamedia("\\2","\\3")', $_G['discuzcodemessage']);
                }

            }
            if(defined('IN_MOBILE') && IN_MOBILE){
                $_G['discuzcodemessage'] = preg_replace("/\[img\=?([\w,]*)\](.*?)\[\/img\]/is", '<img src="\\2" />', $_G['discuzcodemessage']);
            }
        }
    }

    function get_if_recommend($uid, $tid)
    {
        if($uid==0){
            return false;
        }
        $ret = DB::result_first('SELECT recommenduid FROM %t WHERE recommenduid=%d AND tid=%d', array('forum_memberrecommend', $uid, $tid));
        return $ret;
    }

    function get_hotreply_member($uid, $pids){

        if($uid==0){
            return array();
        }
        $rows = DB::fetch_all('SELECT pid,uid FROM %t WHERE uid=%d AND pid in(%n)', array('forum_hotreply_member', $uid, $pids));
        $ret = array();
        foreach ($rows as $k => $row) {
            $ret[$row['pid']] = $row['uid'];
        }
        return $ret;
    }
}

class mobileplugin_xigua_weban extends plugin_xigua_weban{


}

class mobileplugin_xigua_weban_forum extends plugin_xigua_weban{

    public function misc_1_output()
    {
        if($_GET['version']){
            return false;
        }
        if($_GET['action'] == 'commentmore' && $_GET['weban']){
            global $_G,$comments;
            $lang['delete'] = lang('template','delete');
            include template('common/header_ajax');
            include template('xigua_weban:comment_more');
            include template('common/footer_ajax');
            exit;
        }
    }

    public function viewthread_1_output($param){
        global $_G,$postlist,$multipage,$allowpostreply,$secqaacheck,$seccodecheck,$firststand,$hiddenreplies,$post,$page,$threadsort,$threadsortshow,$threadplughtml,$multipage,$totalcomment,$comments,$commentcount,$extra;
        $config = $_G['cache']['plugin']['xigua_weban'];
        if(!$config['mobiletid'] || !in_array($_G['fid'], unserialize($config['fids']))){
            return false;
        }
        if($config['onlywx'] && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false){
            return false;
        }

        if(
            $_GET['aid'] ||
            $_GET['from'] ||
            $_G['forum_thread']['special'] ||
            $_GET['version'] ||$GLOBALS['RUNS']
        ){
            return false;
        }
        $GLOBALS['RUNS'] = 1;
//        hookscriptoutput('viewthread');

        $param = array('template' => 'viewthread', 'message' => $_G['hookscriptmessage'], 'values' => $_G['hookscriptvalues']);
        hookscript(CURMODULE, $_G['basescript'], 'outputfuncs', $param);

        $version = '201512301';
//        print_r($_G['forum_thread']);
//        print_r($postlist);

        $if_recommend = 0;
        $hotrep = array();
        if($_G['uid']){
            $pids = array_keys($postlist);
            $hotrep       = $this->get_hotreply_member($_G['uid'], $pids);
            $if_recommend = $this->get_if_recommend($_G['uid'], $_G['tid']);
        }
//        print_r($hotrep);
//        print_r($if_recommend);

        $realpage = @ceil(($_G['forum_thread']['replies']+1)/$_G['ppp']);
        $lang = array_merge(lang('template'), lang('forum/template'));
        $lang['attach_nopermission_login'] = str_replace(array('{$_G[setting][regname]}', '{$_G[setting][reglinkname]}'), array($_G['setting']['regname'],$_G['setting']['reglinkname']), $lang['attach_nopermission_login']);

        foreach ($postlist as $index => $item) {
            $postlist[$index]['message'] = preg_replace("/\s*\<img\s*id=\"aimg_(\d+)\".*?\>\s*/ies", "replace_aimg(\\1)", $item['message']);
        }

        if(!$_GET['weban']){
            $config['ad_top'] = $this->get_parse_pic($config['ad_top']);
            $config['ad_btm'] = $this->get_parse_pic($config['ad_btm']);
            $config['ad_title'] = $this->get_parse_pic($config['ad_title']);

            foreach ($postlist as $index => $item) {
                if($item['first'] ==1){
                    $message = $item['message'];
                    $postlist[$index]['message'] = $message = preg_replace(array(lang('forum/misc', 'post_edit_regexp'), lang('forum/misc', 'post_edithtml_regexp'), lang('forum/misc', 'post_editnobbcode_regexp')), '', $message);
                    if(strpos($message, '[/hide]') !== FALSE){
                        $message = preg_replace('/\[hide\].*?\[\/hide\]/i', '', $message);
                    }
                    $description = messagecutstr($message, 0, 80);
                    break;
                }
            }
            $sharehtml = get_share($config['appid'], $config['appsecret'], $_G['forum_thread']['subject'], $description, $_G['siteurl'].$GLOBALS['replace_aimg'][0], $config['debug']);

            if($config['yuanwenlink'])
            {
                $yuanwenlink = str_replace(array('{fid}','{tid}'), array($_G['fid'], $_G['tid']), $config['yuanwenlink']);
            }else{
                $yuanwenlink = $_G['siteurl']."forum.php?mod=viewthread&tid=$_G[tid]&extra=$_GET[extra]&version=1";
            }

            include template('xigua_weban:viewthread');

        }else{
            if($_GET['authorid'] || $_GET['viewpostlist']){
                include template('common/header_ajax');
                include template('xigua_weban:viewthread_nodes');
                include template('common/footer_ajax');

            }else if($_GET['viewpid']){
                include template('xigua_weban:viewthread_node');
                include template('common/footer_ajax');

            }
        }
        exit;
    }

    public function forumdisplay_1_output($param){
        global $_G,$postlist,$multipage,$extra,$displayorder_thread,$navtitle;

        $config = $_G['cache']['plugin']['xigua_weban'];
        if(!$config['mobile'] || !in_array($_G['fid'], unserialize($config['fids']))){
            return false;
        }
        if($config['onlywx'] && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false){
            return false;
        }
        if($_GET['version']){
            return false;
        }

        $pic = $this->s1();
        $realpage = @ceil(($_G['forum_threadcount'])/$_G['tpp']);

        $viewtype = ($config['viewtype'] == 1) ? 1 : 0;
        if($_GET['weban']){
            $_GET['weban'] = 0;

            ob_end_clean();
            ob_start();
            @header("Expires: -1");
            @header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
            @header("Pragma: no-cache");
            @header("Content-type: text/xml; charset=".CHARSET);
            echo '<?xml version="1.0" encoding="'.CHARSET.'"?>'."\r\n<root><![CDATA[";

            if( $_G['forum_threadcount']){
                foreach ($_G['forum_threadlist'] as $key => $thread) {
                    if( !$_G['setting']['mobile']['mobiledisplayorder3'] && $thread['displayorder'] > 0){
                        continue;
                    }
                    if ($thread['displayorder'] > 0 && !$displayorder_thread){
                        $displayorder_thread = 1;
                    }
                    if ($thread['moved']){
                        $thread['tid']=$thread['closed'];
                    }

                    if ($pic[$thread[tid]]){
                        $PIC_ = "<img class=\"td-i\" src=\"".$pic[$thread['tid']]."\">";
                    }else{
                        $PIC_ = '';
                    }

                    $ic = '';
                    if(in_array($thread['displayorder'], array(1, 2, 3, 4))){
//                        $ic = "<span class=\"icon_top\">¶¥</span>";
                    }elseif( $thread['digest'] > 0) {
//                        $ic = "<span class=\"icon_top\">¾«</span>";
                    }elseif($thread['attachment'] == 2 && $_G['setting']['mobile']['mobilesimpletype'] == 0){
//                        $ic = "<span class=\"icon_tu\">Í¼</span>";
                    }
                    if($viewtype){
                        $vt = "<span class=\"icon-commentnum\">$thread[replies]</span>";
                    }else{
                        $vt = "<span class=\"icon-viewnum\">$thread[views]</span>";
                    }
                    echo <<<HTML
<li>
    <a class="cl" href="forum.php?mod=viewthread&tid=$thread[tid]&extra=$extra" $thread[highlight]>
    $PIC_
        <div class="td-t">
            <p>{$thread[subject]}</p>
            <div class="cl"><em class="td-t-num">
                    $ic
                    $thread[author]</em>
                <em class="td-t-num">$thread[lastpost]</em>
                $vt
            </div>
        </div>
    </a>
</li>
HTML;
                }
            }

//            output_ajax();
            echo "]]></root>";
        }else{

            $lang = array_merge(lang('template'), lang('forum/template'));
            $lang['attach_nopermission_login'] = str_replace(array('{$_G[setting][regname]}', '{$_G[setting][reglinkname]}'), array($_G['setting']['regname'],$_G['setting']['reglinkname']), $lang['attach_nopermission_login']);

            $imgurl = '';
            foreach ($_G['forum_threadlist'] as $item) {
                $tmp[$item['tid']] = $item;
            }
            $_G['forum_threadlist'] = $tmp;

            $slider1 = array();
            foreach ($pic as $ktid => $item) {
                if(!$_G['setting']['mobile']['mobiledisplayorder3'] && $item['displayorder'] > 0){
                    continue;
                }else{
                    if(!$imgurl){
                        $imgurl = $item;
                    }
                    if(count($slider1)>=$config['lunbo']){
                        break;
                    }
                    $slider1[] = $_G['forum_threadlist'][$ktid];
                    unset($_G['forum_threadlist'][$ktid]);
                }
            }
            $nav= array_filter(explode("\r", trim($config['nav'])));
            foreach ($nav as $index=>$item) {
                $nav[$index] = array_filter(explode(',',trim($item)));
                $query = parse_url($nav[$index][1]);
                parse_str($query['query'], $str);
                $nav[$index][] = intval($str['fid']);
            }
            $nav_show = array_slice($nav, 0, 3);
            $nav_hide = array_slice($nav, 3);

            $has = 0;
            foreach ($nav_show as $item) {
                if($_G['fid'] == $item[2]){
                    $has = 1;
                }
            }
            if(!$has){
                foreach ($nav as $key => $item) {
                    if($_G['fid'] == $item[2]){
                       $nav_current =  $item;
                    }
                }
            }else if($nav_hide){
                $nav_show[] = array_shift($nav_hide);
            }

            $navwidth = '';
            if(!$nav_hide){
                $nav_currentcount = $nav_current ? 1:0;
                $navwidth = 100/(count($nav_show) + $nav_currentcount);
                $navwidth = "style='width:$navwidth%'";
            }else{
                if($nav_current){
                    foreach ($nav_hide as $index => $item) {
                        if($nav_current == $item){
                            unset($nav_hide[$index]);
                        }
                    }
                }
            }

            $showback = $config['showback'];
            $showsearch = $config['showsearch'];
            $searchtxt = $config['searchtxt'];
            $config['lunboheight'] = $config['lunboheight'] ? $config['lunboheight'] : '200';

            if (empty($nobbname)){
                $description = $_G['setting']['bbname'];
            }else{
                $description = $navtitle;
            }
            $sharehtml = get_share($config['appid'], $config['appsecret'], $navtitle, $description, $imgurl, $config['debug']);

            include template('xigua_weban:forumdisplay');
        }
        exit;
    }

    public function s1()
    {
        global $_G;
        $piclist = array();

        foreach ($_G['forum_threadlist'] as $item) {
            $tid = $item['tid'];

            $query = DB::query("SELECT a.aid,a.tableid from " . DB::table('forum_attachment') . " as a  where a.tid='$tid' ORDER BY aid ASC LIMIT 1");
            while ($arow = DB::fetch($query)) {
                if($arow['tableid'] == 127){
                    continue;
                }
                $table = DB::table('forum_attachment_' . intval($arow['tableid']));
                $aid = $arow['aid'];
                $row = DB::fetch_first("SELECT remote,thumb,attachment FROM $table WHERE aid='$aid' AND isimage IN(-1, 1) LIMIT 1");
                if ($row['attachment']) {
                    $piclist[$tid] = $this->get_picurl($row['thumb'] ? getimgthumbname($row['attachment']) : $row['attachment'], $row['remote']);
                }
            }
            if(!$piclist[$tid]){

                $message = DB::result_first(
                    'SELECT message FROM %t WHERE tid=%d AND first=1  AND invisible=0 LIMIT 1',
                    array(table_forum_post::get_tablename('tid:' . $tid), $tid)
                );

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

                    if( strpos($message, '[/img]') !== FALSE )
                    {
                        $pattern = "/\[img.*?\](.*?)\[\/img\]/i";
                        preg_match($pattern, $message, $matchsimg);
                        $piclist[$tid] = $matchsimg[1];
                    }
                }
            }

        }
        return $piclist;
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
    public static function is_picurl($pic){
        return in_array(strtolower(substr($pic, 0, 6)), array('http:/', 'https:', 'ftp://'));
    }

    public function get_parse_pic($pic_string)
    {
        $pic_string = trim($pic_string);
        if(!$pic_string){
            return '';
        }
        $retstr = '';
        global $_G;

        $top_pics = array_filter(explode("\n", $pic_string));
        if(strpos($pic_string,',')!==false && !empty($top_pics) && is_array($top_pics)){
            foreach ($top_pics as $top_pic) {
                $top_pic = str_replace(array(',', lang('plugin/xigua_weban', 'dot')), ' ', trim($top_pic));
                list($fid, $src, $href) = explode(' ', $top_pic);
                $fid = trim($fid);
                $src = trim($src);
                $href = trim($href);
                if(empty($href)){
                    $href = '#';
                }
                if(($fid == 0 || $fid == $_G['fid']) && $src && $href)
                {
                    $retstr .= "<a href='$href'><img style='width:100%;' src='$src' /></a>";
                }
            }
        }
        if(!$retstr){
            $retstr = $pic_string;
        }
        return $retstr;
    }

}