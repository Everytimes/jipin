<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
include xp_display('header');
include xp_display('js');

$cats[] = array(0, xigua_cards::l('article_allcat', 0));
loadcache('portalcategory');
foreach($_G['cache']['portalcategory'] as $value) {
    if($value['level'] == 0) {
        $cats[] = array($value['catid'], $value['catname']);
        if($value['children']) {
            foreach($value['children'] as $catid2) {
                $value2 = $_G['cache']['portalcategory'][$catid2];
                $cats[] = array($value2['catid'], '-- '.$value2['catname']);
                if($value2['children']) {
                    foreach($value2['children'] as $catid3) {
                        $value3 = $_G['cache']['portalcategory'][$catid3];
                        $cats[] = array($value3['catid'], '---- '.$value3['catname']);
                    }
                }
            }
        }
    }
}

$id = $p['id'];
$title = $p['modulename'] . ' ' . $id;
$v = $p['value'];

?>
<style>
.stp{display: inline-block; margin: 3px 0;white-space:nowrap;}
#stw{margin-bottom:5px}
#stw a{background:#7BBFF2;color: #fff;padding:3px 6px; border-radius: 2px;}
</style>
<div class="form">
    <form id="form" accept-charset="<?php echo CHARSET ?>" action="<?php echo $actionsaveurl; ?>" method="POST">
        <table class="table_purview">
            <input type="hidden" name="formhash" value="<?php echo FORMHASH ?>"/>
            <input type="hidden" name="cid" value="<?php echo $id ?>"/>
            <tr>
                <th><?php xigua_cards::l('title')?></th>
                <td>
                    <span class="J_color_pick color_pick"><em style="background:<?php echo $v['themecolor'] ?>"></em></span>
                    <input name="row[themecolor]" type="hidden" class="J_hidden_color bgcolor" value="<?php echo $v['themecolor'] ?>">
                    <input name="row[title]" type="text" class="mini" value="<?php echo $v['title'] ?>">
                    <input placeholder="<?php xigua_cards::l('title_link')?>" name="row[title_link]" type="text" class="normal" value="<?php echo $v['title_link'] ?>">
                </td>
            </tr>
            <tr>
                <th><?php xigua_cards::l('subtitle')?></th>
                <td>
                    <div id="stw">
                        <?php foreach ($v['subtitle'] as $kk => $vv) {
                            $ll = $v['subtitle_link'][$kk];
                            echo '<p class="stp"><a href="'.$ll.'" target="_blank">'.$vv.'</a><span class="del" onclick="return removelink(this)">X</span>'.
                                '<input class="sth" type="hidden" name="row[subtitle][]" value="'.$vv.'" />'.
                                '<input class="sthl" type="hidden" name="row[subtitle_link][]" value="'.$ll.'" /></p>';
                            }
                        ?></div>
                    <div>
                        <input placeholder="<?php xigua_cards::l('subtitle_hold')?>" id="st" type="text" class="mini">
                        <input placeholder="<?php xigua_cards::l('subtitle_link')?>" id="stl" type="text" class="normal">
                        <button onclick="return add_subtitle();" class="button1" type="button"><?php xigua_cards::l('add')?></button>
                    </div>
                </td>
            </tr>

            <tr>
                <th><?php xigua_cards::l('themecolor')?></th>
                <td>
                    <span class="J_color_pick color_pick"><em style="background:<?php echo $v['color'] ?>"></em></span>
                    <input name="row[color]" type="hidden" class="J_hidden_color bgcolor" value="<?php echo $v['color'] ?>">
                </td>
            </tr>

    <tr>
     <th width="80"><?php xigua_cards::l('article_from')?></th>
     <td> <select name="row[script]" onchange="return change_tids(this);" class="ps">
             <option <?php if($v['script'] == 'articlehot'){echo 'selected';}?> value="articlehot" selected=""><?php xigua_cards::l('article_hot')?></option>
             <option <?php if($v['script'] == 'articlespecified'){echo 'selected';}?> value="articlespecified"><?php xigua_cards::l('article_specified')?></option>
             <option <?php if($v['script'] == 'articlenew'){echo 'selected';}?> value="articlenew"><?php xigua_cards::l('article_new')?></option>
         </select>
     </td>
    </tr>
    <tr class="ipe" <?php if($v['script'] != 'articlespecified'){ echo 'style="display:none"';}?>>
        <th><?php xigua_cards::l('article_id')?></th>
        <td>
            <input id="tids" type="text" class="normal" name="row[param][aids]" value="<?php echo $v['param']['aids']?>" placeholder="<?php xigua_cards::l('article_iddesc')?>" />
        </td>
    </tr>
    <tr class="vt">
     <th><?php xigua_cards::l('article_cat')?></th>
     <td>
         <select name="row[param][catid][]" multiple="multiple" size="10" style="height:80px;width:300px">
             <?php foreach ($cats as $cat) {
                 $checked = in_array($cat[0], $v['param']['catid']) ? 'selected' : '';
                 echo "<option $checked value='$cat[0]'>$cat[1]</option>";
             }
             ?>
         </select>
     </td>
    </tr>
    <tr class="vt">
     <th><?php xigua_cards::l('article_album')?></th>
     <td>
         <label for="randomid_1" class="lb">
             <input type="radio" name="row[param][picrequired]" id="randomid_1" <?php if($v['param']['picrequired'] ==1){echo 'checked';}?> class="pr" value="1"  /><?php xigua_cards::l('yes')?>
         </label>
         <label for="randomid_2" class="lb">
             <input type="radio" name="row[param][picrequired]" id="randomid_2" <?php if(!$v['param']['picrequired']){echo 'checked';}?> class="pr" value="0"  /><?php xigua_cards::l('no')?>
         </label>
     </td>
    </tr>
    <tr class="vt">
     <th><?php xigua_cards::l('article_order')?></th>
     <td>
      <ul class="pr">
       <li class="checked">
           <label for="randomid_3"><input type="radio" name="row[param][orderby]" id="randomid_3" class="pr" value="viewnum" <?php if(!$v['param']['orderby'] || $v['param']['orderby'] =='viewnum'){echo 'checked';}?>  /><?php xigua_cards::l('article_order1')?></label>
       </li>
       <li>
           <label for="randomid_4"><input type="radio" name="row[param][orderby]" id="randomid_4" class="pr" value="commentnum" <?php if($v['param']['orderby'] =='commentnum'){echo 'checked';}?>  /><?php xigua_cards::l('article_order2')?></label>
       </li>
       <li>
           <label for="randomid_5"><input type="radio" name="row[param][orderby]" id="randomid_5" class="pr" value="dateline" <?php if($v['param']['orderby'] =='dateline'){echo 'checked';}?>  /><?php xigua_cards::l('article_order3')?></label>
       </li>
      </ul>
     </td>
    </tr>
    <tr class="vt">
     <th><?php xigua_cards::l('article_title')?></th>
     <td><input type="text" name="row[param][titlelength]" class="short" value="<?php echo $v['param']['titlelength'] ?>" /></td>
    </tr>
    <tr class="vt">
     <th><?php xigua_cards::l('article_desc')?></th>
     <td><input type="text" name="row[param][summarylength]" class="short" value="<?php echo $v['param']['summarylength'] ?>" /></td>
    </tr>

    <tr>
     <th><?php xigua_cards::l('article_item')?></th>
     <td><input type="text" name="row[param][items]" value="<?php echo $v['param']['items']?$v['param']['items']:10 ?>" class="short"  /></td>
    </tr>































            <tr>
                <th>&nbsp;</th>
                <td>
                    <button class="button2 "><?php xigua_cards::l('save') ?></button>
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
    var dialog = top.dialog.get(window);
    $(function () {
        dialog.title('<?php echo $title;?>');
        dialog.height(515);
    });

    function add_subtitle(){
        var v = htmlspecialchars($('#st').val()),
            l = htmlspecialchars($('#stl').val());
        if(v){
            $('#stw').append('<p class="stp"><a href="'+l+'" target="_blank">'+v+'</a><span class="del" onclick="return removelink(this)">X</span>\
            <input class="sth" type="hidden" name="row[subtitle][]" value="'+v+'" />\
            <input class="sthl" type="hidden" name="row[subtitle_link][]" value="'+l+'" /></p>');
            $('#st').val('')
            $('#stl').val('');
        }
        return false;
    }
    function removelink(obj){
        $(obj).parent().remove();
        return false;
    }
</script>
</body></html>