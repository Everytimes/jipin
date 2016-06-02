<?php exit('Desgin By http://addon.discuz.com/?@51353.developer Access Denied ');?>
<!--{subtemplate common/header_common}-->
	<meta name="application-name" content="$_G['setting']['bbname']" />
	<meta name="msapplication-tooltip" content="$_G['setting']['bbname']" />
	<!--{if $_G['setting']['portalstatus']}--><meta name="msapplication-task" content="name=$_G['setting']['navs'][1]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['portal']) ? 'http://'.$_G['setting']['domain']['app']['portal'] : $_G[siteurl].'portal.php'};icon-uri={$_G[siteurl]}{IMGDIR}/portal.ico" /><!--{/if}-->
	<meta name="msapplication-task" content="name=$_G['setting']['navs'][2]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['forum']) ? 'http://'.$_G['setting']['domain']['app']['forum'] : $_G[siteurl].'forum.php'};icon-uri={$_G[siteurl]}{IMGDIR}/bbs.ico" />
	<!--{if $_G['setting']['groupstatus']}--><meta name="msapplication-task" content="name=$_G['setting']['navs'][3]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['group']) ? 'http://'.$_G['setting']['domain']['app']['group'] : $_G[siteurl].'group.php'};icon-uri={$_G[siteurl]}{IMGDIR}/group.ico" /><!--{/if}-->
	<!--{if helper_access::check_module('feed')}--><meta name="msapplication-task" content="name=$_G['setting']['navs'][4]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['home']) ? 'http://'.$_G['setting']['domain']['app']['home'] : $_G[siteurl].'home.php'};icon-uri={$_G[siteurl]}{IMGDIR}/home.ico" /><!--{/if}-->
	<!--{if $_G['basescript'] == 'forum' && $_G['setting']['archiver']}-->
		<link rel="archives" title="$_G['setting']['bbname']" href="{$_G[siteurl]}archiver/" />
	<!--{/if}-->
	<!--{if !empty($rsshead)}-->$rsshead<!--{/if}-->
	<!--{if $_G['basescript'] == 'forum' || $_G['basescript'] == 'group'}-->
		<script type="text/javascript" src="{$_G[setting][jspath]}forum.js?{VERHASH}"></script>
	<!--{elseif $_G['basescript'] == 'home' || $_G['basescript'] == 'userapp'}-->
		<script type="text/javascript" src="{$_G[setting][jspath]}home.js?{VERHASH}"></script>
	<!--{elseif $_G['basescript'] == 'portal'}-->
		<script type="text/javascript" src="{$_G[setting][jspath]}portal.js?{VERHASH}"></script>
	<!--{/if}-->
	<!--{if $_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
		<script type="text/javascript" src="{$_G[setting][jspath]}portal.js?{VERHASH}"></script>
	<!--{/if}-->
    <!--{if $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
    <link rel="stylesheet" type="text/css" id="diy_common" href="data/cache/style_{STYLEID}_css_diy.css?{VERHASH}" />
    <!--{/if}-->
	
	
	<script src="{$_G[style][styleimgdir]}/js/jquery-1.11.3.min.js?{VERHASH}"></script>
    <script>jQuery.noConflict();</script>
    <script src="{$_G[style][styleimgdir]}/js/jquery.SuperSlide.2.1.1.js?{VERHASH}"></script>
	
    <link rel="stylesheet" href="{$_G[style][styleimgdir]}/font_awesome/css/font-awesome.min.css?{VERHASH}">
    <link rel="stylesheet" type="text/css" href="{$_G[style][styleimgdir]}/style.css?{VERHASH}">
    <!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="{$_G[style][styleimgdir]}/iefix.css?{VERHASH}">
    <script src="{$_G[style][styleimgdir]}/js/html5shiv.min.js?{VERHASH}"></script>
    <script src="{$_G[style][styleimgdir]}/js/respond.min.js?{VERHASH}"></script>
    <![endif]-->
    <script language="javascript" type="text/javascript">
	function killErrors(){
		return true;
		}
	window.onerror = killErrors;
    </script>
</head>

<body id="nv_{$_G[basescript]}" class="pg_{CURMODULE}{if $_G['basescript'] === 'portal' && CURMODULE === 'list' && !empty($cat)} {$cat['bodycss']}{/if}" onkeydown="if(event.keyCode==27) return false;">
	<div id="append_parent"></div><div id="ajaxwaitid"></div>
	<!--{if $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
		<!--{template common/header_diy}-->
	<!--{/if}-->
	<!--{if check_diy_perm($topic)}-->
		<!--{template common/header_diynav}-->
	<!--{/if}-->
	<!--{if CURMODULE == 'topic' && $topic && empty($topic['useheader']) && check_diy_perm($topic)}-->
		$diynav
	<!--{/if}-->
	<!--{if empty($topic) || $topic['useheader']}-->
		<!--{if $_G['setting']['mobile']['allowmobile'] && (!$_G['setting']['cacheindexlife'] && !$_G['setting']['cachethreadon'] || $_G['uid']) && ($_GET['diy'] != 'yes' || !$_GET['inajax']) && ($_G['mobile'] != '' && $_G['cookie']['mobile'] == '' && $_GET['mobile'] != 'no')}-->
			<div class="xi1 bm bm_c">
			    {lang your_mobile_browser}<a href="{$_G['siteurl']}forum.php?mobile=yes">{lang go_to_mobile}</a> <span class="xg1">|</span> <a href="$_G['setting']['mobile']['nomobileurl']">{lang to_be_continue}</a>
			</div>
		<!--{/if}-->
		<!--{if $_G['setting']['shortcut'] && $_G['member'][credits] >= $_G['setting']['shortcut']}-->
			<div id="shortcut">
				<span><a href="javascript:;" id="shortcutcloseid" title="{lang close}">{lang close}</a></span>
				{lang shortcut_notice}
				<a href="javascript:;" id="shortcuttip">{lang shortcut_add}</a>

			</div>
			<script type="text/javascript">setTimeout(setShortcut, 2000);</script>
		<!--{/if}-->
		<div id="toptb" class="cl" style="display:none;">
			<!--{hook/global_cpnav_top}-->
			<div class="wp">
				<div class="z">
					<!--{loop $_G['setting']['topnavs'][0] $nav}-->
						<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}-->$nav[code]<!--{/if}-->
					<!--{/loop}-->
					<!--{hook/global_cpnav_extra1}-->
				</div>
				<div class="y">
					<a id="switchblind" href="javascript:;" onclick="toggleBlind(this)" title="{lang switch_blind}" class="switchblind">{lang switch_blind}</a>
					<!--{hook/global_cpnav_extra2}-->
					<!--{loop $_G['setting']['topnavs'][1] $nav}-->
						<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}-->$nav[code]<!--{/if}-->
					<!--{/loop}-->
					<!--{if $_G['uid'] && !empty($_G['style']['extstyle'])}--><a id="sslct" href="javascript:;" onmouseover="delayShow(this, function() {showMenu({'ctrlid':'sslct','pos':'34!'})});">{lang changestyle}</a><!--{/if}-->
					<!--{if check_diy_perm($topic)}-->
						$diynav
					<!--{/if}-->
				</div>
			</div>
		</div>

		<!--{if !IS_ROBOT}-->
			<!--{if $_G['uid']}-->
			<ul id="myprompt_menu" class="p_pop" style="display: none;">
				<li><a href="home.php?mod=space&do=pm" id="pm_ntc" style="background-repeat: no-repeat; background-position: 0 50%;"><em class="prompt_news{if empty($_G[member][newpm])}_0{/if}"></em>{lang pm_center}</a></li>
				<li><a href="home.php?mod=follow&do=follower"><em class="prompt_follower{if empty($_G[member][newprompt_num][follower])}_0{/if}"></em><!--{lang notice_interactive_follower}-->{if $_G[member][newprompt_num][follower]}($_G[member][newprompt_num][follower]){/if}</a></li>
				<!--{if $_G[member][newprompt] && $_G[member][newprompt_num][follow]}-->
					<li><a href="home.php?mod=follow"><em class="prompt_concern"></em><!--{lang notice_interactive_follow}-->($_G[member][newprompt_num][follow])</a></li>
				<!--{/if}-->
				<!--{if $_G[member][newprompt]}-->
					<!--{loop $_G['member']['category_num'] $key $val}-->
						<li><a href="home.php?mod=space&do=notice&view=$key"><em class="notice_$key"></em><!--{echo lang('template', 'notice_'.$key)}-->(<span class="rq">$val</span>)</a></li>
					<!--{/loop}-->
				<!--{/if}-->
				<!--{if empty($_G['cookie']['ignore_notice'])}-->
					<li class="ignore_noticeli"><a href="javascript:;" onclick="setcookie('ignore_notice', 1);hideMenu('myprompt_menu')" title="{lang temporarily_to_remind}"><em class="ignore_notice"></em></a></li>
				<!--{/if}-->
			</ul>
			<!--{/if}-->
			<!--{if $_G['uid'] && !empty($_G['style']['extstyle'])}-->
				<div id="sslct_menu" class="cl p_pop" style="display: none;">
					<!--{if !$_G[style][defaultextstyle]}--><span class="sslct_btn" onclick="extstyle('')" title="{lang default}"><i></i></span><!--{/if}-->
					<!--{loop $_G['style']['extstyle'] $extstyle}-->
						<span class="sslct_btn" onclick="extstyle('$extstyle[0]')" title="$extstyle[1]"><i style='background:$extstyle[2]'></i></span>
					<!--{/loop}-->
				</div>
			<!--{/if}-->
			<!--{if $_G['uid']}-->
				<ul id="myitem_menu" class="p_pop" style="display: none;">
					<li><a href="forum.php?mod=guide&view=my">{lang mypost}</a></li>
					<li><a href="home.php?mod=space&do=favorite&view=me">{lang favorite}</a></li>
					<li><a href="home.php?mod=space&do=friend">{lang friends}</a></li>
					<!--{hook/global_myitem_extra}-->
				</ul>
			<!--{/if}-->
            <!--usercenter start-->
            <!--{if $_G['uid']}-->
				
              <div id="mymenu_menu" style="display: none;">
  <div class="ys_userinfo"> <b class="ys_arrow"></b>
    <div class="ys_userinfo_con">
      <div class="ys_userinfo_con_t"> 
        <!--repalce_emouser_start--> 
        <a href="home.php?mod=spacecp&ac=avatar">{echo avatar($_G['uid'], 'small')}</a>
        <dl>
          <dt class="vwmy{if $_G['setting']['connect']['allow'] && $_G[member][conisbind]} qq{/if}"><a href="home.php?mod=space&uid=$_G[uid]">{$_G[member][username]}</a></dt>
          <dt class="usergroup"> <a href="home.php?mod=spacecp&ac=usergroup"> $_G[group][grouptitle]<!--{if $_G[member]['freeze']}-->{lang freeze}<!--{/if}--></a>
          </dt>
        </dl>
        <!--repalce_emouser_end--> 
      </div>
      <div class="ys_userinfo_con_b cl">
        <ul>
        	
           <li><a href="forum.php?mod=guide&view=my">{lang mypost}</a></li>
					<li><a href="home.php?mod=space&do=favorite&view=me">{lang favorite}</a></li>
					<li><a href="home.php?mod=space&do=friend">{lang friends}</a></li>
                   
					<!--{hook/global_myitem_extra}-->
          		
           <li><a href="home.php?mod=spacecp&ac=credit&showcredit=1">{lang credits}</a></li>
          <!--{if $_G[member][newpm]}--><!--{eval $tipTotalCnt = $tipTotalCnt + $_G[member][newpm];}--><!--{/if}--> 
          <!--repalce_emopm_start-->
          <li><a href="home.php?mod=space&do=pm" id="pm_ntc" >{lang pm_center}</a><!--{if $_G[member][newpm]}--><i>$_G[member][newpm]</i><!--{/if}--></li>
          <!--repalce_emopm_end--> 
          
          <!--{if $_G[member][newprompt]}--><!--{eval $tipTotalCnt = $tipTotalCnt + $_G[member][newprompt];}--><!--{/if}--> 
          <!--repalce_emoprompt_start-->
          <li><a href="home.php?mod=space&do=notice" id="myprompt">{lang remind}</a><!--{if $_G[member][newprompt]}--><i>$_G[member][newprompt]</i><!--{/if}--></li>
          <!--repalce_emoprompt_end--> 
          
          <!--{if ($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))}-->
          <li><a href="portal.php?mod=portalcp"><!--{if $_G['setting']['portalstatus'] }-->{lang portal_manage}<!--{else}-->{lang portal_block_manage}<!--{/if}--></a></li>
          <!--{/if}--> 
          <!--{if $_G['uid'] && $_G['group']['radminid'] > 1}-->
          <li><a href="forum.php?mod=modcp&fid=$_G[fid]" target="_blank">{lang forum_manager}</a></li>
          <!--{/if}--> 
          <!--{if $_G['uid'] && $_G['adminid'] == 1 && $_G['setting']['cloud_status']}-->
          <li><a href="admin.php?frames=yes&action=cloud&operation=applist" target="_blank">{lang cloudcp}</a></li>
          <!--{/if}--> 
          <!--{if $_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)}-->
          <li><a href="admin.php" target="_blank">{lang admincp}</a></li>
          <!--{/if}--> 
          <!--{if check_diy_perm($topic)}-->
		  <li><a href="javascript:saveUserdata('diy_advance_mode', '');openDiy();" class="xi2">DIY</a></li>
		  <!--{/if}-->
          <!--{hook/global_usernav_extra2}-->
        </ul>
      </div>
    </div>
    <div class="ys_um_footer"> 
    <a href="home.php?mod=spacecp" class="mkbtn-grey hnus-setting">{lang setup}</a> 
    <a href="member.php?mod=logging&action=logout&formhash={FORMHASH}" class="mkbtn-grey hnus-quit">{lang logout}</a> </div>
  </div>
