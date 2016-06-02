<?php echo '模板巴士原创模板，版权所有，盗版必究，官网 www.mobanbus.cn';exit;?>
<div class="threadlist pb20">
	<h2 class="thread_tit"><!--{if $keyword}-->{lang search_result_keyword} <!--{if $modfid}--><a href="forum.php?mod=modcp&action=thread&fid=$modfid&keywords=$modkeyword&submit=true&do=search&page=$page" >{lang goto_memcp}</a><!--{/if}--><!--{else}-->{lang search_result}<!--{/if}--></h2>
	<!--{if empty($threadlist)}-->
	<ul><li><a href="javascript:;">{lang search_nomatch}</a></li></ul>
	<!--{else}-->
			<ul>
				<!--{loop $threadlist $thread}-->
				<li>
					<a href="forum.php?mod=viewthread&tid=$thread[realtid]&highlight=$index[keywords]"  $thread[highlight]>$thread[subject]</a>
				</li>
				<!--{/loop}-->
			</ul>
	<!--{/if}-->
	$multipage
</div>
