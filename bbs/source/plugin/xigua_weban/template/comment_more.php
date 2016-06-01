<?php exit();?>
<!--{loop $comments $comment}-->
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
        <!--{$comment[dateline]}-->
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