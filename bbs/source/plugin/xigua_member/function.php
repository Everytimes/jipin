<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/12/9
 * Time: 22:39
 */
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

function xul($lang, $echo = TRUE)
{
    $lang = lang('plugin/xigua_member', $lang);
    if ($echo) {
        echo $lang;
        return TRUE;
    } else {
        return $lang;
    }
}

function XG_birthhtml($birthyear = '', $birthmonth = '', $birthday = ''){
    global $_G;
    $birthyeayhtml = '';
    $nowy = dgmdate($_G['timestamp'], 'Y');
    for ($i=0; $i<100; $i++) {
        $they = $nowy - $i;
        $selectstr = $they == $birthyear?' selected':'';
        $birthyeayhtml .= "<option value=\"$they\"$selectstr>$they</option>";
    }
    $birthmonthhtml = '';
    for ($i=1; $i<13; $i++) {
        $selectstr = $i == $birthmonth?' selected':'';
        $birthmonthhtml .= "<option value=\"$i\"$selectstr>$i</option>";
    }
    $birthdayhtml = '';
    if(empty($birthmonth) || in_array($birthmonth, array(1, 3, 5, 7, 8, 10, 12))) {
        $days = 31;
    } elseif(in_array($birthmonth, array(4, 6, 9, 11))) {
        $days = 30;
    } elseif($birthyear && (($birthyear % 400 == 0) || ($birthyear % 4 == 0 && $birthyear % 400 != 0))) {
        $days = 29;
    } else {
        $days = 28;
    }
    for ($i=1; $i<=$days; $i++) {
        $selectstr = $i == $birthday?' selected':'';
        $birthdayhtml .= "<option value=\"$i\"$selectstr>$i</option>";
    }
    $html = '<select name="birthyear" id="birthyear" class="ps" onchange="showbirthday();" tabindex="1">'
        .'<option value="">'.lang('space', 'year').'</option>'
        .$birthyeayhtml
        .'</select> '
        .'<select name="birthmonth" id="birthmonth" class="ps" onchange="showbirthday();" tabindex="1">'
        .'<option value="">'.lang('space', 'month').'</option>'
        .$birthmonthhtml
        .'</select> '
        .'<select name="birthday" id="birthday" class="ps" tabindex="1">'
        .'<option value="">'.lang('space', 'day').'</option>'
        .$birthdayhtml
        .'</select>';
    return $html;
}

function XG_showmessage($key, $extrainfo = '') {
    echo xul($key, 0).($extrainfo ? ' '.$extrainfo : '');
    exit();
}

