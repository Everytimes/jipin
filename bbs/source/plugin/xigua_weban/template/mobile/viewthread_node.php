<?php exit();?>
<!--{eval $_G[forum_thread][special] = 0;}-->
<!--{eval $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']);}-->
<div class="discuss_item cl" id="topic{$post[pid]}">
    <div class="avatar user_info"><img src="<!--{avatar($post[authorid], small, true)}-->" /></div>
    <!--{if !($_G['setting']['threadfilternum'] && $_G['setting']['filterednovote'] && getstatus($post['status'], 11))}-->
    <div class="discuss_opr">
        <div class="meta_praise icon_praise" data-pid="{$post[pid]}" id="datapid-{$post[pid]}" onclick="return dorecomm($(this))">
            <i class="icon_praise_gray<!--{if isset($hotrep[$post[pid]])}--> praised<!--{/if}-->"></i><span class="praise_num">{eval echo intval($post[postreview][support])}</span>
        </div>
    </div>
    <!--{/if}-->
    <div class="nickname user_info" id="nickname_{$post[pid]}">
        <!--{if $post['authorid'] && $post['username'] && !$post['anonymous']}-->
        $post[author]
        <!--{else}-->
        <!--{if !$post['authorid']}-->
        {$lang[guest]} <span>$post[useip]{if $post[port]}:$post[port]{/if}</span>
        <!--{elseif $post['authorid'] && $post['username'] && $post['anonymous']}-->
        {$lang[anonymous]}
        <!--{else}-->
        $post[author] <span>{$lang[member_deleted]}</span>
        <!--{/if}-->
        <!--{/if}-->
    </div>
    <div class="discuss_message" id="message_{$post[pid]}">
        <!--{if $post['warned']}-->
        <span class="grey quote">{$lang[warn_get]}</span>
        <!--{/if}-->
        <!--{if !$post['first'] && !empty($post[subject])}-->
        <h2><strong>$post[subject]</strong></h2>
        <!--{/if}-->
        <!--{if $_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])}-->
        <div class="grey quote">{$lang[message_banned]}</div>
        <!--{elseif $_G['adminid'] != 1 && $post['status'] & 1}-->
        <div class="grey quote">{$lang[message_single_banned]}</div>
        <!--{elseif $needhiddenreply}-->
        <div class="grey quote">{$lang[message_ishidden_hiddenreplies]}</div>
        <!--{elseif $post['first'] && $_G['forum_threadpay']}-->
        <!--{template forum/viewthread_pay}-->
        <!--{else}-->

        <!--{if $_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))}-->
        <div class="grey quote">{$lang[admin_message_banned]}</div>
        <!--{elseif $post['status'] & 1}-->
        <div class="grey quote">{$lang[admin_message_single_banned]}</div>
        <!--{/if}-->
        <!--{if $_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0}-->
        {$lang[pay_threads]}: <strong>$_G[forum_thread][price] {$_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]][unit]}{$_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]][title]} </strong> <a href="forum.php?mod=misc&action=viewpayments&tid=$_G[tid]" >{$lang[pay_view]}</a>
        <!--{/if}-->

        <!--{if $post['first'] && $threadsort && $threadsortshow}-->
        <!--{if $threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']}-->
        <!--{if $threadsortshow['optionlist'] == 'expire'}-->
        {$lang[has_expired]}
        <!--{else}-->
        <div class="box_ex2 viewsort">
            <h4>$_G[forum][threadsorts][types][$_G[forum_thread][sortid]]</h4>
            <!--{loop $threadsortshow['optionlist'] $option}-->
            <!--{if $option['type'] != 'info'}-->
            $option[title]: <!--{if $option['value']}-->$option[value] $option[unit]<!--{else}--><span class="xg1">--</span><!--{/if}--><br />
            <!--{/if}-->
            <!--{/loop}-->
        </div>
        <!--{/if}-->
        <!--{/if}-->
        <!--{/if}-->
        <!--{if $post['first']}-->
        <!--{if !$_G[forum_thread][special]}-->
        $post[message]
        <!--{elseif $_G[forum_thread][special] == 1}-->
        <!--{template forum/viewthread_poll}-->
        <!--{elseif $_G[forum_thread][special] == 2}-->
        <!--{template forum/viewthread_trade}-->
        <!--{elseif $_G[forum_thread][special] == 3}-->
        <!--{template forum/viewthread_reward}-->
        <!--{elseif $_G[forum_thread][special] == 4}-->
        <!--{template forum/viewthread_activity}-->
        <!--{elseif $_G[forum_thread][special] == 5}-->
        <!--{template forum/viewthread_debate}-->
        <!--{elseif $threadplughtml}-->
        $threadplughtml
        $post[message]
        <!--{else}-->
        $post[message]
        <!--{/if}-->
        <!--{else}-->
        $post[message]
        <!--{/if}-->
        <!--{/if}-->


        <!--{if $post['attachment']}-->
            <div class="grey quote">
                {$lang[attachment]}: <em><!--{if $_G['uid']}-->{$lang[attach_nopermission]}<!--{else}-->{$lang[attach_nopermission_login]}<!--{/if}--></em>
            </div>
        <!--{elseif $post['imagelist'] || $post['attachlist']}-->
            <!--{if $post['imagelist']}-->
                <ul class="img_list cl vm">{echo showattach($post, 1)}</ul>
            <!--{/if}-->
            <!--{if $post['attachlist']}-->
                <ul>{echo showattach($post)}</ul>
            <!--{/if}-->
        <!--{/if}-->
    </div>
    <div class="discuss_extra_info">$post[dateline]
    <!--{if $_G['group']['allowdelpost']}-->
        <form id="topicadminform{$post[pid]}" style="display:none" method="post" autocomplete="off" action="forum.php?mod=topicadmin&action=delpost&modsubmit=yes&modclick=yes&mobile=2" >
            <input type="hidden" name="formhash" value="{FORMHASH}" />
            <input type="hidden" name="fid" value="$_G[fid]" />
            <input type="hidden" name="tid" value="$_G[tid]" />
            <input type="hidden" name="page" value="{$page}" />
            <input type="hidden" name="reason" value="{$lang[topicadmin_mobile_mod]}" />
            <input type="hidden" name="topiclist[]" value="{$post[pid]}" />
            <input type="hidden" name="modsubmit" value="1">
        </form>
        <a class="discuss_del" onclick="return dialogdel({$post[pid]});">{$lang[modmenu_deletepost]}</a>
    <!--{/if}-->
        <!--{if $_G[uid] && $config[showrep] }--><a onclick="return showcmtreply({$post[pid]});">{$lang[follow_quickreply]}</a><!--{/if}-->
    </div>

    <!--{if $_GET['from'] != 'preview' && $_G['setting']['commentnumber'] && !empty($comments[$post[pid]])}-->
    <div id="comment_$post[pid]" class="reply_result">
        <!--{loop $comments[$post[pid]] $comment}-->
        <div id="comment1_$comment[id]">
            <div class="nickname">
                <!--{if $comment['authorid']}-->
                $comment[author]
                <!--{else}-->
                {lang guest}
                <!--{/if}-->
            </div>
            <div class="discuss_message">
                $comment[comment]
            </div>

            <div class="discuss_extra_info">
                <!--{date($comment[dateline], 'u')}-->
                <!--{if $_G['forum']['ismoderator'] && $_G['group']['allowdelpost']}-->
                <a href="javascript:;" onclick="return delcomment($comment[id])">{$lang[delete]}</a>
                <form style="display:none" id="comment_form_{$comment[id]}" method="post" autocomplete="off" action="forum.php?mod=topicadmin&action=delcomment&modsubmit=yes&infloat=yes&modclick=yes" >
                        <input type="hidden" name="formhash" value="{FORMHASH}" />
                        <input type="hidden" name="fid" value="$_G[fid]" />
                        <input type="hidden" name="tid" value="$_G[tid]" />
                        <input type="hidden" name="reason" value="" />
                        <input type="hidden" name="sendreasonpm" value="1">
                        <input type="hidden" name="topiclist" value="{$comment[id]}">
                        <input type="hidden" name="modsubmit" value="1" />
                </form>
                <!--{/if}-->
            </div>
        </div>
        <!--{/loop}-->
        <!--{if $commentcount[$post[pid]] > $_G['setting']['commentnumber']}-->
        <div id="comment_more_{$post[pid]}">
            <a href="javascript:;" onclick="return commentget($post[tid],$post[pid])">{lang xigua_weban:more}</a>
        </div>
        <!--{/if}-->
    </div>
    <!--{/if}-->

</div>