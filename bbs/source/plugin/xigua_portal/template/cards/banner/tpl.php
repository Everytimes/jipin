<?php !defined('IN_DISCUZ') && exit('Access Denied');
include xp_display('header');
include xp_display('js');

$id     = $p['id'];
$link   = $p['value']['link'];
$cookiexpire = intval($p['value']['cookiexpire']);
$bg     = $p['value']['bg'];
$img    = $bg ?'<img src="'.$bg.'" />':'';
$check1 = $p['value']['close']?'checked':'';
$check2 = $p['value']['close']?'':'checked';
$title  = $p['modulename'].' '. $id;

?>
<div class="form">
    <table class="table_purview">
        <tr>
            <th><?php xigua_cards::l('upload_image')?></th>
            <td valign="middle">
            <form action="" method="POST" enctype="multipart/form-data">
                <button class="button2 abs"><?php xigua_cards::l('upload')?></button>
                <input name="xiguafile" id="xiguafile" class="file" type="file" onchange="return ajaxFileUpload();" />
                <div class="cl">
                    <span id="ajaxloading">
                        <img id="ajaxloading-img" src="source/plugin/xigua_portal/static/images/loading.gif" />
                    </span>
                    <span id="ajaxtip2"><?php echo $img ?></span>
                    <span id="ajaxtip1"></span>
                    <?php if($img){?><a class="delbg">X</a><?php }?>
                </div>
            </form>
            </td>
        </tr>
        <form id="form" accept-charset="<?php echo CHARSET?>" action="<?php echo $actionsaveurl;?>" method="POST">
        <tr>
            <th><?php xigua_cards::l('link')?></th>
            <td>
                <input type="text" name="row[link]" value="<?php echo $link?>" />
            </td>
        </tr>
        <tr>
            <th><?php xigua_cards::l('display_close')?></th>
            <td>
                <input type="hidden" name="formhash" value="<?php echo FORMHASH?>" />
                <label><input class="radio" type="radio" name="row[close]" value="1" <?php echo $check1?> /> <?php xigua_cards::l('visible')?></label>
                <label class="mr10">
                    <?php xigua_cards::l('cookiexpire')?>
                    <input class="short" type="text" name="row[cookiexpire]" value="<?php echo $cookiexpire?>" />
                    <?php xigua_cards::l('sec')?>
                </label>
                <label><input class="radio" type="radio" name="row[close]" value="0" <?php echo $check2?> /> <?php xigua_cards::l('invisible')?></label>
                <input type="hidden" id="bg" name="row[bg]" value="<?php echo $bg?>" />
                <input type="hidden" name="cid" value="<?php echo $id?>" />
            </td>
        </tr>
        </form>
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
    dialog.height(250);
});
</script>
</body>
</html>