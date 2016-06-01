<?php

define('IN_HHS', true);
require(dirname(__FILE__) . '/includes/init.php');
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : null;
if($cid){
    $_SESSION['cid'] = $cid;
}
if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = true;
}


//分页获取
//code by luo
$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'default';

if($act == 'next')
{
    include('includes/cls_json.php');

    $json   = new JSON;
    $res    = array('err_msg' => '', 'result' => '');

    $page             = intval($_REQUEST['page']);
    $rows             = get_goodslist($page);

    $res['goodslist'] = $rows['goodslist'];
    $res['nextPage']  = $rows['nextPage'];

    header('Content-Type: application/json');
    echo $json->encode($res);
    exit();
}
/* 缓存编号 */
$cache_id = sprintf('%X', crc32($_SESSION['user_rank'] . '-' . $_CFG['lang']));

if (!$smarty->is_cached('index.dwt', $cache_id))
{
    $smarty->assign('page_title',$_CFG['shop_name']);    // 页面标题
    /* meta information */
    $smarty->assign('categories',  get_categories_tree()  ); // 分类树
    $res = get_goodslist();
    $smarty->assign('goods_list',    $res['goodslist']);   // 最新goods
    $smarty->assign('nextPage',    $res['nextPage']);   // 最新goods
    $smarty->assign('site_list',           get_sitelists());
    
    $smarty->assign('title', $_CFG['index_share_title']);
    $smarty->assign('desc', mb_substr($_CFG['index_share_dec'], 0,30,'utf-8')  );
    
    $link    = $hhs->url().substr(PHP_SELF, 1);

    $smarty->assign('link', $link);
    $smarty->assign('link2', urlencode($link) );
    $loading =$smarty->fetch('loading.html');
    $smarty->assign('loading',    $loading);
    $smarty->assign('playerdb',        get_flash_xml());
}

$smarty->assign('appid', $appid);
$timestamp=time();
$smarty->assign('timestamp', $timestamp );
$class_weixin=new class_weixin($appid,$appsecret);
$signature=$class_weixin->getSignature($timestamp);
$smarty->assign('signature', $signature);

$headimgurl = '';
if($_SESSION['user_id'])
{
    $sql        ="select headimgurl from ".$hhs->table('users')." where user_id=".$_SESSION['user_id'];
    $headimgurl =$db->getOne($sql);
}
$smarty->assign('imgUrl', $headimgurl );
$smarty->display('index.dwt');



function get_goodslist($page = 1)
{
    
	$where = "g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 ";
	//获得区域级别
	$current_region_type=get_region_type($_SESSION['cid']); 
	/* 禁用站点选择, 2016-3-18, WJJ
	if($current_region_type<=2){
	     $where.=" and (g.city_id='".$_SESSION['cid'] . "' or g.city_id=1) ";
	}elseif($current_region_type==3){
	    $where.=" and (g.district_id='".$_SESSION['cid'] . "' or g.city_id=1) ";
	} 
	*/

    $pageSize = 10;
    //统计页面总数
    $sql    = "select count(*) FROM ".$GLOBALS['hhs']->table('goods')." as g WHERE " . $where;
    $allNum = $GLOBALS['db']->getOne($sql);
    $pages  = ceil($allNum/$pageSize);
    //page 溢出
    $page   = $page<=$pages ? $page : $pages;
    $skip     = ($page - 1) * $pageSize;
	if($skip<0)
	{
		$skip=0;
	}
    $limit = " limit " . $skip . "," . $pageSize;
    $sql = 'SELECT g.goods_id, g.goods_name, g.ts_a, g.ts_b, g.ts_c, g.goods_number, g.suppliers_id, g.goods_name_style, g.market_price, g.shop_price AS shop_price, ' .
                " g.promote_price, g.goods_type, " .
                'g.promote_start_date, g.promote_end_date, g.goods_brief, g.goods_thumb , g.goods_img,g.little_img ' .
            ' ,g.team_num,g.team_price '.
            'FROM ' . $GLOBALS['hhs']->table('goods') . ' AS g ' .
         //   'LEFT JOIN ' . $GLOBALS['hhs']->table('member_price') . ' AS mp ' .
             //   "ON mp.goods_id = g.goods_id AND mp.user_rank = '$_SESSION[user_rank]' " .
            "WHERE $where ORDER BY g.sort_order, g.goods_id DESC" . $limit;
    $res = $GLOBALS['db']->getAll($sql);

    $arr = array();
    foreach ($res AS $idx => $row)
    {
        $arr[$idx]['goods_id']          = $row['goods_id'];
        $arr[$idx]['goods_name']        = $row['goods_name'];
		$arr[$idx]['ts_a']          = $row['ts_a'];
		$arr[$idx]['ts_b']          = $row['ts_b'];
		$arr[$idx]['ts_c']          = $row['ts_c'];
        $arr[$idx]['goods_brief']       = $row['goods_brief'];
		$arr[$idx]['goods_number']      = $row['goods_number'];
        
        $arr[$idx]['market_price']    = price_format($row['market_price'],false);
		$arr[$idx]['shop_price']    = price_format($row['shop_price'],false);
		
        $arr[$idx]['goods_thumb']      = get_image_path($row['goods_id'], $row['goods_thumb'], true);
        $arr[$idx]['goods_img']        = get_image_path($row['goods_id'], $row['goods_img']);
        $arr[$idx]['url']              = build_uri('goods', array('gid'=>$row['goods_id']), $row['goods_name']);
        $arr[$idx]['team_num']         = $row['team_num'];
        $arr[$idx]['team_price']       = price_format($row['team_price'],false);
        
        $arr[$idx]['team_discount']    = number_format($row['team_price']/$row['market_price']*10,1);
        $arr[$idx]['little_img']        = $row['little_img'];
        
        $arr[$idx]['logo'] = get_logo($row['suppliers_id']);

        $rec_id = $GLOBALS['db']->getOne("select rec_id from ".$GLOBALS['hhs']->table('collect_goods')." where user_id = '".$_SESSION['user_id']."' and `goods_id` = '".$row['goods_id']."' ");

        $arr[$idx]['like'] = $rec_id ? '' : 'un';

    }
    //下一页是否存在
    $res['nextPage']  = $page < $pages ? (++$page) : 0;
    $res['goodslist'] = $arr;
    //改写返回array
    return $res;

    // return $arr;
}

function get_logo($suppliers_id){
    if (empty($suppliers_id)) {
        return '';
    }
    return $GLOBALS['db']->getOne("select supp_logo from ".$GLOBALS['hhs']->table('suppliers')." where suppliers_id='$suppliers_id'");
}

function get_flash_xml($type = 1)
{
    $city_id = $_SESSION['cid'] ? $_SESSION['cid'] : 0;
    // $city_id = get_city_id();
    $flashdb = $GLOBALS['db']->getAll("select * from ".$GLOBALS['hhs']->table('ad')." where position_id='$type' and city_id in(0,'$city_id') order by order_sort");
	foreach($flashdb as $idx=>$v)
	{
		$flashdb[$idx]['url'] = $v['ad_link'];
		$flashdb[$idx]['src'] = '../data/afficheimg/'.$v['ad_code'];
		
	}

    return $flashdb;

}
?>
