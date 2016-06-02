<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
include xp_display('header');
include xp_display('js');

$id = $p['id'];
$bgcolor = $p['value']['bgcolor'];
$bg = $p['value']['bg'];
$img = $bg ? '<img src="' . $bg . '" />' : '';
$check1 = $p['value']['center'] ? 'checked' : '';
$check2 = $p['value']['center'] ? '' : 'checked';
$check3 = $p['value']['user'] ? 'checked' : '';
$check4 = $p['value']['user'] ? '' : 'checked';
$check5 = $p['value']['menu'] ? 'checked' : '';
$check6 = $p['value']['menu'] ? '' : 'checked';
$title = $p['modulename'] . ' ' . $id;
$v = $p['value'];
$names = $v['rightmenu'] ? $v['rightmenu'] : array('');
$links = $v['rightmenu_link'] ? $v['rightmenu_link'] : array('');

?>
<div class="form">
    <table class="table_purview">
        <tr>
            <th><?php xigua_cards::l('background_image');
                echo '<br>';
                xigua_cards::l('kexuan') ?></th>
            <td valign="middle">
                <form action="" method="POST" enctype="multipart/form-data">
                    <button class="button2 abs"><?php xigua_cards::l('upload') ?></button>
                    <input name="xiguafile" id="xiguafile" class="file" type="file" onchange="return ajaxFileUpload();"/>

                    <div class="cl">
                    <span id="ajaxloading">
                        <img id="ajaxloading-img" src="source/plugin/xigua_portal/static/images/loading.gif"/>
                    </span>
                    <span id="ajaxtip2"><?php echo $img ?></span>
                    <span id="ajaxtip1"></span>
                        <?php if($img){?><a class="delbg">X</a><?php }?>
                    </div>
                </form>
            </td>
        </tr>
    </table>
    <form id="form" accept-charset="<?php echo CHARSET ?>" action="<?php echo $actionsaveurl; ?>" method="POST">
    <table class="table_purview">
            <input type="hidden" name="formhash" value="<?php echo FORMHASH ?>"/>
            <input type="hidden" id="bg" name="row[bg]" value="<?php echo $bg ?>"/>
            <input type="hidden" name="cid" value="<?php echo $id ?>"/>
            <tr>
                <th><?php xigua_cards::l('bgcolor') ?></th>
                <td>
                    <span class="J_color_pick color_pick"><em style="background:<?php echo $bgcolor ?>"></em></span>
                    <input name="row[bgcolor]" type="hidden" class="J_hidden_color bgcolor" value="<?php echo $bgcolor ?>">
                </td>
            </tr>
            <tr>
                <th><?php xigua_cards::l('logo_position') ?></th>
                <td>
                    <label><input class="radio" type="radio" name="row[center]" value="0" <?php echo $check2 ?> /> <?php xigua_cards::l('logo_left') ?>
                    </label>
                    <label><input class="radio" type="radio" name="row[center]" value="1" <?php echo $check1 ?> /> <?php xigua_cards::l('logo_center') ?>
                    </label>
                </td>
            </tr>
            <tr>
                <th><?php xigua_cards::l('show_user') ?></th>
                <td>
                    <label><input class="radio" type="radio" name="row[user]" value="1" <?php echo $check3 ?> /> <?php xigua_cards::l('visible') ?>
                    </label>
                    <label><input class="radio" type="radio" name="row[user]" value="0" <?php echo $check4 ?> /> <?php xigua_cards::l('invisible') ?>
                    </label>
                </td>
            </tr>
            <tr>
                <th><?php xigua_cards::l('show_menu') ?></th>
                <td>
                    <label><input class="radio" type="radio" name="row[menu]" value="1" <?php echo $check5 ?> /> <?php xigua_cards::l('visible') ?>
                    </label>
                    <label><input class="radio" type="radio" name="row[menu]" value="0" <?php echo $check6 ?> /> <?php xigua_cards::l('invisible') ?>
                    </label>
                </td>
            </tr>
            <?php foreach ($names as $k => $vv) { ?>
            <tr>
                <th><?php echo  ($k == 0 )? xigua_cards::l('rightmenu', 0) : '&nbsp;';?></th>
                <td>
                    <input type="text" class="mini" placeholder="<?php xigua_cards::l('navname')?>" name="row[rightmenu][]" value="<?php echo $vv?>" />
                    <input type="text" class="normal" placeholder="<?php xigua_cards::l('navlink')?>"  name="row[rightmenu_link][]" value="<?php echo $links[$k]?>">
                    <a class="del" onclick="deleterow(this)">x</a>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <th>&nbsp;</th>
                <td>
                    <button type="button" class="button1" onclick="addrow(this,0);"><?php xigua_cards::l('add');?></button>
                </td>
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
    var rowtypedata = [[
        [1, '&nbsp;', 'th'],
        [1, '<input type="text" class="mini" placeholder="<?php xigua_cards::l('navname')?>" name="row[rightmenu][]" value="" />\
    <input type="text" class="normal" placeholder="<?php xigua_cards::l('navlink')?>"  name="row[rightmenu_link][]" value="">\
    <a class="del" onclick="deleterow(this)">x</a>']
    ]];
    var dialog = top.dialog.get(window);
    $(function () {
        dialog.title('<?php echo $title;?>');
        dialog.height(500);
    });
</script></body></html>