</div>    
			<!--{/if}-->
            <!--usercenter end-->
			<!--{subtemplate common/header_qmenu}-->
		<!--{/if}-->

		<!--{ad/headerbanner/wp a_h}-->
		<!--header start-->
<div class="header_wrap">
	<div class="ys_container">
    	<div class="reset-box-sizing">
    	<div class="row">
        	<div class="col-md-12">
            <!--{eval $mnid = getcurrentnav();}-->
            <!--logo-->
            	<div class="header_logo hidden_ipad"><!--{if !isset($_G['setting']['navlogos'][$mnid])}--><a href="{if $_G['setting']['domain']['app']['default']}http://{$_G['setting']['domain']['app']['default']}/{else}./{/if}" title="$_G['setting']['bbname']">{$_G['style']['boardlogo']}</a><!--{else}-->$_G['setting']['navlogos'][$mnid]<!--{/if}-->
                </div>
            <!--nav-->
            	<div class="header_nav">
                
                <ul id="nav">
                <!--{loop $_G['setting']['navs'] $nav}-->
							<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}--><li {if $mnid == $nav[navid]}class="a" {/if}$nav[nav]></li><!--{/if}-->
				<!--{/loop}-->
                </ul>
                 <!--{hook/global_nav_extra}-->
                </div>
             <div class="pull-right unreset-box-sizing">
             	<div class="header-search-pc hidden_ipad"></div>
                <div class="header-login-pc hidden_ipad"><!--{template common/header_userstatus}--></div>
                
                <!--{if $_G['uid']}-->
                <div class="hidden_pc">
                <a href="home.php?mod=space&uid=$_G[uid]"  title="{lang visit_my_space}" class="ipad-user-name mr10" >{$_G[member][username]}</a>
                <a href="member.php?mod=logging&action=logout&formhash={FORMHASH}" class="ipad-user-name" >{lang logout}</a>
               </div>
               <!--{else}-->
               <div class="header-login-ipad hidden_pc">
               <!--{if $_G['setting']['connect']['allow']}-->
        		<a class="header-qq" href="$_G[connect][login_url]&statfrom=login_simple" title="使用QQ帐号登录"></a><!--{/if}-->
               <a class="text-hide" rel="nofollow" href="member.php?mod=logging&action=login">login</a>
                </div>
               <!--{/if}-->
               
             
             </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--header end-->
<!--header submenu-->       

				<!--{if !empty($_G['setting']['plugins']['jsmenu'])}-->
					<ul class="p_pop h_pop" id="plugin_menu" style="display: none">
					<!--{loop $_G['setting']['plugins']['jsmenu'] $module}-->
						 <!--{if !$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])}-->
						 <li>$module[url]</li>
						 <!--{/if}-->
					<!--{/loop}-->
					</ul>
				<!--{/if}-->
				$_G[setting][menunavs]
                <div class="wp cl">
                <div id="mu" class="cl">
				<!--{if $_G['setting']['subnavs']}-->
					<!--{loop $_G[setting][subnavs] $navid $subnav}-->
						<!--{if $_G['setting']['navsubhover'] || $mnid == $navid}-->
						<ul class="cl {if $mnid == $navid}current{/if}" id="snav_$navid" style="display:{if $mnid != $navid}none{/if}">
						$subnav
						</ul>
						<!--{/if}-->
					<!--{/loop}-->
				<!--{/if}-->
				</div>
                </div>
				<!--{ad/subnavbanner/a_mu}-->
<!--header submenu end-->  	
		<!--{hook/global_header}-->
	<!--{/if}-->



<div id="wp" class="ys_container">
