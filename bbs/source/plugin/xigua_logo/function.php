<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

function get_newthread_url($fid, $siteid, $uid){
    return "http://wsq.discuz.qq.com/?c=index&a=newthread&f=wx&fid=$fid&siteid=$siteid&siteuid=$uid&login=yes";
}

function get_forum_url($fid, $siteid){
    return "http://wsq.discuz.qq.com/?c=index&a=index&f=wx&fid=$fid&siteid=$siteid";
}

function forum_profile(&$forum) {
    global $_G;
    if(!$forum['viewperm'] || ($forum['viewperm'] && forumperm($forum['viewperm'])) || !empty($forum['allowview']) || (isset($forum['users']) && strstr($forum['users'], "\t$_G[uid]\t"))) {
        $forum['permission'] = 2;
    } elseif(!$_G['setting']['hideprivate']) {
        $forum['permission'] = 1;
    } else {
        return FALSE;
    }

    if($forum['icon']) {
        $forum['icon'] = get_forumimg($forum['icon']);
    }

    $forum['moderators'] = moddisplay($forum['moderators'], $_G['setting']['moddisplay'], !empty($forum['inheritedmod']));

    if(isset($forum['subforums'])) {
        $forum['subforums'] = implode(', ', $forum['subforums']);
    }

    return TRUE;
}

function xg_ll($lang, $return = 0){
    if($return){
        return lang('plugin/xigua_logo', $lang);
    }else{
        echo lang('plugin/xigua_logo', $lang);
    }
}


function format_number($number){
    if($number> 9999){
        $number = sprintf('%01.1f'. xg_ll('wan', 1), $number/10000);
    }
    return $number;
}


function fetch_post_by_tid($tid_s, $expire = 86400){
    global $_G;
    $tids = array_filter(explode(',', trim($tid_s)));
    $tids = dintval($tids, true);
    $ctid = count($tids);
    $ret = array();

    if($ctid == 1){
        $tid = $tids[0];
        $ret = xigua_logo_readfromcache($tid);
        if($ret['expire_at'] <$_G['timestamp']){
            $ret = array();
        }
        if(!$ret){
            $row = DB::fetch_first('SELECT subject, message FROM %t WHERE tid=%d AND first=1 LIMIT 1',
                array(table_forum_post::get_tablename('tid:'.$tid), $tid)
            );
            $subject = $row['subject'];
            $message = $row['message'];
            $message = preg_replace(array(lang('forum/misc', 'post_edit_regexp'), lang('forum/misc', 'post_edithtml_regexp'), lang('forum/misc', 'post_editnobbcode_regexp')), '', $message);
            if(
                strpos($message, '[/attach]') !== FALSE ||
                strpos($message, '[/attachimg]') !== FALSE ||
                strpos($message, '[/url]') !== FALSE ||
                strpos($message, '[/img]') !== FALSE ||
                strpos($message, '[/media]') !== FALSE ||
                strpos($message, '[/audio]') !== FALSE ||
                strpos($message, '[/flash]') !== FALSE
            ){
                $pattern = "/(\[attach(img)?\]|\[(img|url|media|audio|flash)(.*)\]).*?(\[\/attach(img)?\]|\[\/(img|url|media|audio|flash)\])/i";
                $message = preg_replace($pattern, '', $message);
            }
            $message = str_replace(array('&nbsp;','&amp;', '&quot;', '&lt;', '&gt;', '[', ']'), array('','','','','', '<', '>'), $message);
            $message = strip_tags($message);
            $message = cutstr($message, 150);
            $ret = array(
                'tid'     => $tid,
                'subject' => trim($subject),
                'message' => trim($message),
                'count'   => 1,
                'expire_at' => $_G['timestamp']+$expire,
            );
            if($subject){
                xigua_logo_writetocache($tid, $ret);
            }
        }
    }else if($ctid> 1){
        $tid_s = implode('_', $tids);
        $ret = xigua_logo_readfromcache($tid_s);
        if($ret['expire_at'] <$_G['timestamp']){
            $ret = array();
        }
        if(!$ret){
            foreach ($tids as $tid) {
                $subject = DB::result_first('SELECT subject FROM %t WHERE tid=%d AND first=1 LIMIT 1',
                    array(table_forum_post::get_tablename('tid:'.$tid), $tid)
                );
                $posts[$tid] = $subject;
            }
            if($posts){
                $ret = array(
                    'posts' => $posts,
                    'expire_at' => $_G['timestamp']+$expire,
                );
                xigua_logo_writetocache($tid_s, $ret);
            }
        }
    }
    return $ret;
}

