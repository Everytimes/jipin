<?php
if (!defined('IN_MOBILE_API')) {
    exit('Access Denied');
}
require './source/class/class_core.php';
$discuz = C::app();
$discuz->init();
require_once dirname(__FILE__)."/../../libs/env.class.php";
admin_check();
$typelist = array();
$fid = isset($_REQUEST['fid']) ? intval($_REQUEST['fid']) : 0;
if ($fid!=0) {
     $list = C::t('forum_threadclass')->fetch_all_by_fid($fid);
     if (!empty($list)) {
         foreach ($list as $item) {
             $typelist[] = array(
                 'typeid' => $item['typeid'],
                 'name'   => reprint_utils::piconv(CHARSET, 'UTF-8//ignore',$item['name']),
             );
         }
     }
}

$res = array(
    'typelist' => $typelist,
);
reprint_env::result($res);
