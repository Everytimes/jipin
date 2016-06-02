<?php exit(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset={CHARSET}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title><!--{if !empty($navtitle)}-->$navtitle - <!--{/if}--><!--{if empty($nobbname)}--> $_G['setting']['bbname']<!--{/if}--></title>
    <link rel="stylesheet" type="text/css" href="{$_G[siteurl]}source/plugin/xigua_weban/static/style.css?$version">
    <link rel="stylesheet" type="text/css" href="{$_G[siteurl]}source/plugin/xigua_weban/static/style_forum.css?$version">
    <style>
    <!--{if $config['index_imgpos'] == 2}-->
    .td-i + .td-t .icon-viewnum,.td-i + .td-t .icon-commentnum{margin-right:8px!important}.td-i{float:right!important;margin-right:0!important}
    <!--{/if}-->
    <!--{if $config['color']}-->
    .n-header {background: $config['color'];}
    .n-tab-box ul li.cur { border-bottom: 2px solid $config['color'];}
    .n-tab-box ul li.cur a {color: $config['color'];}
    .position li.current{background: $config['color'];}
    <!--{/if}-->
    {if $config[showback]}
    .n-form{padding-top:0!important;}
    {/if}
    {if $config[lunboheight]}
    .swipe-wrap img {min-height:$config[lunboheight]px}
    {/if}
    </style>
</head>
<body id="activity-detail" class="zh_CN mm_appmsg not_in_mm">
<div class="n-header">
    <!--{if $showback}-->
    <div class="nhd_bar">
        <div>
            <a href="forum.php" class="btn_back"><span class="ico_btn_back"></span></a>
            <a href="home.php?mod=space&uid={$_G[uid]}&do=profile&mycenter=1&mobile=2" class="btn_home"><span></span></a>
        </div>
    </div>
    <!--{/if}-->
    <!--{if $showsearch}-->
    <form class="n-form" method="post" action="search.php?mod=forum&mobile=2" id="searchForm" accept-charset="UTF-8">
        <input type="hidden" name="formhash" value="{FORMHASH}">
        <input type="hidden" name="searchsubmit" value="yes">
        <div class="n-input-box">
            <input type="text" class="n-input" name="srchtxt" autocomplete="off" maxlength="2048" autocorrect="off" autocapitalize="off" placeholder="{$searchtxt}">
            <a href="javascript:void(0)" class="a2" id="a_query"></a>
        </div>
    </form>
    <!--{/if}-->
</div>
<div class="n-tab-box cl">
    <ul class=" cl">
        <!--{loop $nav_show $nav1}-->
        <li {$navwidth} <!--{if $_G[fid]==$nav1[2]}-->class="cur"<!--{/if}-->><a href="{$nav1[1]}">{$nav1[0]}</a></li>
        <!--{/loop}-->
        <!--{if $nav_current}-->
        <li {$navwidth} class="cur"><a href="{$nav_current[1]}">{$nav_current[0]}</a></li>
        <!--{/if}-->
        <!--{if $nav_hide}-->
        <li class="more-btn"><a href="javascript:;" onclick="$('.n-tab-ul').toggle();">{lang xigua_weban:more}<span></span></a></li>
        <!--{/if}-->
    </ul>
    <ul class="n-tab-ul cl" style="display:none">
        <!--{loop $nav_hide $nav1}-->
        <li><a href="{$nav1[1]}">{$nav1[0]}</a></li>
        <!--{/loop}-->
    </ul>
</div>

<!--{if $slider1}-->
<div class="swipe cl">
    <div class="swipe-wrap" style='height:$config[lunboheight]px'>
    <!--{loop $slider1 $thread}-->
        <!--{if $thread['displayorder'] > 0 && !$displayorder_thread}-->
        <!--{eval $displayorder_thread = 1;}-->
        <!--{/if}-->
        <!--{if $thread['moved']}-->
        <!--{eval $thread[tid]=$thread[closed];}-->
        <!--{/if}-->
        <div>
            <a href="forum.php?mod=viewthread&tid=$thread[tid]&extra=$extra">
                <img src="$pic[$thread[tid]]">
            </a>
            <div class="swipe-title">
                <a href="forum.php?mod=viewthread&tid=$thread[tid]&extra=$extra">{$thread[subject]}</a>
            </div>
        </div>
    <!--{/loop}-->
    </div>
    <nav class="bullets">
        <ul class="position">
            <!--{loop $slider1 $ks $thread}-->
                <li <!--{if $ks==0}-->class="current"<!--{/if}-->></li>
            <!--{/loop}-->
        </ul>
    </nav>
</div>
<!--{/if}-->

<!-- main threadlist start -->
<!--{if !$subforumonly}-->
<div class="threadlist1">
    <ul class="td" id="article-list">
        <!--{if $_G['forum_threadcount']}-->
        <!--{loop $_G['forum_threadlist'] $key $thread}-->
        <!--{if !$_G['setting']['mobile']['mobiledisplayorder3'] && $thread['displayorder'] > 0}-->
        {eval continue;}
        <!--{/if}-->
        <!--{if $thread['displayorder'] > 0 && !$displayorder_thread}-->
        {eval $displayorder_thread = 1;}
        <!--{/if}-->
        <!--{if $thread['moved']}-->
        <!--{eval $thread[tid]=$thread[closed];}-->
        <!--{/if}-->
        <li>
            <a class="cl" href="forum.php?mod=viewthread&tid=$thread[tid]&extra=$extra" $thread[highlight]>
                <!--{if $pic[$thread[tid]]}-->
                <img class="td-i" src="$pic[$thread[tid]]">
                <!--{/if}-->
                <div class="td-t">
                    <p>{$thread[subject]}</p>
                    <div class="cl"><em class="td-t-num">
                            <!--{if in_array($thread['displayorder'], array(1, 2, 3, 4))}-->
<!--                            <span class="icon_top">¶¥</span>-->
                            <!--{elseif $thread['digest'] > 0}-->
<!--                            <span class="icon_top">¾«</span>-->
                            <!--{elseif $thread['attachment'] == 2 && $_G['setting']['mobile']['mobilesimpletype'] == 0}-->
<!--                            <span class="icon_tu">Í¼</span>-->
                            <!--{/if}-->
                            $thread[author]</em>
                        <em class="td-t-num">{$thread[lastpost]}</em>
                        <!--{if $viewtype}-->
                        <span class="icon-commentnum">{$thread[replies]}</span>
                        <!--{else}-->
                        <span class="icon-viewnum">{$thread[views]}</span>
                        <!--{/if}-->
                    </div>
                </div>
            </a>

        </li>
        <!--{/loop}-->
        <!--{else}-->
<!--        <li>{lang xigua_weban:forum_nothreads}</li>-->
        <!--{/if}-->
    </ul>
</div>

<!--{/if}-->
<!-- main threadlist end -->

<div class="rich_tips tips_global loading_tips" id="js_cmt_loading" style="display:none">
    <img src="source/plugin/xigua_weban/static/icon_loading.gif"
         class="rich_icon icon_loading_white">
    <span class="tips">{lang xigua_weban:loading}</span>
</div>
<div id="mask"></div>
<div id="backtotop" class="backtotop"></div>
<script src="{$_G[siteurl]}source/plugin/xigua_weban/static/jquery-1.11.3.min.js"></script>
<!--<script src="source/plugin/xigua_weban/static/jquery.lazyload.min.js"></script>-->
<script src="{$_G[siteurl]}source/plugin/xigua_weban/static/slider.js?$version"></script>
<script src="{$_G[siteurl]}source/plugin/xigua_weban/static/common.js?$version"></script>
<script>
    $(function(){
        $('#a_query').on('click',function(){
            $('.n-form')[0].submit();
        });
        $('div.swipe').each(function () {
            runslider($(this));
        });
        $(window).scroll(function(){
            if(isbottom()){
                loadmoretheread();
            }
        });

        $(window).scroll(function() {
            if ($(window).scrollTop() > 300) {
                $('#backtotop').addClass('backtotop_show');
            } else {
                $('#backtotop').removeClass('backtotop_show')
            }
        });
        $('#backtotop').on('click', function () {
            $('body,html').animate({scrollTop: 0}, 500);
            return false;
        });

    });

    function runslider(_this) {
        var position = _this.find('ul.position');
        new Swipe2(_this[0], {
            startSlide: 0, speed: 500, auto: 3000, continuous: true, callback: function (index) {
                if (position.length > 0) {
                    var selectors = position[0].children;
                    for (var t = 0; t < selectors.length; t++) {
                        selectors[t].className = selectors[t].className.replace("current", "");
                    }
                    selectors[(index) % (selectors.length)].className = "current";
                }
            }
        });
    }

    function isbottom() {
        var scrollTop = 0;
        var clientHeight = 0;
        var scrollHeight = 0;
        if (document.documentElement && document.documentElement.scrollTop) {
            scrollTop = document.documentElement.scrollTop;
        } else if (document.body) {
            scrollTop = document.body.scrollTop;
        }
        if (document.body.clientHeight && document.documentElement.clientHeight) {
            clientHeight = (document.body.clientHeight < document.documentElement.clientHeight) ? document.body.clientHeight: document.documentElement.clientHeight;
        } else {
            clientHeight = (document.body.clientHeight > document.documentElement.clientHeight) ? document.body.clientHeight: document.documentElement.clientHeight;
        }
        scrollHeight = Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
        if (scrollTop + clientHeight == scrollHeight) {
            return true;
        } else {
            return false;
        }
    }
    function shwloading1(){
        $('#js_cmt_loading').show();
    }
    function hidloading1(){
        $('#js_cmt_loading').hide();
    }

    var comment_page = 2;
    var dataloading = 0;
    var realpage = $realpage;
    function loadmoretheread(){
        if(dataloading){
            return;
        }
        dataloading = 1;
        if(comment_page>realpage){
            return;
        }

        shwloading1();
        url = 'forum.php?mod=forumdisplay&fid=' + {$_G[fid]} + '&weban=1&mobile=2&inajax=1&page='+comment_page;

        $.ajax({
                type: 'POST',
                url: url,
                dataType: 'xml'
            })
            .success(function (s) {
                $('#article-list').append(s.lastChild.firstChild.nodeValue);
                hidloading1();
                comment_page++;
                dataloading = 0;
            })
            .error(function () {
                window.location.href = window.location.href;
                popup.close();
                hidloading1();
            });
    }
</script>
{$sharehtml}
</body>
</html>