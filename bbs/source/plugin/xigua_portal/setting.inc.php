<?php
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/2/15
 * Time: 16:39
 */
if(!defined('IN_DISCUZ') && !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
include dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php';
$config = xigua_cards::config();

$app_url = 'http://addon.discuz.com/?@xigua_portal.plugin';

showtableheader(
    xigua_cards::l('manager', 0) .
    '<a style="position:absolute;right:10px;color:red;font-weight:bold" href="'.$app_url.'">'.xigua_cards::l('card_more', 0).'</a>',
    '','style="position:relative"'
);
showtablerow('class="header"', array(), array(
    xigua_cards::l('card_name',0),
    xigua_cards::l('card_desc',0),
    xigua_cards::l('status',0),
));
foreach($config as $k => $v){
    showtablerow('', array(), array($v['modulename'], $v['introduce'],
        xigua_cards::l('installed',0),
    ));
}
showtablefooter();
