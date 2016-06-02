<?php if (!defined('IN_DISCUZ')) { exit('Access Denied'); } ?>
<?php include xp_display('header'); ?>
<div id="root">
    <ul class="wrap" id="wrap">
<?php
foreach ($cards as $id => $card) {
    if(!$card){
        continue;
    }
    if(!defined('IN_DIY') && getcookie('close_' . $card['id'])) {
        continue;
    }
        echo <<<TPL
<li class="card-mod $card[type]" id="$id" data-id="$card[id]">$card[html]</li>
TPL;
}
?>
</ul>
</div>
<?php include xp_display('footer'); ?>