<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

// Install
function moduleInstall(){
    global $_G,$moduleConfig;
    require_once libfile('function/plugin');
    
    $hookData = array();
    $hookData['hook_type'] = '6';
    $hookData['hook_script'] = './source/plugin/tom_weixin/module/hook/submenuHook.php';
    $hookData['obj_id'] = 'submenu';
    $hookData['obj_type'] = '1';
    C::t('#tom_weixin#tom_weixin_hook')->insert($hookData);
    
$sql = <<<EOF

DROP TABLE IF EXISTS `pre_tom_weixin_submenu`;
CREATE TABLE `pre_tom_weixin_submenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `picurl` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `paixu` int(11) DEFAULT NULL,
  `part1` varchar(255) DEFAULT NULL,
  `part2` varchar(255) DEFAULT NULL,
  `part3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

EOF;

    runquery($sql);
    
    return;
}

// Uninstall
function moduleUninstall(){
    global $_G,$moduleConfig;
    require_once libfile('function/plugin');
    
    C::t('#tom_weixin#tom_weixin_hook')->delete_by_obj_id_type("submenu","1");
    
$sql = <<<EOF

DROP TABLE IF EXISTS pre_tom_weixin_submenu;

EOF;

    runquery($sql);

    return;
}

// Upgrade
function moduleUpgrade(){
    global $_G,$moduleConfig,$moduleClass;
    require_once libfile('function/plugin');
    $moduleInfo = $moduleClass->getOneByModuleId('submenu');
    $updateData = array();
    $updateData['is_menu']   = 1;
    $moduleClass->update($moduleInfo['id'],$updateData);
    return;
}

?>
