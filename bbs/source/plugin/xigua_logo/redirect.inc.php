<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install.php 34718 2014-07-14 08:56:39Z nemohou $
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
if(!empty($_GET['url'])){
    $url = $_GET['url'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php echo CHARSET?>">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title></title>
</head>
<body>
<p style="line-height:50px;text-indent:10px">
    Redirecting...
</p>
<script type="text/javascript">
    window.location.href = '<?php echo $url?>';
</script>
</body>
</html>