function get_logo_forums($push_forums, $expire = 86400){
    global $_G;
    $ret = $forum_fields = $fids = array();
    if(empty($push_forums)){
        return $ret;
    }

    $cache_key = md5(implode('#', $push_forums));

    $ret = xigua_logo_readfromcache($cache_key);
    if($ret['expire_at'] <$_G['timestamp']){
        $ret = array();
    }
    if(!$ret) {
        if(empty( $_G['cache']['forums'])){
            loadcache('forums');
        }
        $forums = $_G['cache']['forums'];

        foreach ($forums as $key => $forum) {
            if(!in_array($forum['fid'], $push_forums)){
                unset($forums[$key]);
            }else{
                $fids[] = $forum['fid'];
            }
        }
        if($fids){
            $fids = array_map('intval', (array)$fids);
            $forum_fields = DB::fetch_all("SELECT fid,icon FROM %t WHERE fid IN(%n)", array('forum_forumfield', $fids), 'fid');
        }

        $display = array();
        foreach($forums as $k => $forum)
        {
            if ($forum_fields[ $forum['fid'] ]['fid'])
            {
                if($forum_fields[ $forum['fid'] ]['icon']){
                    $ic = get_forumimg($forum_fields[ $forum['fid'] ]['icon']);
                    if(!in_array(strtolower(substr($ic, 0, 6)), array('http:/', 'https:', 'ftp://'))){
                        $ic = $_G['siteurl'] . $ic;
                    }
                }else{
                    $ic = $_G['siteurl'] .'source/plugin/xigua_logo/images/nologo.png';
                }
                $forum_fields[ $forum['fid'] ]['icon'] = $ic;
                $display[$k] = array_merge($forum, $forum_fields[ $forum['fid'] ]);
            }
        }
        if($display){
            $ret = array(
                'display'   => $display,
                'expire_at' => $_G['timestamp']+$expire,
            );
            xigua_logo_writetocache($cache_key, $ret);
        }
    }
    return $ret['display'];
}

function xigua_logo_writetocache($tid, $array = array())
{
    $datas = $array;
    $cachedata = " return " . var_export($datas, TRUE) . ";";

    global $_G;

    $dir = DISCUZ_ROOT . "./data/sysdata/xigua_logo/";
    if (!is_dir($dir)) {
        dmkdir($dir, 0777);
    }
    $file = "$dir/$tid.php";
    if ($fp = @fopen($file, 'wb')) {
        fwrite($fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n//Identify: " . md5($tid . '.php' . $cachedata . $_G['config']['security']['authkey']) . "\n\n$cachedata?>");
        fclose($fp);
    } else {
        exit('Can not write to cache files, please check directory ./data/ and ./data/sysdata/ and ./data/sysdata/xigua_logo/ .');
    }
}

function xigua_logo_readfromcache($tid)
{
    $ret = array();

    $file = DISCUZ_ROOT . "./data/sysdata/xigua_logo/$tid.php";
    if (is_file($file)) {
        $ret = include $file;
    }

    return $ret;
}

function static__writetocache($array = array(), $prefix = 'm')
{
    global $config;
    $script = 'xigua_logo';
    $datas = array(
        'expireat' => time()+$config['expire'],
        'data'     => $array
    );
    $cachedata = " return ".arrayeval($datas).";";

    if(memory('check')){
        return memory('set', $prefix.$script, serialize($datas), $config['expire']);
    }

    global $_G;

    $dir = DISCUZ_ROOT.'./source/plugin/xigua_logo/';
    if(!is_dir($dir)) {
        dmkdir($dir, 0777);
    }
    if($fp = @fopen("$dir$prefix$script.php", 'wb')) {
        fwrite($fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n//Identify: ".md5($prefix.$script.'.php'.$cachedata.$_G['config']['security']['authkey'])."\n\n$cachedata?>");
        fclose($fp);
    } else {
        exit('Can not write to cache files, please check directory ./source/plugin/xigua_logo/ .');
    }
}

function static__readfromcache($prefix = 'm')
{
    $script = 'xigua_logo';
    if(memory('check')){
        $data = memory('get', $prefix.$script);
        $ret = unserialize($data);
        return $ret['data'];
    }
    $dir = DISCUZ_ROOT.'./source/plugin/xigua_logo/';
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