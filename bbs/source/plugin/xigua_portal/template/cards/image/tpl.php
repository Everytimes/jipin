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
            <th><?php xigua_cards::l('title')?></th>
            <td>
                <span class="J_color_pick color_pick"><em style="background:<?php echo $v['title_color'] ?>"></em></span>
                <input name="row[title_color]" type="hidden" class="J_hidden_color bgcolor" value="<?php echo $v['title_color'] ?>">
                <input type="text" name="row[title]" class="mini" value="<?php echo $v['title']?>"  />
            </td>
        </tr>
        <tr>
            <th><?php xigua_cards::l('showthumb')?></th>
            <td>
                <label for="randomid_25"><input type="radio" name="row[thumb]" id="randomid_25" <?php if($v['thumb'] == '1' ){echo 'checked ';}?>value="1"><?php xigua_cards::l('yes')?></label>
                <label for="randomid_26"><input type="radio" name="row[thumb]" id="randomid_26" <?php if(!$v['thumb'] ){echo 'checked ';}?>value="0"><?php xigua_cards::l('no')?></label>
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
        dialog.height(370);
    });
</script>
</body></html>