<?php
define('IN_HHS', true);
require(dirname(__FILE__) . '/includes/init.php');


/* 缓存编号 */
$cache_id = sprintf('%X', crc32($_SESSION['user_rank'] . '-' . $_CFG['lang']));
$action  = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'hot';

    assign_template();

    $position = assign_ur_here();
    $smarty->assign('page_title',      $position['title']);    // 页面标题
    $smarty->assign('ur_here',         $position['ur_here']);  // 当前位置
    $smarty->assign('categories',      get_categories_tree()); // 分类树 
    /* meta information */
    $smarty->assign('keywords',        htmlspecialchars($_CFG['shop_keywords']));
    $smarty->assign('description',     htmlspecialchars($_CFG['shop_desc']));
	$smarty->assign('action',     $action);
 




$loading=$smarty->fetch('loading.html');
$smarty->assign('loading',    $loading);
if ($action == 'hot')
{
	$smarty->assign('goods_list',    get_goodslist('hot'));
	$smarty->display('rank.dwt');
}
if ($action == 'new')
{
	$smarty->assign('goods_list',    get_goodslist('new'));
	$smarty->display('rank.dwt');
}
if ($action == 'best')
{
	$smarty->assign('goods_list',    get_goodslist('best'));
	$smarty->display('rank.dwt');
}



function get_goodslist($type)
{
	$where = "g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 AND g.is_".$type."";
    $sql = 'SELECT g.sales_num,g.goods_id,g.goods_number, g.goods_name, g.little_img, g.goods_name_style, g.market_price, g.shop_price AS org_price, ' .
                "IFNULL(mp.user_price, g.shop_price * '$_SESSION[discount]') AS shop_price, g.promote_price, g.goods_type, " .
                'g.promote_start_date, g.promote_end_date, g.goods_brief, g.goods_thumb , g.goods_img,g.little_img ' .
            ' ,g.team_num,g.team_price '.
            'FROM ' . $GLOBALS['hhs']->table('goods') . ' AS g ' .
            'LEFT JOIN ' . $GLOBALS['hhs']->table('member_price') . ' AS mp ' .
                "ON mp.goods_id = g.goods_id AND mp.user_rank = '$_SESSION[user_rank]' " .
            "WHERE $where ORDER BY g.sort_order, g.goods_id";
    $res = $GLOBALS['db']->getAll($sql);

    $arr = array();
    foreach ($res AS $idx => $row)
    {
        $arr[$idx]['goods_name']          = $row['goods_name'];
        $arr[$idx]['goods_brief']       = $row['goods_brief'];
        $arr[$idx]['goods_number']          = $row['goods_number'];
        $arr[$idx]['market_price']    = price_format($row['market_price'],false);
		$arr[$idx]['shop_price']    = price_format($row['shop_price'],false);
		
        $arr[$idx]['goods_thumb']      = get_image_path($row['goods_id'], $row['goods_thumb'], true);
		$arr[$idx]['little_img']      = get_image_path($row['goods_id'], $row['little_img'], true);
        $arr[$idx]['goods_img']        = get_image_path($row['goods_id'], $row['goods_img']);
        $arr[$idx]['url']              = build_uri('goods', array('gid'=>$row['goods_id']), $row['goods_name']);
        $arr[$idx]['team_num']    = $row['team_num'];
        $arr[$idx]['team_price']    = price_format($row['team_price'],false);
        
        $arr[$idx]['team_discount']    = @number_format($row['team_price']/$row['market_price']*10,1);

        
        $arr[$idx]['buy_nums']    = $row['sales_num'];
        $arr[$idx]['buy_nums']    += $GLOBALS['db']->getOne("select sum(goods_number) from ".$GLOBALS['hhs']->table('order_goods')." where goods_id = '".$row['goods_id']."'");
    }

    return $arr;
}


?>
