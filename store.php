<?php

/**
 * 昊海电商 商品分类
 * ============================================================================
 * * 版权所有 2012-2014 西安昊海网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.xaphp.cn；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: pangbin $
 * $Id: category.php 17217 2014-05-12 06:29:08Z pangbin $
*/

define('IN_HHS', true);

require(dirname(__FILE__) . '/includes/init.php');

if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = false;
}

if (!empty($_REQUEST['id']))
{
    $store_id = trim($_REQUEST['id']);
}
else
{
    hhs_header("Location: ./\n");
    exit;
}





    $position = assign_ur_here($cat_id, $brand_name);
    $smarty->assign('page_title',       $position['title']);    // 页面标题
    $smarty->assign('ur_here',          $position['ur_here']);  // 当前位置

	
	$sql = "select * from ".$hhs->table('supp_photo')." where is_check = 1 AND supp_id = ".$store_id;
	$supp_photo = $db->getAll($sql);
    $smarty->assign('supp_photo',$supp_photo);

    /**
     * 销量
     * @var string
     */
    $sql = "SELECT sum(`sales_num`) FROM ".$hhs->table('goods')." WHERE `suppliers_id` = " .$store_id;
    $sales_num = $db->getOne($sql);
    $sql = "SELECT count(*) FROM  ".$hhs->table('order_goods')." as o,".$hhs->table('goods')." as g WHERE g.`goods_id` = o.`goods_id` and g.`suppliers_id` = " .$store_id;
    $sales_num += $db->getOne($sql);
	$smarty->assign('sales_num',$sales_num);



	$stores_info = get_suppliers_info($store_id);
	$smarty->assign('stores_info',       $stores_info);
	

    $goodslist = get_store_goods($store_id);
    $smarty->assign('goods_list',       $goodslist);

	assign_dynamic('store'); // 动态内容

    $timestamp=time();
    $smarty->assign('timestamp', $timestamp );
    $smarty->assign('appid', $appid);

    $class_weixin=new class_weixin($appid,$appsecret);
    $signature=$class_weixin->getSignature($timestamp);
    $smarty->assign('signature', $signature);
    
    //$smarty->assign('imgUrl',$info['headimgurl'] );
    $smarty->assign('title', $stores_info['suppliers_name'].'的店铺');
    $smarty->assign('desc', $_CFG['store_share_desc']  );

    $link= $hhs->url().substr($_SERVER['PHP_SELF'], 1).'?id='.$store_id;

    $smarty->assign('link', $link );
    $smarty->assign('link2', urlencode($link) );
    $smarty->assign('root', $hhs->url() );
    
$smarty->display('store.dwt');



/**
 * 获得分类下的商品
 *
 * @access  public
 * @param   string  $children
 * @return  array
 */
function get_store_goods($store_id)
{
    $where = "g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 AND g.suppliers_id = ".$store_id;


    /* 获得商品列表 */
    $sql = 'SELECT g.goods_id, g.goods_name, g.ts_a, g.ts_b, g.ts_c,g.goods_number,g.little_img, g.sales_num, g.goods_name_style, g.market_price, g.is_new, g.is_best, g.is_hot, g.shop_price, ' .
                "g.promote_price, g.goods_type, " .
                'g.promote_start_date, g.promote_end_date, g.goods_brief, g.goods_thumb , g.goods_img ' .
				' ,g.team_num,g.team_price '.
            'FROM ' . $GLOBALS['hhs']->table('goods') . ' AS g ' .
            "WHERE $where ORDER BY sort_order ";
    $goods_list = $GLOBALS['db']->getAll($sql);
	
	foreach($goods_list as $key=>$row)
	{
        $goods_list[$key]['goods_id']         = $row['goods_id'];
        $goods_list[$key]['name']             = $row['goods_name'];
		$goods_list[$key]['ts_a']             = $row['ts_a'];
		$goods_list[$key]['ts_b']             = $row['ts_b'];
		$goods_list[$key]['ts_c']             = $row['ts_c'];
		
		$goods_list[$key]['little_img']             = $row['little_img'];
		
        $goods_list[$key]['goods_number']             = $row['goods_number'];
        $goods_list[$key]['goods_brief']      = $row['goods_brief'];
        $goods_list[$key]['goods_style_name'] = add_style($row['goods_name'],$row['goods_name_style']);
        $goods_list[$key]['market_price']     = price_format($row['market_price']);
        $goods_list[$key]['shop_price']       = price_format($row['shop_price']);
        $goods_list[$key]['type']             = $row['goods_type'];
        $goods_list[$key]['promote_price']    = ($promote_price > 0) ? price_format($promote_price) : '';
        $goods_list[$key]['goods_thumb']      = get_image_path($row['goods_id'], $row['goods_thumb'], true);
        $goods_list[$key]['goods_img']        = get_image_path($row['goods_id'], $row['goods_img']);
        $goods_list[$key]['url']              = build_uri('goods', array('gid'=>$row['goods_id']), $row['goods_name']);
		$goods_list[$key]['team_num']    = $row['team_num'];
        $goods_list[$key]['team_price']    = price_format($row['team_price'],false);
        $goods_list[$key]['team_discount']    = number_format($row['team_price']/$row['shop_price']*10,1);
	}
    return $goods_list;

}

?>
