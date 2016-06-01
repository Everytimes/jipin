<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once dirname(__FILE__).'/libs/env.class.php';

$imgfile = '/home/work/tmp/avatar.jpg';

$res = reprint_imgtool::save($imgfile, 'common', 0, 'reprint');


var_dump($res);
