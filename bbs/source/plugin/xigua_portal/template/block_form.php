<?php if (!defined('IN_DISCUZ')) { exit('Access Denied'); }

require_once libfile('function/forumlist');
$forums = '<select style="height:80px;width:300px" name="row[param][fids][]" size="10" multiple="multiple">
<option value="0">'.xigua_cards::l('all_forums',0).'</option>'.
    forumselect(FALSE, 0, $v['param']['fids'], TRUE).
    '</select>';
?>
<tr>
    <th><?php xigua_cards::l('script') ?></th>
    <td>
        <select name="row[script]" onchange="return change_tids(this);" >
            <option <?php if($v['script'] == 'threadhot'      ){echo 'selected ';}?>value="threadhot"><?php xigua_cards::l('threadhot')?></option>
            <option <?php if($v['script'] == 'threadnew'      ){echo 'selected ';}?>value="threadnew"><?php xigua_cards::l('threadnew')?></option>
            <option <?php if($v['script'] == 'threaddigest'   ){echo 'selected ';}?>value="threaddigest"><?php xigua_cards::l('threaddigest')?></option>
            <option <?php if($v['script'] == 'threadstick'    ){echo 'selected ';}?>value="threadstick"><?php xigua_cards::l('threadstick')?></option>
            <option <?php if($v['script'] == 'threadspecified'){echo 'selected ';}?>value="threadspecified"><?php xigua_cards::l('threadspecified')?></option>
        </select>
        <input type="number" class="short" name="row[param][items]" value="<?php echo $v['param']['items'] ? $v['param']['items'] : '5'?>" />
        <?php xigua_cards::l('item')?>
    </td>
</tr>
<tr class="ipe" <?php if($v['script'] != 'threadspecified'){ echo 'style="display:none"';}?>>
    <th><?php xigua_cards::l('tids')?></th>
    <td>
        <input id="tids" type="text" class="normal" name="row[param][tids]" value="<?php echo $v['param']['tids']?>" />
    </td>
</tr>
<tr>
    <th><?php xigua_cards::l('special')?></th>
    <td>
        <label for="randomid_6"><input type="checkbox" name="row[param][special][]" id="randomid_6" <?php if(in_array(0, $v['param']['special'])){echo "checked ";}?>value="0"><?php xigua_cards::l('special0')?></label>
        <label for="randomid_1"><input type="checkbox" name="row[param][special][]" id="randomid_1" <?php if(in_array(1, $v['param']['special'])){echo "checked ";}?>value="1"><?php xigua_cards::l('special1')?></label>
        <label for="randomid_2"><input type="checkbox" name="row[param][special][]" id="randomid_2" <?php if(in_array(2, $v['param']['special'])){echo "checked ";}?>value="2"><?php xigua_cards::l('special2')?></label>
        <label for="randomid_3"><input type="checkbox" name="row[param][special][]" id="randomid_3" <?php if(in_array(3, $v['param']['special'])){echo "checked ";}?>value="3"><?php xigua_cards::l('special3')?></label>
        <label for="randomid_4"><input type="checkbox" name="row[param][special][]" id="randomid_4" <?php if(in_array(4, $v['param']['special'])){echo "checked ";}?>value="4"><?php xigua_cards::l('special4')?></label>
        <label for="randomid_5"><input type="checkbox" name="row[param][special][]" id="randomid_5" <?php if(in_array(5, $v['param']['special'])){echo "checked ";}?>value="5"><?php xigua_cards::l('special5')?></label>
    </td>
</tr>
<tr>
    <th><?php xigua_cards::l('orderby');?></th>
    <td>
        <select name="row[param][orderby]">
            <option value="lastpost" <?php if($v['param']['orderby'] == 'lastpost'  ){echo 'selected';}?>><?php xigua_cards::l('lastpost')?></option>
            <option value="dateline" <?php if($v['param']['orderby'] == 'dateline'  ){echo 'selected';}?>><?php xigua_cards::l('dateline')?></option>
            <option value="replies" <?php if($v['param']['orderby'] == 'replies'   ){echo 'selected';}?>><?php xigua_cards::l('replies')?></option>
            <option value="views" <?php if($v['param']['orderby'] == 'views'     ){echo 'selected';}?>><?php xigua_cards::l('views')?></option>
            <option value="heats" <?php if($v['param']['orderby'] == 'heats'     ){echo 'selected';}?>><?php xigua_cards::l('heats')?></option>
            <option value="recommends" <?php if($v['param']['orderby'] == 'recommends'){echo 'selected';}?>><?php xigua_cards::l('recommends')?></option>
        </select>
    </td>
</tr>
<tr>
    <th><?php xigua_cards::l('postdateline')?></th>
    <td>
        <select name="row[param][postdateline]">
            <option <?php if($v['param']['postdateline'] == '0'){echo 'selected ';}?> value="0" ><?php xigua_cards::l('postdateline0')?></option>
            <option <?php if($v['param']['postdateline'] == '3600' ){echo 'selected ';}?> value="3600"><?php xigua_cards::l('postdateline1')?></option>
            <option <?php if($v['param']['postdateline'] == '86400'){echo 'selected ';}?> value="86400"><?php xigua_cards::l('postdateline2')?></option>
            <option <?php if($v['param']['postdateline'] == '604800'){echo 'selected ';}?> value="604800"><?php xigua_cards::l('postdateline3')?></option>
            <option <?php if($v['param']['postdateline'] == '2592000'){echo 'selected ';}?> value="2592000"><?php xigua_cards::l('postdateline4')?></option>
        </select>
    </td>
</tr>
<tr>
    <th><?php xigua_cards::l('inforums') ?></th>
    <td>
        <?php echo $forums?>
    </td>
</tr>