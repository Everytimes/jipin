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
<div class="form">
    <form id="form" accept-charset="<?php echo CHARSET ?>" action="<?php echo $actionsaveurl; ?>" method="POST">
        <table class="table_purview">
            <input type="hidden" name="formhash" value="<?php echo FORMHASH ?>"/>
            <input type="hidden" name="cid" value="<?php echo $id ?>"/>
            <tr>
                <th><?php xigua_cards::l('topcolor')?></th>
                <td>
                    <span class="J_color_pick color_pick"><em style="background:<?php echo $v['topcolor'] ?>"></em></span>
                    <input name="row[topcolor]" type="hidden" class="J_hidden_color bgcolor" value="<?php echo $v['topcolor'] ?>">
                </td>
            </tr>
            <tr>
                <th><?php xigua_cards::l('showicon')?></th>
                <td>
                    <label for="randomid_25"><input type="radio" name="row[showicon]" id="randomid_25" <?php if($v['showicon'] == '1' ){echo 'checked ';}?>value="1"><?php xigua_cards::l('visible')?></label>
                    <label for="randomid_26"><input type="radio" name="row[showicon]" id="randomid_26" <?php if(!$v['showicon'] ){echo 'checked ';}?>value="0"><?php xigua_cards::l('invisible')?></label>
                </td>
            </tr>
            <tr>
                <th><?php xigua_cards::l('showkuo')?></th>
                <td>
                    <label for="randomid_27"><input type="radio" name="row[showkuo]" id="randomid_27" <?php if($v['showkuo'] == '1' ){echo 'checked ';}?>value="1"><?php xigua_cards::l('visible')?></label>
                    <label for="randomid_28"><input type="radio" name="row[showkuo]" id="randomid_28" <?php if(!$v['showkuo'] ){echo 'checked ';}?>value="0"><?php xigua_cards::l('invisible')?></label>
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
        dialog.height(500);
    });
</script>
</body></html>