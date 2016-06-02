<?php echo '模板巴士原创模板，版权所有，盗版必究，官网 www.mobanbus.cn';exit;?>
<!--{template common/header_space}-->
<!--{subtemplate home/space_userabout}-->

<div class="mobanbus_bd">
<div class="bus_alum">

<div id="ct" class="wp cl">
	<div class="mn">
		<div class="bm">
			<span class="bus_tt">{lang upload_pic}</span>
			<div class="clear"></div>
			<div class="bm_c">
			<!--{if $haveattachsize}-->
			<div class="tbmu">
				{lang hava_attach_size} <strong>$haveattachsize</strong> (<a href="home.php?mod=spacecp&ac=upload&op=recount">{lang recount}</a>)
				<!--{if $_G['setting']['magicstatus'] && $_G[setting][magics][attachsize]}-->
				<br />
				<img src="{STATICURL}image/magic/attachsize.small.gif" alt="attachsize" class="vm" />
				<a id="a_magic_attachsize" href="home.php?mod=magic&mid=attachsize" onclick="showWindow('magics', this.href, 'get', 0)">{lang i_want_more_space}</a>
				({lang you_can_buy_magictools})
				<!--{/if}-->
			</div>
			<!--{/if}-->

		<!--{if empty($_GET['op'])}-->
		<form method="post" autocomplete="off" id="albumform" action="home.php?mod=spacecp&ac=upload" onsubmit="return validate(this);">
			<h2 class="mtw xs2">1. {lang select_pic}</h2>
			<div class="uploadform mtn ptm pbw">

				<table cellspacing="0" cellpadding="0" class="tfm up_row mbm">
					<tbody id="attachbody"></tbody>
				</table>

				<div class="fieldset flash" id="imgUploadProgress"></div>
				<div class="hm"><span id="imgSpanButtonPlaceholder"></span></div>
				<!--{if empty($_G['setting']['pluginhooks']['spacecp_upload_extend'])}-->
					<!--{subtemplate common/upload}-->
					<script type="text/javascript">
						var upload = new SWFUpload({
							// Backend Settings
							upload_url: "{$_G[siteurl]}misc.php?mod=swfupload&action=swfupload&operation=album",
							post_params: {"uid" : "$_G[uid]", "hash":"$swfconfig[hash]"},

							// File Upload Settings
							file_size_limit : "$swfconfig[max]",	// 100MB
							file_types : "$swfconfig[imageexts][ext]",
							file_types_description : "$swfconfig[imageexts][depict]",
							file_upload_limit : 0,
							file_queue_limit : 0,

							// Event Handler Settings (all my handlers are in the Handler.js file)
							swfupload_preload_handler : preLoad,
							swfupload_load_failed_handler : loadFailed,
							file_dialog_start_handler : fileDialogStart,
							file_queued_handler : fileQueued,
							file_queue_error_handler : fileQueueError,
							file_dialog_complete_handler : fileDialogComplete,
							upload_start_handler : uploadStart,
							upload_progress_handler : uploadProgress,
							upload_error_handler : uploadError,
							upload_success_handler : uploadSuccess,
							upload_complete_handler : uploadComplete,

							// Button Settings
							button_image_url : "{IMGDIR}/uploadbutton.png",
							button_placeholder_id : "imgSpanButtonPlaceholder",
							button_width: 100,
							button_height: 25,
							button_cursor:SWFUpload.CURSOR.HAND,
							button_window_mode: "transparent",

							custom_settings : {
								progressTarget : "imgUploadProgress",
								uploadSource: 'home',
								uploadType: 'album',
								imgBoxObj: $('attachbody')
							},

							// Debug Settings
							debug: false
						});

					</script>
				<!--{else}-->
					<!--{hook/spacecp_upload_extend}-->
				<!--{/if}-->

			</div>

				<script type="text/javascript">
					var check = false;
					no_insert = 1;
					function a_addOption() {
						var obj = $('uploadalbum');
						obj.value = 'addoption';
						addOption(obj);
					}

					function album_op(id) {
						$('selectalbum').style.display = 'none';
						$('creatalbum').style.display = 'none';
						$(id).style.display = '';
						check = false;
						if(id == 'creatalbum') {
							check = true;
							$('albumname').select();
						}
					}
				</script>

				<h2 class="mtw xs2">2. {lang select_album}</h2>
				<div class="uploadform mtn ptw pbw">
					<!--{if $albums}-->
					<p class="hm pbw xs2 xw1">
						<label for="albumop_selectalbum" class="lb"><input type="radio" name="albumop" id="albumop_selectalbum" class="pr" value="selectalbum" checked="checked" onclick="album_op(this.value);" />{lang add_to_existing_album}</label>
						<label for="albumop_creatalbum" class="lb"><input type="radio" name="albumop" id="albumop_creatalbum" class="pr" value="creatalbum" onclick="album_op(this.value);" />{lang create_new_album}</label>
					</p>
					<div id="selectalbum" class="hm">
						{lang select_album}
						<select name="albumid" id="uploadalbumid">
						<!--{loop $albums $value}-->
							<!--{if $value['albumid'] == $_GET['albumid']}-->
								<option value="$value[albumid]" selected="selected">$value[albumname]</option>
							<!--{else}-->
								<option value="$value[albumid]">$value[albumname]</option>
							<!--{/if}-->
						<!--{/loop}-->
						</select>
					</div>
					<div id="creatalbum" style="display:none;">
					<!--{else}-->
					<p class="hm pbw xs2 xw1">{lang create_new_album}</p>
					<input type="hidden" name="albumop" value="creatalbum" />
					<div id="creatalbum">
					<!--{/if}-->
						<table cellspacing="0" cellpadding="0" class="tfm">
							<tr>
								<th>{lang album_name}</th>
								<td><input type="text" name="albumname" id="albumname" class="px" size="20" value="{lang my_album}" /></td>
							</tr>
							<tr>
								<th>{lang album_depict}</th>
								<td><textarea name="depict" class="pt" cols="40" rows="3"></textarea></td>
							</tr>
							<!--{if $_G['setting']['albumcategorystat'] && $categoryselect}-->
							<tr>
								<th>{lang site_categories}</th>
								<td>
									$categoryselect
									<p class="d">{lang select_site_album_categories}</p>
								</td>
							</tr>
							<!--{/if}-->
							<tr>
								<th>{lang privacy_settings}</th>
								<td>
									<select name="friend" id="uploadfriend" onchange="passwordShow(this.value);" class="ps">
										<option value="0">{lang friendname_0}</option>
										<option value="1">{lang friendname_1}</option>
										<option value="2">{lang friendname_2}</option>
										<option value="3">{lang friendname_3}</option>
										<option value="4">{lang friendname_4}</option>
									</select>
								</td>
							</tr>
							<tbody id="span_password" style="display:none;">
								<tr>
									<th>{lang password}</th>
									<td><input type="text" name="password" id="uploadpassword" class="px" value="" size="10" /></td>
								</tr>
							</tbody>
							<tbody id="tb_selectgroup" style="display:none;">
								<tr>
									<th>{lang specified_friends}</th>
									<td>
										<select name="selectgroup" class="ps" onchange="getgroup(this.value);">
											<option value="">{lang from_friends_group}</option>
											<!--{loop $groups $key $value}-->
											<option value="$key">$value</option>
											<!--{/loop}-->
										</select>
										<p class="d">{lang choices_following_friends_list}</p>
									</td>
								</tr>
								<tr>
									<th>&nbsp;</th>
									<td>
										<textarea name="target_names" id="target_names" class="pt" rows="3"></textarea>
										<p class="d">{lang friend_name_space}</p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="mtm hm">
					<input type="hidden" name="albumsubmit" id="albumsubmit" value="true" />
					<button type="submit" name="albumsubmit_btn" id="albumsubmit_btn" class="up_alum bus_btn" value="true"{if $_G['setting']['albumcategoryrequired']} onclick="return validate(this);"{/if}><strong>{lang upload_start}</strong></button>
					<input type="hidden" name="formhash" value="{FORMHASH}" />
				</div>
			</form>

			<script type="text/javascript">
				<!--{if empty($albums)}-->
					if(typeof $('albumname') == 'object') {
						$('albumname').select();
					}
				<!--{/if}-->
				function validate(obj) {
					if(!$('attachbody').getElementsByTagName('tr').length) {
						showDialog('{lang select_upload_pic}', 'notice', '{lang reminder}', null, 0);
						return false;
					}
					<!--{if $_G['setting']['albumcategorystat'] && $_G['setting']['albumcategoryrequired']}-->
					var catObj = $("catid");
					if(catObj && check) {
						if (catObj.value < 1) {
							showDialog('{lang select_system_cat}', 'notice', '{lang reminder}', null, 0);
							catObj.focus();
							return false;
						}
					}
					<!--{/if}-->
					return true;
				}
			</script>

		<!--{elseif $_GET['op'] == 'cam'}-->
		</div>
		<div class="bm">
			<script type="text/javascript">
				document.write(AC_FL_RunContent(
					'width', '100%', 'height', '415',
					'src', '{IMGDIR}/cam.swf?config=$config&albumid=$_GET[albumid]',
					'quality', 'high', 'wmode', 'transparent'
				));
			</script>
		<!--{/if}-->

		</div>
	</div>
	</div>
</div>
</div>

</div>
<!-- Mobanbus_cn mobanbus_bd end -->
<!--{template common/footer}-->