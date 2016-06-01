<?php exit();?>
<!--{loop $postlist $post}-->
<!--{if !$post['first']}-->
<!--{subtemplate xigua_weban:viewthread_node}-->
<!--{/if}-->
<!--{/loop}-->
<script>realpage = $realpage;</script>