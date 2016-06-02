<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

include_once libfile('function/forumlist');
include_once dirname(__FILE__) . '/function.php';
include_once libfile('function/cache');

$_GET['siteid'] = intval($_GET['siteid']);

if(!$_G['cache']['plugin']){
    loadcache('plugin');
}
$config = $_G['cache']['plugin']['xigua_logo'];

if($config['expire']){

    if($res = static__readfromcache()){
        echo $res['res'];
        exit;
    }

}

$wechat = unserialize($_G['setting']['mobilewechat']);
$logo = $wechat['wsq_sitelogo'];
$title = xg_ll('forum', 1);

$config['hidenum'] = unserialize($config['hidenum']);
$hidenew = !in_array(1, $config['hidenum']);
$hidethread = !in_array(2, $config['hidenum']);
$hidepost = !in_array(3, $config['hidenum']);

if($config['show_fav'])
{
    if($_G['uid']) {
        $forum_favlist = C::t('home_favorite')->fetch_all_by_uid_idtype($_G['uid'], 'fid');
        foreach($forum_favlist as $key => $favorite)
        {
            $forum_favlist[$key]['title'] = strip_tags($favorite['title']);
            $favfids[] = $favorite['id'];
        }
        if($favfids) {
            $favforumlist = C::t('forum_forum')->fetch_all($favfids);
            $favforumlist_fields = C::t('forum_forumfield')->fetch_all($favfids);
            foreach($favforumlist as $id => $forum) {
                if($favforumlist_fields[$forum['fid']]['fid']) {
                    $favforumlist[$id] = array_merge($forum, $favforumlist_fields[$forum['fid']]);
                    $favforumlist[$id]['threads'] = format_number($favforumlist[$id]['threads']);
                    $favforumlist[$id]['posts']   = format_number($favforumlist[$id]['posts']  );
                }
                if($favforumlist[$id]['icon']) {
                    $favforumlist[$id]['icon'] = get_forumimg($favforumlist[$id]['icon']);
                }
            }
        }
    }
}
if($_GET['fid']){
    $fids[] = intval($_GET['fid']);
    $fup = C::t('forum_forum')->fetch_all_subforum_by_fup(intval($_GET['fid']));
    foreach ($fup as $v) {
        $fids[] = $v['fid'];
        $fids[] = $v['fup'];
        $fupgid = C::t('forum_forum')->fetch_all_by_fid(array($v['fup']));
        $fids[] = $fupgid[$v['fup']]['fup'];
    }
    $forums = C::t('forum_forum')->fetch_all_by_fid($fids);
}else{
    $forums = C::t('forum_forum')->fetch_all_by_status(1, 1);
}

$fids = array();
foreach($forums as $forum) {
    $fids[$forum['fid']] = $forum['fid'];
}
$forum_access = array();
if(!empty($_G['member']['accessmasks'])) {
    $forum_access = C::t('forum_access')->fetch_all_by_fid_uid($fids, $_G['uid']);
}
$forum_fields = C::t('forum_forumfield')->fetch_all($fids);

foreach($forums as $forum) {

    if($forum_fields[$forum['fid']]['fid']) {
        $forum = array_merge($forum, $forum_fields[$forum['fid']]);
    }
    if($forum_access['fid']) {
        $forum = array_merge($forum, $forum_access[$forum['fid']]);
    }
    $forumname[$forum['fid']] = strip_tags($forum['name']);
    $forum['extra'] = empty($forum['extra']) ? array() : dunserialize($forum['extra']);
    if(!is_array($forum['extra'])) {
        $forum['extra'] = array();
    }

    if(forum_profile($forum)) {
        $forumlist[$forum['fid']] = $forum;
        $forumlist[$forum['fid']]['id'] = $forum['fid'];
        $forumlist[$forum['fid']]['parent_id'] = $forum['fup'];
        $forumlist[$forum['fid']]['threads'] = format_number($forumlist[$forum['fid']]['threads']);
        $forumlist[$forum['fid']]['posts'] = format_number($forumlist[$forum['fid']]['posts']);
    }
}