function XG_renameuser($uid, $newusername)
{
    global $_G;
    $oldusername = $_G['username'];
    loaducenter();

    $uid      = intval($uid);
    XG_checkusername($newusername);
    XG_rule_run($newusername);

    $UC_tables = array(
        'members'          => array('id' => 'uid', 'name' => 'username'),
        'admins'           => array('id' => 'uid', 'name' => 'username'),
        'feeds'            => array('id' => 'uid', 'name' => 'username'),
        'protectedmembers' => array('id' => 'uid', 'name' => 'username'),
    );
    foreach($UC_tables as $table => $conf) {
        DB::query("UPDATE ".(UC_DBTABLEPRE .$table) ." SET `$conf[name]`=%s WHERE `$conf[id]`=%d", array(
            $newusername,
            $uid
        ),  TRUE);
    }

    $UC_tables_s = array(
        'badwords' => array('id' => 'admin', 'name' => 'admin'),
    );
    foreach($UC_tables_s as $table => $conf) {
        DB::query("UPDATE ".(UC_DBTABLEPRE .$table) ." SET `$conf[name]`=%s WHERE `$conf[id]`=%s", array(
            $newusername,
            $oldusername
        ),  TRUE);
    }

    $tables = array(
        'common_block'                => array('id' => 'uid', 'name' => 'username'),
        'common_member_verify_info'   => array('id' => 'uid', 'name' => 'username'),
        'common_mytask'               => array('id' => 'uid', 'name' => 'username'),
        'common_report'               => array('id' => 'uid', 'name' => 'username'),
        'common_invite'               => array('id' =>'fuid', 'name' => 'fusername'),
        /*append*/
        'common_diy_data'             => array('id' => 'uid', 'name' => 'username'),
        'common_member_security'      => array('id' => 'uid', 'name' => 'username'),
        'common_session'              => array('id' => 'uid', 'name' => 'username'),
        'common_block_item_data'      => array('id' => 'uid', 'name' => 'username'),
        'common_card_log'             => array('id' => 'uid', 'name' => 'username'),
        'common_grouppm'              => array('id' => 'authorid', 'name' => 'author'),

        'forum_activityapply'         => array('id' => 'uid', 'name' => 'username'),
        'forum_groupuser'             => array('id' => 'uid', 'name' => 'username'),
        'forum_pollvoter'             => array('id' => 'uid', 'name' => 'username'),
        'forum_ratelog'               => array('id' => 'uid', 'name' => 'username'),
        'forum_thread'                => array('id' => 'authorid', 'name' => 'author'),
        'forum_post'                  => array('id' => 'authorid', 'name' => 'author'),
        'forum_postcomment'           => array('id' => 'authorid', 'name' => 'author'),
        /*append*/
        'forum_collection'            => array('id' => 'uid', 'name' => 'username'),
        'forum_collectioncomment'     => array('id' => 'uid', 'name' => 'username'),
        'forum_collectionfollow'      => array('id' => 'uid', 'name' => 'username'),
        'forum_collectionteamworker'  => array('id' => 'uid', 'name' => 'username'),
        'forum_promotion'             => array('id' => 'uid', 'name' => 'username'),
        'forum_threadmod'             => array('id' => 'uid', 'name' => 'username'),
        'forum_tradecomment'          => array('id' => 'raterid', 'name' => 'rater'),
        'forum_trade'                 => array('id' => 'sellerid', 'name' => 'seller'),
        'forum_tradelog'              => array('id' => 'sellerid', 'name' => 'seller'),
        'forum_forumrecommend'        => array('id' => 'authorid', 'name' => 'author'),
        'forum_warning'               => array('id' => 'authorid', 'name' => 'author'),
        'forum_forumfield'            => array('id' => 'founderuid', 'name' => 'foundername'),

        'home_album'                  => array('id' => 'uid', 'name' => 'username'),
        'home_blog'                   => array('id' => 'uid', 'name' => 'username'),
        'home_clickuser'              => array('id' => 'uid', 'name' => 'username'),
        'home_docomment'              => array('id' => 'uid', 'name' => 'username'),
        'home_doing'                  => array('id' => 'uid', 'name' => 'username'),
        'home_feed'                   => array('id' => 'uid', 'name' => 'username'),
        'home_feed_app'               => array('id' => 'uid', 'name' => 'username'),
        'home_pic'                    => array('id' => 'uid', 'name' => 'username'),
        'home_share'                  => array('id' => 'uid', 'name' => 'username'),
        'home_show'                   => array('id' => 'uid', 'name' => 'username'),
        'home_specialuser'            => array('id' => 'uid', 'name' => 'username'),
        'home_visitor'                => array('id' => 'vuid', 'name' => 'vusername'),
        'home_friend'                 => array('id' => 'fuid', 'name' => 'fusername'),
        'home_friend_request'         => array('id' => 'fuid', 'name' => 'fusername'),
        'home_notification'           => array('id' => 'authorid', 'name' => 'author'),
        'home_poke'                   => array('id' => 'fromuid', 'name' => 'fromusername'),
        /*append*/
        'home_follow'                 => array('id' => 'uid', 'name' => 'username'),
        'home_follow_feed'            => array('id' => 'uid', 'name' => 'username'),
        'home_follow_feed_archiver'   => array('id' => 'uid', 'name' => 'username'),
        'home_comment'                => array('id' => 'authorid', 'name' => 'author'),

        'portal_article_title'        => array('id' => 'uid', 'name' => 'username'),
        'portal_comment'              => array('id' => 'uid', 'name' => 'username'),
        'portal_topic'                => array('id' => 'uid', 'name' => 'username'),
        'portal_topic_pic'            => array('id' => 'uid', 'name' => 'username'),
        /*append*/
        'portal_category'             => array('id' => 'uid', 'name' => 'username'),
    );

    if(!C::t('common_member')->update($uid, array('username' => $newusername)) && isset($_G['setting']['membersplit'])){
        C::t('common_member_archive')->update($uid, array('username' => $newusername));
    }

    loadcache("posttableids");
    if($_G['cache']['posttableids']) {
        foreach($_G['cache']['posttableids'] AS $tableid) {
            $tables[getposttable($tableid)] = array('id' => 'authorid', 'name' => 'author');
        }
    }

    foreach($tables as $table => $conf) {
        DB::query("UPDATE ".DB::table($table)." SET `$conf[name]`=%s WHERE `$conf[id]`=%d", array(
            $newusername,
            $uid
        ),  TRUE);
    }

    /*repeat tables */
    $tables_2 = array(
        'forum_tradecomment' => array('id' => 'rateeid', 'name' => 'ratee'),
    );
    foreach($tables_2 as $table => $conf) {
        DB::query("UPDATE ".DB::table($table)." SET `$conf[name]`=%s WHERE `$conf[id]`=%d", array(
            $newusername,
            $uid
        ),  TRUE);
    }

    $tables_3 = array(
        'portal_rsscache'    => array('id' => 'author', 'name' => 'author'),
        'forum_announcement' => array('id' => 'author', 'name' => 'author'),
        'forum_rsscache'     => array('id' => 'author', 'name' => 'author'),
        'common_banned'      => array('id' => 'admin',  'name' => 'admin'),
        'common_adminnote'   => array('id' => 'admin',  'name' => 'admin'),
        'common_word'        => array('id' => 'admin',  'name' => 'admin'),
    );
    foreach($tables_3 as $table => $conf) {
        DB::query("UPDATE ".DB::table($table)." SET `$conf[name]`=%s WHERE `$conf[id]`=%s", array(
            $newusername,
            $oldusername
        ),  TRUE);
    }
    return TRUE;
}

