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

$affiliate = unserialize($GLOBALS['_CFG']['affiliate']);
$smarty->assign('affiliate', $affiliate);

/*------------------------------------------------------ */
//-- INPUT
/*------------------------------------------------------ */

$goods_id = isset($_REQUEST['id'])  ? intval($_REQUEST['id']) : 0;

/*------------------------------------------------------ */
//-- 改变属性、数量时重新计算商品价格
/*------------------------------------------------------ */

if (!empty($_REQUEST['act']) && $_REQUEST['act'] == 'price')
{
    include('includes/cls_json.php');

    $json   = new JSON;
    $res    = array('err_msg' => '', 'result' => '', 'qty' => 1);

    $attr_id    = isset($_REQUEST['attr']) ? explode(',', $_REQUEST['attr']) : array();
    $number     = (isset($_REQUEST['number'])) ? intval($_REQUEST['number']) : 1;
	
	

    if ($goods_id == 0)
    {
        $res['err_msg'] = $_LANG['err_change_attr'];
        $res['err_no']  = 1;
		die($json->encode($res));
    }
    else
    {
		$limit_buy_bumber = $db->getOne("select limit_buy_bumber from ".$hhs->table('goods')." where goods_id='$goods_id'");
        if ($number == 0)
        {
            $res['qty'] = $number = 1;
        }
        else
        {
            $res['qty'] = $number;
        }
		if($number>$limit_buy_bumber&&$limit_buy_bumber>0)
		{
			
      	   $res['err_msg'] = '购买数量不可大于限购数量';
           $shop_price  = get_final_price($goods_id, $number, true, $attr_id);
           $res['result'] = price_format($shop_price * $number);
		   $res['number'] = $limit_buy_bumber;
		   die($json->encode($res)); 
		}
		else
		{
			$shop_price  = get_final_price($goods_id, $number, true, $attr_id);
			$res['result'] = price_format($shop_price * $number);
			die($json->encode($res)); 
		}
    }
	

  
}


if(!empty($_REQUEST['act']) && $_REQUEST['act'] =='save_location'){
    
	include_once('includes/cls_json.php');
	$json = new JSON();
	$result = array('error' => 0,'message'=>'', 'content' => '');
	
	$lat=$_REQUEST['lat'];
	$lng=$_REQUEST['lng'];
	$xaphp_sopenid=$_SESSION['xaphp_sopenid'];
	$sql="update ".$hhs->table('users')." set lat='$lat',lng='$lng' where openid='$xaphp_sopenid' ";
	$db->query($sql);
	//setcookie("lat",$lat);
	//setcookie("lng",$lng);
	die($json->encode($result));
	
}


/*------------------------------------------------------ */
//-- PROCESSOR
/*------------------------------------------------------ */

    $smarty->assign('image_width',  $_CFG['image_width']);
    $smarty->assign('image_height', $_CFG['image_height']);

    $smarty->assign('id',           $goods_id);
    $smarty->assign('type',         0);
    $smarty->assign('cfg',          $_CFG);

    /* 获得商品的信息 */
    $goods = get_goods_info($goods_id);
    $smarty->assign('d_team_num', $goods['team_num']-1);
    if ($goods === false)
    {
        /* 如果没有找到任何记录则跳回到首页 */
        hhs_header("Location: ./\n");
        exit;
    }
    else
    {
        

        $shop_price   = $goods['shop_price'];


        /* 购买该商品可以得到多少钱的优惠劵 */
    //    if ($goods['bonus_type_id'] > 0)
//        {
//            $time = gmtime();
//            $sql = "SELECT type_money FROM " . $hhs->table('bonus_type') .
//                    " WHERE type_id = '$goods[bonus_type_id]' " .
//                    " AND send_type = '" . SEND_BY_GOODS . "' " .
//                    " AND send_start_date <= '$time'" .
//                    " AND send_end_date >= '$time'";
//            $goods['bonus_money'] = floatval($db->getOne($sql));
//            if ($goods['bonus_money'] > 0)
//            {
//                $goods['bonus_money'] = price_format($goods['bonus_money']);
//            }
//        }

        $smarty->assign('goods',              $goods);
        $smarty->assign('goods_id',           $goods['goods_id']);
        $smarty->assign('promote_end_time',   $goods['gmt_end_time']);

        /* meta */


        /* current position */
        $smarty->assign('page_title',   $goods['goods_name']);                    // 页面标题

        $properties = get_goods_properties($goods_id);  // 获得商品的规格和属性

        $smarty->assign('properties',          $properties['pro']);                              // 商品属性
        $smarty->assign('specification',       $properties['spe']);                              // 商品规格
                                      // 关联商品
        $smarty->assign('pictures',            get_goods_gallery($goods_id));                    // 商品相册
     /**
     * 销量
     * @var string
     */
    $store_id = $goods['suppliers_id'];
    $sql = "SELECT sum(`sales_num`) FROM ".$hhs->table('goods')." WHERE `suppliers_id` = " .$store_id;
    $sales_num = $db->getOne($sql);
    $sql = "SELECT count(*) FROM  ".$hhs->table('order_goods')." as o,".$hhs->table('goods')." as g WHERE g.`goods_id` = o.`goods_id` and g.`suppliers_id` = " .$store_id;
    $sales_num += $db->getOne($sql);
    $smarty->assign('sales_num',$sales_num);



        assign_dynamic('goods');
        //$volume_price_list = get_volume_price_list($goods['goods_id'], '1');
       // $smarty->assign('volume_price_list',$volume_price_list);    // 商品优惠价格区间
    }