if($_GET['gid']){
    foreach ($forumlist as $kkk => $vvv) {
        if($vvv['type'] == 'group' && $vvv['fid'] != $_GET['gid']){
            unset($forumlist[$kkk]);
        }
    }
}

$show_hot = !$_GET['gid'] && !$_GET['fid'];
if($show_hot){
    $o_forumlist = $forumlist;
}

include_once 'tree.class.php';
$xg_tree = new XG_treeclass();
$xg_tree->init($forumlist);
$forumlist = $xg_tree->get_tree_array(0);

if($show_hot && $push_forums = array_filter(unserialize($config['hot']))){
    $hotform = array(
        'fid' => -1,
        'fup' => 0,
        'type' => 'group',
        'name' => $config['hot_title']
    );
    foreach ($push_forums as $push_forum) {
        $hotform['child'][$push_forum] = $o_forumlist[$push_forum];
    }
    array_unshift($forumlist, $hotform);
//    ksort($forumlist);
}

$ads = array();
if($pic_string = trim($config['ads'])){
    foreach (array_filter(explode("\n", $pic_string)) as $top_pic) {
        list($adname, $adsrc, $adhref) = explode(',', trim($top_pic));
        $adname  = trim($adname);
        $adsrc   = trim($adsrc);
        $adhref  = trim($adhref);
        if(empty($adhref) || $adhref == '#'){
            $adhref = 'javascript:void(0);';
        }
        $topads[$adname] = "<a class=\"forumtop\" href='$adhref' ><img src='$adsrc'/></a>";
    }
}

?><!DOCTYPE html>
<html>
<head>
    <meta charset="<?php echo CHARSET?>">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title><?php echo $title;?></title>
    <link href="source/plugin/xigua_logo/images/xigua.css?20150621" type="text/css" rel="stylesheet" />
    <style type="text/css">
    .nav li.on a{<?php echo $config['nav_color'] ? 'border-left-color:'.$config['nav_color'] : ''?>}
    .forum_list .fav{<?php echo $config['submit_color'] ? 'background:'.$config['submit_color'] : ''?>}
    .forum_list h4 span{<?php echo $config['newthreadc_color'] ? 'background:'.$config['newthreadc_color'] : ''?>}
    <?php if($config['btns']){echo '.forum_list{margin-bottom:40px}';}?>
.forum_list h4{<?php if(!$hidepost && !$hidethread){echo 'height:50px;line-height:50px';}?>}
    </style>
    <script type="text/javascript" src="source/plugin/xigua_logo/images/zepto.js"></script>
    <script type="text/javascript" src="source/plugin/xigua_logo/images/iscroll-lite.js"></script>
</head>
<body>
<div id="wrapper">
<div class="nav">
    <ul class="clear"><?php
        $i = 0;
        foreach ($forumlist as $upid => $cat) {
        ?>
        <li <?php if($i++ == 0){echo 'class="on"';}?>><a><?php echo $cat['name']?></a></li>
        <?php }?>
        <?php if($config['show_fav']) { ?>
        <li><a><?php xg_ll('my_fav')?></a></li>
        <?php }?>
    </ul>
