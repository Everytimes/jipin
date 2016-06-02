<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php echo CHARSET?>">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title><?php echo $title;?></title>
    <link href="source/plugin/xigua_member/images/xigua.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div style="padding:10px;">
    <?php echo sprintf(xul('please_login', 0), $_G['wechat']['setting']['wsq_allow'] ? "http://wsq.discuz.qq.com/?c=index&a=profile&f=wx&siteid=$siteid&login=yes" : $_G['siteurl'].'member.php?mod=logging&action=login&mobile=2')?>
</div>
<script type="text/javascript" src="http://wsq.discuz.qq.com/cdn/discuz/js/openjs.js"></script>
<script type="text/javascript">
    WSQ.showBtmBar();
    WSQ.initPlugin({name:'<?php echo $title?>'});
</script>
</body>
</html>