$sales_num = $goods['sales_num'];



if ($goods['suppliers_id']){
    $stores_info = get_suppliers_info($goods['suppliers_id']);
    $smarty->assign('stores_info',$stores_info);
    $smarty->assign('qq',$stores_info['qq']);
}
else{
    $smarty->assign('qq',$_CFG['qq']);
}



$smarty->assign('buy_num',get_buy_sum($goods_id)+$sales_num);

$smarty->assign('now_time',  gmtime());           // 当前系统时间

$timestamp=time();
$smarty->assign('timestamp', $timestamp );
$smarty->assign('appid', $appid);

$class_weixin=new class_weixin($appid,$appsecret);
$signature=$class_weixin->getSignature($timestamp);
$smarty->assign('signature', $signature);
//$smarty->assign('jssdk', jssdk($appid,$secret,$timestamp));
$smarty->assign('imgUrl','http://' . $_SERVER['HTTP_HOST'].'/'.$goods['goods_thumb'] );
$smarty->assign('title', $goods['goods_name']);
$smarty->assign('desc', mb_substr($_CFG['goods_share_dec'], 0,30,'utf-8')  );
/*
if(($pos=strrpos($_SERVER[REQUEST_URI], "from"))!==false){
	$uri=substr($_SERVER[REQUEST_URI],0,$pos-1);
}else{
    $uri=$_SERVER[REQUEST_URI];
}*/

$link="http://" . $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];

$smarty->assign('link', $link );
$smarty->assign('link2', urlencode($link) );


//查找附近的团
if($goods['is_nearby']){


    $sql="select oi.team_sign,oi.pay_time,g.goods_name,g.team_price,u.user_name,u.uname,u.headimgurl, (oi.team_num-oi.teammen_num ) as progress from ".$hhs->table("order_info")." as oi left join "
       .$hhs->table("goods")." as g on oi.extension_id=g.goods_id left join "
       .$hhs->table('users')." as u on oi.user_id=u.user_id where oi.team_first=1 and oi.team_status=1 and oi.pay_status=2 and oi.extension_code='team_goods' and oi.extension_id='$goods_id' ";
    $group_list=$db->getAll($sql);
    $time=gmtime();
    foreach($group_list as $k=>$v){
        $ctime=$group_list[$k]['pay_time']+$_CFG['team_suc_time']*24*3600-$time;
        if ($ctime < 0) {
            unset($group_list[$k]);
            continue;
        }
        $hour=intval($ctime/3600);
        
        $minu=intval(($ctime%3600)/60);
        $sec=intval(($ctime%3600)%60);
        $group_list[$k]['finish_str']="剩余 ".$hour."小时".$minu."分".$sec."秒结束";
    }
    $smarty->assign('group_list', $group_list );
}

if($goods['is_luck']){
    $smarty->assign('now', time() );
    // $smarty->display('goods_luck.dwt');
}else{
	// $smarty->display('goods.dwt');
}

// comments
$comments = assign_comment($goods_id,0,1);
$smarty->assign('comments', $comments['comments'] );
$smarty->assign('comments_nums', $comments['pager']['record_count'] );

// 
$sql = "select g.shop_price as goods_price,g.team_price,g.goods_name,g.goods_id,g.goods_img,c.rec_id from ".$hhs->table("goods")." as g LEFT JOIN ".$hhs->table("collect_goods")." as c ON  c.user_id='".$_SESSION['user_id']."' and c.goods_id=g.goods_id where g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 order by rand() limit 6";
// $sql = "select g.shop_price as goods_price,g.goods_name,g.goods_id,g.goods_img,c.rec_id from ".$hhs->table("goods")." as g,".$hhs->table("collect_goods")." as c where c.user_id='".$_SESSION['user_id']."' and c.goods_id=g.goods_id and g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 order by rand() limit 6";
$rands_goods = $db->getAll($sql);
    $smarty->assign('rands_goods', $rands_goods );


$liked = $db->getOne("select rec_id from ".$hhs->table("collect_goods")." where user_id='".$_SESSION['user_id']."'");
$liked = $liked ? 'liked' : '';
$smarty->assign('liked', $liked);

$smarty->assign('bonus_free_all',           isset($_REQUEST['bonus_free_all']) ? 1:0);
$smarty->display('goods.dwt');

/*------------------------------------------------------ */
//-- PRIVATE FUNCTION
/*------------------------------------------------------ */



/**
 * 获得商品选定的属性的附加总价格
 *
 * @param   integer     $goods_id
 * @param   array       $attr
 *
 * @return  void
 */
function get_attr_amount($goods_id, $attr)
{
    $sql = "SELECT SUM(attr_price) FROM " . $GLOBALS['hhs']->table('goods_attr') .
        " WHERE goods_id='$goods_id' AND " . db_create_in($attr, 'goods_attr_id');

    return $GLOBALS['db']->getOne($sql);
}
function get_buy_sum($goods_id)
{
    $sql = 'SELECT IFNULL(SUM(g.goods_number), 0) ' .
        'FROM ' . $GLOBALS['hhs']->table('order_info') . ' AS o, ' .
            $GLOBALS['hhs']->table('order_goods') . ' AS g ' .
        "WHERE o.order_id = g.order_id " .
        "AND o.order_status  in (0,1,5)  ".
        " AND o.shipping_status in (0,1,2) "  .
        " AND o.pay_status in (1,2) ".
        " AND g.goods_id = ".$goods_id;
    
    return $GLOBALS['db']->getOne($sql);
}
?>