</div>
</div>
<div id="wrapper2">
    <div class="content">
    <?php
    $i = 0;
    foreach ($forumlist as $upid => $cat) {
        ?>
        <div class="forum_list clear">
<?php
    echo $topads[$cat['name']];
?>
            <ul>
                <?php foreach ($cat['child'] as $k => $forum) {
                    if(!$forum['name']){
                        continue;
                }?>
                    <li>
                        <a class="clear" target="_parent" href="<?php echo get_forum_url($forum['fid'], $_GET['siteid'])?>">
                            <p class="logo">
                                <?php if($forum['icon']){?>
                                    <img src="<?php echo $forum['icon']?>" />
                                <?php }else{
                                    echo '<i class="fa fa-leaf"></i>';
                                }?>
                            </p>
                            <h4><?php echo $forum['name']?> <?php if($hidenew){?><span><?php echo $forum['todayposts']?></span><?php }?></h4>
                            <p class="sub_title">
                                <?php if($hidethread){?><span><?php xg_ll('thread')?> <em><?php echo $forum['threads']?></em></span><?php }?>
                                <?php if($hidepost){?><span><?php xg_ll('post')?>  <em><?php echo $forum['posts']?></em></span><?php }?>
                            </p>
                        </a>
                        <?php if($forum['child']){?>
                            <i class="<?php if(!$config['show_submit']){?>right8 <?php }?>down fa fa-chevron-circle-down" data-id="<?php echo $forum['fid']?>" data-opened="<?php echo $config['show_sub'] ? 1 : 0;?>" <?php echo $config['show_sub'] ? 'style="-webkit-transform:rotateZ(180deg);-moz-transform:rotateZ(180deg);"' : ''?>></i>
                        <?php }?>
                        <?php if($config['show_submit']){?>
                        <a class="fav" target="_parent" href="<?php echo get_newthread_url($forum['fid'], $_GET['siteid'], $_G['uid'])?>"><?php echo $config['show_submit'];?></a>
                        <?php }?>
                    </li>
                    <?php if($forum['child']){?>
                        <label class="subforum sub-<?php echo $forum['fid']?>" <?php echo $config['show_sub'] ? '' : 'style="display:none;"';?>>
                            <?php foreach ($forum['child'] as $subk => $sub_forum) { ?>
                                <!--subforum-->
                                <li <?php echo $config['sub_indent'] ? 'style="padding-left:'.(intval($config['sub_indent'])+10).'px"' : '';?>>
                                    <a class="clear" target="_parent"  href="<?php echo get_forum_url($sub_forum['fid'], $_GET['siteid'])?>">
                                        <p class="logo">
                                            <?php if($sub_forum['icon']){?>
                                                <img src="<?php echo $sub_forum['icon']?>" />
                                            <?php }else{
                                                echo '<i class="fa fa-leaf"></i>';
                                            }?>
                                        </p>
                                        <h4><?php echo $sub_forum['name']?> <?php if($hidenew){?><span><?php echo $sub_forum['todayposts']?></span><?php }?></h4>
                                        <p class="sub_title">
                                            <?php if($hidethread){?><span><?php xg_ll('thread')?> <em><?php echo $sub_forum['threads']?></em></span><?php }?>
                                            <?php if($hidepost){?><span><?php xg_ll('post')?> <em><?php echo $sub_forum['posts']?></em></span><?php }?>
                                        </p>
                                    </a>
                                    <?php if($config['show_submit']){?>
                                    <a class="fav" target="_parent" href="<?php echo get_newthread_url($sub_forum['fid'], $_GET['siteid'], $_G['uid'])?>"><?php echo $config['show_submit'];?></a>
                                    <?php }?>
                                </li>
                            <?php }?>
                        </label>
                    <?php }?>
                <?php }?>
            </ul>
        </div>
    <?php
    }
    ?>
    <?php if($config['show_fav']){?>
        <div id="favforumlist" class="forum_list clear" style="display:none;">
<?php
$my_fav = xg_ll('my_fav', 1);
echo $topads[$my_fav];
?>
            <ul>
                <?php if($_G['uid']) { ?>
                    <?php
                    if ($favforumlist) {
                        foreach ($favforumlist as $forum) {
                            ?>
                            <li>
                                <a class="clear" target="_parent" href="<?php echo get_forum_url($forum['fid'], $_GET['siteid'])?>">
                                    <p class="logo">
                                        <?php if($forum['icon']){?>
                                            <img src="<?php echo $forum['icon']?>" />
                                        <?php }else{
                                            echo '<i class="fa fa-leaf"></i>';
                                        }?>
                                    </p>
                                    <h4><?php echo $forum['name'] ?> <?php if($hidenew){?><span><?php echo $forum['todayposts'] ?></span><?php }?></h4>

                                    <p class="sub_title">
                                        <?php if($hidethread){?><span><?php xg_ll('thread')?> <em><?php echo $forum['threads'] ?></em></span><?php }?>
                                        <?php if($hidepost){?><span><?php xg_ll('post')?> <em><?php echo $forum['posts'] ?></em></span><?php }?>
                                    </p>
                                </a>

                            <?php if($config['show_submit']){?>
                                <a class="fav" target="_parent" href="<?php echo get_newthread_url($forum['fid'], $_GET['siteid'], $_G['uid'])?>"><?php echo $config['show_submit'];?></a>
                            <?php }?>
                            </li>
                        <?php
                        }
                    } else {
                        echo '<li><a>'.xg_ll('no_fav', 1).'</a></li>';
                    }
                }else{
                    ?>
                    <li><?php echo sprintf(xg_ll('please_login', 1), 'http://wsq.discuz.qq.com/?c=index&a=profile&f=wx&siteid='.$_GET['siteid'].'&login=yes')?></li>
                <?php }?>
            </ul>
        </div>
    <?php }?>
