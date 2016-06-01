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
            <th><?php xigua_cards::l('sliderheight')?></th>
            <td>
                <input type="number" class="mini" name="row[height]" value="<?php echo $v['height'] ? $v['height'] : '200'?>" /> px
            </td>
        </tr>
        <tr>
            <th><?php xigua_cards::l('showthumb')?></th>
            <td>
                <label for="randomid_25"><input type="radio" name="row[thumb]" id="randomid_25" <?php if($v['thumb'] == '1' ){echo 'checked ';}?>value="1"><?php xigua_cards::l('yes')?></label>
                <label for="randomid_26"><input type="radio" name="row[thumb]" id="randomid_26" <?php if(!$v['thumb'] ){echo 'checked ';}?>value="0"><?php xigua_cards::l('no')?></label>
            </td>
        </tr>
        <tr>
            <th><?php xigua_cards::l('pointer')?></th>
            <td>
                <label for="randomid_27">
                    <input type="radio" name="row[pointer]" id="randomid_27" <?php if($v['pointer'] == '1' ){echo 'checked ';}?>value="1"><?php xigua_cards::l('pointer_1')?>
                </label>
                <label for="randomid_28">
                    <input type="radio" name="row[pointer]" id="randomid_28" <?php if(!$v['pointer'] ){echo 'checked ';}?>value="0"><?php xigua_cards::l('pointer_2')?>
                </label>
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
        dialog.height(460);
    });
</script>
</body></html>