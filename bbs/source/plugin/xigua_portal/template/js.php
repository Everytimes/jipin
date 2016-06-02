<?php if (!defined('IN_DISCUZ')) { exit('Access Denied'); } ?>
<link href="source/plugin/xigua_portal/static/css/form.css" rel="stylesheet">
<link href="source/plugin/xigua_portal/static/js/colorPicker/colorPicker.css" rel="stylesheet">
<style type="text/css">
html,body{background:#fff}
</style>
<script type="text/javascript">
var actionurl = '<?php echo $actionurl?>',
    FORMHASH = '<?php echo  FORMHASH?>',
    advance_color = '<?php xigua_cards::l('advance_color')?>',
    default_color = '<?php xigua_cards::l('default_color')?>',
    error_color = '<?php xigua_cards::l('error_color')?>',
    deal = '<?php xigua_cards::l('deal')?>';
</script>
<script src="source/plugin/xigua_portal/static/js/art/lib/jquery-1.10.2.js"></script>
<script src="source/plugin/xigua_portal/static/js/ajaxfileupload.js"></script>
<script src="source/plugin/xigua_portal/static/js/diy.js?20150603"></script>
<script src="source/plugin/xigua_portal/static/js/colorPicker/colorPicker.js"></script>