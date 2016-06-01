<?php echo '模板巴士原创模板，版权所有，盗版必究，官网 www.mobanbus.cn';exit;?>
<!--{eval $_G[forum_thread][special] = 0;}-->
<!-- main postlist start -->
	<!--{eval $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']);}-->
   <div class="bus_sd mb15 bus_replybd plc cl">
	   <span class="avatar"><img src="<!--{avatar($post[authorid], small, true)}-->" style="width:32px;height:32px;" /></span>
       <div class="bus_auther pt5">
	   <div class="avatar"><img src="<!--{if !$post['authorid'] || $post['anonymous']}--><!--{avatar(0, small, true)}--><!--{else}--><!--{avatar($post[authorid], small, true)}--><!--{/if}-->" /></div>
       <ul class="authi">
				<li class="grey">
					<!--{if $post['authorid'] && $post['username'] && !$post['anonymous']}-->
						<b><a href="home.php?mod=space&uid=$post[authorid]&do=profile&mobile=2" class="bus_colora">$post[author]</a><span class="ml10">{$post[authortitle]}</span></b>
					<!--{else}-->
						<!--{if !$post['authorid']}-->
						<a href="javascript:;">{lang guest} <em>$post[useip]{if $post[port]}:$post[port]{/if}</em></a>
						<!--{elseif $post['authorid'] && $post['username'] && $post['anonymous']}-->
						<!--{if $_G['forum']['ismoderator']}--><a href="home.php?mod=space&uid=$post[authorid]&do=profile&mobile=2">{lang anonymous}</a><!--{else}-->{lang anonymous}<!--{/if}-->
						<!--{else}-->
						$post[author] <em>{lang member_deleted}</em>
						<!--{/if}-->
					<!--{/if}-->
				</li>
				<li class="grey rela">
					<em class="bus_fr">
						<!--{if isset($post[isstick])}-->
							<img src ="{IMGDIR}/settop.png" title="{lang replystick}" class="vm" /> {lang from} {$post[number]}{$postnostick}
						<!--{elseif $post[number] == -1}-->
							<span style="color:#FB6156">{lang recommend_post}</span>
						<!--{else}-->
							<!--{if !empty($postno[$post[number]])}-->$postno[$post[number]]<!--{else}-->{$post[number]}{$postno[0]}<!--{/if}-->
						<!--{/if}-->
					</em>
					$post[dateline]
				</li>
       </ul>




       <div class="message" id="isfirst">
                	<!--{if $post['warned']}-->
                        <span class="grey quote">{lang warn_get}</span>
                    <!--{/if}-->
                    <!--{if !$post['first'] && !empty($post[subject])}-->
                        <h2><strong>$post[subject]</strong></h2>
                    <!--{/if}-->
                    <!--{if $_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])}-->
                        <div class="grey quote">{lang message_banned}</div>
                    <!--{elseif $_G['adminid'] != 1 && $post['status'] & 1}-->
                        <div class="grey quote">{lang message_single_banned}</div>
                    <!--{elseif $needhiddenreply}-->
                        <div class="grey quote">{lang message_ishidden_hiddenreplies}</div>
                    <!--{elseif $post['first'] && $_G['forum_threadpay']}-->
						<!--{template forum/viewthread_pay}-->
					<!--{else}-->

                    	<!--{if $_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))}-->
                            <div class="grey quote">{lang admin_message_banned}</div>
                        <!--{elseif $post['status'] & 1}-->
                            <div class="grey quote">{lang admin_message_single_banned}</div>
                        <!--{/if}-->

                        <!--{if $post['first'] && $threadsort && $threadsortshow}-->
                        	<!--{if $threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']}-->
                                <!--{if $threadsortshow['optionlist'] == 'expire'}-->
                                    {lang has_expired}
                                <!--{else}-->
                                    <div class="box_ex2 viewsort">
                                        <h4>$_G[forum][threadsorts][types][$_G[forum_thread][sortid]]</h4>
                                    <!--{loop $threadsortshow['optionlist'] $option}-->
                                        <!--{if $option['type'] != 'info'}-->
                                            $option[title]: <!--{if $option['value']}-->$option[value] $option[unit]<!--{else}--><span class="grey">--</span><!--{/if}--><br />
                                        <!--{/if}-->
                                    <!--{/loop}-->
                                    </div>
                                <!--{/if}-->
                            <!--{/if}-->
                        <!--{/if}-->
                        <!--{if $post['first']}-->
							<!--{if $threadsortshow['typetemplate']}-->
								$threadsortshow[typetemplate]
								<div class="clear"></div>
								<p>$post[message]</p>
							<!--{elseif $threadsortshow['optionlist']}-->
								<div class="typeoption">
									<!--{if $threadsortshow['optionlist'] == 'expire'}-->
										{lang has_expired}
									<!--{else}-->
										<table summary="{lang threadtype_option}" cellpadding="0" cellspacing="0" class="cgtl mbm">
											<caption>$_G[forum][threadsorts][types][$_G[forum_thread][sortid]]</caption>
											<tbody>
												<!--{loop $threadsortshow['optionlist'] $option}-->
													<!--{if $option['type'] != 'info'}-->
														<tr>
															<th>$option[title]:</th>
															<td><!--{if $option['value'] !== ''}-->$option[value] $option[unit]<!--{else}-->-<!--{/if}--></td>
														</tr>
													<!--{/if}-->
												<!--{/loop}-->
											</tbody>
										</table>
									<!--{/if}-->
								</div>
								<div class="clear"></div>
 								<p>$post[message]</p>
                           <!--{elseif !$_G[forum_thread][special]}-->
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
					
					<!--{if $_G['setting']['mobile']['mobilesimpletype'] == 0}-->
					<!--{if $post['attachment']}-->
					   <div class="grey quote">
					   {lang attachment}: <em><!--{if $_G['uid']}-->{lang attach_nopermission}<!--{else}-->{lang attach_nopermission_login}<!--{/if}--></em>
					   </div>
					<!--{elseif $post['imagelist'] || $post['attachlist']}-->
					   <!--{if $post['imagelist']}-->
						<!--{if count($post['imagelist']) == 1}-->
						<ul class="img_one">{echo showattach($post, 1)}</ul>
						<!--{else}-->
						<ul class="img_list cl vm">{echo showattach($post, 1)}</ul>
						<!--{/if}-->
						<!--{/if}-->
						<!--{if $post['attachlist']}-->
						<ul>{echo showattach($post)}</ul>
						<!--{/if}-->
					<!--{/if}-->
					<!--{/if}-->					
			</div>
			<!-- Mobanbus_cn message end -->





       </div>
   </div>
<!-- main postlist end -->