</div>
</div>
<script type="text/javascript">
    document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
    var navli = $('.nav li');
    navli.click(function(){
        var $this = $(this);
        var forumlist = $('.forum_list').eq($this.index());
        forumlist.addClass('animation').show();
        forumlist.siblings('.forum_list').removeClass('animation').hide();
        $this.addClass('on').siblings().removeClass('on');
        setTimeout(function(){
            forumlist.removeClass('animation');
        }, 300);
        new IScroll('#wrapper2', {scrollX:false,scrollY:true,click:true});
    });
    navli.eq(0).click();
    $('.down').on('touchstart', function(){
        var $this = $(this);
        var id = $this.attr('data-id');
        if($this.attr('data-opened') == "1"){
            $this.attr('data-opened', 0);
            $this.animate({rotateZ:'0deg'}, 150);
            $('.sub-'+id).animate({opacity:0,translateX:'20px'}, 300, 'ease-out', function(){
                $('.sub-'+id).hide();
            });
        }else{
            $this.attr('data-opened', 1);
            $this.animate({rotateZ:'180deg'}, 150);
            $('.sub-'+id).css({opacity:1}).show().addClass('show_sub');
            setTimeout(function(){
                $('.sub-'+id).removeClass('show_sub');
            }, 300);
        }
        new IScroll('#wrapper2', {scrollX:false,scrollY:true,click:true});
    });

    var sc = new IScroll('#wrapper', {scrollX:false,scrollY:true,click:true});
</script>
<script type="text/javascript" src="http://wsq.discuz.qq.com/cdn/discuz/js/openjs.js"></script>
<script type="text/javascript">

<?php
if($config['btns'])
{
    echo 'var menu = new Array();';
    $btmlink = array_filter(explode("\n", $config['btns']));
    foreach ($btmlink as $each_link)
    {
        list($menu_name, $menu_link) = explode(' ', trim($each_link)) ;
        $menu_link = urlencode($menu_link);
            echo 'menu.push({name:"', $menu_name, '", pluginid:"xigua_logo:redirect", param:"url=', $menu_link, '"});';
    }
    echo 'WSQ.initBtmBar(menu);
    WSQ.showBtmBar();';
}else{
    echo 'WSQ.hideBtmBar();';
}
?>
    WSQ.initPlugin({name:'<?php echo $title?>'});
    var initWx = {
        'img': '<?php echo $logo?>',
        'desc': '<?php echo $wechat['wsq_sitename'] . $title?>',
        'title': '<?php echo $wechat['wsq_sitename'] . $title?>',
        'pluginid':'xigua_logo:forumlist',
        'param': 'fromuid=<?php echo $_G['uid']?>&siteid=<?php echo $_GET['siteid']?>'
    };
    WSQ.initShareWx(initWx);
</script>
</body>
</html>
<?php
if($config['expire']){

    $res = ob_get_contents();
    if($res){
        static__writetocache(array('res'=>str_replace(array("\n","\r", '  '), '', $res)));
    }
    ob_end_clean();

    echo $res;
    exit;

}