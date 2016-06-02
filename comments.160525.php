<?php

/**
 * 昊海电商 商品详情
 * ============================================================================
 * * 版权所有 2012-2014 西安昊海网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.xaphp.cn；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: pangbin $
 * $Id: goods.php 17217 2014-05-12 06:29:08Z pangbin $
*/

define('IN_HHS', true);

require(dirname(__FILE__) . '/includes/init.php');

if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = true;
}

/*------------------------------------------------------ */
//-- INPUT
/*------------------------------------------------------ */

$goods_id = isset($_REQUEST['id'])  ? intval($_REQUEST['id']) : 0;


    $smarty->assign('id',           $goods_id);
    $smarty->assign('type',         0);
    $smarty->assign('cfg',          $_CFG);

    if ($goods === false)
    {
        /* 如果没有找到任何记录则跳回到首页 */
        hhs_header("Location: ./\n");
        exit;
    }
    else
    {

        $smarty->assign('goods',              $goods);
        $smarty->assign('goods_id',           $goods['goods_id']);
        $smarty->assign('page_title',   $goods['goods_name']); 
    }



$smarty->assign('now_time',  gmtime());           // 当前系统时间

$timestamp=time();
$smarty->assign('timestamp', $timestamp );
$smarty->assign('appid', $appid);

$class_weixin=new class_weixin($appid,$appsecret);
$signature=$class_weixin->getSignature($timestamp);
$smarty->assign('signature', $signature);
$smarty->assign('imgUrl','http://' . $_SERVER['HTTP_HOST'].'/'.$goods['goods_thumb'] );
$smarty->assign('title', $goods['goods_name']);
$smarty->assign('desc', mb_substr($_CFG['goods_share_dec'], 0,30,'utf-8')  );

$link="http://" . $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];

$smarty->assign('link', $link );
$smarty->assign('link2', urlencode($link) );


// comments
$comments = assign_comment($goods_id,0,1);

$smarty->assign('comments', $comments['comments'] );



$smarty->display('comments.dwt');

?>
