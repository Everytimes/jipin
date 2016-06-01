<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
include xp_display('header');
include xp_display('js');

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
                <th><?php xigua_cards::l('showsubtop')?></th>
                <td>
                    <select name="row[showsubtop]">
                        <option <?php if($v['showsubtop'] == '1' ){echo 'selected ';}?>value="1"><?php xigua_cards::l('yes')?></option>
                        <option <?php if(!$v['showsubtop'] ){echo 'selected ';}?>value="0"><?php xigua_cards::l('no')?></option>
                    </select>
                </td>
            </tr>

            <tr>
                <th><?php xigua_cards::l('showreply')?></th>
                <td>
                    <select name="row[showreply]">
                        <option <?php if($v['showreply'] == 'replies' ){echo 'selected ';}?>value="replies"><?php xigua_cards::l('replies')?></option>
                        <option <?php if($v['showreply'] == 'views' ){echo 'selected ';}?>value="views"><?php xigua_cards::l('views')?></option>
                    </select>
                </td>
            </tr>

            <tr>
                <th><?php xigua_cards::l('showpic')?></th>
                <td>
                    <select name="row[showpic]">
                        <option <?php if($v['showpic'] == 'all' ){echo 'selected ';}?>value="all"><?php xigua_cards::l('all')?></option>
                        <option <?php if($v['showpic']=='bottom'){echo 'selected ';}?>value="bottom"><?php xigua_cards::l('bottom')?></option>
                        <option <?php if($v['showpic'] == 'top' ){echo 'selected ';}?>value="top"><?php xigua_cards::l('top')?></option>
                        <option <?php if(!$v['showpic']||$v['showpic'] =='invisible'){echo 'selected ';}?>value="invisible"><?php xigua_cards::l('invisible')?></option>
                    </select>
                    <?php xigua_cards::l('showthumb')?>
                    <label><input type="radio" name="row[thumb]" <?php if($v['thumb'] == '1' ){echo 'checked ';}?>value="1"><?php xigua_cards::l('yes')?></label>
                    <label><input type="radio" name="row[thumb]" <?php if(!$v['thumb'] ){echo 'checked ';}?>value="0"><?php xigua_cards::l('no')?></label>
                </td>
            </tr>

            <?php include xp_display('block_form');?>
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