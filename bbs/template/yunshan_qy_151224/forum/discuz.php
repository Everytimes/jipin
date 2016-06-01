<?php exit('Desgin By http://addon.discuz.com/?@51353.developer Access Denied ');?>
<!--{template common/header}-->
<div class="reset-box-sizing">
<div class="row" style="display:none;">
<div id="pt" class="bm col-md-12 cl">
	<!--{if empty($gid) && $announcements}-->
	<div class="y">
		<div id="an">
			<dl class="cl">
				<dt class="z xw1">{lang announcements}:&nbsp;</dt>
				<dd>
					<div id="anc"><ul id="ancl">$announcements</ul></div>
				</dd>
			</dl>
		</div>
		<script type="text/javascript">announcement();</script>
	</div>
	<!--{/if}-->
	<div class="z">
		<a href="./" class="nvhm" title="{lang homepage}">$_G[setting][bbname]</a><em>&raquo;</em><a href="forum.php">{$_G[setting][navs][2][navname]}</a>$navigation
	</div>
	<div class="z"><!--{hook/index_status_extra}--></div>
</div>
</div>

<!--{if empty($gid)}-->
	<!--{ad/text/wp a_t}-->
<!--{/if}-->

	<style id="diy_style" type="text/css"></style>

<!--{if empty($gid)}-->
	<div class="row">
    	<div class="col-md-12">
		<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
        </div>
	</div>
<!--{/if}-->
<!--#chart-->
<!--{if empty($gid)}-->
<div class="row">
            <div class="col-md-12">
                <div class="bbs_info_box cl">
                    <ul>
                        <li>
                            <p class="p_1"></p>{lang index_today}：$todayposts</li>
                        <li>
                            <p class="p_2"></p>{lang index_yesterday}: $postdata[0]</li>
                        <!--<li>
                            <p class="p_3"></p>最高日：21</li>-->
                        <li>
                            <p class="p_4"></p>{lang index_posts}：$posts</li>
                        <li>
                            <p class="p_5"></p>{lang index_members}：$_G['cache']['userstats']['totalmembers']</li>
                        <!--{if $_G['cache']['userstats']['newsetuser']}--><li>
                            <p class="p_6"></p>新会员：$_G['cache']['userstats']['newsetuser']</li><!--{/if}-->
                        <!--{hook/index_nav_extra}-->
                    </ul>
                </div>
            </div>
        </div>