function XG_checkusername($newusername)
{
    global $_G;
    loaducenter();

    $usernamelen = dstrlen($newusername);

    if($usernamelen < 3){
        XG_showmessage('profile_username_tooshort');
    } elseif($usernamelen > 15) {
        XG_showmessage('profile_username_toolong');
    }
    if(is_numeric($newusername)){
        XG_showmessage('profile_username_is_numeric');
    }
    if(preg_match('#(\{|\}|\[|\]|\+|\=|,|\/|-|`|%|\.|\*|\?|>|\'|<|;|\\\\|")#is',$newusername)){
        XG_showmessage('profile_username_illegal');
    }

    $ucresult = uc_user_checkname($newusername);
    if($ucresult == -1) {
        XG_showmessage('profile_username_illegal');
    } elseif($ucresult == -2) {
        XG_showmessage('profile_username_protect');
    } elseif($ucresult == -3) {
        if(C::t('common_member')->fetch_by_username($newusername) || C::t('common_member_archive')->fetch_by_username($newusername)) {
            XG_showmessage('register_check_found');
        } else {
            XG_showmessage('register_activation');
        }
    }

    $censorexp = '/^('.str_replace(array('\\*', "\r\n", ' '), array('.*', '|', ''), preg_quote(($_G['setting']['censoruser'] = trim($_G['setting']['censoruser'])), '/')).')$/i';
    if($_G['setting']['censoruser'] && @preg_match($censorexp, $newusername)) {
        XG_showmessage('profile_username_protect');
    }
}

function XG_rule(){
    global $_G, $wechat, $config;
    $uid = $_G['uid'];
    $rule = $config['rule'];
    $credit  = $config['credit'];
    $rulelimit = intval(abs($config['rulelimit']));
    $tip = trim($config['tip']);
    if(!XG_allow_reusername()){
        return array();
    }
    $allow = TRUE;
    switch($rule)
    {
        case 1:
            $ret = $tip ? $tip : sprintf(lang('plugin/xigua_member', 'times1'), $rulelimit.$_G['setting']['extcredits'][$credit]['title']);
            $allow = TRUE;
            break;
        case 2:
            $times = C::t('#xigua_member#plugin_xigua_member')->read_count($uid);
            $times = $rulelimit - $times;
            if($times <1){
                $times = 0;
            }
            $ret = $tip ? $tip : sprintf(lang('plugin/xigua_member', 'times2'), $times);
            $allow = $times ? TRUE : FALSE;
            break;
        default:
            $ret = $tip ? $tip : xul('type_your_username', FALSE);
            $allow = TRUE;
            break;
    }
    return array(
        'tip' => $ret,
        'allow' => $allow
    );
}

function XG_allow_reusername(){
    global $_G, $wechat, $config;

    if(!$config['username_allow']){
        return FALSE;
    }
    if(! in_array($_G['groupid'], unserialize($config['groups']))){
        return FALSE;
    }

    loaducenter();
    if(UC_CONNECT == 'mysql'){
        return TRUE;
    }else{
        return FALSE;
    }
}

function XG_rule_run($lastusername){
    global $_G, $wechat, $config;
    $uid = $_G['uid'];
    $rule = $config['rule'];
    $credit  = $config['credit'];
    $credit_title = $_G['setting']['extcredits'][$credit]['title'];
    $rulelimit = intval(abs($config['rulelimit']));

    switch($rule)
    {
        case 1:
            $price = $rulelimit;
            if(getuserprofile('extcredits' . $credit) < $price)
            {
                if($_G['setting']['ec_ratio'] && $_G['setting']['creditstrans'][0] == $credit) {
                    XG_showmessage(
                        sprintf(lang('plugin/xigua_member', 'credits_no_enough_and_charge'), $credit_title)
                    );
                } else {
                    XG_showmessage(
                        sprintf(lang('plugin/xigua_member', 'credits_no_enough'), $credit_title)
                    );
                }
            }
            $extcredit = 'extcredits'.$credit;
            $log = sprintf(xul('wsq_apicredit_log', FALSE), $lastusername);
            updatemembercount(array($_G['uid']), array($extcredit => -$rulelimit), true, '', 0, '', $log);
            C::t('#xigua_member#plugin_xigua_member')->svae_log($uid, $_G['username'], $lastusername, $rulelimit.$credit_title);
            break;
        case 2:
            $has_times = C::t('#xigua_member#plugin_xigua_member')->read_count($uid);
            if(($rulelimit - $has_times) <1){
                XG_showmessage('cant_reusername');
            }
            C::t('#xigua_member#plugin_xigua_member')->svae_log($uid, $_G['username'], $lastusername, sprintf(lang('plugin/xigua_member', 'use_once'), $has_times+1));
            break;
        default:
            C::t('#xigua_member#plugin_xigua_member')->svae_log($uid, $_G['username'], $lastusername, lang('plugin/xigua_member', 'none'));
            break;
    }
}