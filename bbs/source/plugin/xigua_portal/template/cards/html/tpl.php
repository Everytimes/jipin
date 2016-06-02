<?php !defined('IN_DISCUZ') && exit('Access Denied');
include xp_display('header');
include xp_display('js');

$id     = $p['id'];
$v   = $p['value'];
$title = $p['modulename'] . ' ' . $id;

?>
<div class="form">
    <table class="table_purview">
        <tr>
            <th><?php echo lang('admincp', 'adv_edit_style_code_html')?></th>
            <td>
<form id="form" accept-charset="<?php echo CHARSET?>" action="<?php echo $actionsaveurl;?>" method="POST">
<input type="hidden" name="formhash" value="<?php echo FORMHASH?>" />
<input type="hidden" name="cid" value="<?php echo $id?>" />
    <textarea style="width:420px;height:150px;" name="row[adcode]"><?php echo $v['adcode']?></textarea>
</form>
            </td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td>
                <button class="button2 "><?php xigua_cards::l('save')?></button>
            </td>
        </tr>
    </table>
</div>

<script>
var dialog = top.dialog.get(window);
$(function () {
    dialog.title('<?php echo $title;?>');
    dialog.height(220);
});
</script>
</body>
</html>