<?php

define("IN_MOBILE", 1);
define("IN_MOBILE_API", 1);
define("PLUGIN_PATH", dirname(__FILE__));
define("LIB_PATH", PLUGIN_PATH."/libs");
chdir("../../../");


$modules = array (
    "crawl", "saveimg", "config",
    'threadlist', "postthread",
    'newthread', 'upload',
    'rthread',
    'typelist',
);

if(!in_array($_GET['module'], $modules)) {
    module_not_exists();
}
$module  = $_GET['module'];
$version = !empty($_GET['version']) ? intval($_GET['version']) : 1;
while ($version>=1) {
    $apifile = PLUGIN_PATH."/api/$version/$module.php";
    if(file_exists($apifile)) {
        require_once $apifile;
        exit(0);
    }
    --$version;    
}
module_not_exists();


function module_not_exists()
{
	header("Content-type: application/json");
    echo json_encode(array('error' => 'module_not_exists'));
    exit;
}


function real_escape_string($str)
{
    $len = strlen($str);
    if ($len==0) return $str;
    $res = "";
    for ($i=0; $i<$len; ++$i) {
        $c = $str[$i];
        if ($c=="\r") $c = "\\r";
        if ($c=="\n") $c = "\\n";
        if ($c=="\x00") $c = "\\0";
        if ($c=="\x1a") $c = "\\Z";
        if ($c=="'" || $c=='"' || $c=='\\') $res.="\\";
        $res.= $c; 
    }
    return $res;
}


function admin_check($adminids=array())
{
    try {

        if (!reprint_env::check_authrights()) {
            throw new Exception("抱歉，您没有权限执行此操作");
        }
    } catch (Exception $e) {
        $res = array(
            "retcode" => "1000070",
            "retmsg"  => $e->getMessage(),
        );
        echo json_encode($result);
        exit;
    }
}



?>
