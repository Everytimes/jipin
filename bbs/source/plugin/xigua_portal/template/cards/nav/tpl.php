<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
include xp_display('header');
include xp_display('js');

$id = $p['id'];
$title = $p['modulename'] . ' ' . $id;
$perline_num = $p['value']['perline_num'] ? intval($p['value']['perline_num']) : '5';
$names = $p['value']['name'] ? $p['value']['name'] : array('');
$links = $p['value']['link'] ? $p['value']['link'] : array('');
$colors = $p['value']['color'] ? $p['value']['color'] : array('');
$v = $p['value'];

?>
<div class="form">
    <form id="form" accept-charset="<?php echo CHARSET ?>" action="<?php echo $actionsaveurl; ?>" method="POST">
    <table class="table_purview">
            <input type="hidden" name="formhash" value="<?php echo FORMHASH ?>"/>
            <input type="hidden" name="cid" value="<?php echo $id ?>"/>
        <tr>
            <th><?php xigua_cards::l('title') ?></th>
            <td>
                <span class="J_color_pick color_pick"><em style="background:<?php echo $v['fcolor'] ?>"></em></span>
                <input name="row[fcolor]" type="hidden" class="J_hidden_color bgcolor" value="<?php echo $v['fcolor'] ?>">
                <input type="text" class="mini" name="row[title]" value="<?php echo $v['title']?>" />
            </td>
        </tr>
        <tr>
            <th><?php xigua_cards::l('bgcolor') ?></th>
            <td>
                <span class="J_color_pick color_pick"><em style="background:<?php echo $v['bg'] ?>"></em></span>
                <input name="row[bg]" type="hidden" class="J_hidden_color bgcolor" value="<?php echo $v['bg'] ?>">
            </td>
        </tr>
            <tr>
                <th><?php xigua_cards::l('perline_num') ?></th>
                <td>
                    <input type="number" class="mini" name="row[perline_num]" value="<?php echo $perline_num?>" />
                </td>
            </tr>
        <?php foreach ($names as $k => $vv) { ?>
            <tr>
                <th><?php echo  ($k == 0 )? xigua_cards::l('nav_list', 0) : '&nbsp;';?></th>
                <td>
                    <input type="text" class="mini" placeholder="<?php xigua_cards::l('navname')?>" name="row[name][]" value="<?php echo $vv?>" />
                    <span class="J_color_pick color_pick"><em style="background:<?php echo $colors[$k] ?>"></em></span>
                    <input name="row[color][]" type="hidden" class="J_hidden_color bgcolor" value="<?php echo $colors[$k] ?>">
                    <input type="text" class="normal" placeholder="<?php xigua_cards::l('navlink')?>"  name="row[link][]" value="<?php echo $links[$k]?>">
                    <a class="del" onclick="deleterow(this)">x</a>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <th>&nbsp;</th>
            <td>
                <button type="button" class="button1" onclick="addrow(this,0);picker();"><?php xigua_cards::l('add');?></button>
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
    <div style="height:80px;width:300px;"></div>
</div>
<script>
    var rowtypedata = [[
        [1, '&nbsp;', 'th'],
        [1, '<input type="text" class="mini" placeholder="<?php xigua_cards::l('navname')?>" name="row[name][]" value="" />\
        <span class="J_color_pick color_pick"><em></em></span>\
        <input name="row[color][]" type="hidden" class="J_hidden_color bgcolor">\
        <input type="text" class="normal" placeholder="<?php xigua_cards::l('navlink')?>"  name="row[link][]" value="">\
    <a class="del" onclick="deleterow(this)">x</a>']
    ]];
    var dialog = top.dialog.get(window);
    $(function () {
        dialog.title('<?php echo $title;?>');
        dialog.height(400);
    });
</script>
</body></html>