<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
include xp_display('header');
include xp_display('js');

$id = $p['id'];
$title = $p['modulename'] . ' ' . $id;
$v = $p['value'];
if(!$v['height']){
    $v['height'] = '40';
}

?>
<div class="form">
    <form id="form" accept-charset="<?php echo CHARSET ?>" action="<?php echo $actionsaveurl; ?>" method="POST">
        <table class="table_purview">
            <input type="hidden" name="formhash" value="<?php echo FORMHASH ?>"/>
            <input type="hidden" name="cid" value="<?php echo $id ?>"/>
            <tr>
                <th><?php xigua_cards::l('sboxcolor')?></th>
                <td>
                    <span class="J_color_pick color_pick"><em style="background:<?php echo $v['sboxcolor'] ?>"></em></span>
                    <input name="row[sboxcolor]" type="hidden" class="J_hidden_color bgcolor" value="<?php echo $v['sboxcolor'] ?>">
                </td>
            </tr>
            <tr>
                <th><?php xigua_cards::l('sbtncolor')?></th>
                <td>
                    <span class="J_color_pick color_pick"><em style="background:<?php echo $v['sbtncolor'] ?>"></em></span>
                    <input name="row[sbtncolor]" type="hidden" class="J_hidden_color bgcolor" value="<?php echo $v['sbtncolor'] ?>">
                </td>
            </tr>
            <tr>
                <th><?php xigua_cards::l('height')?></th>
                <td>
                    <input name="row[height]" type="text" class="mini" value="<?php echo $v['height'] ?>"> PX
                </td>
            </tr>
            <tr>
                <th><?php xigua_cards::l('yutian')?></th>
                <td>
                    <input name="row[yutian]" type="text" class="normal" value="<?php echo $v['yutian'] ?>">
                </td>
            </tr>
            <tr>
                <th><?php xigua_cards::l('Radius')?></th>
                <td>
                    <input name="row[radius]" type="text" class="normal" value="<?php echo $v['radius'] ?>"> PX
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
    var dialog = top.dialog.get(window);
    $(function () {
        dialog.title('<?php echo $title;?>');
        dialog.height(240);
    });
</script>
</body></html>