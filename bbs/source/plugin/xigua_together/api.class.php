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

class xigua_together {

    public function __construct()
    {
        global $_G;
        if(!$_G['cache']['plugin']){
            loadcache('plugin');
        }
        $this->vars = $_G['cache']['plugin']['xigua_together'];
        $this->t_fids  = array_filter(unserialize($this->vars['t_fids']));
        $this->show  = $this->vars['show'];
        $this->relate  = $this->vars['relate'];
        $this->tags  = $this->vars['tags'];
        $this->order  = $this->vars['order'];
        $this->nodig  = $this->vars['nodig'];
        $this->closedig  = $this->vars['closedig'];
        $this->showsub  = $this->vars['showsub'];
        $this->background = array(
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
        $this->fields = 'attachment,author,authorid,dateline,digest,displayorder,lastpost,lastposter,price,readperm,recommend_add,replies,replycredit,status,special,subject,tid,typeid,views,fid';
    }

    function forumdisplay_variables(& $params)
    {
        $data = array();
        global $_G;
        if(!$_GET['page']){
            $_GET['page'] = 1;
        }

        if($_G['forum']['picstyle']){
            return TRUE;
        }
        if($this->vars['showdefault']){
            $fid = $_G['fid'];
        }else{
            $fid = 0;
        }
        if(!empty($_GET['filter']))
        {
            return TRUE;
        }
        $wechat = unserialize($_G['setting']['mobilewechat']);


        switch($this->order){
            case 1:
                $order = 'ORDER BY dateline DESC';
                break;
            case 2:
                $order = 'ORDER BY lastpost DESC';
                break;
            case 3:
                $order = 'ORDER BY replies DESC, views DESC';
                break;
            case 5:
                $order = 'ORDER BY recommend_add DESC';
                break;
            case 4:
            default:
                $order = 'ORDER BY views DESC';
                break;
        }

        if($_G['fid'] == $wechat['wsq_fid'])
        {
            if($this->vars['showdefault']) {
                $this->t_fids[] = $_G['fid'];
            }
            if($this->t_fids)
            {
                $fid = implode(',', $this->t_fids);
            }
        }
        else
        {
            if(!$this->showsub){
                return TRUE;
            }
            $fid_s = array();
            foreach ($_G['cache']['forums'] as $forum) {
                if($_G['fid'] == $forum['fid'] || $_G['fid'] == $forum['fup']){
                    $fid_s[] = intval($forum['fid']);
                }
            }

            if(count(array_filter($fid_s)) <=1){
                return TRUE;
            }

            $where = array();
            $where[] = " fid in(".implode(',', $fid_s).")  ";
            $where[] = 'displayorder>=0';

            $condition = implode(' AND ', $where);

            $tpp = intval($_GET['tpp']);
            $page = intval($_GET['page']);
            $start_limit = ($page - 1) * $tpp;
            if($start_limit<0){
                $start_limit = 0;
            }

            $sql = "SELECT {$this->fields} FROM ".DB::table('forum_thread')." WHERE $condition $order LIMIT $start_limit, $tpp";
            $thread_list=DB::fetch_all($sql);

            $tids = array();
            foreach ($thread_list as $row) {
                $tids[] = $row['tid'];
            }
            $replies = $this->get_replies_by_tids($tids);
            $recommends = $this->get_forum_memberrecommend($_G['uid'], $tids);
            $thread_list = self::get_addviews($tids, $thread_list);

            foreach($thread_list as $row)
            {
                if(in_array($row['tid'], $_G['wechat']['setting']['showactivity']['tids'])) {
                    $row['showactivity'] = 1;
                    $params['showactivity'][$row['tid']] = $row['tid'];
                }
                $row['rushreply'] = getstatus($row['status'], 3);
                $row['dblastpost'] = $row['lastpost'];
                $row['dbdateline'] = $row['dateline'];
                $row['lastpost']   = strip_tags(dgmdate($row['lastpost'], 'u'));
                $row['dateline']   = strip_tags(dgmdate($row['dateline'], 'u'));
                $row['recommend']  = (int)$recommends[$row['tid']];
                $row['reply']      = (array)$replies[$row['tid']];
                $data[] = $row;
            }
            $params['forum']['threadcount'] = $params['forum']['threads'] = '10000';
            $GLOBALS['threadlist'] = $params['forum_threadlist'] = $data;
            return TRUE;
        }

        if($_GET['page'] == 1 && !$this->closedig)  //displayorder >0
        {
            if($this->nodig){
                $dis_where = "fid='".$_G['fid']."'";
            }else{
                $dis_where = "fid IN ($fid)";
            }
            $sql = "SELECT {$this->fields} FROM ".DB::table('forum_thread')." WHERE $dis_where AND displayorder>0 ORDER BY displayorder DESC,dateline DESC LIMIT 20";
            $querys=DB::query($sql);
            while($row=DB::fetch($querys))
            {
                $data[] = $row;
            }
        }
        $forums = array();
        foreach ($_G['cache']['forums'] as $forum) {
            $forums[$forum['fid']] = $forum['name'];
        }

        $where = array();
        $where[] = $fid ? "fid IN ($fid)" : '';
        $where[] = 'displayorder=0';

        $condition = implode(' AND ', $where);

        $tpp = intval($_GET['tpp']);
        $page = intval($_GET['page']);
        $start_limit = ($page - 1) * $tpp;
        if($start_limit<0){
            $start_limit = 0;
        }

        $where_abs = '';
        $abs = array();
        if($_GET['page'] == 1 && $this->vars['abs']){
            $abs = dintval(array_filter(explode(',',trim($this->vars['abs']))), true);
            if($abs){
                $where_abs = ' OR tid IN('.implode(',', $abs).')';
            }
        }

        $sql = "SELECT {$this->fields} FROM ".DB::table('forum_thread')." WHERE ($condition) $where_abs $order LIMIT $start_limit, $tpp";
        $thread_list=DB::fetch_all($sql, array(), 'tid');

        if($abs){
            $r = array();
            foreach ($abs as $v_tid) {
                $r[$v_tid] = $thread_list[$v_tid];
                unset($thread_list[$v_tid]);
            }
            $thread_list = array_merge($r, $thread_list);
        }

        $tids = array();
        foreach ($thread_list as $row) {
            $tids[] = $row['tid'];
        }
        $replies = $this->get_replies_by_tids($tids);
        $recommends = $this->get_forum_memberrecommend($_G['uid'], $tids);

        $thread_list = self::get_addviews($tids, $thread_list);

        foreach($thread_list as $row)
        {
            if(in_array($row['tid'], $_G['wechat']['setting']['showactivity']['tids'])) {
                $row['showactivity'] = 1;
                $params['showactivity'][$row['tid']] = $row['tid'];
            }
            $row['rushreply'] = getstatus($row['status'], 3);
            $row['dblastpost'] = $row['lastpost'];
            $row['dbdateline'] = $row['dateline'];
            $row['lastpost']   = strip_tags(dgmdate($row['lastpost'], 'u'));
            $row['dateline']   = strip_tags(dgmdate($row['dateline'], 'u', '9999', 'Y-m-d'));
            $row['recommend']  = (int)$recommends[$row['tid']];
            $row['reply']      = (array)$replies[$row['tid']];
            if($this->show && $row['displayorder'] ==0 && $row['showactivity'] != 1){
                $row['subject']    =  '<a class="studioBtn">' . $forums[$row['fid']] .'</a>' . $row['subject'];
            }
            $data[] = $row;
        }
        $params['forum']['threadcount'] = $params['forum']['threads'] = '10000';
        $GLOBALS['threadlist'] = $params['forum_threadlist'] = $data;
        return TRUE;
    }


    static  public function get_addviews($tids, $indexlist){
        foreach(C::t('forum_threadaddviews')->fetch_all($tids) as $tidkey => $value) {
            $indexlist[$tidkey]['views'] += $value['addviews'];
        }
        return $indexlist;
    }
    function viewthread_threadBottom() {
        if(!$this->relate && !$this->tags){
            return false;
        }
        global $_G;
        $retval = '';
        $tag_tmp = $relateitem = array();

        foreach($GLOBALS['postlist'] as $pid => $post){
            if($post['first'] == 1)
            {
                $sql = 'SELECT pid,tags FROM '.DB::table(table_forum_post::get_tablename('tid:'.$post['tid'])).' WHERE tid='.$post['tid'].' LIMIT 1 ';
                $row = DB::fetch_first($sql);
                if(!empty($row['tags'])){
                    $tag_tmp = explode('	', trim($row['tags']));
                    foreach ($tag_tmp as $k => $tag) {
                        $tag_tmp[$k] = explode(',', $tag);
                    }
                }

                $relateitem = getrelateitem(
                    $tag_tmp,
                    $post['tid'],
                    $_G['setting']['relatenum'],
                    $_G['setting']['relatetime']
                );
                break;
            }
        }

        if($this->tags && $tag_tmp){
            $retval .= '<div style="margin:5px 0;clear:both;"><h5 style="color:#666">'.lang('plugin/xigua_together', 'tags').'</h5><ul style="clear: both;width: 100%;float:left;">';
            foreach ($tag_tmp as $k => $tag) {
                $tag_id = $tag['0'];
                $tag_name = $tag['1'];

                $background = $this->background[$k%7];
                $style = "style='display:block;background:$background;color:#FFF;padding:0 5px;border-radius:3px;margin:5px 5px 0 0;'";

                $retval .= "<li style='float:left;padding:0;'  tagid='$tag_id'><a href='javascript:;' $style>$tag_name</a></li>";
            }
            $retval .= '</ul><div style="clear:both"></div></div>';
        }

        if($this->relate && !empty($relateitem)){
            $retval .= '<div style="margin:5px 0;clear:both;"><h5 style="color:#666">'.lang('plugin/xigua_together', 'title').'</h5><ul>';
            foreach ($relateitem as $rpost) {
                $retval .= '<li style="padding:0;"  tid="'.$rpost['tid'].'" >'
                    . '<a href="'.$this->get_url($rpost['tid']).'" style="float:left;width:100%;padding-right:1%;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;" >' . $rpost['subject']. '</a></li>';
            }
            $retval .= '</ul><div style="clear:both"></div></div>';
        }
        return $retval;
    }

    function get_url($tid){
        $param = array_merge(array(
            'c' => 'index',
            'a' => 'viewthread',
            'f' => 'wx',
            'siteid' => $_GET['siteid']
        ), array('tid' => $tid));
        $url = 'http://wsq.discuz.qq.com/?' . http_build_query($param);
        return trim($url);
    }

    public function get_replies_by_tids($tids)
    {
        if(!$tids){
            return array();
        }
        $data = $ret = array();
        $list = DB::fetch_all("select * from %t WHERE skey IN(%n)", array(
            'mobile_wsq_threadlist',
            $tids
        ));
        foreach ($list as $k => $v) {
            $data[$v['skey']] = $v['svalue'] ? dunserialize($v['svalue']) : array();
        }
        return $data;
    }


    public function get_forum_memberrecommend($uid, $tids)
    {
        if(!$tids || !$uid){
            return array();
        }
        $list = DB::fetch_all('SELECT tid FROM %t WHERE recommenduid=%d AND tid IN(%n)', array('forum_memberrecommend', $uid, $tids));
        $data = array();
        foreach ($list as $row) {
            $data[$row['tid']] = 1;
        }
        return $data;
    }

}