<!--{/if}-->
<!--[diy=diy_chart]--><div id="diy_chart" class="area"></div><!--[/diy]-->
<div id="ct" class="wp cl">
	<div class="mn">
		<!--{hook/index_top}-->
        <!--{hook/index_catlist_top}-->
		<!--{loop $catlist $key $cat}-->
			<!--{hook/index_catlist $cat[fid]}-->
           <div class="forum_group cl">
				<div class="forum_group_cname">
					<span class="o pull-right">
						<img id="category_$cat[fid]_img" src="{IMGDIR}/$cat[collapseimg]" title="{lang spread}" alt="{lang spread}" onclick="toggle_collapse('category_$cat[fid]');" />
					</span>
					<!--{if $cat['moderators']}--><span class="y">{lang forum_category_modedby}: $cat[moderators]</span><!--{/if}-->
					<!--{eval $caturl = !empty($cat['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$cat['domain'].'.'.$_G['setting']['domain']['root']['forum'] : '';}-->
					<a class="ft16" href="{if !empty($caturl)}$caturl{else}forum.php?gid=$cat[fid]{/if}">$cat[name]</a>
            	</div>
                <div class="col-md-12 box-reset"><span class="box-topline"></span></div>
                <div id="category_$cat[fid]" class="row box-reset" style="{echo $collapse['category_'.$cat[fid]]}">
					<!--{loop $cat[forums] $forumid}-->
						<!--{eval $forum=$forumlist[$forumid];}-->
						<!--{eval $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forum['fid'];}-->
                        <!--{eval $forum_icon = DB::fetch_first('SELECT icon from %t where fid = %d',array('forum_forumfield',$forum['fid']));}-->
                        <!--{if $cat['forumcolumns']}-->
                            <!--{if $forum['orderid'] && ($forum['orderid'] % $cat['forumcolumns'] == 0)}-->
                                <!--{if $forum['orderid'] < $cat['forumscount']}--><!--{/if}-->
                            <!--{/if}-->
                    <div class="hidden_ipad">
                    <div class="col-md-3 box-reset">
                         <div class="forum-list-one box-rightline">
                             <a href="$forumurl">
                              <!--{if $forum[icon]}-->
                              <img alt="$forum[name]" src="data/attachment/common/$forum_icon['icon']" class="img-circle">
                              <!--{else}-->
							  <img src="{IMGDIR}/forum{if $forum[folder]}_new{/if}.gif" alt="$forum[name]" />
							 <!--{/if}-->
                              <strong >$forum[name]</strong>
                              <!--{if $forum[description]}--><p>$forum[description]</p><!--{/if}-->
                              </a>
                         </div>
                     </div>
        			</div>
                    <div class="hidden_pc">
                    
                    <div class="col-sm-4 col-xs-4 box-reset">
                         <div class="forum-list-one box-rightline">
                        	
                             <a href="$forumurl">
                              <!--{if $forum[icon]}-->
                             
                              
                              <img alt="$forum[name]" src="data/attachment/common/$forum_icon['icon']" class="img-circle">
                              <!--{else}-->
							  <img src="{IMGDIR}/forum{if $forum[folder]}_new{/if}.gif" alt="$forum[name]" />
							 <!--{/if}-->
                              <strong >$forum[name]</strong>
                             
                              </a>
                         </div>
                     </div>
        			</div>
					
						<!--{else}-->
							<div class="hidden_ipad">
                   
                    <div class="col-md-12 box-reset">
                         <div class="forum-list-no-columns">
                        	<div class="col-xs-12 col-md-2">
                                <div class="forum-list-no-columns-icon">
                                 <a href="$forumurl">
                                  <!--{if $forum[icon]}-->
                                 
                                  
                                  <img alt="$forum[name]" src="data/attachment/common/$forum_icon['icon']" class="img-circle vm">
                                  <!--{else}-->
                                  <img src="{IMGDIR}/forum{if $forum[folder]}_new{/if}.gif" alt="$forum[name]" class="img-circle vm" />
                                 <!--{/if}-->
                                 
                                  </a>
                                  </div>
                             </div>
                             <div class="col-md-10">
                                 <div class="forum-name">
                                 <a href="$forumurl"{if $forum[redirect]} target="_blank"{/if}{if $forum[extra][namecolor]} style="color: {$forum[extra][namecolor]};"{/if} class="ft16">$forum[name]<!--{if $forum[todayposts] && !$forum['redirect']}--><em class="xw0 xi1" title="{lang forum_todayposts}"> ($forum[todayposts])</em><!--{/if}--></a>
                                 </div>
                             </div>
                             <div class="col-md-10">
                             <div class="forum-list-info">
                              <!--{if $forum[description]}--><p>$forum[description]</p><!--{/if}-->
                              <!--{if $forum['subforums']}--><p>{lang forum_subforums}: $forum['subforums']</p><!--{/if}-->
							<!--{if $forum['moderators']}--><p>{lang forum_moderators}: <span class="xi2">$forum[moderators]</span></p><!--{/if}-->
							<!--{hook/index_forum_extra $forum[fid]}-->
                            	<p><!--{if empty($forum[redirect])}-->主题：<span class="xi2"><!--{echo dnumber($forum[threads])}--></span><span class="pipe"></span>帖子：<span class="xg1"><!--{echo dnumber($forum[posts])}--></span><!--{/if}-->
                                <!--{if $forum['permission'] == 1}-->
									{lang private_forum}
								<!--{else}-->
									<!--{if $forum['redirect']}-->
										<a href="$forumurl" class="xi2">{lang url_link}</a>
									<!--{elseif is_array($forum['lastpost'])}-->
                                    	<span class="pipe"></span><!--{if $forum['lastpost']['author']}-->$forum['lastpost']['author']    <!--{else}-->$_G[setting][anonymoustext] <!--{/if}--><cite>$forum[lastpost][dateline]</cite>回复 <a href="forum.php?mod=redirect&tid=$forum[lastpost][tid]&goto=lastpost#lastpost" class="xi2"><!--{echo cutstr($forum[lastpost][subject], 30)}--></a> 
									<!--{else}-->
										{lang never}
									<!--{/if}-->
								<!--{/if}-->
                               </p>
                              </div>
                             </div>
                             </div>
                         </div>
                     </div>
        			
                    
                    
                    <div class="hidden_pc">
                    <div class="col-md-12 box-reset"><span class="box-topline hidden_ipad"></span></div>
                    <div class="col-md-12 box-reset">
                         <div class="forum-list-no-columns">
                        	<div class="col-xs-2 col-md-2">
                            <div class="forum-list-no-columns-icon">
                             <a href="$forumurl">
                              <!--{if $forum[icon]}-->
                              <!--{eval include TPLDIR.'/php/1.php';}-->
                              
                              <img alt="$forum[name]" src="data/attachment/common/$forum_icon['icon']" class="img-circle vm">
                              <!--{else}-->
							  <img src="{IMGDIR}/forum{if $forum[folder]}_new{/if}.gif" alt="$forum[name]" class="img-circle vm" />
							 <!--{/if}-->
                             
                              </a>
                              </div>
                             </div>
                             <div class="col-xs-10 col-md-10">
                             <div class="forum-name">
                             <a href="$forumurl"{if $forum[redirect]} target="_blank"{/if}{if $forum[extra][namecolor]} style="color: {$forum[extra][namecolor]};"{/if} class="ft16">$forum[name]<!--{if $forum[todayposts] && !$forum['redirect']}--><em class="xw0 xi1" title="{lang forum_todayposts}"> ($forum[todayposts])</em><!--{/if}--></a>
                             </div>
                             </div>
                             <div class="col-xs-10 col-md-10">
                             <div class="forum-list-info">
                              <!--{if $forum[description]}--><p>$forum[description]</p><!--{/if}-->
                              <!--{if $forum['subforums']}--><p>{lang forum_subforums}: $forum['subforums']</p><!--{/if}-->
							<!--{if $forum['moderators']}--><p>{lang forum_moderators}: <span class="xi2">$forum[moderators]</span></p><!--{/if}-->
							<!--{hook/index_forum_extra $forum[fid]}-->
                            	<p><!--{if empty($forum[redirect])}-->主题：<span class="xi2"><!--{echo dnumber($forum[threads])}--></span><span class="pipe"></span>帖子：<span class="xg1"><!--{echo dnumber($forum[posts])}--></span><!--{/if}-->
                                <!--{if $forum['permission'] == 1}-->
									{lang private_forum}
								<!--{else}-->
									<!--{if $forum['redirect']}-->
										<a href="$forumurl" class="xi2">{lang url_link}</a>
									<!--{elseif is_array($forum['lastpost'])}-->
                                    	<span class="pipe"></span><!--{if $forum['lastpost']['author']}-->$forum['lastpost']['author']    <!--{else}-->$_G[setting][anonymoustext] <!--{/if}--><cite>$forum[lastpost][dateline]</cite>回复 <a href="forum.php?mod=redirect&tid=$forum[lastpost][tid]&goto=lastpost#lastpost" class="xi2"><!--{echo cutstr($forum[lastpost][subject], 30)}--></a> 
									<!--{else}-->
										{lang never}
									<!--{/if}-->
								<!--{/if}-->
                               </p>
                              </div>
                             </div>
                             </div>
                         </div>
                     </div>
        			
						<!--{/if}-->
						<!--{/loop}-->
						
						
				</div>
			</div>
			<!--{ad/intercat/bm a_c/$cat[fid]}-->
		<!--{/loop}-->
			

		</div>

		<!--{hook/index_middle}-->
		<div class="wp mtn">
			<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
		</div>

		<!--{if empty($gid) && $_G['setting']['whosonlinestatus']}-->
			<div id="online" class="bm oll">
				<div class="forum_group_cname">
				<!--{if $detailstatus}-->
					<span class="o pull-right"><a href="forum.php?showoldetails=no#online" title="{lang spread}"><img src="{IMGDIR}/collapsed_no.gif" alt="{lang spread}" /></a></span>
					
						<a href="home.php?mod=space&do=friend&view=online&type=member" class="ft16">{lang onlinemember}</a>
						<span class="xs1">- <strong>$onlinenum</strong> {lang onlines}
						- <strong>$membercount</strong> {lang index_members}(<strong>$invisiblecount</strong> {lang index_invisibles}),
						<strong>$guestcount</strong> {lang index_guests}
						- {lang index_mostonlines} <strong>$onlineinfo[0]</strong> {lang on} <strong>$onlineinfo[1]</strong>.</span>
					
				<!--{else}-->
					<!--{if empty($_G['setting']['sessionclose'])}-->
						<span class="o pull-right"><a href="forum.php?showoldetails=yes#online" title="{lang spread}"><img src="{IMGDIR}/collapsed_yes.gif" alt="{lang spread}" /></a></span>
					<!--{/if}-->
					<h3>
						<strong>
							<!--{if !empty($_G['setting']['whosonlinestatus'])}-->
								{lang onlinemember}
							<!--{else}-->
								<a href="home.php?mod=space&do=friend&view=online&type=member">{lang onlinemember}</a>
							<!--{/if}-->
						</strong>
						<span class="xs1">- {lang total} <strong>$onlinenum</strong> {lang onlines}
						<!--{if $membercount}-->- <strong>$membercount</strong> {lang index_members},<strong>$guestcount</strong> {lang index_guests}<!--{/if}-->
						- {lang index_mostonlines} <strong>$onlineinfo[0]</strong> {lang on} <strong>$onlineinfo[1]</strong>.</span>
					</h3>
				<!--{/if}-->
				</div>
                <div class="col-md-12 box-reset"><span class="box-topline"></span></div>
			<!--{if $_G['setting']['whosonlinestatus'] && $detailstatus}-->
				<dl id="onlinelist" class=" bm_c unreset-box-sizing">
					<dt class="ptm pbm bbda">$_G[cache][onlinelist][legend]</dt>
					<!--{if $detailstatus}-->
						<dd class="ptm pbm">
						<ul class="cl">
						<!--{if $whosonline}-->
							<!--{loop $whosonline $key $online}-->
								<li title="{lang time}: $online[lastactivity]">
								<img src="{STATICURL}image/common/$online[icon]" alt="icon" />
								<!--{if $online['uid']}-->
									<a href="home.php?mod=space&uid=$online[uid]">$online[username]</a>
								<!--{else}-->
									$online[username]
								<!--{/if}-->
								</li>
							<!--{/loop}-->
						<!--{else}-->
							<li style="width: auto">{lang online_only_guests}</li>
						<!--{/if}-->
						</ul>
					</dd>
					<!--{/if}-->
				</dl>
			<!--{/if}-->
			</div>
		<!--{/if}-->

		<!--{if empty($gid) && ($_G['cache']['forumlinks'][0] || $_G['cache']['forumlinks'][1] || $_G['cache']['forumlinks'][2])}-->
		<div class="bm lk unreset-box-sizing">
			<div id="category_lk" class="bm_c ptm">
				<!--{if $_G['cache']['forumlinks'][0]}-->
					<ul class="m mbn cl">$_G['cache']['forumlinks'][0]</ul>
				<!--{/if}-->
				<!--{if $_G['cache']['forumlinks'][1]}-->
					<div class="mbn cl">
						$_G['cache']['forumlinks'][1]
					</div>
				<!--{/if}-->
				<!--{if $_G['cache']['forumlinks'][2]}-->
					<ul class="x mbm cl">
						$_G['cache']['forumlinks'][2]
					</ul>
				<!--{/if}-->
			</div>
		</div>
		<!--{/if}-->

		<!--{hook/index_bottom}-->
	</div>

	<!--{if $_G['setting']['forumallowside']}-->
			<!--{hook/index_side_bottom}-->
	<!--{/if}-->
</div>
<!--{if $_G['group']['radminid'] == 1}-->
	<!--{eval helper_manyou::checkupdate();}-->
<!--{/if}-->
<!--{if empty($_G['setting']['disfixednv_forumindex']) }--><script>fixed_top_nv();</script><!--{/if}-->
</div>
<!--{template common/footer}-->

